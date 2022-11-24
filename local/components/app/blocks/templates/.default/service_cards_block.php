<? /** @var $block array */ ?>
<section class="section-rd section-rd--gray <?if($block['hpb']) :?><?=$block['hpb'];?><?endif;?>" data-attr="section-end-block">
    <div class="container-rd">
		<? $is_retina = (isset($_COOKIE["device_pixel_ratio"]) && ($_COOKIE["device_pixel_ratio"] >= 2)); ?>
        <? if($block['heading']) :?>
            <h2 class="section-rd__h2 section-rd__h2--center"><?=$block['heading'];?></h2>
        <? endif; ?>
        <div class="info-cards-slider">
            <div class="info-cards js-info-cards-slider appWidgetInfoProductSlider">
                <?foreach ($block['elements'] as $element) :?>
                    <div class="info-cards__element">
                        <div class="info-card">
                            <div class="info-card__img-holder">
								<? if($is_retina && !empty($element['img_retina'])): ?>
                                <img src="<?=$element['img_retina'];?>" alt="<?=$element['alt_retina'];?>">
								<? else: ?>
								<img src="<?=$element['img'];?>" alt="<?=$element['alt'];?>">
								<? endif; ?>
                            </div>
                            <div class="info-card__text">
                                <h3 class="info-card__title"><?=$element['title'];?></h3>
                                <span class="info-card__remark"><?=$element['subtitle'];?></span>
								<? if ($element['btnType'] == 'basket_button'): ?>
									<button class="button js-add-to-basket" data-product="<?= $element['link'] ?>"><?= $element['btnText'] ?></button>
								<? else: ?>
                                	<a href="<?if($element['btnType'] == 'form' && $element['link'] == '') :?>#callback-new<?else:?><?=$element['link'];?><?endif;?>" class="button <?if($element['btnType'] != '') :?>pupop<?endif;?>" <?if($element['btnType'] != '') :?>onclick="<?=FormHelper::getFormOnclickFunctionForConstructor($element['link'], $element['btnHead'], $element['btnHead'].' '.$element['title']);?>"<?endif;?><?= !empty($element['nofollow'])? 'rel="nofollow"' : '' ?>><?=$element['btnText'];?></a>
								<? endif; ?>
                            </div>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
</section>
