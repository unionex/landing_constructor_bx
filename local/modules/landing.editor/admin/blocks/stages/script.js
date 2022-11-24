wait_editor.registerBlock('stages', function ($, $el, data) {

	data = $.extend({
		noindex: '',
		heading: '',
		hpb: '',
		elements: [{
			text: ''
		}, {
			text: ''
		}, {
			text: ''
		}]
	}, data);

	this.getData = function () {
		return data;
	};

	this.collectData = function () {

		//Класс отступов
		//section-rd--has-padding-bottom
		if ($el.find('.has-padding-bottom').prop('checked')) {
			data.hpb = $el.find('.has-padding-bottom').val();
		} else {
			data.hpb = "";
		}

		data.noindex = $el.find('[name="noindex"]').is(":checked");
		data.heading = $el.find('input.js-heading').val();
		data.elements = [];

		$el.find('.js-elem').each(function () {
			let target = $(this);
			let dataElem = {};

			dataElem.text = $.trim(target.find('[name="text"]').val());

			data.elements.push(dataElem);
		});

		return data;
	};

	this.afterRender = function () {
		let $res = $el.find('.js-elements');

		//Проверяем чекбокс
		let val = '';

		val = $el.find('.has-padding-bottom').attr('data-selected');
		if(val.length > 0) {
			$el.find('.has-padding-bottom').prop('checked', true);
		}

		$res.html(
			wait_editor.renderTemplate('list-items', data)
		);

		$el.on('click', '.sp-lists-add', function () {
			if($res[0].childElementCount >= 5) {
				$el.find('.sp-lists-add').hide();
			}
			$res.append(
				wait_editor.renderTemplate('list-items', {
					elements: [{
						text: ''
					}]
				})
			);
		});

		if($res[0].childElementCount == 6) {
			$el.find('.sp-lists-add').hide();
		}
	}
});