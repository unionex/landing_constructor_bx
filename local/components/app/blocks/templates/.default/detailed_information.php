<? /** @var $block array */
global $obJsonFAQ;
if(!isset($obJsonFAQ))
{
    $obJsonFAQ = new App\SEO\JsonFAQ();
}
foreach ($block['elements'] as $key => $element) {
    /**
     * Заголовок содержит вопрос
     */
    if (stristr($element['head'], "?")){
        $obJsonFAQ->setQuestion($element['head']);
        $obJsonFAQ->setAnswer($element['text']);
    }
}
?>

<section class="section-rd <?if($block['hpb']) :?><?=$block['hpb'];?><?endif;?>"  data-attr="section-end-block">
    <div class="container-rd">
		<? $is_retina = (isset($_COOKIE["device_pixel_ratio"]) && ($_COOKIE["device_pixel_ratio"] >= 2)); ?>
        <h2 class="section-rd__h2"><?=$block["heading"]?></h2>
        <? foreach ($block["elements"] as $k => $element) : ?>
            <? if($k % 2 == 0) :?>
                <div class="row-fl-rd <?= count($block["elements"]) - 1 != $k ? '_mb40-md' : ''?>">
                    <div class="col-fl-rd col-fl-rd--1-2-md _mb20-up-to-md">
                        <div class="img-wrapper">
							<? if ($is_retina && !empty($element["icon_retina"])): ?>
                            <a href="<?=$element["icon_retina"];?>" class="js-fancy-media appWidgetFancy"><img class="lazy" data-src="<?=$element["icon_retina"];?>" alt="<?=$element["alt_retina"];?>"></a>
							<? else: ?>
							<a href="<?=$element["icon"];?>" class="js-fancy-media appWidgetFancy"><img class="lazy" data-src="<?=$element["icon"];?>" alt="<?=$element["alt"];?>"></a>
							<? endif; ?>
                        </div>
                    </div>
                    <div class="col-fl-rd col-fl-rd--1-2-md _mb25-up-to-md">
                        <h3 class="section-rd__h3"><?=$element["head"];?></h3>
                        <div class="content-area"><?=$element["text"]?></div>
                    </div>
                </div>
            <? else : ?>
                <div class="row-fl-rd <?= count($block["elements"]) - 1 != $k ? '_mb40-md' : ''?>">
                    <div class="col-fl-rd col-fl-rd--1-2-md  col-fl-rd--order-2-up-to-md  _mb25-up-to-md">
                        <h3 class="section-rd__h3"><?=$element["head"];?></h3>
						<div class="content-area"><?=$element["text"]?></div>
                    </div>
                    <div class="col-fl-rd col-fl-rd--1-2-md _mb20-up-to-md">
                        <div class="img-wrapper">
							<? if ($is_retina): ?>
								<a href="<?=$element["icon_retina"];?>" class="js-fancy-media appWidgetFancy"><img class="lazy" data-src="<?=$element["icon_retina"];?>" alt="<?=$element["alt_retina"];?>"></a>
							<? else: ?>
								<a href="<?=$element["icon"];?>" class="js-fancy-media appWidgetFancy"><img class="lazy" data-src="<?=$element["icon"];?>" alt="<?=$element["alt"];?>"></a>
							<? endif; ?>
                        </div>
                    </div>
                </div>
            <? endif; ?>
        <?endforeach;?>
    </div>
</section>
