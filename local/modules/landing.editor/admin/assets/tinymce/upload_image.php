<?

use \Bitrix\Main\FileTable;
use \Bitrix\Main\Context;

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
// json_encode(print_r($_FILES));
// $arResult = array();
$request = Context::getCurrent()->getRequest();
$image = $request->getFile('file');
$description = $request->getPost('alt');
$request->getPost('alt');
$fileId = CFile::SaveFile(array(
    'name' => $image['name'],
    'size' => $image['size'],
    'tmp_name' => $image['tmp_name'],
    'type' => $image['type'],
    'MODULE_ID' => 'landing.editor',
    'description' => $description
), 'landing.editor');
if ($fileId) {
    $arResult['success'] = true;
    $arResult['location'] = CFile::getPath($fileId);
} else {
    $arResult['success'] = false;
}
echo json_encode($arResult);



