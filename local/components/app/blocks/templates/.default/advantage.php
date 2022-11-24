<? /** @var $block array */ ?>
<? $elementCount = count($block['elements']); ?>
<section class="section-rd section-rd--after-text <?if($block['hpb']) :?><?=$block['hpb'];?><?endif;?>" data-attr="section-end-text">
    <div class="container-rd">
        <h2 class="section-rd__h2"><?=$block['heading'];?></h2>
        <ul class="iconic-list-rd <?if($elementCount == 4):?>iconic-list-rd--four-cols<?endif;?>">
            <?foreach ($block['elements'] as $element):?>
                <li>
                    <div class="iconic-list-rd__img-holder">
                        <img width="48" height="48" class="lazy" data-src="<?=$element['img'];?>" alt="<?=$element['alt'];?>">
                    </div>
                    <div class="iconic-list-rd__text">
                        <h3 class="iconic-list-rd__title"><?=$element['title'];?></h3>
                        <p><?=$element['subtitle'];?></p>
                    </div>
                </li>
            <?endforeach;?>
        </ul>
    </div>
</section>
