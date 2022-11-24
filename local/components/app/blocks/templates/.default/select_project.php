<? /** @var $block array */ ?>
<? $elementCount = count($block['elements']); ?>
<style>
	.projects-slider-rd._new .projects-slider-rd__slide .ul_mdash ul{
		list-style: none inside;
	}
	.projects-slider-rd._new .projects-slider-rd__slide .ul_mdash ul>li:before{
		content: "–";
	}
</style>
<section class="section-rd section-rd--gray section-rd--has-padding-bottom">
	<div class="container-rd section-rd__last-block">
		<h2 class="section-rd__h2">
			Выберите свой проект
		</h2>
		<div class="projects-slider-rd js-projects-slider-rd _new">
			<div class="projects-slider-rd__slides ">
				<?$i = 0;?>
				<?foreach ($block['elements'] as $element):?>
					<div class="projects-slider-rd__slide <?if($i == 0):?>active-slide<?endif;?>">
						<?$i++;?>
						<div class="projects-slider-rd__heading">
							<div class="projects-slider-rd__heading-logo">
								<img src="<?=$element["img"]?>" alt="" width="117" height="117">
							</div>
							<div class="projects-slider-rd__heading-text">
								<h3 class="projects-slider-rd__heading-title"><?=$element["title"]?></h3>
							</div>
						</div>
						<div class="projects-slider-rd">
							<span class="projects-slider-rd__info-remark"><?=$element["subtitle1"]?></span>
							<div class="ul_mdash">
								<?=$element["text1"]?>
							</div><br>
							<span class="projects-slider-rd__info-remark"><?=$element["subtitle2"]?></span>
							<div class="ul_mdash">
								<?=$element["text2"]?>
							</div>
						</div>
						<div class="projects-slider-rd-iconList">
							<?if($element["circleText1"] && $element["circleSubText1"]) :?>
								<div class="projects-slider-rd-iconList-item">
									<div class="projects-slider-rd-iconList-item__icon">
										<span><?=$element["circleText1"]?></span>
									</div>
									<p><?=$element["circleSubText1"]?></p>
								</div>
							<?endif;?>
							<?if($element["circleText2"] && $element["circleSubText2"]) :?>
								<div class="projects-slider-rd-iconList-item">
									<div class="projects-slider-rd-iconList-item__icon">
										<span><?=$element["circleText2"]?></span>
									</div>
									<p><?=$element["circleSubText2"]?></p>
								</div>
							<?endif;?>
							<?if($element["circleText3"] && $element["circleSubText3"]) :?>
								<div class="projects-slider-rd-iconList-item">
									<div class="projects-slider-rd-iconList-item__icon">
										<span><?=$element["circleText3"]?></span>
									</div>
									<p><?=$element["circleSubText3"]?></p>
								</div>
							<?endif;?>
							<?if($element["circleText4"] && $element["circleSubText4"]) :?>
								<div class="projects-slider-rd-iconList-item">
									<div class="projects-slider-rd-iconList-item__icon">
										<span><?=$element["circleText4"]?></span>
									</div>
									<p><?=$element["circleSubText4"]?></p>
								</div>
							<?endif;?>
						</div>
					</div>
				<?endforeach;?>
			</div>
		</div>
	</div>
</section>

<?
   $asset = Bitrix\Main\Page\Asset::getInstance();
   $asset->addJs(SITE_TEMPLATE_PATH . '/scripts/projects-slider-rd.js');
?>
