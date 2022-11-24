wait_editor.registerBlock('boxes', function ($, $el, data) {

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
		noindex: '',
		heading: '',
		hpb: '',
		elements: [{
			icon: '',
			alt: '',
			title: '',
			subtitle: '',
			titleLink: '',
			update: '',
			freeTime: '',
			delivery: '',
			its3Mons: '',
			report: '',
			install: '',
			price: '',
			link: '',
			nofollow: '',
			linkType: '',
			linkTitle: ''
		}, {
			icon: '',
			alt: '',
			title: '',
			subtitle: '',
			titleLink: '',
			update: '',
			freeTime: '',
			delivery: '',
			its3Mons: '',
			report: '',
			install: '',
			price: '',
			link: '',
			nofollow: '',
			linkType: '',
			linkTitle: ''
		},{
			icon: '',
			alt: '',
			title: '',
			subtitle: '',
			titleLink: '',
			update: '',
			freeTime: '',
			delivery: '',
			its3Mons: '',
			report: '',
			install: '',
			price: '',
			link: '',
			nofollow: '',
			linkType: '',
			linkTitle: ''
		}]
	}, data);

	this.getData = function () {
		return data;
	};

	this.collectData = function () {
		data.noindex = $el.find('[name="noindex"]').is(":checked");
		data.heading = $el.find('input.js-heading').val();
		data.elements = [];

		//Класс отступов
		//section-rd--has-padding-bottom
		if($el.find('.has-padding-bottom').prop('checked')){
			data.hpb = $el.find('.has-padding-bottom').val();
		}else{
			data.hpb = "";
		}

		$el.find('.js-elem').each(function () {
			let target = $(this);
			let dataElem = {};

			dataElem.title = $.trim(target.find('[name="title"]').val());
			dataElem.subtitle = $.trim(target.find('[name="subtitle"]').val());
			dataElem.titleLink = $.trim(target.find('[name="titleLink"]').val());
			if (target.find('.has-update').prop('checked')) {
				dataElem.update = target.find('.has-update').val();
			} else {
				dataElem.update = "";
			}
			if (target.find('.has-free-time').prop('checked')) {
				dataElem.freeTime = target.find('.has-free-time').val();
			} else {
				dataElem.freeTime = "";
			}
			if (target.find('.has-delivery').prop('checked')) {
				dataElem.delivery = target.find('.has-delivery').val();
			} else {
				dataElem.delivery = "";
			}
			if (target.find('.has-its-3-mons').prop('checked')) {
				dataElem.its3Mons = target.find('.has-its-3-mons').val();
			} else {
				dataElem.its3Mons = "";
			}
			if (target.find('.has-report').prop('checked')) {
				dataElem.report = target.find('.has-report').val();
			} else {
				dataElem.report = "";
			}
			if (target.find('.has-install').prop('checked')) {
				dataElem.install = target.find('.has-install').val();
			} else {
				dataElem.install = "";
			}
			dataElem.icon = $.trim(target.find('[name="icon"]').val());
			dataElem.alt = $.trim(target.find('[name="alt"]').val());
			dataElem.price = $.trim(target.find('[name="price"]').val());
			dataElem.link = $.trim(target.find('[name="link"]').val());
			if (target.find('.has-rel-nofollow').prop('checked')) {
				dataElem.nofollow = target.find('.has-rel-nofollow').val();
			} else {
				dataElem.nofollow = "";
			}
			dataElem.linkType = $.trim(target.find('[name="linkType"]').val());
			dataElem.linkTitle = $.trim(target.find('[name="linkTitle"]').val());

			data.elements.push(dataElem);
		});

		return data;
	};

	this.afterRender = function () {
		let $res = $el.find('.js-elements');

		//Проверяем чекбоксы
		let val = '';

		val = $el.find('.has-padding-bottom').attr('data-selected');
		if(val.length > 0) {
			$el.find('.has-padding-bottom').prop('checked', true);
		}

		$res.html(
			wait_editor.renderTemplate('boxes-items', data)
		);

		$el.find('.js-elem').each(function () {
			let target = $(this);
			val = target.find('.has-update').attr('data-selected');
			if (val.length > 0) {
				target.find('.has-update').prop('checked', true);
			}
			val = target.find('.has-free-time').attr('data-selected');
			if (val.length > 0) {
				target.find('.has-free-time').prop('checked', true);
			}
			val = target.find('.has-delivery').attr('data-selected');
			if (val.length > 0) {
				target.find('.has-delivery').prop('checked', true);
			}
			val = target.find('.has-its-3-mons').attr('data-selected');
			if (val.length > 0) {
				target.find('.has-its-3-mons').prop('checked', true);
			}
			val = target.find('.has-report').attr('data-selected');
			if (val.length > 0) {
				target.find('.has-report').prop('checked', true);
			}
			val = target.find('.has-install').attr('data-selected');
			if (val.length > 0) {
				target.find('.has-install').prop('checked', true);
			}
			let item = $(this);
			val = item.find('.has-rel-nofollow').attr('data-selected');
			if(val.length > 0) {
				item.find('.has-rel-nofollow').prop('checked', true);
			}
		});

		$el.on('click', '.sp-base_image_item-del', function () {
			let wrap = $(this).parents('.sp-base_image_item');
			wrap.find('.file-val').val('');
			wrap.find('img').attr('src', blank);
		});

		$el.on('click', '.sp-lists-remove', function () {
			$res.children().last().remove();
		});

		$el.on('click', '.sp-lists-add', function () {
			$res.append(
				wait_editor.renderTemplate('boxes-items', {
					elements: [{
						icon: '',
						alt: '',
						title: '',
						subtitle: '',
						titleLink: '',
						update: '',
						freeTime: '',
						delivery: '',
						its3Mons: '',
						report: '',
						install: '',
						price: '',
						link: '',
						nofollow: '',
						linkType: '',
						linkTitle: ''
					}]
				})
			);
		});
	}
});
