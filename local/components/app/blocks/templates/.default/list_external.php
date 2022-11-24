<? /** @var $block array */ ?>

<section class="section-rd <?if($block['hpb']) :?><?=$block['hpb'];?><?endif;?>"  data-attr="section-end-block">
    <div class="container-rd">
        <h2 class="section-rd__h2"><?=$block['heading'];?></h2>
        <div class="steps-rd">
            <? foreach ($block['elements'] as $k => $item): ?>
                <div class="steps-rd__element">
                    <div class="steps-rd__number"><?= $k+1; ?></div>
                    <p class="steps-rd__text"><?= $item['text']; ?></p>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>
