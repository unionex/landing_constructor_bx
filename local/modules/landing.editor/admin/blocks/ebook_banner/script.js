landing_editor.registerBlock('ebook_banner', function ($, $el, data) {

	let curImage = false;
	let blank = "data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==";

	document.setMedia = null;
	document.OpenImage = function () {};

	$el.on('click', '.button-select-medialib', function () {
		curImage = $el.find('.file-val');
		OpenImage();
		document.setMedia = function (filename, path, site) {
			curImage.val(path + '/' + filename);
			curImage.next('img').attr('src', path + '/' +  filename);
		};
	});
	$el.on('click', '.button-select-medialib-retina', function () {
		curImage = $el.find('.file-val_retina');
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
		head: '',
		text: '',
		icon: '',
		alt: '',
		btnName: '',
		btnLink: '',
		nofollow: '',
		btnType: '',
		btnHead: '',
		buttonIDForm: ''
	}, data);

	this.getData = function () {
		return data;
	};

	this.collectData = function () {

		data.head = $.trim($el.find('[name="head"]').val());
		data.text = $.trim($el.find('[name="text"]').val());
		data.icon = $.trim($el.find('[name="icon"]').val());
		data.alt = $.trim($el.find('[name="alt"]').val());
		data.icon_retina = $.trim($el.find('[name="icon_retina"]').val());
		data.alt_retina = $.trim($el.find('[name="alt_retina"]').val());
		data.btnName = $.trim($el.find('[name="btnName"]').val());
		data.btnLink = $.trim($el.find('[name="btnLink"]').val());
		if ($el.find('.has-rel-nofollow').prop('checked')) {
			data.nofollow = $el.find('.has-rel-nofollow').val();
		} else {
			data.nofollow = "";
		}
		data.btnType = $.trim($el.find('[name="btnType"]').val());
		data.btnHead = $.trim($el.find('[name="btnHead"]').val());
		data.buttonIDForm = $.trim($el.find('[name="buttonIDForm"]').val());

		return data;
	};

	this.afterRender = function () {
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

		val = $el.find('.has-rel-nofollow').attr('data-selected');
		if (val.length > 0) {
			$el.find('.has-rel-nofollow').prop('checked', true);
		}

		renderEditor();
	};

	function renderEditor() {
		tinymce.init({
			selector: '.tinymce-24',
			plugins: [
				'advlist autolink link image lists charmap preview hr anchor pagebreak',
				'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
				'table template paste'
			],
			toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | ' +
				'bullist numlist | link image | preview fullscreen | ',
			menubar: 'view edit table',
			advlist_bullet_styles: 'default',
			advlist_number_styles: 'default',
			language: 'ru'
		});
	}
});
