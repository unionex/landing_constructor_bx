landing_editor.registerBlock('top_lead_magnet', function($, $el, data) {

	document.myFunc = null;
	// глобальная функция-обработчик нужна для метода ShowScript модуля CAdminFileDialog
	document.OpenImage = function () {};

	$el.on('click', '.lead-m-button-select-img', OpenImage);
	// при клике на кнопку "Выбрать" мы сохраняем функцию чтобы потом ее вызвать,
	// в ней контекст "data" кокретного блока замкнута
	$el.on('click', '.lead-m-button-select-img', function () {
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
			url: landing_editor.getBlockWebPath('top_lead_magnet') + '/upload.php',
			data: {url_local_file: path + '/' + filename},
			dataType: 'json'
		}).done(function (data) {
			document.myFunc(data);
		});
	};

    data = $.extend({
        title: '',
        subtitle: '',
        buttonText: '',
        buttonLink: '',
		nofollow: '',
		buttonType: '',
		buttonHead: '',
		buttonIDForm: '',
		buttonText2: '',
		buttonLink2: '',
		nofollow2: '',
		buttonType2: '',
		buttonHead2: '',
		buttonIDForm2: '',
		titleTag: '',
        file: {},
		linkFB: '',
		linkInst: '',
		linkVK: '',
        desc: '',
		elements: [{
			name: '',
			link: ''
		}]
    }, data);

    this.getData = function () {
        return data;
    };

    this.collectData = function () {

        data.desc = $el.find('.sp-base_lead-m-image_item-text').val();
        data.title = $el.find('.lead-m-title').val();
        data.subtitle = $el.find('.lead-m-subtitle').val();
        data.buttonText = $el.find('.lead-m-text-btn').val();
        data.buttonLink = $el.find('.lead-m-text-btn-link').val();
		if ($el.find('.has-rel-nofollow').prop('checked')) {
			data.nofollow = $el.find('.has-rel-nofollow').val();
		} else {
			data.nofollow = "";
		}
		data.buttonType = $el.find('.lead-m-text-btn-type').val();
		data.buttonHead = $el.find('.lead-m-text-btn-head').val();
		data.buttonIDForm = $el.find('[name="buttonIDForm"]').val();
		data.buttonText2 = $el.find('.lead-m-text-btn2').val();
		data.buttonLink2 = $el.find('.lead-m-text-btn-link2').val();
		if ($el.find('.has-rel-nofollow2').prop('checked')) {
			data.nofollow2 = $el.find('.has-rel-nofollow2').val();
		} else {
			data.nofollow2 = "";
		}
		data.buttonType2 = $el.find('.lead-m-text-btn-type2').val();
		data.buttonHead2 = $el.find('.lead-m-text-btn-head2').val();
		data.buttonIDForm2 = $el.find('[name="buttonIDForm2"]').val();
		data.titleTag = $.trim($el.find('[name="titleTag"]').val());
		data.linkFB = $.trim($el.find('[name="linkFB"]').val());
		data.linkInst = $.trim($el.find('[name="linkInst"]').val());
		data.linkVK = $.trim($el.find('[name="linkVK"]').val());
		var trimed = [];
		$el.find('.sp-item').each(function () {
			let item = $(this);
			let element = {};
			element.name = $.trim(item.find('[name="name"]').val());
			element.link = $.trim(item.find('[name="link"]').val());
			trimed.push(element);
		});
		data.elements = trimed;
        return data;
    };

    this.afterRender = function () {

        renderfiles();

        var btn = $el.find('.sp-lead-m-file');
        var btninput = btn.find('input[type=file]');
        var label = btn.find('span');
        var labeltext = label.text();
		let $res = $el.find('.sp-lists-result');

        btninput.fileupload({
            url: landing_editor.getBlockWebPath('top_lead_magnet') + '/upload.php',
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

		$res.html(
			landing_editor.renderTemplate('top_lead_magnet-items', data)
		);

		val = $el.find('.has-rel-nofollow').attr('data-selected');
		if (val.length > 0) {
			$el.find('.has-rel-nofollow').prop('checked', true);
		}

		val2 = $el.find('.has-rel-nofollow2').attr('data-selected');
		if (val2.length > 0) {
			$el.find('.has-rel-nofollow2').prop('checked', true);
		}

        $el.on('click', '.sp-base_lead-m-image_item-del', function(){
            data['file'] = {};
            data['desc'] = '';
            renderfiles();
        });

		$el.on('click', '.sp-lists-add', function () {
			$res.append(
				landing_editor.renderTemplate('top_lead_magnet-items', {
					elements: [{
						name: '',
						link: ''
					}]
				})
			);
		});
    };

    var renderfiles = function() {
        $el.find('.sp-lead-m-result').html(
			landing_editor.renderTemplate('top_lead_magnet-image', data)
        );
    }


});
