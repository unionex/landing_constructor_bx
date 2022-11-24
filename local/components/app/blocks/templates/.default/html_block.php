<? /** @var $block array */

global $APPLICATION;

$fileName = md5($block['value']) . '.php';
$path = EnvironmentHelper::getParam('filepathFromHtmlBlock');
$file = $_SERVER["DOCUMENT_ROOT"] . $path . $fileName;


$placeTarget = '#BLOCK_SUBSCRIBE_WITH_TELEGRAM_FORM';
$placeTargetEnd = '#';

$articleText = $block['value'];

if (strpos($articleText, $placeTarget) !== false) {
    $params = array();

    $pattern = '/(?<=' . $placeTarget . '\\$)(.*)(?=' . $placeTargetEnd . ')/';
    preg_match($pattern, $articleText, $matches);
    $matchVal = $matches[0];

    if ($matchVal) {
        $replacePart = $placeTarget . '$' . $matchVal . $placeTargetEnd;
        $matchVals = explode("|", $matchVal);
        $params = array(
            'URL_SUBSCRIBE_REASON' => $matchVals[0],
            'CUSTOM_HEADING' => $matchVals[1],
            'CUSTOM_DESCRIPTION' => $matchVals[2]
        );
    } else {
        $replacePart = $placeTarget . $placeTargetEnd;
    }
    ob_start();
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => '/local/include/form_subscribe_article_with_telegram.php'
        )
    );
    $html = ob_get_clean();

    $block['value'] = str_ireplace($replacePart, $html, $articleText);
}

if (!file_exists($file)) {
    file_put_contents($file, $block['value']);
}

?>
<section class="section-rd <?= $block["block_style"] ?> <?= $block["nopt"] ?>" data-attr="section-end-text">
    <div class="container-rd">
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => $path . $fileName
            )
        ); ?>
    </div>
</section>
