<?
$additional_styles = "";
if(App\Editor\Blocks\Text::getValue($block,'top_border')){
    $additional_styles .= " _top-bordered";
}
if(App\Editor\Blocks\Text::getValue($block,'bottom_border')){
    $additional_styles .= " _bottom-bordered";
}
if(App\Editor\Blocks\Text::getValue($block,'nopt')){
    $additional_styles .= " ".App\Editor\Blocks\Text::getValue($block,'nopt');
}
if(App\Editor\Blocks\Text::getValue($block,'nopb')){
    $additional_styles .= " ".App\Editor\Blocks\Text::getValue($block,'nopb');
}
?>
<section class="section content-area <?= $additional_styles ?>">
	<div class="content-center">
		<div class="c-service-description__cols">
			<div class="c-service-description__left-col">
				<div class="c-service-description__content content-area">
					<?= $block['text_block'] ?>
				</div>
			</div>
			<div class="c-service-description__right-col">
				<div class="c-service-description__price">
					<div class="b-order-service _gray">
						<div class="b-order-service__top">
							<?= $block['upper_button']?>
						</div>
						<div class="b-order-service__price-holder">

							от <span class="b-order-service__price"><?= $block['price'] ?> </span><?= $block['price_measure'] ?>
						</div>
						<div class="b-order-service__btn-holder">
							<a href="#callback-new" onclick="setCallbackFormHeader('<?= $block['form_header']?>');" class="b-order-service__btn button pupop"><?= $block['button'] ?></a>
							<div class="b-order-service__remark b-order-service_remark-full-width"><?= $block['sub_button'] ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
