<? /** @var $block array */ ?>
<?$path = $block['cases'] == 'CASES_BLOCK' ? 'local/include/cases-block.php' : 'local/include/reviews-block.php' ?>
<?
global $APPLICATION;
$APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
		"AREA_FILE_SHOW" => "file",
		"PATH"           => SITE_DIR . $path
));
?>

