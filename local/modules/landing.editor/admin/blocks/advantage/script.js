wait_editor.registerBlock('advantage', function ($, $el, data) {

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

	SetImageUrl = function (filename, path, site) {
		document.setMedia(filename, path, site);
	};

	data = $.extend({
		heading: '',
		hpb: '',
		elements: [{
			title: '',
			subtitle: '',
			alt: '',
			img: ''
		}, {
			title: '',
			subtitle: '',
			alt: '',
			img: ''
		}, {
			title: '',
			subtitle: '',
			alt: '',
			img: ''
		}]
	}, data);

	this.getData = function () {
		return data;
	};

	this.collectData = function () {
		data.heading = $el.find('input.js-heading').val();

		//Классы отступов
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

			data.title = $.trim(item.find('[name="title"]').val());
			data.subtitle = $.trim(item.find('[name="subtitle"]').val());
			data.img = $.trim(item.find('[name="img"]').val());
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
			wait_editor.renderTemplate('advantage-items', data)
		);

		$el.on('click', '.sp-lists-add', function () {
			$res.append(
				wait_editor.renderTemplate('advantage-items', {
					elements: [
						{
							title: '',
							subtitle: '',
							alt: '',
							img: ''
						}
					]
				})
			);

		});
	}
});
