landing_editor.registerBlock('text_editor', function ($, $el, data) {

    data = $.extend({
		title: '',
        block_style: '',
        value: '',
    }, data);

    var parser = new HtmlWhitelistedSanitizer();

    this.getData = function () {
        data.title = parser.sanitizeString(
            escapeHtml(data.title)
        );
        data.value = parser.sanitizeString(
            escapeHtml(data.value)
        );

        return data;
    };

    this.collectData = function () {
        if (!$.fn.trumbowyg) {
            return data;
        }

        data.title = parser.sanitizeString(
            $el.find('.sp-item-title').val()
        );
        data.block_style = parser.sanitizeString(
            $el.find('.constructor-block-style').val()
        );
        data.value = parser.sanitizeString(
            $el.find('.sp-text').val()
        );

        return data;
    };

    this.afterRender = function () {
        var val = $el.find('.constructor-block-style').attr('data-selected');
        $el.find('.constructor-block-style option[value="' + val + '"]').attr('selected', 'true');

        renderEditor();
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

    function renderEditor() {
		tinymce.init({
			selector: '.tinymce-4',
			plugins: [
				'advlist autolink link image lists charmap preview hr anchor pagebreak',
				'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
				'table template paste'
			],
			toolbar: 'undo redo | h3 | h4 | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | ' +
				'bullist numlist | link image | preview fullscreen | ',
			menubar: 'view edit table',
			advlist_bullet_styles: 'default',
			advlist_number_styles: 'default',
			extended_valid_elements: [
				'h1[class=section-rd__h1]',
				'h2[class=section-rd__h2]',
				'h3[class=section-rd__h3]'
			],
			convert_urls: false,
			relative_urls: false,
			language: 'ru'
		});
	}
});
