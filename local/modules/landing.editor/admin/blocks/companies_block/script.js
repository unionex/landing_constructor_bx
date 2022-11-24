landing_editor.registerBlock('companies_block', function ($, $el, data) {

    data = $.extend({
        value: '',
		companies:''
    }, data);

    var parser = new HtmlWhitelistedSanitizer();

    this.getData = function () {
        data.value = parser.sanitizeString(
            escapeHtml(data.value)
        );
		data.companies = parser.sanitizeString(
			escapeHtml(data.companies)
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
		data.companies = parser.sanitizeString(
			$el.find('.constructor-input2').val()
		);

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
					title: 'Плагины',
					hasIcon: false
				},
                image: {
					dropdown: ['insertImage', 'upload'],
					title: 'Изображения',
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
