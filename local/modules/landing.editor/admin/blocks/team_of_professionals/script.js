landing_editor.registerBlock('team_of_professionals', function ($, $el, data) {

	data = $.extend({
		head: '',
		hpb: '',
		text: '',
		textMsg: ''
	}, data);

	this.getData = function () {
		return data;
	};

	this.collectData = function () {

		//Класс отступов
		//section-rd--has-padding-bottom
		if ($el.find('.has-padding-bottom').prop('checked')) {
			data.hpb = $el.find('.has-padding-bottom').val();
		} else {
			data.hpb = "";
		}

		data.head = $.trim($el.find('[name="head"]').val());
		data.text = $.trim($el.find('[name="text"]').val());
		data.textMsg = $.trim($el.find('[name="textMsg"]').val());

		return data;
	};

	this.afterRender = function () {

		//Проверяем чекбокс
		let val = '';

		val = $el.find('.has-padding-bottom').attr('data-selected');
		if(val.length > 0) {
			$el.find('.has-padding-bottom').prop('checked', true);
		}

		renderEditor();
	};

	function renderEditor() {
		tinymce.init({
			selector: '.tinymce-19',
			plugins: [
				'advlist autolink link image lists charmap preview hr anchor pagebreak',
				'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
				'table template paste'
			],
			toolbar: 'undo redo | h4 | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | ' +
				'bullist numlist | link | preview fullscreen | ',
			menubar: 'view edit table',
			advlist_bullet_styles: 'default',
			advlist_number_styles: 'default',
			language: 'ru'
		});
	}
});
