<? /** @var $block array */ ?>
<?
$unCache = $block['head'] ? md5($block['head']) : md5($block['elements'][0]['name']);
?>

<section class="section-rd <?if($block['hpb']) :?><?=$block['hpb'];?><?endif;?>"  data-attr="section-end-text">
    <div class="container-rd">
        <? if ($block['heading']) : ?><h2 class="section-rd__h2"><?= $block['heading'] ?></h2><? endif; ?>
        <div class="vertical-tabs js-tabs appWidgetTabsList" data-vertical="true">
            <ul class="vertical-tabs__list js-tabs__list">
                <? foreach ($block['elements'] as $key => $element) : ?>
					<? $bWithoutText = trim(strip_tags($element['text'])) === ''; ?>
                    <li data-id="c<?=$unCache?>-<?= $key; ?>"
                        class="js-tabs__tab is-hide <? if ($key == 0) : ?>is-active<? endif; ?> vertical-tabs__list-item">
						<?=$bWithoutText ? '<span>' : '';?><?= $element['name'] ?><?=$bWithoutText ? '</span>' : '';?>
					</li>
                <? endforeach; ?>
            </ul>
            <div class="vertical-tabs__container">
                <? foreach ($block['elements'] as $key => $element) : ?>
					<?
					$element['text'] = str_replace('../../', '/', $element['text']);
					if (substr_count($element['text'], '<p>') > 1 || preg_match('/(<table>)|(<ol>)|(<ul>)/', $element['text'])){
						$element['text'] = str_replace('js-fancy-media', 'js-fancy-media js-zoomib-event', $element['text']);
					}

					if (preg_match_all('/<img[^>]+>/i', $element['text'], $arImages)) {
						foreach ($arImages[0] as $image) {
							preg_match('/src=(["\'])(.*?)\1/', $image, $srcMatch);
							$src = $srcMatch[2];
							if (empty ($src)) {
								continue;
							}
							$element['text'] = str_replace($image, "<a href=\"{$src}\" class=\"js-fancy-media js-zoomib-event\">{$image}</a>", $element['text']);
						}
					}

					?>
                    <div id="c<?=$unCache?>-<?= $key; ?>" class="vertical-tabs__content js-tabs__content <? if ($key == 0) : ?>is-active<? endif; ?>">
                        <? if($element['title']):?><h3 class="vertical-tabs__content-title"><?= $element['title'] ?></h3><?endif;?>
                        <div class="content-area img-wrapper">
							<?= $element['text']; ?>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</section>
