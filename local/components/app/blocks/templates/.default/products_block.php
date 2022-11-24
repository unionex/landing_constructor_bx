<? /** @var $block array */ ?>

<section class="section-rd <?if($block['hpb']) :?><?=$block['hpb'];?><?endif;?> section-rd--gray"  data-attr="section-end-block">
    <div class="container-rd">
        <? if ($block['heading']): ?><h2 class="section-rd__h2 section-rd__h2--center"><?= $block['heading']; ?></h2><? endif; ?>
        <div class="product-cards-rd product-cards-rd--centered product-cards-rd--change-layout js-equal-height product-cards-rd--slider-like product-cards-rd--three-columns">
            <? foreach ($block['elements'] as $k => $item): ?>
				<? if (array_filter($item)): ?>
                <div class="product-cards-preview__element">
                    <div class="product-card-preview product-card-preview--shadow product-card-preview--v2 product-card-preview--no-border">
                        <div class="product-card-preview__img-holder product-card-preview__img-holder--centered">
                            <img src="<?= $item['img']; ?>" alt="<?= $item['alt']; ?>" width="296" height="123">
                        </div>
                        <div class="product-card-preview__text-wrapper">
                            <div class="product-card-preview__title product-card-preview__title--lg"><?= $item['title']; ?></div>
                            <p class="product-card-preview__text product-card-preview__text--lg"><?= $item['subtitle']; ?></p>
                        </div>
                        <div class="product-card-preview__footer product-card-preview__footer--bordered">
                            <div class="product-card-preview__price">
                                <span><?= $item['price']; ?></span>
                            </div>
                            <div class="product-card-preview__link-wrapper">
								<? if ($item['linkType'] == 'basket_button'): ?>
									<a href="javascript:void(0);" class="product-card-preview__link js-add-to-basket" data-product="<?= $item['link'] ?>" <?= !empty($item['nofollow'])? 'rel="nofollow"' : '' ?>>Купить</a>
								<? else: ?>
                                	<a href="<?if($item['linkType'] == 'form' && $item['link'] == ''):?>#callback-new<?else :?><?= $item['link']; ?><?endif;?>" class="product-card-preview__link <?if($item['linkType'] != '') :?>pupop<?endif;?>" <?if($item['linkType'] != '') :?>onclick="<?=FormHelper::getFormOnclickFunctionForConstructor($item['link'], $item['linkHead'], $item['linkHead'].' '.$item['title'].' '.$item['price']);?>"<?endif;?> <?= !empty($item['nofollow'])? 'rel="nofollow"' : '' ?>>Подробнее</a>
								<? endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
				<?endif;?>
            <? endforeach; ?>
        </div>
    </div>
</section>
