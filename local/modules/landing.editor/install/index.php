<?php

Class wait_editor extends CModule
{
    var $MODULE_ID = "landing.editor";

    var $MODULE_NAME;
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_DESCRIPTION;
    var $PARTNER_NAME;
    var $PARTNER_URI;

    var $MODULE_GROUP_RIGHTS = "Y";

    function wait_editor() {
        $arModuleVersion = array();

        include(__DIR__ . "/version.php");

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        include(__DIR__ .'/../loader.php');
        include(__DIR__ .'/../locale/ru.php');

        $this->MODULE_NAME = GetMessage("WAIT_EDITOR_MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("WAIT_EDITOR_MODULE_DESCRIPTION");
        $this->PARTNER_NAME = GetMessage("WAIT_EDITOR_PARTNER_NAME");
        $this->PARTNER_URI = GetMessage("WAIT_EDITOR_PARTNER_URI");
    }

    function DoInstall() {
        RegisterModule($this->MODULE_ID);
        RegisterModuleDependences('iblock', 'OnIBlockPropertyBuildList', 'landing.editor', '\\App\\Editor\\IblockPropertyEditor', 'GetUserTypeDescription');
        RegisterModuleDependences('main', 'OnUserTypeBuildList', 'landing.editor', '\\App\\Editor\\UserTypeEditor', 'GetUserTypeDescription');

        $this->afterInstall();
    }

    function afterInstall(){

    }

    function DoUninstall() {
        global $DB;

        $DB->Query('DELETE FROM b_module_to_module WHERE TO_MODULE_ID="landing.editor"');
        UnRegisterModuleDependences('iblock', 'OnIBlockPropertyBuildList', 'landing.editor');
        UnRegisterModuleDependences('main', 'OnUserTypeBuildList', 'landing.editor');
        UnRegisterModule($this->MODULE_ID);
    }

}
