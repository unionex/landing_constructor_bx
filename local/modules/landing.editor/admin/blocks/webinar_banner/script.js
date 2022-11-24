landing_editor.registerBlock('webinar_banner', function ($, $el, data) {
	//todo Добавил на ходах, хотя не надо было. Как появится верстка нужно будет доделать
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

	SetImageUrl = function (filename, path, site) {
		document.setMedia(filename, path, site);
	};

	data = $.extend({
		head: '',
		text: '',
		icon: '',
		btnName: '',
		btnLink: ''
	}, data);

	let parser = new HtmlWhitelistedSanitizer();

	this.getData = function () {
		escapeHtml(data.text);
		return data;
	};

	this.collectData = function () {

		data.head = $.trim($el.find('[name="head"]').val());
		data.text = $.trim($el.find('[name="text"]').val());
		data.icon = $.trim($el.find('[name="icon"]').val());
		data.btnName = $.trim($el.find('[name="btnName"]').val());
		data.btnLink = $.trim($el.find('[name="btnLink"]').val());

		return data;
	};

	this.afterRender = function () {

		if (!$.fn.trumbowyg) {
			return false;
		}

		$el.on('click', '.sp-base_image_item-del', function () {
			let wrap = $el.find('.sp-base_image_item');
			wrap.find('.file-val').val('');
			wrap.find('img').attr('src', blank);
		});

		renderEditor($el);
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

	function renderEditor($el) {

		$el.find('.sp-text').trumbowyg({
			btnsDef: {
				plugins: {
					dropdown: ['tooltip', 'textcat', 'textpopup'],
					title: 'Плагины',
					hasIcon: false
				}
			},
			svgPath: '/local/modules/landing.editor/admin/assets/trumbowyg/ui/icons.svg',
			lang: 'ru',
			resetCss: true,
			removeformatPasted: true,
			btns: [
				['viewHTML'],
				['h4', 'bold', 'italic', 'underline', 'strikethrough'],
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
	}
});
