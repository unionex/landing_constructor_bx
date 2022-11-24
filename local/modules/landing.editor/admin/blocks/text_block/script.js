wait_editor.registerBlock('text_block', function ($, $el, data) {

	data = $.extend({
		value: '',
		block_style: '',
		nopt: '',
	}, data);

	var parser = new HtmlWhitelistedSanitizer();

	this.getData = function () {
		return data;
	};

	this.collectData = function () {

		data.value = parser.sanitizeString($el.find('.sp-text').val());
		data.block_style = parser.sanitizeString($el.find('.constructor-block-style').val());

		//nopt
		if ($el.find('.nopt-checkbox').prop('checked')) {
			data.nopt = parser.sanitizeString($el.find('.nopt-checkbox').val());
		} else {
			data.nopt = parser.sanitizeString("");
		}

		return data;
	};

	this.afterRender = function () {
		var val = $el.find('.constructor-block-style').attr('data-selected');
		$el.find('.constructor-block-style option[value="' + val + '"]').attr('selected', 'true');

		var val = $el.find('.nopt-checkbox').attr('data-selected');
		if (val.length > 0) {
			$el.find('.nopt-checkbox').prop('checked', true);
		}

		renderEditor();
	};

	function renderEditor() {
		tinymce.init({
			selector: '.tinymce-3',
			plugins: [
				'advlist autolink link image lists charmap preview hr anchor pagebreak',
				'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
				'table template paste'
			],
			toolbar: 'undo redo | h3 | h4 | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | ' +
				'bullist numlist | link image | preview fullscreen | ',
			menubar: 'view edit table',
			advlist_bullet_styles: 'default',
			advlist_number_styles: 'default',
			extended_valid_elements: [
				'h1[class=section-rd__h1]',
				'h2[class=section-rd__h2]',
				'h3[class=section-rd__h3]'
			],
			convert_urls: false,
			relative_urls: false,
			language: 'ru'
		});
	}
});
