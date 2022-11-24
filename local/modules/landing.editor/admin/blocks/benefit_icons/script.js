landing_editor.registerBlock('benefit_icons', function ($, $el, data) {

	let curImage = false;
	let blank = "data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==";

	document.setMedia = null;
	document.OpenIcon = function () {};

	$el.on('click', '.button-select-medialib', function () {
		curImage = $(this).parents('.sp-item').find('.file-val');
		OpenIcon();
		document.setMedia = function (filename, path, site) {
			curImage.val(path + '/' + filename);
			curImage.next('img').attr('src', path + '/' +  filename);
		};
	});

	SetIconUrl = function (filename, path, site) {
		document.setMedia(filename, path, site);
	};

	data = $.extend({
		heading: '',
		hpb: '',
		last: '',
		elements: [{
			head: '',
			headBr: '',
			icon: '',
			alt: ''
		}, {
			head: '',
			headBr: '',
			icon: '',
			alt: ''
		}, {
			head: '',
			headBr: '',
			icon: '',
			alt: ''
		},{
			head: '',
			headBr: '',
			icon: '',
			alt: ''
		}, {
			head: '',
			headBr: '',
			icon: '',
			alt: ''
		}]
	}, data);

	this.getData = function () {
		return data;
	};

	this.collectData = function () {
		data.heading = $el.find('input.js-heading').val();

		//Класс отступов
		//section-rd--has-padding-bottom
		if($el.find('.has-padding-bottom').prop('checked')){
			data.hpb = $el.find('.has-padding-bottom').val();
		}else{
			data.hpb = "";
		}

		var trimed = [];

		$el.find('.sp-item').each(function () {
			let item = $(this);
			let data = {};

			data.head = $.trim(item.find('[name="head"]').val());
			data.headBr = $.trim(item.find('[name="headBr"]').val());
			data.icon = $.trim(item.find('[name="icon"]').val());
			data.alt = $.trim(item.find('[name="alt"]').val());

			trimed.push(data);
		});

		data.elements = trimed;
		return data;
	};

	this.afterRender = function () {
		let $res = $el.find('.sp-lists-result');

		//Проверяем чекбоксы
		let val = '';

		val = $el.find('.has-padding-bottom').attr('data-selected');
		if(val.length > 0) {
			$el.find('.has-padding-bottom').prop('checked', true);
		}

		$el.on('click', '.sp-base_image_item-del', function () {
			let wrap = $(this).parents('.sp-base_image_item');
			wrap.find('.file-val').val('');
			wrap.find('img').attr('src', blank);
		});

		$res.html(
			landing_editor.renderTemplate('benefit_icons-items', data)
		);
	}
});
