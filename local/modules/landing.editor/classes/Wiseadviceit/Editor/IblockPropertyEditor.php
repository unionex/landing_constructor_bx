<?php


namespace App\Editor;

class IblockPropertyEditor
{

    public function GetUserTypeDescription() {
        return array(
            "PROPERTY_TYPE" => "S",
            "USER_TYPE" => "wait_editor",
            "DESCRIPTION" => GetMessage('WAIT_EDITOR_TITLE'),
            'GetAdminListViewHTML' => array(__CLASS__, 'GetAdminListViewHTML'),
            'GetPropertyFieldHtml' => array(__CLASS__, 'GetPropertyFieldHtml'),
            "GetSearchContent" => array(__CLASS__, "GetSearchContent"),
            "GetSettingsHTML" => array(__CLASS__, "GetSettingsHTML"),
            "PrepareSettings" => array(__CLASS__, "PrepareSettings"),
        );
    }

    public function GetAdminListViewHTML($arProperty, $value, $strHTMLControlName) {
        return 'text';
    }

    public function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName) {

		\Bitrix\Main\Page\Asset::getInstance()->addString(
			'<style>#tr_PROPERTY_'.$arProperty['ID'].'>td:first-of-type {display:none;}
			#tr_PROPERTY_'.$arProperty['ID'].'>td {width:100%!important;}</style>'
		);

        $settings = self::PrepareSettings($arProperty);
        $settings = $settings['USER_TYPE_SETTINGS'];

        if (self::isSettingsPage()){
            $settings['DISABLE_CHANGE'] = '';
            $settings['ENABLE_SORT_BUTTONS'] = '';
            $settings['SETTINGS_NAME'] = '';
        }

		return AdminEditor::init(array(
            'uniqId' => $arProperty['ID'],
            'value' => $value['VALUE'],
            'inputName' => $strHTMLControlName['VALUE'],
            'defaultValue' => $arProperty['DEFAULT_VALUE'],
            'userSettings' => $settings
        ));
    }

    public function GetSearchContent($arProperty, $value, $strHTMLControlName) {
        return AdminEditor::getSearchIndex($value["VALUE"]);
    }

    public static function GetSettingsHTML($arProperty, $strHTMLControlName, &$arPropertyFields) {
        $arPropertyFields = array(
            "HIDE" => array("FILTRABLE", "ROW_COUNT", "COL_COUNT", "SMART_FILTER", "WITH_DESCRIPTION", "HINT", "MULTIPLE_CNT", "MULTIPLE", "IS_REQUIRED"),
            "SET" => array("FILTRABLE" => "N", "SMART_FILTER" => "N", "IS_REQUIRED" => "N", "MULTIPLE" => "N", "SECTION_PROPERTY" => "Y"),
        );

        $settings = self::PrepareSettings($arProperty);
        $settings = $settings['USER_TYPE_SETTINGS'];
        $userfiles = AdminEditor::getUserSettingsFiles();

        return AdminEditor::renderFile(Module::getModuleDir() . '/templates/iblock_property.php', array(
            'inputName' => $strHTMLControlName['NAME'],
            'settings' => $settings,
            'userfiles' => $userfiles,
        ));
    }

    public static function PrepareSettings($arProperty) {
        $settings = $arProperty['USER_TYPE_SETTINGS'];
        $newsettings = array();

        foreach (array('DISABLE_CHANGE', 'ENABLE_SORT_BUTTONS','SETTINGS_NAME') as $val){
            $newsettings[$val] = !empty($settings[$val]) ? $settings[$val] : '';
        }

        return array('USER_TYPE_SETTINGS' => $newsettings);
    }

    public static function isSettingsPage(){
        return ($_SERVER["SCRIPT_NAME"] == '/bitrix/admin/iblock_edit_property.php');
    }
}
