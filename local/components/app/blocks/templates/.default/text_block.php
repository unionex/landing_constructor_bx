<?/** @var $block array */?>
<section class="section-rd <?=$block["block_style"]?> <?=$block["nopt"]?>" data-attr="section-end-text">
	<div class="container-rd content-area">
		<?
		$h1 = array("<h1>");
		$h1_format   = array("<h1 class='section-rd__h1'>");
		$content = str_replace($h1, $h1_format, $block["value"]);
		$h2 = array("<h2>");
		$h2_format   = array("<h2 class='section-rd__h2'>");
		$content = str_replace($h2, $h2_format, $block["value"]);
		?>
		<?=$content?>
	</div>
</section>
