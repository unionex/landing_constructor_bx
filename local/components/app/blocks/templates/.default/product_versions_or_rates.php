<? /** @var $block array */ ?>
<? $countElements = count($block['elements']); ?>
<section class="section-rd section-rd--gray <?if($block['hpb']) :?><?=$block['hpb'];?><?endif;?>"  data-attr="section-end-block">
    <div class="container-rd">
        <h2 class="section-rd__h2 section-rd__h2--center"><?=$block['heading'];?></h2>
        <div class="product-cards-rd <? if($countElements) :?>product-cards-rd--centered <? endif; ?>
        product-cards-rd--change-layout js-equal-height product-cards-rd--slider-like product-cards-rd--three-columns
        appWidgetEqualHeight">
            <?foreach ($block['elements'] as $element) :?>
            <?$arList = explode(';', $element['text']);?>
            <div class="product-cards-rd__element <?if($element['select'] == true) :?>product-cards-rd__element--active<?endif;?>">
                <div class="product-card-rd <?if($element['select'] == true) :?>product-card-rd--active<?endif;?>">
                    <div data-equal-title="true" class="product-card-rd__top-section js-equal-height__block">
                        <h3 class="product-card-rd__title"><?if($element['titleLink']):?><a href="<?=$element['titleLink'];?>"><?=$element['title'];?></a><?else:?><?=$element['title'];?><?endif;?></h3>
                    </div>
                    <div class="product-card-rd__middle-section">
                        <ul class="check-bullet-list check-bullet-list--orange check-bullet-list--sm">
                            <?foreach ($arList as $item) :?>
                                <?if($item) :?>
                                    <li><?=$item;?></li>
                                <?endif;?>
                            <?endforeach;?>
                        </ul>
                    </div>
                    <div data-equal-price="true" class="product-card-rd__bottom-section js-equal-height__block">
                        <div class="product-card-rd__price-info">
                            <div class="product-card-rd__price"><?=$element['price'];?></div>
                            <span class="product-card-rd__price-remark"><?=$element['priceInfo'];?></span>
                        </div>
						<? if ($element['btnType'] == 'basket_button'): ?>
							<button class="button _lg _full js-add-to-basket" data-product="<?= $element['link'] ?>"><?= $element['btnText'] ?></button>
						<? else: ?>
                        	<a href="<?if($element['btnType'] == 'form' && $element['link'] == '') :?>#callback-new<?else:?><?=$element['link'];?><?endif;?>" class="button <?if($element['btnType'] != '') :?>pupop<?endif;?> _lg _full" <?if($element['btnType'] != '') :?>onclick="<?=FormHelper::getFormOnclickFunctionForConstructor($element['link'], $element['btnHead'], $element['btnHead'].' '.$element['title'].' '.$element['price']);?>"<?endif;?> <?= !empty($element['nofollow'])? 'rel="nofollow"' : '' ?>><?=$element['btnText'];?></a>
						<? endif; ?>
                    </div>
                </div>
            </div>
            <?endforeach;?>
        </div>
    </div>
</section>


