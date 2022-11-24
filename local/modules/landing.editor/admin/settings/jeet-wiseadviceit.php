<?php
/*
 * Настройка конструктора страниц для Jeet на проекте App
 */

$settings = array(
    'title' => 'JeetApp',

    'layout_classes' => array(
        'type1' => array(
        	array('container'),
        	array('clearfix'),
            array('section--gray', 'section--bright-gray')
        ),
        'type2' => array(
            array('col-1-2-md'),
            array('pull-1-2-md','push-1-2-md'),
            array('section--gray', 'section--bright-gray')
        ),
        'type3' => array(
        ),
        'type4' => array(
        ),
    ),

    'layout_defaults' => array(
        'type1' => 'container',
        'type2' => 'col-1-2-md',
        'type3' => '',
        'type4' => '',
    ),

	'block_settings' => array(
		'free_consult' => array(
			'adaptive' => array(
				'type' => 'select',
				'value' => array(
					'default' => 'Показывать всегда',
					'show-xs' => 'Показывать на мобильной версии',
					'show-md' => 'Показывать на полной версии',
				)
			),
		),
		'subscribe' => array(
			'adaptive' => array(
				'type' => 'select',
				'value' => array(
					'default' => 'Показывать всегда',
					'show-xs' => 'Показывать на мобильной версии',
					'show-md' => 'Показывать на полной версии',
				)
			),
		),
		'links' => array(
			'type' => array(
				'type' => 'select',
				'value' => array(
					'default' => 'Текстовые ссылки',
					'buttons' => 'Ссылки кнопками'
				)
			),
			'color' => array(
				'type' => 'select',
				'value' => array(
					'default' => 'Серый фон',
					'blue' => 'Синий фон'
				)
			),
		),
		'text' => array(
			'type' => array(
				'type' => 'select',
				'value' => array(
					'default' => 'Отображение по умолчанию',
					'info' => 'Блок с информацией',
					'alert' => 'Блок "Внимание!"',
				)
			),
		),
		'lists_heading' => array(
			'type' => array(
				'type' => 'select',
				'value' => array(
					'default' => 'Отображение по умолчанию',
					'alert' => 'Блок "Внимание!"',
				)
			),
		)
	),

);
