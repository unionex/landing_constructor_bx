<?php

define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_STATISTIC", true);
define("NO_AGENT_CHECK", true);
define("DisableEventsCheck", true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

/* @global $APPLICATION CMain */
/* @global $USER CUser */
/* @global $DB CDatabase */

global $APPLICATION;
global $USER;
global $DB;

if (\CModule::IncludeModule('landing.editor')) {
	// Параметр в запросе передается, в случаи если было выбрана картинка в "Менеджере файлов"
	// иначе просто загружается картинка с компьютера
	if (empty($_REQUEST['url_local_file'])) {
		$handler = new \App\Editor\UploadHandler(array(
			'bitrix_resize' => array(
				'width'  => 200,
				'height' => 200,
				'exact'  => 1
			)
		));
	} else {
		$path_file = $_REQUEST['url_local_file'];

		$arrFile = [
			'name'     => basename($path_file),
			'tmp_name' => $_SERVER["DOCUMENT_ROOT"] . $path_file,
			'type'     => mime_content_type($_SERVER["DOCUMENT_ROOT"] . $path_file),
			'size'     => filesize($_SERVER["DOCUMENT_ROOT"] . $path_file),
			'error'    => 0
		];

		$_FILES['file'] = $arrFile;
		$handler        = new \App\Editor\UploadHandler(array(
			'bitrix_resize' => array(
				'width'  => 200,
				'height' => 200,
				'exact'  => 1
			)
		));
	}
}
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
