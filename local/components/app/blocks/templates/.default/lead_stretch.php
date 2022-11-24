<? /** @var $block array */ ?>
<div class="highlighted-banner">
	<div class="container-rd">
		<div class="highlighted-banner__inner">
			<h2 class="highlighted-banner__title"><?=$block['text'];?></h2>
			<? if ($block['btnType'] == 'basket_button'): ?>
				<button class="button js-add-to-basket" data-product="<?= $block['btnLink'] ?>"><?= $block['btnName'] ?></button>
			<? else: ?>
				<a href="<?if($block['btnType'] == 'form' && $block['btnLink'] == '') :?>#callback-new<?else:?><?=$block['btnLink'];?><?endif;?>" class="button <?if($block['btnType'] != '') :?>pupop<?endif;?>" <?if($block['btnType'] != '') :?>onclick="<?=FormHelper::getFormOnclickFunctionForConstructor($block['btnLink'], $block['btnHead'], $block['btnHead'], $block['buttonIDForm']) ;?>"<?endif;?> <?= !empty($block['nofollow'])? 'rel="nofollow"' : '' ?>><?=$block['btnName'];?></a>
			<? endif; ?>
		</div>
	</div>
</div>
