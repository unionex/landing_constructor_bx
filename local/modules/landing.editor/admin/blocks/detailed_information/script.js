landing_editor.registerBlock('detailed_information', function ($, $el, data) {

	let curImage = false;
	let blank = "data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==";

	document.setMedia = null;
	document.OpenImage = function () {};

	$el.on('click', '.button-select-medialib', function () {
		curImage = $(this).parents('.sp-item').find('.file-val');
		OpenImage();
		document.setMedia = function (filename, path, site) {
			curImage.val(path + '/' + filename);
			curImage.next('img').attr('src', path + '/' +  filename);
		};
	});
	$el.on('click', '.button-select-medialib-retina', function () {
		curImage = $(this).parents('.sp-item').find('.file-val_retina');
		OpenImage();
		document.setMedia = function (filename, path, site) {
			curImage.val(path + '/' + filename);
			curImage.next('img').attr('src', path + '/' +  filename);
		};
	});

	SetImageUrl = function (filename, path, site) {
		document.setMedia(filename, path, site);
	};

	data = $.extend({
		heading: '',
		hpb: '',
		elements: [{
			head: '',
			text: '',
			icon: '',
			alt: ''
		}]
	}, data);

	let parser = new HtmlWhitelistedSanitizer();

	this.getData = function () {

		let key;

		for (key in data.elements) {
			data.value = parser.sanitizeString(data.elements[key].text);
		}

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
		//section-rd__last-text-block
		//section-rd__last-block
		data.last = $.trim($el.find('[name="last"]').val());

		data.heading = $el.find('input.js-heading').val();
		let trimed = [];

		$el.find('.sp-item').each(function () {
			let item = $(this);
			let data = {};

			data.head = $.trim(item.find('[name="head"]').val());
			data.text = $.trim(item.find('[name="text"]').val());
			data.icon = $.trim(item.find('[name="icon"]').val());
			data.alt = $.trim(item.find('[name="alt"]').val());
			data.icon_retina = $.trim(item.find('[name="icon_retina"]').val());
			data.alt_retina = $.trim(item.find('[name="alt_retina"]').val());

			trimed.push(data);
		});

		data.elements = trimed;
		return data;
	};

	this.afterRender = function () {

		if (!$.fn.trumbowyg) {
			return false;
		}

		//Проверяем чекбокс
		let val = '';

		val = $el.find('.has-padding-bottom').attr('data-selected');
		if(val.length > 0) {
			$el.find('.has-padding-bottom').prop('checked', true);
		}

		let $res = $el.find('.sp-lists-result');

		$el.on('click', '.sp-base_image_item-del', function () {
			let wrap = $(this).parents('.sp-base_image_item');
			wrap.find('.file-val').val('');
			wrap.find('img').attr('src', blank);
		});
		$el.on('click', '.sp-base_image_item-del-retina', function () {
			let wrap = $(this).parents('.sp-base_image_item');
			wrap.find('.file-val_retina').val('');
			wrap.find('img').attr('src', blank);
		});

		$res.html(
			landing_editor.renderTemplate('detailed_information-items', data)
		);

		$el.on('click', '.sp-lists-add', function () {
			$res.append(
				landing_editor.renderTemplate('detailed_information-items', {
					elements: [
						{
							head: '',
							text: '',
							icon: '',
							alt: ''
						}
					]
				})
			);
			renderEditor($res);
		});

		renderEditor($res);
	};

	function renderEditor() {
		tinymce.init({
			selector: ".tinymce-5",
			plugins: [
				'advlist autolink link image lists charmap preview hr anchor pagebreak',
				'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
				'table template paste'
			],
			toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | ' +
				'bullist numlist | link | preview fullscreen | ',
			menubar: 'view edit table',
			advlist_bullet_styles: 'default',
			advlist_number_styles: 'default',
			language: 'ru'
		});
	}
});
