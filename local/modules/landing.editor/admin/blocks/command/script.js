wait_editor.registerBlock('command', function ($, $el, data) {

	data = $.extend({
		head: '',
		text: '',
		btnName: '',
		btnLink: '',
		btnType: '',
		btnHead: ''
	}, data);

	this.getData = function () {
		return data;
	};

	this.collectData = function () {

		data.head = $.trim($el.find('[name="head"]').val());
		data.text = $.trim($el.find('[name="text"]').val());
		data.btnName = $.trim($el.find('[name="btnName"]').val());
		data.btnLink = $.trim($el.find('[name="btnLink"]').val());
		data.btnType = $.trim($el.find('[name="btnType"]').val());
		data.btnHead = $.trim($el.find('[name="btnHead"]').val());

		return data;
	};

	this.afterRender = function () {
		renderEditor();
	};

	function renderEditor() {
		tinymce.init({
			selector: '.tinymce-70',
			plugins: [
				'advlist autolink link image lists charmap preview hr anchor pagebreak',
				'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
				'table template paste'
			],
			toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | ' +
				'bullist numlist | link | preview fullscreen | ',
			menubar: 'view edit table',
			advlist_bullet_styles: 'default',
			advlist_number_styles: 'default',
			language: 'ru'
		});
	}
});
