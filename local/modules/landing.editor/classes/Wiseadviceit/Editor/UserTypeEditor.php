<?php


namespace App\Editor;

class UserTypeEditor
{

    function GetUserTypeDescription() {
        return array(
            "USER_TYPE_ID" => "landing_editor",
            "CLASS_NAME" => "App\\Editor\\UserTypeEditor",
            "DESCRIPTION" => GetMessage("WAIT_EDITOR_TITLE"),
            "BASE_TYPE" => "string",
        );
    }


    public function GetAdminListViewHTML($arUserField, $arHtmlControl) {
        return 'text';
    }

    public function GetEditFormHTML($arUserField, $arHtmlControl) {

		\Bitrix\Main\Page\Asset::getInstance()->addString(
			'<style>#tr_PROPERTY_'.$arUserField['ID'].'>td:first-of-type {display:none;}
			#tr_PROPERTY_'.$arUserField['ID'].'>td {width:100%!important;}</style>'
		);

        return AdminEditor::init(array(
            'uniqId' => $arUserField['ID'],
            'value' => $arUserField['VALUE'],
            'inputName' => $arHtmlControl['NAME'],
            'userSettings' => $arUserField['SETTINGS'],
            'defaultValue' => $arUserField['SETTINGS']['DEFAULT_VALUE']
        ));
    }

    public function OnSearchIndex($arUserField) {
        return AdminEditor::getSearchIndex($arUserField["VALUE"]);
    }

    public function PrepareSettings($arUserField) {
        $settings = $arUserField['SETTINGS'];
        $newsettings = array();

        foreach (array('DEFAULT_VALUE','DISABLE_CHANGE', 'ENABLE_SORT_BUTTONS','SETTINGS_NAME') as $val){
            $newsettings[$val] = !empty($settings[$val]) ? $settings[$val] : '';
        }

        return $newsettings;
    }

    public function GetSettingsHTML($arUserField, $arHtmlControl, $bVarsFromForm){
        $settings = self::PrepareSettings($arUserField);
        $userfiles = AdminEditor::getUserSettingsFiles();

        $defaultEditor = AdminEditor::init(array(
            'uniqId' => $arUserField['ID'],
            'value' => $arUserField['VALUE'],
            'inputName' => $arHtmlControl['NAME'] . '[DEFAULT_VALUE]',
            'userSettings' => array(
                'DISABLE_CHANGE' => '',
                'ENABLE_SORT_BUTTONS' => '',
                'SETTINGS_NAME' => ''
            ),
            'defaultValue' => $arUserField['SETTINGS']['DEFAULT_VALUE']
        ));

        return AdminEditor::renderFile(Module::getModuleDir() . '/templates/user_type.php', array(
            'inputName' => $arHtmlControl['NAME'],
            'settings' => $settings,
            'userfiles' => $userfiles,
            'defaultEditor' => $defaultEditor,
        ));
    }

    public function GetDBColumnType($arUserField) {
        global $DB;
        switch (strtolower($DB->type)) {
            case "mysql":
                return "mediumtext";
            case "mssql":
                return "varchar(max)";
        }
    }
}
