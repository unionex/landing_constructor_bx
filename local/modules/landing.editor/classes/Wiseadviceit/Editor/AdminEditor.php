<?php


namespace App\Editor;

use Bitrix\Main\Application;
use Bitrix\Main\Page\Asset;


class AdminEditor
{

    protected static $initCounts = 0;

    protected static $css = array();
    protected static $js = array();

    protected static $parameters = array();
    protected static $templates = array();

    protected static $selectValues = array();

    public static function init($params) {
        self::$initCounts++;

        if (self::$initCounts == 1) {

            self::registerBlocks('blocks');
            self::registerBlocks('my');
            self::registerLayouts();

            self::registerAssets();
        }

        $params = array_merge(array(
            'uniqId' => '',
            'value' => '',
            'inputName' => '',
            'defaultValue' => '',
            'userSettings' => ''
        ), $params);

        $value = self::prepareValue($params['value']);
        if (empty($value)) {
            $value = self::prepareValue($params['defaultValue']);
        }

        $events = GetModuleEvents("landing.editor", "OnBeforeShowEditorBlocks", true);
        foreach ($events as $aEvent) {
            ExecuteModuleEventEx($aEvent, array(&$value['blocks']));
        }

        $enableChange = 0;
        if (empty($params['userSettings']['DISABLE_CHANGE'])) {
            $enableChange = 1;
        }

        $showSortButtons = 1;
        if (empty($params['userSettings']['ENABLE_SORT_BUTTONS'])) {
            $showSortButtons = 0;
        }

        $userSettings = array();
        if (!empty($params['userSettings']['SETTINGS_NAME'])) {
            $userSettings = self::loadSettings($params['userSettings']['SETTINGS_NAME']);
        }

        return self::renderFile(Module::getModuleDir() . '/templates/admin_editor.php', array(
            'jsonValue' => json_encode(Locale::convertToUtf8IfNeed($value)),
            'selectValues' => self::$selectValues,
            'jsonTemplates' => json_encode(Locale::convertToUtf8IfNeed(self::$templates)),
            'jsonParameters' => json_encode(Locale::convertToUtf8IfNeed(self::$parameters)),
            'jsonUserSettings' => json_encode(Locale::convertToUtf8IfNeed($userSettings)),
            'showSortButtons' => $showSortButtons,
            'enableChange' => $enableChange,
            'inputName' => $params['inputName'],
            'uniqId' => $params['uniqId'],
            'firstRun' => (self::$initCounts == 1) ? 1 : 0,
        ));
    }

    protected static function loadSettings($settingsName) {
        $path = Module::getDocRoot() . '/local/modules/landing.editor/admin/settings/';
        $settingsFile = $path . $settingsName . '.php';

        $settings = array();
        if ($settingsName && is_file($settingsFile)) {
            include $settingsFile;
        }

        $settings = array_merge(array(
            'title' => $settingsName,
            'enable_blocks' => array(),
            'layout_classes' => array(),
            'block_settings' => array(),
        ), $settings);

        return $settings;
    }

    public static function getUserSettingsFiles() {
        $path = Module::getDocRoot() . '/local/modules/landing.editor/admin/settings/';
        $directory = new \DirectoryIterator($path);
        $result = array('' => GetMessage('WAIT_EDITOR_SETTINGS_NAME_NO'));
        foreach ($directory as $item) {
            if ($item->isFile() && $item->getExtension() == 'php') {
                $settingsName = $item->getBasename('.php');
                $settings = self::loadSettings($settingsName);
                $result[$settingsName] = $settings['title'];
            }
        }
        return Locale::convertToWin1251IfNeed($result);
    }

    public static function prepareValue($value) {
        $value = !empty($value) && is_string($value) ? $value : '[]';
        $value = json_decode(Locale::convertToUtf8IfNeed($value), true);
        $value = (json_last_error() == JSON_ERROR_NONE && is_array($value)) ? $value : array();

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

    public static function getSearchIndex($jsonValue) {
        $value = AdminEditor::prepareValue($jsonValue);
        $search = '';
        foreach ($value['blocks'] as $key => $val) {
            if ($val['name'] == 'text' && !empty($val['value'])) {
                $search .= ' ' . $val['value'];
            }
            if ($val['name'] == 'htag' && !empty($val['value'])) {
                $search .= ' ' . $val['value'];
            }
        }
        return $search;
    }

    protected static function registerAssets() {
        global $APPLICATION;
        $asset = Asset::getInstance();


        if (Module::getDbOption('load_jquery') == 'yes') {
            $asset->addJs('/local/modules/landing.editor/admin/assets/jquery-1.11.1.min.js');
        } else {
            \CUtil::InitJSCore(Array("jquery"));
        }

        \CUtil::InitJSCore(array('translit'));

        if (Module::getDbOption('load_jquery_ui') == 'yes') {
            $asset->addJs('/local/modules/landing.editor/admin/assets/jquery-ui-1.12.1.custom/jquery-ui.min.js');
        }

        if (Module::getDbOption('load_dotjs') == 'yes') {
            $asset->addJs('/local/modules/landing.editor/admin/assets/doT-master/doT.min.js');

        }

        $APPLICATION->SetAdditionalCSS('/local/modules/landing.editor/admin/assets/trumbowyg/ui/trumbowyg.min.css');
        $APPLICATION->SetAdditionalCSS('/local/modules/landing.editor/admin/assets/trumbowyg/ui/trumbowyg.custom.css');
		$asset->addJs('/local/modules/landing.editor/admin/assets/trumbowyg/trumbowyg.js');

		/* tinymce */
//		$APPLICATION->SetAdditionalCSS('/local/modules/landing.editor/admin/assets/trumbowyg/ui/trumbowyg.min.css');
//		$APPLICATION->SetAdditionalCSS('/local/modules/landing.editor/admin/assets/trumbowyg/ui/trumbowyg.custom.css');
		$asset->addJs('/local/modules/landing.editor/admin/assets/tinymce/tinymce.min.js');

		/* table Trumbowyg plugin */
		$asset->addJs('/local/modules/landing.editor/admin/assets/trumbowyg/plugins/table/trumbowyg.table.js');
		$APPLICATION->SetAdditionalCSS('/local/modules/landing.editor/admin/assets/trumbowyg/plugins/table/ui/sass/trumbowyg.table.css');

        /* Tooltip Trumbowyg plugin */
		$APPLICATION->SetAdditionalCSS('/local/modules/landing.editor/admin/assets/trumbowyg/plugins/tooltip/ui/trumbowyg.tooltip.css');
		$asset->addJs('/local/modules/landing.editor/admin/assets/trumbowyg/plugins/tooltip/trumbowyg.tooltip.js');

		/* Pastermbed Trumbowyg plugin */
		$asset->addJs('/local/modules/landing.editor/admin/assets/trumbowyg/plugins/pasteembed/trumbowyg.pasteembed.js');

		$asset->addJs('/local/modules/landing.editor/admin/assets/trumbowyg/plugins/fontsize/trumbowyg.fontsize.js');
		$asset->addJs('/local/modules/landing.editor/admin/assets/trumbowyg/plugins/lineheight/trumbowyg.lineheight.js');

		/* Textcat Trumbowyg plugin */
		$APPLICATION->SetAdditionalCSS('/local/modules/landing.editor/admin/assets/trumbowyg/plugins/textcat/ui/trumbowyg.textcat.css');
		$asset->addJs('/local/modules/landing.editor/admin/assets/trumbowyg/plugins/textcat/trumbowyg.textcat.js');

		/* Textpopup Trumbowyg plugin */
		$APPLICATION->SetAdditionalCSS('/local/modules/landing.editor/admin/assets/trumbowyg/plugins/textpopup/ui/trumbowyg.textpopup.css');
		$asset->addJs('/local/modules/landing.editor/admin/assets/trumbowyg/plugins/textpopup/trumbowyg.textpopup.js');

		/* Upload Trumbowyg plugin */
		$asset->addJs('/local/modules/landing.editor/admin/assets/trumbowyg/plugins/upload/trumbowyg.upload.js');

        if (Locale::isWin1251()) {
            $asset->addJs('/local/modules/landing.editor/admin/assets/trumbowyg/langs/ru.windows-1251.js');
        } else {
            $asset->addJs('/local/modules/landing.editor/admin/assets/trumbowyg/langs/ru.min.js');
        }

        $APPLICATION->SetAdditionalCSS('/local/modules/landing.editor/admin/assets/wait_editor.css');
        foreach (self::$css as $val) {
            $APPLICATION->SetAdditionalCSS($val);
        }

        $asset->addJs('/local/modules/landing.editor/admin/assets/wait_editor.js');
        foreach (self::$js as $val) {
            $asset->addJs($val);
        }
    }

    protected static function registerBlocks($groupname) {
        $webpath = '/local/modules/landing.editor/admin/' . $groupname . '/';
        $rootpath = Module::getDocRoot() . $webpath;

        if (!is_dir($rootpath)) {
            return false;
        }

        $selectBlocks = array();

        $iterator = new \DirectoryIterator($rootpath);

        foreach ($iterator as $item) {
            if (!$item->isDir() || $item->isDot()) {
                continue;
            }

			if(startsWith($item->getFilename(), '.')) {
            	continue;
			}

            $blockName = $item->getFilename();

            $param = array();
            if (is_file($rootpath . $blockName . '/config.json')) {
                $param = file_get_contents($rootpath . $blockName . '/config.json');
                $param = json_decode($param, true);
            }

            $param['name'] = $blockName;
            $param['groupname'] = $groupname;

			$param['optgroup'] = !empty($param['optgroup']) ? $param['optgroup'] : 'general';

            $param['title'] = !empty($param['title']) ? $param['title'] : '';
            $param['hint'] = !empty($param['hint']) ? $param['hint'] : '';

            $param['sort'] = !empty($param['sort']) ? intval($param['sort']) : 500;
            $param['sort'] = ($param['sort'] > 0) ? $param['sort'] : 500;

            if (is_file($rootpath . $blockName . '/style.css')) {
                self::$css[] = $webpath . $blockName . '/style.css';
            }

            if (!empty($param['css']) && is_array($param['css'])) {
                foreach ($param['css'] as $css) {
                    self::$css[] = $css;
                }
            }

            if (is_file($rootpath . $blockName . '/script.js')) {
                self::$js[] = $webpath . $blockName . '/script.js';
            }
            if (!empty($param['js']) && is_array($param['js'])) {
                foreach ($param['js'] as $js) {
                    self::$js[] = $js;
                }
            }

            if (is_file($rootpath . $blockName . '/template.html')) {
                self::$templates[$blockName] = file_get_contents($rootpath . $blockName . '/template.html');
            }

            if (!empty($param['templates']) && is_array($param['templates'])) {
                foreach ($param['templates'] as $val) {
                    $tmp = $blockName . '-' . pathinfo($val, PATHINFO_FILENAME);
                    self::$templates[$tmp] = file_get_contents($rootpath . $blockName . '/' . $val);
                }
            }

            unset($param['templates']);
            unset($param['css']);
            unset($param['js']);

            if (!empty($param['title'])) {
                $selectBlocks[] = $param;
            }

            self::$parameters[$blockName] = $param;
        }

        self::sortBySort($selectBlocks);

        foreach ($selectBlocks as $selectBlock) {
        	if(isset(self::$selectValues[$selectBlock['optgroup']])) {
        		array_push(self::$selectValues[$selectBlock['optgroup']]['blocks'],$selectBlock);
			} else {
				self::$selectValues[$selectBlock['optgroup']] = array(
					'title' => GetMessage('WAIT_EDITOR_group_'.$selectBlock['optgroup']),
            		'blocks' => array(
						$selectBlock
					)
				);
			}
		};
    }

    protected static function registerLayouts() {
    	/*
        $selectLayouts = array();
        for ($num = 1; $num <= 1; $num++) {
            $selectLayouts[] = array(
                'title' => GetMessage('WAIT_EDITOR_layout_type' . $num),
                'name' => 'layout_' . $num,
            );
        }

        self::$selectValues['layout'] = Locale::convertToWin1251IfNeed(array(
            'title' => GetMessage('WAIT_EDITOR_group_layout'),
            'blocks' => $selectLayouts
        ));
	*/
    }

    public static function renderFile($file, $vars = array()) {
        if (is_array($vars)) {
            extract($vars, EXTR_SKIP);
        }

        ob_start();
        /** @noinspection PhpIncludeInspection */
        include $file;

        $html = ob_get_clean();
        return $html;
    }

    protected static function sortBySort(&$input = array()) {
        usort($input, function ($a, $b) {
            if ($a['sort'] == $b['sort']) {
                return 0;
            }
            return ($a['sort'] < $b['sort']) ? -1 : 1;
        });
    }

}
