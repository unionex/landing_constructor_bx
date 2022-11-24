<? /** @var $block array */ ?>

<?
global $arrFilter, $APPLICATION;

$iblockId = $block['type'] == 'article' ? EnvironmentHelper::getParam("articlesIblockID") :
		EnvironmentHelper::getParam('newsIblockID');

$page = $block['type'] == 'article' ? 'articles' :
		'novosti';

$arSections = explode(',', $block['sections']);

$arrFilter = BlogHelper::getFilterForListElements($arSections);
$arrFilter["FAKE_FILTER_TAGS"] = $arSections;

?>
<section class="section-rd <?if($block['hpb']) :?><?=$block['hpb'];?><?endif;?>"  data-attr="section-end-block">
	<div class="container-rd">
		<? if ($block['heading']) : ?><h2 class="section-rd__h2"><?= $block['heading'] ?></h2><? endif; ?>
		<?$APPLICATION->IncludeComponent("bitrix:news.list", "blog2.useful.articles", [
				"HIDE_DESCRIPTION"                => true,
				"ACTIVE_DATE_FORMAT"              => "d.m.Y",
				"ADD_SECTIONS_CHAIN"              => "N",
				'ADD_ELEMENT_CHAIN'               => 'N',
				"INCLUDE_IBLOCK_INTO_CHAIN"       => "N",
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
				"COMPONENT_TEMPLATE"              => ".default",
				"DETAIL_URL"                      => "",
				"DISPLAY_BOTTOM_PAGER"            => "Y",
				"DISPLAY_DATE"                    => "Y",
				"DISPLAY_NAME"                    => "Y",
				"DISPLAY_PICTURE"                 => "N",
				"DISPLAY_PREVIEW_TEXT"            => "Y",
				"DISPLAY_TOP_PAGER"               => "N",
				"FIELD_CODE"                      => ["TAGS"],
				"FILTER_NAME"                     => "arrFilter",
				"HIDE_LINK_WHEN_NO_DETAIL"        => "N",
				"IBLOCK_ID"                       => $iblockId,
				"NEWS_COUNT"                      => "3",
				"NEWS_COUNT_MOBILE"               => "2",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL"                  => "Y",
				"PAGER_SHOW_ALWAYS"               => "N",
				"PAGER_TEMPLATE"                  => ".default",
				"PAGER_TITLE"                     => "Новости",
				"PREVIEW_TRUNCATE_LEN"            => "200",
				'PROPERTY_CODE'                   => [
						'ARTICLE_TAGS'
				],
				"SET_BROWSER_TITLE"               => "N",
				"SET_LAST_MODIFIED"               => "N",
				"SET_META_DESCRIPTION"            => "N",
				"SET_META_KEYWORDS"               => "N",
				"SET_STATUS_404"                  => "N",
				"SET_TITLE"                       => "N",
				"SHOW_404"                        => "N",
				"SORT_BY1"                        => "ACTIVE_FROM",
				"SORT_ORDER1"                     => "DESC",
				"SECTION"                         => "articles",
				"SECTION_URL"                     => "articles",
				"ALL_ITEMS_URL"					  => "/o-kompanii/blog/".$page."/"
		], false);
		?>
	</div>
</section>

