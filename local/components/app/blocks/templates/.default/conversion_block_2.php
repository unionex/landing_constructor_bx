<?
global $APPLICATION;
$style2 = "contact-modal__plate ";
$style = App\Editor\Blocks\Text::getValue($block,'block_style');
$heading = App\Editor\Blocks\Text::getValue($block,'value');
if($style == '_gray'){
	$style2 .= ' _white';
	if(App\Editor\Blocks\Text::getValue($block,'top_border')){
		$style .= " _top-bordered-white";
	}
	if(App\Editor\Blocks\Text::getValue($block,'bottom_border')){
		$style .= " _bottom-bordered-white";
	}
}else{
	if(App\Editor\Blocks\Text::getValue($block,'top_border')){
		$style .= " _top-bordered";
	}
	if(App\Editor\Blocks\Text::getValue($block,'bottom_border')){
		$style .= " _bottom-bordered";
	}
}
if(App\Editor\Blocks\Text::getValue($block,'nopt')){
    $style .= " ".App\Editor\Blocks\Text::getValue($block,'nopt');
}
if(App\Editor\Blocks\Text::getValue($block,'nopb')){
    $style .= " ".App\Editor\Blocks\Text::getValue($block,'nopb');
}

use App\Editor\Blocks\Text; ?>

<section class="section <?=$style?>">
	<div class="content-center">
		<div class="b-consultation-block">
			<div class="h1"><?=$heading?></div>
			<div class="section__row-lg">
				<div class="section__col-1-2-lg center">
					<div class="h2">Консультации по 1С</div>
					<div class="h4">Звоните</div>
					<div class="b-consultation-block__contacts">
						<div class="b-consultation-block__phone"><?
							$APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
								"AREA_FILE_SHOW" => "file",
								"PATH"           => SITE_DIR . '/local/include/phone_link.php'
							));
							?></div>

						<a class="b-consultation-block__email-link" href="mailto:<? include($_SERVER['DOCUMENT_ROOT'] . '/local/include/email.php') ?>"><? include($_SERVER['DOCUMENT_ROOT'] . '/local/include/email.php') ?></a>

					</div>
					<p class="b-consultation-block__text">На все вопросы отвечают только <br> сертифицированные специалисты</p>
				</div>
				<div class="section__col-1-2-lg">
					<div class="contact-modal form-standart b-consultation-block__form _block _outside-of-modal">
						<?$APPLICATION->IncludeComponent(
							"bitrix:form.result.new",
							"CallbackFooter",
							array(
								"WEB_FORM_ID" => "RECALL_NEW",
								"ZATO_DIRECTION" => FormHelper::getDefaultZatoDirection(),
								"HIDE_EMAIL" => "Y",
								"IGNORE_CUSTOM_TEMPLATE" => "N",
								"USE_EXTENDED_ERRORS" => "Y",
								"SEF_MODE" => "N",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "3600",
								"LIST_URL" => "",
								"EDIT_URL" => "",
								"SUCCESS_URL" => "",
								"CHAIN_ITEM_TEXT" => "",
								"CHAIN_ITEM_LINK" => "",
								"SEF_FOLDER" => "",
								"WEB_FORM_ID2" => "N",
								"ITEM_TITLE_VALUE" => "",
								"ITEM_URL_VALUE" => "",
								"FORM_CONTAINER_CLASS" => $style2, // yeah, i know. It's SEO, baby.
								"FORM_CONTAINER_ID" => "callback-no-modal",
								"VARIABLE_ALIASES" => array(
									"WEB_FORM_CLASS" => "js-ajax",
									"WEB_FORM_ID" => "CALLBACK_FORM",
									"RESULT_ID" => "RESULT_ID",
								),
								"SUBMIT_TEXT" => "Заказать звонок",
								"COLOR" => $style,
                                "FORM_AUTOCALL_VALUE" => 'true'
							),
							false
						);?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
