<?
/**
 * @var $block array
 * @var $title string
 * @var $subtitle string
 * @var $buttonLink string
 * @var $buttonText string
 * @var $buttonType string
 * @var $buttonHead string
 * @var $buttonIDForm string
 * @var $buttonLink2 string
 * @var $buttonText2 string
 * @var $buttonType2 string
 * @var $buttonHead2 string
 * @var $buttonIDForm2 string
 */

use Bitrix\Main\Application;

$arFile = \CFile::GetByID($block['file']['ID'])->Fetch();
$image = null;


foreach ($block as $name => $value) {
	if(App\Editor\Blocks\Text::getValue($block,"$name")){
		$$name = App\Editor\Blocks\Text::getValue($block,"$name");
	}
}
$image = App\Editor\Blocks\Image::getImage($block);

$request = Application::getInstance()->getContext()->getRequest();
$uriString = $request->getRequestUri();
$uriString = explode('?', $uriString)[0];

if (CSite::InDir('/uslugi-1s/')){
	\App\SEO\JsonLdBuilder::getServiceBuilder()->setProperty('customImage',  $image['SRC']);
}
?>
<?if(!empty($block['elements'][0]['name']) && !empty($block['elements'][0]['link'])):?>
<div class="tab-like">
	<div class="container-rd">
		<div class="tab-like__wrapper">
			<?if($block['titleTag']):?><span class="tab-like__preview-text"><?=$block['titleTag']?>:</span><?endif;?>
			<?foreach ($block['elements'] as $element) :?>
				<a href="<?=$element['link']?>" class="tab-like__link <?if($uriString == $element['link']):?>active<?endif;?>"><?=$element['name']?></a>
			<?endforeach;?>
		</div>
	</div>
</div>
<?endif;?>
<div class="product-banner-rd product-banner-rd--gray">
    <div class="product-banner-rd__container">
        <h1 class="product-banner-rd__title" style="word-wrap: break-word"><?=$title?></h1>
        <p class="product-banner-rd__subtitle"><?=$subtitle?></p>
		<div class="product-banner__buttons">
			<? if ($buttonType == 'basket_button'): ?>
				<button class="button _red js-add-to-basket" data-product="<?= $buttonLink ?>"><?= $buttonText ?></button>
			<? else: ?>
				<a href="<?if($buttonType == 'form' && $buttonLink == '') :?>#callback-new<?else:?><?=$buttonLink?><?endif;?>" class="button _red <?if($buttonType != '') :?>pupop<?endif;?>" <?if($buttonType != '') :?>onclick="<?=FormHelper::getFormOnclickFunctionForConstructor($buttonLink,$buttonHead, $buttonHead, $buttonIDForm);?>"<?endif;?><?= !empty($block['nofollow'])? 'rel="nofollow"' : '' ?>><?=$buttonText?></a>
			<? endif; ?>

			<? if($buttonText2) :?>
				<? if ($buttonType2 == 'basket_button'): ?>
					<button class="button _white js-add-to-basket" data-product="<?= $buttonLink2 ?>"><?= $buttonText2 ?></button>
				<? else: ?>
					<a href="<?if($buttonType2 == 'form' && $buttonLink2 == '') :?>#callback-new<?else:?><?=$buttonLink2?><?endif;?>" class="button _white <?if($buttonType2 != '') :?>pupop<?endif;?>" <?if($buttonType2 != '') :?>onclick="<?=FormHelper::getFormOnclickFunctionForConstructor($buttonLink2,$buttonHead2, $buttonHead2, $buttonIDForm2);?>"<?endif;?><?= !empty($block['nofollow2'])? 'rel="nofollow"' : '' ?>><?=$buttonText2?></a>
				<? endif; ?>
			<?endif;?>
		</div>
		<div class="product-banner-rd__img-holder">
			<img src="<?= $image['SRC'] ?>" alt="<?=$desc?>">
            <?php if (!empty($block['linkFB'] || !empty($block['linkInst']) || !empty($block['linkVK']))){?>
            <div class="social-btns first-iteration-hidden" style="text-align: center; padding-top: 20px;">
                <ul class="social-btns__list">
                    <?php if (!empty($block['linkFB'])){?>
                        <li class="social-btns__item">
                            <a href="<?= $block['linkFB'] ?>" target="_blank">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/svg/Facebook_black.svg">
                            </a>
                        </li>
                    <?php }?>
                    <?php if (!empty($block['linkInst'])){?>
                        <li class="social-btns__item">
                            <a href="<?= $block['linkInst'] ?>" target="_blank">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/svg/Instagram_black.svg">
                            </a>
                        </li>
                    <?php }?>
                    <?php if (!empty($block['linkVK'])){?>
                        <li class="social-btns__item">
                            <a href="<?= $block['linkVK'] ?>" target="_blank">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/svg/VK_black.svg">
                            </a>
                        </li>
                    <?php }?>
                </ul>
            </div>
            <?php }?>
		</div>
    </div>
</div>

