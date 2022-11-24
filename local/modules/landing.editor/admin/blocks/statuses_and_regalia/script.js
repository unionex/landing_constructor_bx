landing_editor.registerBlock('statuses_and_regalia', function ($, $el, data) {

	randomInt = function (min, max) {
		return min + Math.floor((max - min) * Math.random());
	};

	if(!data.elements) {
		data = $.extend({
			value: '',
			hpb: '',
			elements: [{
				service_packages_sets: [],
				uid: randomInt( 1, 100000),
				selected_element_id: ''
			}]
		}, data);
	} else {
		count = data.elements.length - 1;
	}

	this.getData = function () {
		return data;
	};

	this.collectData = function () {

		//Классы отступов
		//section-rd--has-padding-bottom
		if ($el.find('.has-padding-bottom').prop('checked')) {
			data.hpb = $el.find('.has-padding-bottom').val();
		} else {
			data.hpb = "";
		}

		data.elements = [];
		data.value = $el.find('input.title-statuses-input').val();

		$el.find('.js-elem-company').each(function () {
			let target = $(this);
			let dataElem = {};

			dataElem.selected_element_id = target.find('.input-element').val();
			dataElem.uid = randomInt( 1, 100000);

			data.elements.push(dataElem);
		});

		return data;
	};

	this.afterRender = function () {
		let $res = $el.find('.js-elements-company');

		//Проверяем чекбокс
		let val = '';

		val = $el.find('.has-padding-bottom').attr('data-selected');
		if(val.length > 0) {
			$el.find('.has-padding-bottom').prop('checked', true);
		}

		$res.html(
			landing_editor.renderTemplate('statuses_and_regalia-select', data)
		);

		$el.on('click', '.button-remove', function () {
			let wrap = $(this).parents('.js-elem-company');

			wrap.remove();

			countNext = 0;
			count = 0;

			data.elements = [];

			$el.find('.js-elem-company').each(function () {
				let target = $(this);
				let dataElem = {};

				dataElem.selected_element_id = target.find('.input-element').val();
				dataElem.uid = randomInt( 1, 100000);

				data.elements.push(dataElem);
			});
		});

		$el.on('click', '.sp-lists-add-company', function () {
			$res.append(
				landing_editor.renderTemplate('statuses_and_regalia-select', {
					elements: [{
						service_packages_sets: [],
						uid: randomInt( 1, 100000),
						selected_element_id: ''
					}]
				})
			);
		});
	};


});
