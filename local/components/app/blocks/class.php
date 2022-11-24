<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;

class AppEditorBlocksComponent extends CBitrixComponent
{
    protected $preparedBlocks = array();
    protected $includedBlocks = 0;
    protected $layoutIndex = 0;
    protected $resourcesCache = array();

    public function onPrepareComponentParams($arParams) {
        $arParams['USE_JQUERY'] = (!empty($arParams['USE_JQUERY']) && $arParams['USE_JQUERY'] == 'Y') ? 'Y' : 'N';
        $arParams['USE_FANCYBOX'] = (!empty($arParams['USE_FANCYBOX']) && $arParams['USE_FANCYBOX'] == 'Y') ? 'Y' : 'N';
        return $arParams;
    }

    public function executeComponent() {
        if (!\CModule::IncludeModule('landing.editor')) {
            return 0;
        }

        $this->arParams['TEMPLATE_NAME'] = $this->getTemplateName();
        if (empty($this->arParams['TEMPLATE_NAME'])) {
            $this->arParams['TEMPLATE_NAME'] = '.default';
        }

        if (!empty($this->arParams['JSON'])) {
            $this->outJson($this->arParams['~JSON']);

        } elseif (!empty($this->arParams['IBLOCK_ID']) && !empty($this->arParams['ELEMENT_ID'])) {
            $this->outIblockElement();

        } elseif (!empty($this->arParams['IBLOCK_ID']) && !empty($this->arParams['SECTION_ID'])) {
            $this->outIblockSection();
        }

        return $this->includedBlocks;
    }


    protected function outIblockElement() {
        \CModule::IncludeModule("iblock");

        $aPropertyCodes = array();
        if (empty($this->arParams['PROPERTY_CODE'])) {
            $dbRes = \CIBlockProperty::GetList(array('SORT' => 'ASC'), array(
                'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
                'CHECK_PERMISSIONS' => 'N',
                'USER_TYPE' => 'landing_editor',
            ));
            while ($aProp = $dbRes->Fetch()) {
                $aPropertyCodes[] = 'PROPERTY_' . $aProp['CODE'];
            }


        } else {
            $aPropertyCodes[] = 'PROPERTY_' . $this->arParams['PROPERTY_CODE'];
        }

        if (empty($aPropertyCodes)) {
            return false;
        }

        $aSelect = array_merge(array(
            'ID',
            'IBLOCK_ID',
            'NAME',
            'CODE',
            'SORT',
			'ACTIVE_FROM'
        ), $aPropertyCodes);

        /** @noinspection PhpDynamicAsStaticMethodCallInspection */
        $aItem = \CIBlockElement::GetList(array('SORT' => 'ASC'), array(
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            'ID' => $this->arParams['ELEMENT_ID'],
        ), false, array('nTopCount' => 1), $aSelect)->Fetch();
        foreach ($aPropertyCodes as $propertyCode) {
            if (!empty($aItem[$propertyCode . '_VALUE'])) {
                $this->outJson($aItem[$propertyCode . '_VALUE']);
            }
        }

        return true;
    }

    protected function outIblockSection() {
        \CModule::IncludeModule("iblock");

        $aPropertyCodes = array();
        if (empty($this->arParams['PROPERTY_CODE'])) {
            //todo: получить все пользовательские поля с редактором если явно не указано
            return false;
        } else {
            $aPropertyCodes[] = $this->arParams['PROPERTY_CODE'];
        }

        if (empty($aPropertyCodes)) {
            return false;
        }

        $aSelect = array_merge(array(
            'ID',
            'IBLOCK_ID',
            'NAME',
            'CODE',
            'SORT',
        ), $aPropertyCodes);

        /** @noinspection PhpDynamicAsStaticMethodCallInspection */
        $aItem = \CIBlockSection::GetList(array('SORT' => 'ASC'), array(
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            'ID' => $this->arParams['SECTION_ID'],
        ), false, $aSelect, array('nTopCount' => 1))->Fetch();

        foreach ($aPropertyCodes as $propertyCode) {
            if (!empty($aItem[$propertyCode])) {
                $this->outJson($aItem[$propertyCode]);
            }
        }

        return true;
    }

    protected function prepareValue($value) {
        $value = json_decode(App\Editor\Locale::convertToUtf8IfNeed($value), true);
        $value = App\Editor\Locale::convertToWin1251IfNeed($value);
        $value = (json_last_error() == JSON_ERROR_NONE) ? $value : array();
        if (!empty($value) && !isset($value['layouts'])) {
            foreach ($value as $index => $block) {
                $block['layout'] = '0,0';
                $value[$index] = $block;
            }

            $value = array(
                'blocks' => $value,
                'layouts' => array(
                    array(''),
                )
            );
        }

        return $value;
    }

    protected function prepareBlocks($blocks) {
        $this->preparedBlocks = array();

        foreach ($blocks as $block) {
            $pos = $block['layout'];

            if (!isset($this->preparedBlocks[$pos])) {
                $this->preparedBlocks[$pos] = array();
            }

            $this->preparedBlocks[$pos][] = $block;
        }
    }

    protected function outJson($value) {

        $value = $this->prepareValue($value);

        $events = GetModuleEvents("landing.editor", "OnBeforeShowComponentBlocks", true);
        foreach ($events as $aEvent) {
            ExecuteModuleEventEx($aEvent, array(&$value['blocks'], &$value['layouts']));
        }
		$this->includeHeader($value['blocks'], $this->arParams);
		$this->prepareBlocks($value['blocks']);
		$this->layoutIndex = 0;
        foreach ($value['layouts'] as $columns) {
            $this->includeLayout($columns);
        }

        $this->includeFooter($this->arParams);

    }

    public function includeLayoutBlocks($columnIndex) {
        $pos = $this->layoutIndex . ',' . $columnIndex;
        if (isset($this->preparedBlocks[$pos])) {
            foreach ($this->preparedBlocks[$pos] as $block) {
                $this->includeBlock($block);
            }
        }
    }

    protected function registerJs($path) {
        if (empty($path)) {
            return false;
        }

        Asset::getInstance()->addJs($path);
        if ($this->getParent()) {
            $this->getParent()->addChildJS($path);
        }
    }

    protected function registerCss($path) {
        if (empty($path)) {
            return false;
        }

        Asset::getInstance()->addCss($path);
        if ($this->getParent()) {
            $this->getParent()->addChildCSS($path);
        }
    }

    protected function includeBlock($block) {
        $root = \App\Editor\Module::getDocRoot();

        $path = $this->findResource($block['name']);

        if (!$path) {
            $path = $this->findResource('dump');
        }

        if (!$path) {
            return false;
        }

		if ($pathCss = $this->getCssPath($path)) {
			$this->registerCss($pathCss);
		}

        /** @noinspection PhpIncludeInspection */
        include($root . $path);

        $this->includedBlocks++;

        return true;

    }

    protected function includeLayout($columns) {
        $root = \App\Editor\Module::getDocRoot();
        $path = $this->findResource('_layout');
        if (!$path) {
            return false;
        }

        /** @noinspection PhpIncludeInspection */
        include($root . $path);

        $this->layoutIndex++;

        return true;
    }

    protected function includeHeader(&$blocks, $arParams) {
        $root = \App\Editor\Module::getDocRoot();
        $path = $this->findResource('_header');
        if (!$path) {
            return false;
        }

        /** @noinspection PhpIncludeInspection */
        include($root . $path);
        return true;
    }

    protected function includeFooter($arParams) {
        $root = \App\Editor\Module::getDocRoot();
        $path = $this->findResource('_footer');
        if (!$path) {
            return false;
        }

        /** @noinspection PhpIncludeInspection */
        include($root . $path);
        return true;
    }

    protected function findResource($resName) {
        $templateName = $this->arParams['TEMPLATE_NAME'];
        $root = \App\Editor\Module::getDocRoot();

        $uniq = $templateName . $resName;

        if (isset($this->resourcesCache[$uniq])) {
            return $this->resourcesCache[$uniq];
        }

        $paths = array(
			SITE_TEMPLATE_PATH . '/components/landing.editor/blocks/' . $templateName . '/' . $resName . '/index.php',
			SITE_TEMPLATE_PATH . '/components/landing.editor/blocks/.default/' . $resName . '/index.php',

			'/local/templates/.default/components/landing.editor/blocks/' . $templateName . '/' . $resName . '/index.php',
			'/bitrix/templates/.default/components/landing.editor/blocks/' . $templateName . '/' . $resName . '/index.php',

			'/local/templates/.default/components/landing.editor/blocks/.default/' . $resName . '/index.php',
			'/bitrix/templates/.default/components/landing.editor/blocks/.default/' . $resName . '/index.php',

			'/local/components/landing.editor/blocks/templates/' . $templateName . '/' . $resName . '/index.php',
			'/bitrix/components/landing.editor/blocks/templates/' . $templateName . '/' . $resName . '/index.php',

			'/local/components/landing.editor/blocks/templates/.default/' . $resName . '/index.php',
			'/bitrix/components/landing.editor/blocks/templates/.default/' . $resName . '/index.php',

            SITE_TEMPLATE_PATH . '/components/landing.editor/blocks/' . $templateName . '/' . $resName . '.php',
            SITE_TEMPLATE_PATH . '/components/landing.editor/blocks/.default/' . $resName . '.php',

            '/local/templates/.default/components/landing.editor/blocks/' . $templateName . '/' . $resName . '.php',
            '/bitrix/templates/.default/components/landing.editor/blocks/' . $templateName . '/' . $resName . '.php',

            '/local/templates/.default/components/landing.editor/blocks/.default/' . $resName . '.php',
            '/bitrix/templates/.default/components/landing.editor/blocks/.default/' . $resName . '.php',

            '/local/components/landing.editor/blocks/templates/' . $templateName . '/' . $resName . '.php',
            '/bitrix/components/landing.editor/blocks/templates/' . $templateName . '/' . $resName . '.php',

            '/local/components/landing.editor/blocks/templates/.default/' . $resName . '.php',
            '/bitrix/components/landing.editor/blocks/templates/.default/' . $resName . '.php',
        );

        foreach ($paths as $path) {
            if (is_file($root . $path)) {
                $this->resourcesCache[$uniq] = $path;
                return $path;
            }
        }

        return false;
    }

    function getCssPath($path) {
		$root = \App\Editor\Module::getDocRoot();
		$pathCss = str_replace('index.php', 'style.css', $path);
		if (is_file($root . $pathCss)) {
			return $pathCss;
		}
		return false;
	}

}
