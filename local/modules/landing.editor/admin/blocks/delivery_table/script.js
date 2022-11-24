landing_editor.registerBlock('delivery_table', function ($, $el, data) {

	let curImage = false;

	document.setMedia = null;
	document.OpenIcon = function () {};

	SetIconUrl = function (filename, path, site) {
		document.setMedia(filename, path, site);
	};

	if (!data.elements) {
		data = $.extend({
			noindex: '',
			title: '',
			hpb: '',
			tables: []
		}, data);
	}

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
		data.title = $el.find('input.title-delivery-input').val();

		let tables = [];
		let i = 0;

		$el.find('.js-elem-delivery_table').each(function () {
			$(this).find('.main-delivery_table .js-row-area').each(function () {
				let j = 0;
				let table = [];
				$(this).find('tr').each(function () {

					let row = {};

					if($(this)[0].childElementCount == 5) {

						let img = [];
						let link = [];
						let nofollow = "";

						row['td1'] = {};
						row['td3'] = {};

						$(this).find('.icon').each(function () {
							img.push([{
								src: $(this).find('img').attr('src'),
								alt: $(this).find('[name="img-alt"]').val()
							}]);
						});

						row['td0'] = $.trim($(this).find('[name="td0"]').val());
						row['td1'] = img;
						row['td2'] = $.trim($(this).find('[name="td2"]').val());
						if ($(this).find('.has-rel-nofollow').prop('checked')) {
							nofollow = $(this).find('.has-rel-nofollow').val();
						}
						row['td3'] = {
							link: $.trim($(this).find('[name="btnLink"]').val()),
							nofollow: nofollow,
							type: $.trim($(this).find('[name="btnType"]').val()),
							head: $.trim($(this).find('[name="btnHead"]').val()),
							name: $.trim($(this).find('[name="btnName"]').val())
						}

					}else if ($(this)[0].childElementCount == 2){
						row['cnt'] = $.trim($(this).find('[name="cnt"]').val());

						if($(this).find('.show-all').prop('checked')){
							row['cntAll'] = $(this).find('.show-all').val();
						}else{
							row['cntAll'] = "";
						}
					} else {
						row['th'] = $.trim($(this).find('[name="th"]').val());
					}

					table.push(row);
				});
				tables.push(table);
			});
			i++;
		});

		data.tables = tables;

		return data;
	};

	this.afterRender = function () {
		let $tableArea = $el.find('.js-elements-delivery');

		//Проверяем чекбокс
		let val = '';

		val = $el.find('.has-padding-bottom').attr('data-selected');
		if(val.length > 0) {
			$el.find('.has-padding-bottom').prop('checked', true);
		}

		$tableArea.html(
			landing_editor.renderTemplate('delivery_table-table', data.tables)
		);

		$el.find('.js-elem-delivery_table').each(function () {
			$(this).find('.main-delivery_table .js-row-area').each(function () {
				let j = 0;
				$(this).find('tr').each(function () {
					if($(this)[0].childElementCount == 5) {
						val = $(this).find('.has-rel-nofollow').attr('data-selected');
						if (val.length > 0) {
							$(this).find('.has-rel-nofollow').prop('checked', true);
						}
					}
				});
			});
		});


		$el.on('click', '.delete-row', function () {
			let $row = $(this).parent('td').parent('tr');
			$row.remove();
		});

		$el.on('click', '.add-header', function () {

			let $rowArea = $(this).siblings('.main-delivery_table').find('.js-row-area');
			let index = $(this).attr('data-index');

			$rowArea.append(
				landing_editor.renderTemplate('delivery_table-header', data)
			);
		});

		$el.on('click', '.table-remove', function () {
			let index = $(this).attr('data-index');

			$el.find('.js-elem-delivery_table').each(function (indexTable) {
				if(index == indexTable) {
					$(this).remove();
					reindex();
				}
			});


		});

		$el.on('click', '.add-row', function () {

			let $rowArea = $(this).siblings('.main-delivery_table').find('.js-row-area');
			let index = $(this).attr('data-index');

			$rowArea.append(
				landing_editor.renderTemplate('delivery_table-row', data)
			);
		});

		$el.on('click', '.element-btn', function () {

			let container = $(this).closest('.td-icons');

			container.prepend("<div class='icon'>" +
				"<img src=''>" +
				"<input type='text' name='img-alt' placeholder='alt'>" +
				"<input type='button' class='del-img' value='X'>" +
				"<hr class='bx-color-style'></div>");

			let thisImg = container.find('img').first();

			OpenIcon();

			document.setMedia = function (filename, path, site) {
				thisImg.attr('src', path + '/' +  filename);

				let inputImg = container.find('[name="td1"]');
				let param = inputImg.val();

				if(param) {
					param += ';' + path + '/' +  filename;
				} else {
					param = path + '/' +  filename;
				}
				inputImg.val(param);
			};
		});

		$el.on('click', '.del-img', function () {

			let thisElement = $(this).closest('.icon');
			let container = $(this).closest('.td-icons');
			thisElement.remove();

			let srcString = '';

			container.each(function () {
				$(this).find('img').each(function () {
					let src = $(this).attr('src');

					if (srcString) {
						srcString += ';' + src;
					} else {
						srcString = src;
					}
				});
			});

			let inputImg = container.find('[name="td1"]');

			inputImg.val(srcString);
		});

		$el.on('click', '.add-delivery-table', function () {
			$tableArea.append(
				landing_editor.renderTemplate('delivery_table-tabletpl', {
					tables: [{
							th: '',
						}, {
							td0: '',
							td1: '',
							td2: '',
							td3: ''
						},
						{
							cnt: '',
							cntAll: ''
						}
					]
				})
			);

			reindex();
		});

		reindex();
	};

	function reindex() {
		$el.find('.js-elem-delivery_table').each(function (index) {
			$(this).find('.add-header').attr('data-index', index);
			$(this).find('.add-row').attr('data-index', index);
		});
	}

});
