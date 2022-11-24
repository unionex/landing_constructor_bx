<!--noindex-->
<? global $APPLICATION;?>
<section class="experience-section section">
	<div class="content-center">

		<div class="experience-section__partners">
			<div class="h2"><?=(App\Editor\Blocks\Text::getValue($block,'value') ? App\Editor\Blocks\Text::getValue($block,'value'):"С нами уже работают");?></div>
			<!-- Начало блока: Карусель-->

			<?
			if(App\Editor\Blocks\Text::getValue($block,'companies')){
				$companies = App\Editor\Blocks\Text::getValue($block,'companies');
			}
			if($companies) {
				$projectWithSortArr = explode(",", $companies); //array("1:904","2:60","3:234", "4:58", "5:65","6:1642","7:208");
				global $arrFilterTopValue;
				unset($arrFilterTopValue);
				$arSort = array();
				// если свойтсво не пустое значит у нас есть явно заданые проекты по порядку
				if (!empty($projectWithSortArr)) {
					foreach ($projectWithSortArr as $item) {
						$project                   = explode(':', $item);
						$arrFilterTopValue['ID'][] = intval($project[1]);
						$arSort[ $project[1] ]     = intval($project[0]);

					}
					$news_count = count($arSort);
				}
			}
			?>
			<? $APPLICATION->IncludeComponent("bitrix:news.list", "partnersShort", Array(
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
		<div class="experience-section__offer">
			<div class="experience-section__offer-text">Уже готовы к началу<br/>сотрудничества?</div>
			<div class="experience-section__offer-button"><a href="#callback-new" onclick="setCallbackFormSource('Блок С нами уже работают')" class="button pupop">Да, перезвоните
					мне!</a></div>
		</div>
	</div>
</section>
<!--/noindex-->
