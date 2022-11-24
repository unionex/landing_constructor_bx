<?php

use Bitrix\Main\Application;
use Bitrix\Main\IO;
use Bitrix\Main\Page\Asset;

/**
 * Класс функций-помощников для интеграции лендингов
 *
 * Class LandingHelper
 *
 */
class LandingHelper
{

	/**
	 * Показывает блок для лендинга, если он существует
	 *
	 * @param $partial
	 * @return bool
	 * @throws
	 */
	public static function checkPartial($partial) {

		if (!defined('LANDING_PAGE') || LANDING_PAGE !== true) {
            return false;
        }

		$app = Application::getInstance();
		$appContextRequest = $app->getContext()->getRequest();

		$execFile = IO\Path::convertRelativeToAbsolute($appContextRequest->getScriptFile());
		$incPartDir = IO\Path::getDirectory($execFile).DIRECTORY_SEPARATOR.'partials';
		$incPartFile = $incPartDir.DIRECTORY_SEPARATOR.$partial.'.php';

		if(!IO\Directory::isDirectoryExists($incPartDir) || !IO\File::isFileExists($incPartFile)) {

			return false;

		} else {

			include $incPartFile;

			return true;
		}

	}

	/*
	 * Подключаем подключаем отдельные скрипты для конструктора лендингов
	 */
	public static function initStyleConstructor() {
        $BlocksCssPath = '/local/components/app/blocks/templates/.default';

        $cssPathDir = $_SERVER["DOCUMENT_ROOT"] . $BlocksCssPath;

        $arList = array_diff(scandir($cssPathDir), array('..', '.'));

        foreach ($arList as $name) {
            $curName = $cssPathDir . DIRECTORY_SEPARATOR . $name;
            if (is_dir($curName)) {
                $cssName = $curName . DIRECTORY_SEPARATOR . 'style.css';
                if (file_exists($cssName)) {
                    Asset::getInstance()->addCss($BlocksCssPath . '/' . $name . '/' . 'style.css');
                }
            }
        }

    }

	/**
	 * Подключаем там где нужно вывести страницу из конструктора
	 * @throws \Bitrix\Main\SystemException
	 */
	public static function showPageConstructor() {

		global $APPLICATION;

		$path = str_replace('index.php', '', \Bitrix\Main\Application::getInstance()->getContext()->getRequest()->getRequestedPage());

		if($iblock = IBlockHelper::findOneBy(
			[
				'IBLOCK_CODE' => EnvironmentHelper::getParam('constructorIblockCode'),
				'PROPERTY_PATH' => $path
			],
			['ID', 'IBLOCK_ID'])
		) {

			CHTTP::SetStatus("200 OK");

		$db_props = CIBlockElement::GetProperty($iblock['IBLOCK_ID'], $iblock['ID'], array("sort" => "asc"), Array("CODE"=>'BREADCRUMBS'));

			while($ar_props = $db_props->Fetch()){
				$arBreadcrumbs[] = $ar_props;

			}

			if(count($arBreadcrumbs) > 1 || $arBreadcrumbs[0]['DESCRIPTION']){
				$APPLICATION->AddChainItem('DELETE_AFTER_THIS');
				foreach ($arBreadcrumbs as $breadcrumb) {
					if ($breadcrumb['VALUE']) {
						$APPLICATION->AddChainItem($breadcrumb['VALUE'], $breadcrumb['DESCRIPTION']);
					}
				}
			}

			$APPLICATION->IncludeComponent(
				"bitrix:news.detail",
				"constructor.page",
				Array(
					"IBLOCK_TYPE" => EnvironmentHelper::getParam('constructorIblockType'),
					"IBLOCK_ID" => $iblock['IBLOCK_ID'],
					"PROPERTY_CODE" => ['PROPERTY_CONSTRUCTOR', 'BREADCRUMBS_GRAY', 'BREADCRUMBS_GRAY'],
					"SET_TITLE" => 'Y',
					"CACHE_TYPE" => 'A',
					"CACHE_TIME" => '360000',
					"ELEMENT_ID" => $iblock['ID'],
					'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
					'ADD_ELEMENT_CHAIN' => 'N',
				),
				false
			);
		} else {
			CHTTP::SetStatus("404 Not Found");
			@define("ERROR_404", "Y");

			$APPLICATION->SetTitle("Ошибка 404");
			$APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR . '/local/include/blocks/page404.php'
			));
		}
	}
}
