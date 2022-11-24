<? /** @var $block array */

$arUlNames = [
    'update' => 'Обновление',
    'freeTime' => 'Бесплатные часы',
    'delivery' => 'Доставка',
    'its3Mons' => 'ИТС 3 мес.',
    'report' => 'Отчетность',
    'install' => 'Установка',
];
?>

<section class="section-rd <? if ($block['hpb']) : ?><?= $block['hpb']; ?><? endif; ?> section-rd--gray"
         data-attr="section-end-block">
    <div class="container-rd">
        <? if ($block['heading']): ?><h2
                class="section-rd__h2 section-rd__h2--center"><?= $block['heading']; ?></h2><? endif; ?>
        <div class="product-cards-rd<?= isMobile()?' _adaptiveCol':''?> product-cards-rd--centered product-cards-rd--change-layout js-equal-height product-cards-rd--slider-like product-cards-rd--three-columns product-cards-rd">
            <? foreach ($block['elements'] as $k => $item):

                ?>
                <? if (array_filter($item)): ?>
                <div class="product-cards-preview__element">
                    <div class="product-card-preview product-card-preview--shadow product-card-preview--no-border product-cards-rd--centered">
                        <div class="product-card-preview__img-holder product-card-preview__img-holder--centered">
                            <img class="lazy" data-src="<?= $item['icon']; ?>" alt="<?= $item['alt']; ?>" width="109"
                                 height="92">
                        </div>
                        <div class="product-card-preview__text-wrapper">
                            <div class="product-card-preview__title product-card-preview__title--lg">
                                <? if ($item['titleLink']): ?><a
                                    href="<?= $item['titleLink']; ?>"><?= $item['title']; ?></a><? else: ?><?= $item['title']; ?><? endif; ?>
                            </div>
                            <p class="product-card-preview__text product-card-preview__text--lg"><?= $item['subtitle']; ?></p>
                            <?php
                            $ulOpen = false;
                            foreach ($arUlNames as $key => $name) {
                                if ($item[$key] == 'Y') {
                                    if (!$ulOpen) {
                                        echo "<ul class='product-card-preview__ul'>";
                                        $ulOpen = true;
                                    }
                                    echo "<li class='product-card-preview__li'>" . $name . "</li>";
                                }
                            }
                            if ($ulOpen) {
                                echo "</ul>";
                            }
                            ?>
                        </div>
                        <div class="product-card-preview__footer product-card-preview__footer--bordered">
                            <div class="product-card-preview__price">
                                <span><?= $item['price']; ?></span>
                            </div>
                            <div class="product-card-preview__link-wrapper">
                                <? if ($item['linkType'] == 'basket_button'): ?>
                                    <a href="javascript:void(0);" class="product-card-preview__link js-add-to-basket"
                                       data-product="<?= $item['link'] ?>">Купить</a>
                                <? else: ?>
                                    <a href="<? if ($item['linkType'] == 'form' && $item['link'] == '') : ?>#callback-new<? else: ?><?= $item['link']; ?><? endif; ?>"
                                       class="product-card-preview__link <? if ($item['linkType'] != '') : ?>pupop<? endif; ?>"
                                       <? if ($item['linkType'] != '') : ?>onclick="<?= FormHelper::getFormOnclickFunctionForConstructor($item['link'],
                                           $item['linkTitle'],
                                           $item['linkTitle'] . ' ' . $item['title'] . ' ' . $item['price']); ?>"<? endif; ?>>Подробнее</a>
                                <? endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <? endif; ?>
            <? endforeach; ?>
        </div>
    </div>
</section>
<script>
    if ($('.product-cards-preview__element').length < 3) {

    }
</script>
