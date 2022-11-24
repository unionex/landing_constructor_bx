<?
$additional_styles = "";
if(App\Editor\Blocks\Text::getValue($block,'block_style')){
	$additional_styles .= " ".App\Editor\Blocks\Text::getValue($block,'block_style');
}
if(App\Editor\Blocks\Text::getValue($block,'nopt')){
	$additional_styles .= " ".App\Editor\Blocks\Text::getValue($block,'nopt');
}
if(App\Editor\Blocks\Text::getValue($block,'nopb')){
	$additional_styles .= " ".App\Editor\Blocks\Text::getValue($block,'nopb');
}
if(App\Editor\Blocks\Text::getValue($block,'block_style') == '_gray'){
	if(App\Editor\Blocks\Text::getValue($block,'top_border')){
		$additional_styles .= " _top-bordered-white";
	}
	if(App\Editor\Blocks\Text::getValue($block,'bottom_border')){
		$additional_styles .= " _bottom-bordered-white";
	}
}else{
	if(App\Editor\Blocks\Text::getValue($block,'top_border')){
		$additional_styles .= " _top-bordered";
	}
	if(App\Editor\Blocks\Text::getValue($block,'bottom_border')){
		$additional_styles .= " _bottom-bordered";
	}
}
?>
<section class="section content-area <?=$additional_styles;?>">
	<div class="content-center">
		<div class="promo-block _demonstration">
			<div class="promo-block__content">
				<div class="h2">
					<?=App\Editor\Blocks\Text::getValue($block,'value');?>
				</div>
				<a href="#callback-new" class="button pupop"><?=App\Editor\Blocks\Text::getValue($block,'value2');?></a>
				<p>
					<?=App\Editor\Blocks\Text::getValue($block,'value3');?>
				</p>
			</div>
		</div>

	</div>
</section>
