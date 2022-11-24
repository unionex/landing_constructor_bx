<? /** @var $block array */ ?>
<!--noindex-->
<? global $APPLICATION;?>
<section class="section-rd profteam-section section-rd--has-padding-bottom">
    <div class="container-rd section-rd__last-block">
        <h2 class="section-rd__h2"><?=(App\Editor\Blocks\Text::getValue($block,'value') ?
					App\Editor\Blocks\Text::getValue($block,'value') : 'С нами уже работают');?></h2>
        <!-- Начало блока: Карусель-->
        <?
        $count = 1;
        if(count($block['elements']) > 1) {
            global $arrFilterTopValue;
            unset($arrFilterTopValue);
            $arSort = [];
            // если свойтсво не пустое значит у нас есть явно заданые проекты по порядку
            foreach ($block['elements'] as $item) {
                $arrFilterTopValue['ID'][] = intval($item['selected_element_id']);
                $arSort[$item['selected_element_id']] = intval($count);
                $count++;
            }
            $news_count = count($arSort);
        }
        ?>
        <? $APPLICATION->IncludeComponent("bitrix:news.list", "workingWithUs",
            Array(
            "ACTIVE_DATE_FORMAT"              => "d.m.Y",
            "ADD_SECTIONS_CHAIN"              => "N",
            "AJAX_MODE"                       => "N",
            "AJAX_OPTION_ADDITIONAL"          => "",
            "AJAX_OPTION_HISTORY"             => "N",
            "AJAX_OPTION_JUMP"                => "N",
            "AJAX_OPTION_STYLE"               => "Y",
            "CACHE_FILTER"                    => "N",
            "CACHE_GROUPS"                    => "Y",
            "CACHE_TIME"                      => "36000000",
            "CACHE_TYPE"                      => "A",
            "CHECK_DATES"                     => "Y",
            "COMPONENT_TEMPLATE"              => "partnersShort",
            "DETAIL_URL"                      => "",
            "DISPLAY_BOTTOM_PAGER"            => "Y",
            "DISPLAY_DATE"                    => "Y",
            "DISPLAY_NAME"                    => "Y",
            "DISPLAY_PICTURE"                 => "Y",
            "DISPLAY_PREVIEW_TEXT"            => "Y",
            "DISPLAY_TOP_PAGER"               => "N",
            "FIELD_CODE"                      => array("", ""),
            "FILTER_NAME"                     => "arrFilterTopValue",
            "HIDE_LINK_WHEN_NO_DETAIL"        => "N",
            "IBLOCK_ID"                       => "20",
            "IBLOCK_TYPE"                     => "partners",
            "INCLUDE_IBLOCK_INTO_CHAIN"       => "N",
            "INCLUDE_SUBSECTIONS"             => "N",
            "MESSAGE_404"                     => "",
            "NEWS_COUNT"                      => "100",
            "PAGER_BASE_LINK_ENABLE"          => "N",
            "PAGER_DESC_NUMBERING"            => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL"                  => "N",
            "PAGER_SHOW_ALWAYS"               => "N",
            "PAGER_TEMPLATE"                  => ".default",
            "PAGER_TITLE"                     => "Новости",
            "PARENT_SECTION"                  => "",
            "PARENT_SECTION_CODE"             => "",
            "PREVIEW_TRUNCATE_LEN"            => "",
            "PROPERTY_CODE"                   => array("", ""),
            "SET_BROWSER_TITLE"               => "Y",
            "SET_LAST_MODIFIED"               => "N",
            "SET_META_DESCRIPTION"            => "Y",
            "SET_META_KEYWORDS"               => "Y",
            "SET_STATUS_404"                  => "N",
            "SET_TITLE"                       => "N",
            "SHOW_404"                        => "N",
            "SORT_BY1"                        => "ACTIVE_FROM",
            "SORT_BY2"                        => "SORT",
            "SORT_ORDER1"                     => "DESC",
            "SORT_ORDER2"                     => "ASC",
            "SORT_BY_CUSTOM_SORT"        => $arSort,
        )); ?>
        <!-- Конец блока: Карусель-->
	</div>
</section>
<!--/noindex-->
