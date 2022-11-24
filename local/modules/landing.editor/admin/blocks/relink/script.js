wait_editor.registerBlock('relink', function ($, $el, data) {

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
		elements: [{
			head: '',
			link: '',
			nofollow: '',
			text: '',
			icon: '',
			alt: ''
		}, {
			head: '',
			link: '',
			nofollow: '',
			text: '',
			icon: '',
			alt: ''
		}]
	}, data);

	this.getData = function () {
		return data;
	};

	this.collectData = function () {

		//Классы отступов
		//section-rd--has-padding-bottom
		if ($el.find('.has-padding-bottom').prop('checked')) {
			data.hpb = $el.find('.has-padding-bottom').val();
		} else {
			data.hpb = "";
		}

		data.heading = $el.find('input.js-heading').val();
		var trimed = [];

		$el.find('.sp-item').each(function () {
			let item = $(this);
			let data = {};

			data.head = $.trim(item.find('[name="head"]').val());
			data.link = $.trim(item.find('[name="link"]').val());
			if (item.find('.has-rel-nofollow').prop('checked')) {
				data.nofollow = item.find('.has-rel-nofollow').val();
			} else {
				data.nofollow = "";
			}
			data.text = $.trim(item.find('[name="text"]').val());
			data.icon = $.trim(item.find('[name="icon"]').val());
			data.alt = $.trim(item.find('[name="alt"]').val());

			trimed.push(data);
		});

		data.elements = trimed;
		return data;
	};

	this.afterRender = function () {
		let $res = $el.find('.sp-lists-result');

		//Проверяем чекбокс
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
			wait_editor.renderTemplate('relink-items', data)
		);

		$el.find('.sp-item').each(function () {
			let item = $(this);
			val = item.find('.has-rel-nofollow').attr('data-selected');
			if (val.length > 0) {
				item.find('.has-rel-nofollow').prop('checked', true);
			}
		});
		$el.on('click', '.sp-lists-add', function () {
			$res.append(
				wait_editor.renderTemplate('relink-items', {
					elements: [{
						head: '',
						link: '',
						nofollow: '',
						text: '',
						icon: '',
						alt: ''
					},{
						head: '',
						link: '',
						nofollow: '',
						text: '',
						icon: '',
						alt: ''
					}]
				})
			);

			if($res[0].childElementCount >= 8) {
				$el.find('.sp-lists-add').hide();
			}
		});

		if($res[0].childElementCount >= 8) {
			$el.find('.sp-lists-add').hide();
		}
	}
});
