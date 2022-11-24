<? /** @var $block array */ ?>

<div class="highlighted-banner">
	<div class="container-rd">
		<div class="highlighted-banner__inner">
			<h2 class="highlighted-banner__title"><?=$block['text'];?></h2>
			<? if ($block['btnType'] == 'basket_button'): ?>
				<button class="button js-add-to-basket" data-product="<?= $block['btnLink'] ?>"><?= $block['btnName'] ?></button>
			<? else: ?>
				<a href="<?if($block['btnType'] == 'form' && $block['btnLink'] == '') :?>#callback-new<?else:?><?=$block['btnLink'];?><?endif;?>" class="button <?if($block['btnType'] != '') :?>pupop<?endif;?>" <?if($block['btnType'] != '') :?>onclick="<?=FormHelper::getFormOnclickFunctionForConstructor($block['btnLink'], $block['btnHead'], $block['btnHead']);?>"<?endif;?>><?=$block['btnName'];?></a>
			<? endif; ?>
		</div>
	</div>
</div>


<? if(isset($block['head']) && strlen($block['head']) > 0)
	$header = $block['head'];
else
	$header = 'Команда профессионалов';
?>
<section class="section-rd section-rd--gray section-rd--has-padding-bottom team-person">
	<div class="container-rd is-adaptive section-rd__last-block">
		<h2 class="section-rd__h2 section-rd__h2--before-text team-person__h2"><?= $header ?></h2>
		<div class="profteam-section__top-info">
			<?if($block['btnType'] ==! 'none') :?>
				<div class="profteam-section__aside">
					<a href="<?if($block['btnType'] == 'form' && $block['btnLink'] == '') :?>#callback-new<?else:?><?=$block['btnLink'];?><?endif;?>" class="balloon-link balloon-link--white <?if($block['btnType'] != '') :?>pupop<?endif;?>" <?if($block['btnType'] != '') :?>onclick="<?=FormHelper::getFormOnclickFunctionForConstructor($block['btnLink'], $block['btnHead'], $block['btnHead']);?>"<?endif;?>><span class="balloon-link__text"><?=$block['btnName'];?></span></a>
				</div>
			<?endif;?>
			<div class="profteam-section__content">
				<?=$block['text']?>
			</div>
		</div>
		<!-- Начало блока: Новая команда -->
		<?
		$team = [
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person35_smile.jpg',
						'name' => 'Овчинников Сергей',
						'position' => 'Менеджер по качеству',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person36_smile.jpg',
						'name' => 'Плешко Алина',
						'position' => 'Менеджер по качеству',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person48_smile.jpg',
						'name' => 'Якушев Михаил',
						'position' => 'Менеджер по качеству',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person77_smile.jpg',
						'name' => 'Федяев Дмитрий',
						'position' => 'Руководитель проектов',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person70_smile.jpg',
						'name' => 'Бессонов Олег',
						'position' => 'Руководитель проектов',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person74_smile.jpg',
						'name' => 'Романенко Юрий',
						'position' => 'Руководитель проектов',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person78_smile.jpg',
						'name' => 'Шаршин Сергей',
						'position' => 'Руководитель проектов',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person71_smile.jpg',
						'name' => 'Голобурда Наталья',
						'position' => 'Руководитель проектов',
				],

				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person73_smile.jpg',
						'name' => 'Наумов Сергей',
						'position' => 'Руководитель проектов',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person47_smile.jpg',
						'name' => 'Лунев Сергей',
						'position' => 'Руководитель проектов',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person60_smile.jpg',
						'name' => 'Пузанов Игорь',
						'position' => 'Руководитель проектов',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person72_smile.jpg',
						'name' => 'Литовка Дмитрий',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person80_smile.jpg',
						'name' => 'Ярхамов Альфред',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person76_smile.jpg',
						'name' => 'Тараканов Дмитрий',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person81_smile.jpg',
						'name' => 'Живолупова Юлия',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person79_smile.jpg',
						'name' => 'Югай Ирина',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person1_smile.jpg',
						'name' => 'Беппиева Нана',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person2_smile.jpg',
						'name' => 'Брыкина Ирина',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person3_smile.jpg',
						'name' => 'Глухова Светлана',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person14_smile.jpg',
						'name' => 'Демина Евгения',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person15_smile.jpg',
						'name' => 'Югова Анастасия',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person22_smile.jpg',
						'name' => 'Полянин Иван',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person23_smile.jpg',
						'name' => 'Махмудова Галина',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person24_smile.jpg',
						'name' => 'Мартынов Захар',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person27_smile.jpg',
						'name' => 'Егорова Елена',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person26_smile.jpg',
						'name' => 'Львова Алла',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person28_smile.jpg',
						'name' => 'Евстратова Наталья',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person39_smile.jpg',
						'name' => 'Жукова Татьяна',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person40_smile.jpg',
						'name' => 'Коркодел Мария',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person43_smile.jpg',
						'name' => 'Айрапетова Марина',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person44_smile.jpg',
						'name' => 'Абросимова Лариса',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person54_smile.jpg',
						'name' => 'Мерзляков Евгений',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person58_smile.jpg',
						'name' => 'Забелина Ирина',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person57_smile.jpg',
						'name' => 'Лебедев Андрей',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person50_smile.jpg',
						'name' => 'Скуридин Дмитрий',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person52_smile.jpg',
						'name' => 'Тозик Виктория',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person55_smile.jpg',
						'name' => 'Парамзин Андрей',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person66_smile.jpg',
						'name' => 'Романов Николай',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person16_smile.jpg',
						'name' => 'Федулов Сергей',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person18_smile.jpg',
						'name' => 'Тельнова Светлана',
						'position' => 'Консультант-аналитик 1С',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person19_smile.jpg',
						'name' => 'Слюсаренко Евгений',
						'position' => 'Консультант 1C',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person20_smile.jpg',
						'name' => 'Романовская Светлана',
						'position' => 'Консультант-аналитик',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person25_smile.jpg',
						'name' => 'Мамукова Елена',
						'position' => 'Консультант',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person41_smile.jpg',
						'name' => 'Плечева Елена',
						'position' => 'Руководитель центра ERP-систем',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person46_smile.jpg',
						'name' => 'Голобурда Наталья',
						'position' => 'Руководитель центра автоматизации корпоративных финансов',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person53_smile.jpg',
						'name' => 'Рыбакова Валентина',
						'position' => 'Консультант 1С',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person56_smile.jpg',
						'name' => 'Сухарев Юрий',
						'position' => 'Консультант 1С',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person63_smile.jpg',
						'name' => 'Фурсов Иван',
						'position' => 'Ведущий консультант 1С',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person65_smile.jpg',
						'name' => 'Горбенко Екатерина',
						'position' => 'Консультант 1С',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person75_smile.jpg',
						'name' => 'Санников Михаил',
						'position' => 'Программист',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person5_smile.jpg',
						'name' => 'Топорков Александр',
						'position' => 'Инженер-программист',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person6_smile.jpg',
						'name' => 'Сластная Елена',
						'position' => 'Инженер-программист',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person7_smile.jpg',
						'name' => 'Постнов Евгений',
						'position' => 'Инженер-программист',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person8_smile.jpg',
						'name' => 'Осокин Владимир',
						'position' => 'Инженер-программист',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person9_smile.jpg',
						'name' => 'Мустафин Марат',
						'position' => 'Руководитель центра разработки',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person68_smile.jpg',
						'name' => 'Быков Игорь',
						'position' => 'Программист 1С',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person10_smile.jpg',
						'name' => 'Корнеев Дмитрий',
						'position' => 'Программист',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person11_smile.jpg',
						'name' => 'Калюкин Владислав',
						'position' => 'Программист',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person12_smile.jpg',
						'name' => 'Иншаков Илья',
						'position' => 'Программист',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person13_smile.jpg',
						'name' => 'Дроздов Павел',
						'position' => 'Программист',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person49_smile.jpg',
						'name' => 'Сайко Михаил',
						'position' => 'Программист',
				],
				[
						'image' => SITE_TEMPLATE_PATH . '/img/content/persons/person67_smile.jpg',
						'name' => 'Трегуб Александр',
						'position' => 'Программист',
				],
		];
		?>
		<!--noindex-->
		<div class="team-person__block">
			<div class="team-person__main">
				<div>
					<div class="team-person__main-name">Александр Прямоносов</div>
					<div class="team-person__main-position">Генеральный директор</div>
				</div>
				<div class="team-person__main-photo">
					<img class="lazy" data-src="<?=SITE_TEMPLATE_PATH?>/img/content/persons/team-person1.jpg" alt="Фото" class="team-person__main-img"/>
				</div>
			</div>
			<div class="team-person__staff">
				<div class="b-personal-photos">
					<div class="b-personal-photos__plates _overlay">
						<?foreach ($team as $key => $item):?>
							<div class="b-personal-photos__plate <?= $key > 17 ? '_hide' : ''?>">
								<div class="b-personal-photo">
									<img class="lazy" data-src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" width="85" height="99" class="b-personal-photo__smile"/>
									<div class="b-personal-photo__title">
										<div><b><?= $item['name'] ?></b><span><?= $item['position'] ?></span></div>
									</div>
								</div>
							</div>
						<?endforeach;?>
					</div>
					<? $count = count($team) - 18 ?>
					<div class="b-personal-photos__more-holder">
						<a href="#" class="b-personal-photos__more">
							<span>Посмотреть еще <span><?= $count ?></span> специалистов</span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<!--/noindex-->
		<!-- Конец блока: Новая команда -->
	</div>
</section>
