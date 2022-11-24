wait_editor.registerBlock('faq_block', function ($, $el, data) {

	data = $.extend({
		heading: '',
		preview: '',
		elements: [{
			title: '',
			text: '',
			hpb: ''
		}]
	}, data);

	this.getData = function () {
		return data;
	};

	this.collectData = function () {

		//Класс отсутпов
		//section-rd--has-padding-bottom
		if($el.find('.has-padding-bottom').prop('checked')){
			data.hpb = $el.find('.has-padding-bottom').val();
		}else{
			data.hpb = "";
		}

		data.heading = $el.find('input.js-heading').val();
		data.preview = $el.find('textarea.js-preview').val();
		let trimed = [];

		$el.find('.sp-item').each(function () {
			let item = $(this);
			let data = {};

			data.title = $.trim(item.find('[name="title"]').val());
			data.text = item.find('.sp-text').val();

			trimed.push(data);
		});

		data.elements = trimed;
		return data;
	};

	this.afterRender = function () {

		//Проверяем чекбокс
		let val = '';

		val = $el.find('.has-padding-bottom').attr('data-selected');
		if(val.length > 0) {
			$el.find('.has-padding-bottom').prop('checked', true);
		}

		let $res = $el.find('.sp-lists-result');

		$res.html(
			wait_editor.renderTemplate('faq_block-items', data)
		);

		$el.on('click', '.sp-lists-add', function () {
			$res.append(
				wait_editor.renderTemplate('faq_block-items', {
					elements: [{
						name: '',
						title: '',
						text: ''
					}]
				})
			);
		});
	};

	function escapeHtml(text) {
		var map = {
			'&': '&amp;',
			'<': '&lt;',
			'>': '&gt;',
			'"': '&quot;',
			"'": '&#039;'
		};

		return text.replace(/[&<>"']/g, function (m) {
			return map[m];
		});
	}
});
