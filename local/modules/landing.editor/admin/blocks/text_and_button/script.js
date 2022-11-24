landing_editor.registerBlock('text_and_button', function ($, $el, data) {
	data = $.extend({
		text_block: '',
		upper_button: '',
		price: '',
		price_measure: '',
		button: 'Заказать звонок',
		sub_button: '',
		form_header: 'Заказать звонок',
		nopt: '',
		nopb: '',
		top_border:'',
		bottom_border: ''
	}, data);

	let parser = new HtmlWhitelistedSanitizer();

	this.getData = function () {
		data.text_block = parser.sanitizeString(escapeHtml(data.text_block));
		data.nopt = parser.sanitizeString(
			escapeHtml(data.nopt)
		);
		data.nopb = parser.sanitizeString(
			escapeHtml(data.nopb)
		);
		data.top_border = parser.sanitizeString(
			escapeHtml(data.top_border)
		);
		data.bottom_border = parser.sanitizeString(
			escapeHtml(data.bottom_border)
		);
		return data;
	};

	this.collectData = function () {
		if (!$.fn.trumbowyg) {
			return data;
		}
		data.text_block = parser.sanitizeString($el.find('.js-text_block').val());
		data.upper_button = $el.find('.js-upper_button').val();
		data.price = $el.find('.js-price').val();
		data.price_measure = $el.find('.js-price_measure').val();
		data.sub_button = $el.find('.js-sub_button').val();
		data.button = $el.find('.js-button').val();
		data.form_header = $el.find('.js-form-header').val();
		//nopt
		if($el.find('.nopt-checkbox').prop('checked')){
			data.nopt = parser.sanitizeString($el.find('.nopt-checkbox').val());
		}else{
			data.nopt = parser.sanitizeString("");
		}
		//nopb
		if($el.find('.nopb-checkbox').prop('checked')){
			data.nopb = parser.sanitizeString($el.find('.nopb-checkbox').val());
		}else{
			data.nopb = parser.sanitizeString("");
		}
		//top_border
		if($el.find('.top-border-checkbox').prop('checked')){
			data.top_border = parser.sanitizeString($el.find('.top-border-checkbox').val());
		}else{
			data.top_border = parser.sanitizeString("");
		}
		//bottom_border
		if($el.find('.bottom-border-checkbox').prop('checked')){
			data.bottom_border = parser.sanitizeString($el.find('.bottom-border-checkbox').val());
		}else{
			data.bottom_border = parser.sanitizeString("");
		}
		return data;
	};

	this.afterRender = function () {

		if (!$.fn.trumbowyg) {
			return false;
		}

		$el.find('.sp-text').trumbowyg({
			btnsDef: {
				plugins: {
					dropdown: ['tooltip','textcat', 'textpopup'],
					title: 'Плагины',
					hasIcon: false
				},
				image: {
					dropdown: ['insertImage', 'upload'],
					title: 'Изображения',
					hasIcon: false
				}
			},
			svgPath: '/local/modules/landing.editor/admin/assets/trumbowyg/ui/icons.svg',
			lang: 'ru',
			resetCss: true,
			removeformatPasted: true,
			btns: [
				['viewHTML'],
				['bold', 'italic', 'underline', 'strikethrough'],
				['unorderedList', 'orderedList'],
				['fontsize'],
				['table'],
				['lineheight'],
				['link'],
				['removeformat'],
				['plugins'],
				['image']
			],

			autogrow: true,

			plugins: {
				upload: {
					serverPath: '/local/modules/landing.editor/admin/assets/trumbowyg/upload_image.php',
					fileFieldName: 'image',
					urlPropertyName: 'data.link'
				}
			}

		});
		var val = $el.find('.constructor-block-style').attr('data-selected');
		$el.find('.constructor-block-style option[value="' + val + '"]').attr('selected', 'true');


		var val = $el.find('.nopt-checkbox').attr('data-selected');
		if(val.length > 0){
			$el.find('.nopt-checkbox').prop('checked', true);
		}

		var val = $el.find('.nopb-checkbox').attr('data-selected');
		if(val.length > 0){
			$el.find('.nopb-checkbox').prop('checked', true);
		}

		var val = $el.find('.top-border-checkbox').attr('data-selected');
		if(val.length > 0){
			$el.find('.top-border-checkbox').prop('checked', true);
		}

		var val = $el.find('.bottom-border-checkbox').attr('data-selected');
		if(val.length > 0){
			$el.find('.bottom-border-checkbox').prop('checked', true);
		}
	};

	function escapeHtml(text) {
		let map = {
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
