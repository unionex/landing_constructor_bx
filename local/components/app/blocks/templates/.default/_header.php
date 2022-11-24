<?php
 /** Подключается перед выводом всех блоков
 *
 * @var $this     \AppEditorBlocksComponent
 * @var $blocks   array - массив со всеми блоками, можно модифицировать
 * @var $arParams array - массив с параметрами компонента
 */

use Quetzal\Data\Bitrix\IBlockSectionRepository;
use Quetzal\Data\Bitrix\IBlockElementRepository;

global $USER;

LandingHelper::initStyleConstructor();

$editLink = '';

if (($USER->IsAuthorized() && ($USER->IsAdmin() || in_array(5, $USER->GetUserGroupArray())))) {

	if (isset($this->arParams['ELEMENT_ID'])) {
		$oGateway  = new IBlockElementRepository(new CIBlockElement(), $this->arParams['IBLOCK_ID']);
		$arElement = $oGateway->find($this->arParams['ELEMENT_ID']);
		$editLink  = '/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=' .
					 $arElement['IBLOCK_ID'] .
					 '&type=' .
					 $arElement['IBLOCK_TYPE_ID'] .
					 '&ID=' .
					 $arElement['ID'] .
					 '&lang=ru&find_section_section=' .
					 $arElement['IBLOCK_SECTION_ID'] .
					 '';
	} else {
		$oGateway  = new IBlockSectionRepository(new CIBlockSection(), $this->arParams['IBLOCK_ID']);
		$arSection = $oGateway->find($this->arParams['SECTION_ID']);
		$editLink  = '/bitrix/admin/iblock_section_edit.php?IBLOCK_ID=' .
					 $arSection['IBLOCK_ID'] .
					 '&type=' .
					 $arSection['IBLOCK_TYPE_ID'] .
					 '&ID=' .
					 $arSection['ID'] .
					 '&lang=ru&find_section_section=' .
					 $arSection['IBLOCK_SECTION_ID'] .
					 '';
	}

}
global $isNoBlogBlock;
$isNoBlogBlock = true;
?>
<? if ($editLink) : ?>
    <div class="container">
        <p style="text-align: center;"><a href="<?= $editLink ?>" target="_blank">Редактировать страницу в панели
                управления</a></p>
    </div>
<? endif; ?>


