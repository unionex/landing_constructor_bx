landing_editor.registerBlock('html_block1', function ($, $el, data) {

    data = $.extend({
        value: '',
		block_style: '',
		nopt: '',
    }, data);

    this.getData = function () {

        return data;
    };

    this.collectData = function () {

        data.value = $el.find('.sp-text').val();

		data.block_style = $el.find('.constructor-block-style').val();

		//nopt
		if($el.find('.nopt-checkbox').prop('checked')){
			data.nopt = $el.find('.nopt-checkbox').val();
		}else{
			data.nopt = "";
		}

        return data;
    };

    this.afterRender = function () {

		var val = $el.find('.constructor-block-style').attr('data-selected');
		$el.find('.constructor-block-style option[value="' + val + '"]').attr('selected', 'true');

		var val = $el.find('.nopt-checkbox').attr('data-selected');
		if(val.length > 0){
			$el.find('.nopt-checkbox').prop('checked', true);
		}

	};

});
