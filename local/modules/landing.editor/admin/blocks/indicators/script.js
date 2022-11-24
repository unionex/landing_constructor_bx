wait_editor.registerBlock('indicators', function ($, $el, data) {

	randomInt = function (min, max) {
		return min + Math.floor((max - min) * Math.random());
	};

	if(!data.elements) {
		data = $.extend({
			// value: '',
			elements: [{
				service_packages_sets: [],
				uid: randomInt( 1, 100000),
				selected_element_id: '',
				selected_element_value: ''
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
		// data.value = $el.find('input.title-working-input').val();

		$el.find('.js-elem-company').each(function () {
			let target = $(this);
			let dataElem = {};

			dataElem.selected_element_id = target.find('.input-element-id').val();
			dataElem.selected_element_value = target.find('.input-element-value').val();
			dataElem.uid = randomInt( 1, 100000);

			data.elements.push(dataElem);
		});

		return data;
	};

	this.afterRender = function () {
		let $res = $el.find('.js-elements-indicators');

		$res.html(
			wait_editor.renderTemplate('indicators-select', data)
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

				dataElem.selected_element_id = target.find('.input-element-id').val();
				dataElem.selected_element_value = target.find('.input-element-value').val();
				dataElem.uid = randomInt( 1, 100000);

				data.elements.push(dataElem);
			});
		});

		$el.on('click', '.sp-lists-add-company', function () {
			$res.append(
				wait_editor.renderTemplate('indicators-select', {
					elements: [{
						service_packages_sets: [],
						uid: randomInt( 1, 100000),
						selected_element_id: '',
						selected_element_value:''
					}]
				})
			);
		});
	};


});
