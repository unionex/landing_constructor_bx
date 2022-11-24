<?php
$module_id = "landing.editor";
CModule::IncludeModule($module_id);

global $APPLICATION;
$MODULE_RIGHT = $APPLICATION->GetGroupRight($module_id);
if (!($MODULE_RIGHT >= "R")) {
    $APPLICATION->AuthForm("ACCESS_DENIED");
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && check_bitrix_sessid()) {

    if (isset($_REQUEST['opts_save'])) {
        $optionsConfig = \App\Editor\Module::getOptionsConfig();
        foreach ($optionsConfig as $name => $aOption) {
            if (!empty($_REQUEST[$name])) {
                \App\Editor\Module::setDbOption($name, 'yes');
            } else {
                \App\Editor\Module::setDbOption($name, 'no');
            }
        }
    }

}

?>
<form method="post">
<?
    $optionsConfig = \Wiseadviceit\Editor\Module::getOptionsConfig();
    foreach ($optionsConfig as $name => $aOption):
        $value = \Wiseadviceit\Editor\Module::getDbOption($name) ?>
        <label>
            <input <? if ($value == 'yes'): ?>checked="checked"<? endif ?>
                   type="checkbox"
                   name="<?= $name ?>"
                   value="<?= $aOption['DEFAULT'] ?>">
            <?= $aOption['TITLE'] ?>
        </label><br/>
    <? endforeach; ?>
    <br/>
    <input class="adm-btn-green" type="submit" name="opts_save" value="<?=GetMessage('APP_EDITOR_BTN_SAVE')?>">
    <input type="hidden" name="lang" value="<?= LANGUAGE_ID ?>">
    <input type="hidden" name="mid" value="<?= urlencode($module_id) ?>">
    <?= bitrix_sessid_post(); ?>
</form>
<br/>
<br/>

<h2><?=GetMessage('APP_EDITOR_HELP')?></h2>
<p><?=GetMessage('APP_EDITOR_HELP_WIKI')?> <br/></p>
