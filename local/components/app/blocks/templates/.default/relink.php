<? /** @var $block array */ ?>

<section class="section-rd section-rd--after-accordeon <?if($block['hpb']) :?><?=$block['hpb'];?><?endif;?>" data-attr="section-end-text">
	<div class="container-rd">
		<h2 class="section-rd__h2"><?= $block['heading']; ?></h2>
		<ul class="iconic-list-rd iconic-list-rd--horizontal iconic-list-rd--two-cols">
			<? foreach ($block['elements'] as $item) : ?>
				<li>
					<div class="iconic-list-rd__img-holder iconic-list-rd__img-holder--32">
						<img width="32" height="32" src="<?= $item['icon']; ?>" alt="">
					</div>
					<div class="iconic-list-rd__text">
						<a href="<?= $item['link']; ?>" class="default-link iconic-list-rd__link" <?= !empty($item['nofollow'])? 'rel="nofollow"' : '' ?>><?= $item['head']; ?></a>
						<p><?= $item['text']; ?></p>
					</div>
				</li>
			<? endforeach; ?>
		</ul>
	</div>
</section>

