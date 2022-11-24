<? /** @var $block array */

global $obJsonFAQ;
if(!isset($obJsonFAQ))
{
    $obJsonFAQ = new App\SEO\JsonFAQ();
}
foreach ($block['elements'] as $key => $element) {
    /**
     * Заголовок содержит вопрос
     */
    if (stristr($element['title'], "?")){
        $obJsonFAQ->setQuestion($element['title']);
        $obJsonFAQ->setAnswer($element['text']);
    }
}
?>

<section class="section-rd <?if($block['hpb']) :?><?=$block['hpb'];?><?endif;?>"  data-attr="section-end-block">
    <div class="container-rd">
        <h2 class="section-rd__h2"><?=$block['heading']?></h2>
		<?if($block['preview']) :?><p><?=$block['preview']?></p><?endif;?>
        <ol class="accordeon-rd">
            <?foreach ($block['elements'] as $key => $element) :?>
                <li class="more-info accordeon-rd__item" data-accordeon="true">
                    <a href="#" class="accordeon-rd__question more-info__link <?if($key == 0) :?>_opened<?endif;?>"><?=$element['title']?></a>
                    <div class="accordeon-rd__answer more-info__container  <?if($key == 0) :?>_opened<?endif;?> content-area">
                        <?=$element['text']?>
                    </div>
                </li>
            <?endforeach;?>
        </ol>
    </div>
</section>
