<? /** @var $block array */ ?><?

$arFile       = \CFile::GetByID($block['file']['ID'])->Fetch();
$image        = null;
$isFancyModal = false; // применить ли css класс js-fancy-media

// если размеры большие ресайзим и применяем js-fancy-media иначе оригинал без js-fancy-media
if (!empty($arFile['HEIGHT']) && !empty($arFile['WIDTH']) && (intval($arFile['HEIGHT']) > 768 || intval($arFile['WIDTH']) > 712)) {
    $image        = App\Editor\Blocks\Image::getImage($block, array(
        'width'  => 960,
        'height' => 9999,
    ));
        $isFancyModal = true; // ок, картинку показываем модально
} else {
    $image = App\Editor\Blocks\Image::getImage($block);
}
?><? if ($image): ?>
    <div class="col-block" style="text-align: <?=$block['align']?>;">
        <? if ($isFancyModal && empty($image['DESCRIPTION'])): ?>
        <a class="js-fancy-media link-unstyled" data-fullsize="true" href="<?= $image['ORIGIN_SRC']?>">
            <?else:?>
        <?if(!empty($image['DESCRIPTION'])):?>
            <a href="<?= $image['DESCRIPTION']?>">
                <?endif;?>
                <? endif; ?>
                <img src="<?= $image['SRC'] ?>">
                <? if ($isFancyModal || !empty($image['DESCRIPTION'])): ?>
            </a>
        <? endif; ?>
    </div>
<? endif; ?>
