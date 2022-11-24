landing_editor.registerBlock('select_project', function ($, $el, data) {

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
	//@todo img На конкретный размер сделать не успел т.к очень сжатые сроки. Да простит меня тот кто видит этот код ;)
	data = $.extend({
		hpb: '',
		elements: [{
			title: '',
			subtitle1: '',
			text1: '',
			subtitle2: '',
			text2: '',
			circleText1: '',
			circleSubText1: '',
			circleText2: '',
			circleSubText2: '',
			circleText3: '',
			circleSubText3: '',
			circleText4: '',
			circleSubText4: '',
			alt: '',
			img: ''
		}]
	}, data);

	this.getData = function () {
		return data;
	};

	this.collectData = function () {
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
			data.subtitle1 = $.trim(item.find('[name="subtitle1"]').val());
			data.subtitle2 = $.trim(item.find('[name="subtitle2"]').val());
			data.text1 = $.trim(item.find('[name="text1"]').val());
			data.text2 = $.trim(item.find('[name="text2"]').val());
			data.circleText1 = $.trim(item.find('[name="circleText1"]').val());
			data.circleSubText1 = $.trim(item.find('[name="circleSubText1"]').val());
			data.circleText2 = $.trim(item.find('[name="circleText2"]').val());
			data.circleSubText2 = $.trim(item.find('[name="circleSubText2"]').val());
			data.circleText3 = $.trim(item.find('[name="circleText3"]').val());
			data.circleSubText3 = $.trim(item.find('[name="circleSubText3"]').val());
			data.circleText4 = $.trim(item.find('[name="circleText4"]').val());
			data.circleSubText4 = $.trim(item.find('[name="circleSubText4"]').val());
			data.img = $.trim(item.find('[name="img"]').val());
			data.alt = $.trim(item.find('[name="alt"]').val());
			data.img_retina = $.trim(item.find('[name="img_retina"]').val());
			data.alt_retina = $.trim(item.find('[name="alt_retina"]').val());

			trimed.push(data);
		});

		data.elements = trimed;
		return data;
	};

	this.afterRender = function () {
		let $res = $el.find('.swt-lists-result');

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
		$el.on('click', '.sp-base_image_item-del-retina', function () {
			let wrap = $(this).parents('.sp-base_image_item');
			wrap.find('.file-val_retina').val('');
			wrap.find('img').attr('src', blank);
		});

		$res.html(
			landing_editor.renderTemplate('select_project-items', data)
		);

		$el.on('click', '.swt-lists-add', function () {
			$res.append(
				landing_editor.renderTemplate('select_project-items', {
					elements: [
						{
							title: '',
							subtitle1: '',
							text1: '',
							subtitle2: '',
							text2: '',
							circleText1: '',
							circleSubText1: '' ,
							circleText2: '',
							circleSubText2: '',
							circleText3: '',
							circleSubText3: '',
							circleText4: '',
							circleSubText4: '',
							alt: '',
							img: ''
						}
					]
				})
			);

		});
	}
});
