landing_editor.registerBlock('comparison_table', function ($, $el, data) {

	randomInt = function (min, max) {
		return min + Math.floor((max - min) * Math.random());
	};

	data = $.extend({
		noindex: '',
		title: '',
        hpb: '',
		firstFooterTitle: '',
		settingColumn: {
			td2: false,
			td3: false
		},
		header: {
			th1: '',
			th2: '',
			th3: '',
		},
		body: [{
			td0: '',
			td1: '',
			td2: '',
			td3: '',
		}],
		footer : {
			ft1: {
				price: '',
				name: '',
				link: '',
				nofolow: '',
				form: {
					type: '',
					title: ''
				}
			},
			ft2: {
				price: '',
				name: '',
				link: '',
				nofolow: '',
				form: {
					type: '',
					title: ''
				}
			},
			ft3: {
				price: '',
				name: '',
				link: '',
				nofolow: '',
				form: {
					type: '',
					title: ''
				}
			}
		}
	}, data);

	this.getData = function () {
		return data;
	};

	this.collectData = function () {

        data.cases = $.trim($el.find('[name="cases"]').val());

        //Класс отсутпов
        //section-rd--has-padding-bottom
        if($el.find('.has-padding-bottom').prop('checked')){
            data.hpb = $el.find('.has-padding-bottom').val();
        }else{
            data.hpb = "";
        }

		data.body = [];
		data.title = $el.find('input.title-comparison-input').val();
		data.firstFooterTitle = $el.find('[name="firstFooterTitle"]').val();

		let header = {};
		let footer = {};

		for (let i = 1; i < 4; i++) {
			footer['ft' + i] = {};
			header['th' + i] = $.trim($el.find('[name="title' + i + '"]').val());
			footer['ft' + i].price = $.trim($el.find('[name="price' + i + '"]').val());
			footer['ft' + i].name = $.trim($el.find('[name="btn_name_' + i + '"]').val());
			footer['ft' + i].link = $.trim($el.find('[name="btn_link_' + i + '"]').val());
			if ($el.find('.has-rel-nofollow' + i).prop('checked')) {
				footer['ft' + i].nofollow = $el.find('.has-rel-nofollow' + i).val();
			} else {
				footer['ft' + i].nofollow = "";
			}
			footer['ft' + i].form = {
				type: $.trim($el.find('[name="btn_type_' + i + '"]').val()),
				title: $.trim($el.find('[name="btn_form_' + i + '"]').val())
			}
		}

		data.header = header;
		data.footer = footer;

		$el.find('.js-elem-comparison').each(function () {
			let target = $(this);
			let dataBody = {};

			for (let i = 0; i < 4; i++) {
				dataBody['td' + i] = target.find('[name="td' + i + '"]').val();
			}

			data.body.push(dataBody);
		});

		return data;
	};

	this.afterRender = function () {
		let $res = $el.find('.js-elements-comparison');

        //Проверяем чекбоксы
        let val = '';

        val = $el.find('.has-padding-bottom').attr('data-selected');
        if(val.length > 0) {
            $el.find('.has-padding-bottom').prop('checked', true);
        }

		$res.html(
			landing_editor.renderTemplate('comparison_table-select', data)
		);

		for (let i = 1; i < 4; i++) {
			val = $el.find('.has-rel-nofollow' + i).attr('data-selected');
			if(val.length > 0) {
				$el.find('.has-rel-nofollow' + i).prop('checked', true);
			}
		}

		$el.on('click', '.button-remove', function () {
			let wrap = $(this).parents('.js-elem-comparison');

			wrap.remove();

			data.body = [];

			$el.find('.js-elem-comparison').each(function () {
				let target = $(this);
				let dataBody = {};

				for (let i = 0; i < 4; i++) {
					dataBody['td' + i] = target.find('[name="td' + i + '"]').val();
				}

				data.body.push(dataBody);
			});
		});

		$el.on('click', '.button-tire', function () {
			$(this).siblings('.element-body').attr('value', String.fromCharCode(8212))
		});

		$el.on('click', '.button-true', function () {
			$(this).siblings('.element-body').attr('value', String.fromCharCode(10003))
		});

		let removeColumn = $el.find('.remove-column');
		let addColumn = $el.find('.add-column');

		removeColumn.hide();

		if(data.settingColumn.td3 === true) {
			removeColumn.show();
			addColumn.hide();
		}

		$el.on('click', '.add-column', function () {
			if (data.settingColumn.td2 === true && data.settingColumn.td3 === false) {
				data.settingColumn.td3 = true;
				addColumn.hide();
				removeColumn.show();
				CheckShowColumn($el, data.settingColumn);
			}
			if (data.settingColumn.td2 === false) {
				data.settingColumn.td2 = true;
				CheckShowColumn($el, data.settingColumn);
			}
		});

		$el.on('click', '.remove-column', function () {
			if(data.settingColumn.td3 === true){
				data.settingColumn.td3 = false;
				addColumn.show();
				removeColumn.hide();
				CheckShowColumn($el, data.settingColumn);
			}
		});

		$el.on('click', '.sp-lists-add-comparison', function () {
			$res.append(
				landing_editor.renderTemplate('comparison_table-select', {
					body: [{
						td0: '',
						td1: '',
						td2: '',
						td3: ''
					}]
				})
			);
			CheckShowColumn($el, data.settingColumn);
		});

		CheckShowColumn($el, data.settingColumn);
	};

	function CheckShowColumn($el, setting) {
		for(let td in setting){
			$el.find('.'+td).each(function () {
				let target = $(this);
				if(setting[td]) {
					target.show();
				} else {
					target.hide();
				}
			});

		}
	}

});
