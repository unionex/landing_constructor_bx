<? /** @var $block array */ ?>

<section class="section-rd <?if($block['hpb']) :?><?=$block['hpb'];?><?endif;?>"  data-attr="section-end-block">
    <div class="container-rd">
        <?if($block['heading']) :?><h2 class="section-rd__h2"><?=$block['heading']; ?></h2><?endif;?>
        <div class="highlighted-text highlighted-text--before-text">
            <? foreach ($block['elements'] as $item): ?>
                <div class="highlighted-text__element highlighted-text__element--inline-up-to-md">
                    <div class="highlighted-text__top">
                        <img src="<?=$item['icon'];?>" alt="<?= $item['alt'];?>" height="48" width="48">
                    </div>
                    <p class="highlighted-text__text"><?= $item['head']; ?><br class="hide-up-to-md"><?= $item['headBr']; ?></p>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>
