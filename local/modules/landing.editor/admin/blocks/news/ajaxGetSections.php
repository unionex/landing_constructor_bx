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

if (\CModule::IncludeModule('iblock')) {

	if ($_GET['type'] == 'news') {
		$propertyId = EnvironmentHelper::getParam('propNewsTags');
	} else {
		$propertyId = EnvironmentHelper::getParam('propArticleTags');
	}

	$arValues = array();
	$rsPropEnums = CIBlockProperty::GetPropertyEnum($propertyId);
	while ($arEnum = $rsPropEnums->Fetch())
	{
		$arValues[$arEnum['ID']] = $arEnum['VALUE'];
	}

	echo json_encode($arValues);
}
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
