landing_editor.registerBlock('product_versions_or_rates', function ($, $el, data) {

	data = $.extend({
		heading: '',
		hpb: '',
		elements: [{
			title: '',
			titleLink: '',
			text: '',
			price: '',
			priceInfo: '',
			btnText: '',
			btnType: '',
			btnHead: '',
			select: '',
			link: '',
			nofollow: ''
		}]
	}, data);

	this.getData = function () {
		return data;
	};

	this.collectData = function () {

		data.cases = $.trim($el.find('[name="cases"]').val());

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

			data.title = $.trim(item.find('[name="title"]').val());
			data.titleLink = $.trim(item.find('[name="titleLink"]').val());
			data.text = $.trim(item.find('.sp-text').val());
			data.btnText = $.trim(item.find('[name="btnText"]').val());
			data.btnType = $.trim(item.find('[name="btnType"]').val());
			data.btnHead = $.trim(item.find('[name="btnHead"]').val());
			data.price = $.trim(item.find('[name="price"]').val());
			data.priceInfo = $.trim(item.find('[name="priceInfo"]').val());
			data.link = $.trim(item.find('[name="link"]').val());
			if (item.find('.has-rel-nofollow').prop('checked')) {
				data.nofollow = item.find('.has-rel-nofollow').val();
			} else {
				data.nofollow = "";
			}

			if(item.find('[name="select"]').attr('data-selected')) {
				data.select = item.find('[name="select"]').val();
			}

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

		$res.html(
			landing_editor.renderTemplate('product_versions_or_rates-items', data)
		);

		$el.find('.sp-item').each(function () {
			let item = $(this);
			val = item.find('.has-rel-nofollow').attr('data-selected');
			if(val.length > 0) {
				item.find('.has-rel-nofollow').prop('checked', true);
			}
		});

		$el.on('click', '.sp-lists-remove', function () {
			$res.children().last().remove();
			$el.find('.sp-lists-add').show();
			$el.find('.sp-lists-remove').hide();
		});

		$el.find('.sp-item').each(function () {
			let item = $(this);
			let val = item.find('[name="select"]').attr('data-selected');

			if (val.length > 0) {
				item.find('[name="select"]').prop('checked', true);
			}
		});

		$el.on('click', '[name="select"]', function () {
			$(this).attr('data-selected', true)
		});

		$el.on('click', '.sp-lists-add', function () {

			$res.append(
				landing_editor.renderTemplate('product_versions_or_rates-items', {
					elements: [
						{
							title: '',
							titleLink: '',
							text: '',
							price: '',
							priceInfo: '',
							btnText: '',
							btnType: '',
							btnHead: '',
							select: '',
							link: '',
							nofollow: ''
						}
					]
				})
			);

			if($res[0].childElementCount >= 3) {
				$el.find('.sp-lists-add').hide();
				$el.find('.sp-lists-remove').show();
			}
		});

		if($res[0].childElementCount >= 3) {
			$el.find('.sp-lists-add').hide();
			$el.find('.sp-lists-remove').show();
		} else {
			$el.find('.sp-lists-add').show();
			$el.find('.sp-lists-remove').hide();
		}
	}
});
