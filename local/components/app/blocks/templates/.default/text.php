<?/** @var $block array */
use App\Editor\Blocks\Text; ?>
<?
$additional_styles = $block['block_style'];
if(App\Editor\Blocks\Text::getValue($block,'nopt')){
    $additional_styles .= " ".App\Editor\Blocks\Text::getValue($block,'nopt');
}
if(App\Editor\Blocks\Text::getValue($block,'nopb')){
    $additional_styles .= " ".App\Editor\Blocks\Text::getValue($block,'nopb');
}
if(App\Editor\Blocks\Text::getValue($block,'top_border')){
    $additional_styles .= " _top-bordered";
}
if(App\Editor\Blocks\Text::getValue($block,'bottom_border')){
    $additional_styles .= " _bottom-bordered";
}
?>
<section class="section content-area <?= $additional_styles ?>">
	<div class="content-center">
		<?=App\Editor\Blocks\Text::getValue($block);?>
	</div>
</section>

