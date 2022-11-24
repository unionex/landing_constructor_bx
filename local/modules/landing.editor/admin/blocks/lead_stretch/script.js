landing_editor.registerBlock('lead_stretch', function ($, $el, data) {

	data = $.extend({
		text: '',
		btnName: '',
		btnLink: '',
		nofollow: '',
		btnType: '',
		btnHead: '',
		buttonIDForm: ''
	}, data);

	this.getData = function () {
		return data;
	};

	this.collectData = function () {

		data.text = $.trim($el.find('[name="text"]').val());
		data.btnName = $.trim($el.find('[name="btnName"]').val());
		data.btnLink = $.trim($el.find('[name="btnLink"]').val());
		if ($el.find('.has-rel-nofollow').prop('checked')) {
			data.nofollow = $el.find('.has-rel-nofollow').val();
		} else {
			data.nofollow = "";
		}
		data.btnType = $.trim($el.find('[name="btnType"]').val());
		data.btnHead = $.trim($el.find('[name="btnHead"]').val());
		data.buttonIDForm = $.trim($el.find('[name="buttonIDForm"]').val());

		return data;
	};

	this.afterRender = function () {
		renderEditor();
	};

	function renderEditor() {
		val = $el.find('.has-rel-nofollow').attr('data-selected');
		if(val.length > 0) {
			$el.find('.has-rel-nofollow').prop('checked', true);
		}

		tinymce.init({
			selector: '.tinymce-7',
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
