wait_editor.registerBlock('news', function ($, $el, data) {

	data = $.extend({
		heading: '',
		type: '',
		hpb: '',
		sections: '',
		json: ''
	}, data);

	let dateAjax;

	getSections = function (type) {
		// делаем запрос с полученным адресом к рисунку выбранного в "Менеджере файлов"
		$.ajax({
			method: 'GET',
			url: wait_editor.getBlockWebPath('news') + '/ajaxGetSections.php',
			data: {type: type},
			dataType: 'json',
			async : false,
		}).done(function (res) {
			dateAjax = res;
		});
	};

	this.getData = function () {
		data.sections = data.sections.split(',');

		console.log(data);

		return data;
	};

	this.collectData = function () {

		//Класс отступов
		//section-rd--has-padding-bottom
		if($el.find('.has-padding-bottom').prop('checked')){
			data.hpb = $el.find('.has-padding-bottom').val();
		}else{
			data.hpb = "";
		}

		data.type = $.trim($el.find('[name="type"]').val());
		data.sections = $.trim($el.find('[name="sections"]').val());
		data.heading = $.trim($el.find('.js-heading').val());

		return data;
	};

	this.afterRender = function () {

		//Проверяем чекбоксы
		let val = '';

		val = $el.find('.has-padding-bottom').attr('data-selected');
		if(val.length > 0) {
			$el.find('.has-padding-bottom').prop('checked', true);
		}

		data.type = data.type === 'article' ? 'article' : 'news';
		renderfiles();

		$el.on('click', '.checkIn', function () {
			data.type = $(this).val();
			renderfiles();
		});
	};

	var renderfiles = function() {
		getSections(data.type);
		data.json = Object.keys(dateAjax).map(function(key) {
			return dateAjax[key];
		});
		$el.find('.sp-result').html(
			wait_editor.renderTemplate('news-list', data)
		);
	}

});
