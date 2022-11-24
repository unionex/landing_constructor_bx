landing_editor.registerBlock('working_with_us', function ($, $el, data) {

	randomInt = function (min, max) {
		return min + Math.floor((max - min) * Math.random());
	};

	if(!data.elements) {
		data = $.extend({
			value: '',
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

		data.elements = [];
		data.value = $el.find('input.title-working-input').val();

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

		$res.html(
			landing_editor.renderTemplate('working_with_us-select', data)
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
				landing_editor.renderTemplate('working_with_us-select', {
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
