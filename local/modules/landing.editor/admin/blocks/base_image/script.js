wait_editor.registerBlock('base_image', function($, $el, data) {

	document.myFunc = null;
	// глобальная функция-обработчик нужна для метода ShowScript модуля CAdminFileDialog
	document.OpenImage = function () {};

	$el.on('click', '.button-select-img', OpenImage);
	// при клике на кнопку "Выбрать" мы сохраняем функцию чтобы потом ее вызвать,
	// в ней контекст "data" кокретного блока замкнута
	$el.on('click', '.button-select-img', function () {
		document.myFunc = function (file) {
			data.file = file.file[0];
			renderfiles();
		};
	});

	// глобальная функция нужна для метода ShowScript модуля CAdminFileDialog
	// при выборе в "Менеджере файлов" картинку, в функцию передадутся путь к файлу
	SetImageUrl = function (filename, path, site) {
		// делаем запрос с полученным адресом к рисунку выбранного в "Менеджере файлов"
		$.ajax({
			method: 'GET',
			url: wait_editor.getBlockWebPath('base_image') + '/upload.php',
			data: {url_local_file: path + '/' + filename},
			dataType: 'json'
		}).done(function (data) {
			document.myFunc(data);
		});
	};

    data = $.extend({
        file: {},
        desc: ''
    }, data);

    this.getData = function () {
        return data;
    };

    this.collectData = function () {
        data.desc = $el.find('.sp-base_image_item-text').val();
        return data;
    };

    this.afterRender = function () {

        renderfiles();

        var btn = $el.find('.sp-file');
        var btninput = btn.find('input[type=file]');
        var label = btn.find('span');
        var labeltext = label.text();

        btninput.fileupload({
            url: wait_editor.getBlockWebPath('base_image') + '/upload.php',
            dataType: 'json',
            done: function (e, result) {
                $.each(result.result.file, function(index,file){
                    data.file = file;
                });

                renderfiles();
            },
            progressall: function (e, result) {
                var progress = parseInt(result.loaded / result.total * 100, 10);

                label.text('Загрузка: ' + progress + '%');

                if (progress>=100){
                    label.text(labeltext);
                }
            }
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');


        $el.on('click', '.sp-base_image_item-del', function(){
            data['file'] = {};
            data['desc'] = '';
            renderfiles();
        });
    };

    var renderfiles = function() {
        $el.find('.sp-result').html(
            wait_editor.renderTemplate('base_image-image', data)
        );
    }


});
