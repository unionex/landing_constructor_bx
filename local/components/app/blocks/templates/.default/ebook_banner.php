<? /** @var $block array */ ?>

<div class="book-banner">
    <div class="book-banner__container">
		<? $is_retina = (isset($_COOKIE["device_pixel_ratio"]) && ($_COOKIE["device_pixel_ratio"] >= 2)); ?>
        <?if($block['head']) :?><h2 class="book-banner__title"><?=$block['head'];?></h2><?endif;?>
        <div class="book-banner__subtitle"><?=$block['text'];?></div>
        <div class="book-banner__img-holder">
			<? if($is_retina && !empty($block['icon_retina'])): ?>
          	  <img src="<?=$block['icon_retina'];?>" alt="<?=$block['alt_retina'];?>"></div>
			<? else: ?>
			  <img src="<?=$block['icon'];?>" alt="<?=$block['alt'];?>"></div>
			<? endif; ?>
		<? if ($block['btnType'] == 'basket_button'): ?>
			<a href="javascript:void(0);" class="button js-add-to-basket" data-product="<?= $block['btnLink']; ?>" <?= !empty($block['nofollow'])? 'rel="nofollow"' : '' ?>><?=$block['btnName'];?></a>
		<? else: ?>
        	<a href="<?if($block['btnType'] == 'form' && $block['btnLink'] == ''):?>#callback-new<?else :?><?=$block['btnLink'];?><?endif;?>" class="button <?if($block['btnType'] != '') :?>pupop<?endif;?>" <?if($block['btnType'] != '') :?>onclick="<?=FormHelper::getFormOnclickFunctionForConstructor($block['btnLink'], $block['btnHead'], $block['btnHead'], $block['buttonIDForm']);?>"<?endif;?> <?= !empty($block['nofollow'])? 'rel="nofollow"' : '' ?>><?=$block['btnName'];?></a>
		<? endif; ?>
    </div>
</div>
