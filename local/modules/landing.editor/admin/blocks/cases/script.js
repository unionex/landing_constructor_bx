wait_editor.registerBlock('cases', function ($, $el, data) {

	data = $.extend({
		cases: ''
	}, data);

	this.getData = function () {
		return data;
	};

	this.collectData = function () {

		data.cases = $.trim($el.find('[name="cases"]').val());

		return data;
	};

});