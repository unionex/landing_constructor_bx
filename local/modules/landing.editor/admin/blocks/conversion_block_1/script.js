landing_editor.registerBlock('conversion_block_1', function ($, $el, data) {

    data = $.extend({
		block_style:'',
        value: '',
		value2: '',
		value3: '',
		nopt: '',
		nopb: '',
		top_border:'',
		bottom_border: ''
    }, data);

    var parser = new HtmlWhitelistedSanitizer();

    this.getData = function () {
        data.value = parser.sanitizeString(
            escapeHtml(data.value)
        );
		data.value2 = parser.sanitizeString(
			escapeHtml(data.value2)
		);
		data.value3 = parser.sanitizeString(
			escapeHtml(data.value3)
		);
		data.nopt = parser.sanitizeString(
			escapeHtml(data.nopt)
		);
		data.nopb = parser.sanitizeString(
			escapeHtml(data.nopb)
		);
		data.top_border = parser.sanitizeString(
			escapeHtml(data.top_border)
		);
		data.bottom_border = parser.sanitizeString(
			escapeHtml(data.bottom_border)
		);

        return data;
    };

    this.collectData = function () {
        if (!$.fn.trumbowyg) {
            return data;
        }

        data.value = parser.sanitizeString(
			$el.find('.constructor-input').val()
		);
		data.value2 = parser.sanitizeString(
			$el.find('.constructor-input2').val()
		);
		data.value3 = parser.sanitizeString(
			$el.find('.constructor-input3').val()
		);
		data.block_style = parser.sanitizeString(
			$el.find('.constructor-block-style').val()
		);

		//nopt
		if($el.find('.nopt-checkbox').prop('checked')){
				data.nopt = parser.sanitizeString($el.find('.nopt-checkbox').val());
		}else{
			data.nopt = parser.sanitizeString("");
		}
		//nopb
		if($el.find('.nopb-checkbox').prop('checked')){
			data.nopb = parser.sanitizeString($el.find('.nopb-checkbox').val());
		}else{
			data.nopb = parser.sanitizeString("");
		}
		//top_border
		if($el.find('.top-border-checkbox').prop('checked')){
			data.top_border = parser.sanitizeString($el.find('.top-border-checkbox').val());
		}else{
			data.top_border = parser.sanitizeString("");
		}
		//bottom_border
		if($el.find('.bottom-border-checkbox').prop('checked')){
			data.bottom_border = parser.sanitizeString($el.find('.bottom-border-checkbox').val());
		}else{
			data.bottom_border = parser.sanitizeString("");
		}

        return data;
    };

    this.afterRender = function () {

        if (!$.fn.trumbowyg) {
            return false;
        }

        $el.find('.sp-text').trumbowyg({
			btnsDef: {
				plugins: {
					dropdown: ['tooltip','textcat', 'textpopup'],
					title: '??????????????',
					hasIcon: false
				},
                image: {
					dropdown: ['insertImage', 'upload'],
					title: '??????????????????????',
					hasIcon: false
				}
			},
            svgPath: '/local/modules/landing.editor/admin/assets/trumbowyg/ui/icons.svg',
            lang: 'ru',
            resetCss: true,
            removeformatPasted: true,
            btns: [
                ['viewHTML'],
                ['bold', 'italic', 'underline', 'strikethrough'],
				['fontsize'],
				['lineheight'],
                ['link'],
                ['removeformat'],
				['plugins'],
                ['image']
            ],

            autogrow: true,

			plugins: {
				upload: {
					serverPath: '/local/modules/landing.editor/admin/assets/trumbowyg/upload_image.php',
					fileFieldName: 'image',
					urlPropertyName: 'data.link'
				}
			}

        });
		var val = $el.find('.constructor-block-style').attr('data-selected');
		$el.find('.constructor-block-style option[value="' + val + '"]').attr('selected', 'true');


		var val = $el.find('.nopt-checkbox').attr('data-selected');
		if(val.length > 0){
			$el.find('.nopt-checkbox').prop('checked', true);
		}

		var val = $el.find('.nopb-checkbox').attr('data-selected');
		if(val.length > 0){
			$el.find('.nopb-checkbox').prop('checked', true);
		}

		var val = $el.find('.top-border-checkbox').attr('data-selected');
		if(val.length > 0){
			$el.find('.top-border-checkbox').prop('checked', true);
		}

		var val = $el.find('.bottom-border-checkbox').attr('data-selected');
		if(val.length > 0){
			$el.find('.bottom-border-checkbox').prop('checked', true);
		}


    };

    function escapeHtml(text) {
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };

        return text.replace(/[&<>"']/g, function (m) {
            return map[m];
        });
    }
});
