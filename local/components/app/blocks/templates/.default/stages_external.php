<? /** @var $block array */

    $classStep = [
        '',
        '',
        'steps__element--three-step',
        'steps__element--four-step',
        'steps__element--five-step',
        'steps__element--six-step'
    ];
?>
<section class="section-rd <?if($block['hpb']) :?><?=$block['hpb'];?><?endif;?>" data-attr="section-end-text">
    <div class="container-rd">
        <h2 class="section-rd__h2"><?=$block['heading'];?></h2>
        <div class="steps steps--lg-pb">
            <? foreach ($block['elements'] as $k => $item): ?>
                <div class="steps__element <?=$classStep[$k];?>">
                    <span class="steps__number"><?=$k+1;?></span>
                    <p class="steps__text"><?=$item['text'];?></p>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>
