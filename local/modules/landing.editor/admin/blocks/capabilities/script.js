landing_editor.registerBlock('capabilities', function ($, $el, data) {

	data = $.extend({
		heading: '',
		hpb: '',
		elements: [{
			name: '',
			title: '',
			text: ''
		}]
	}, data);

	let parser = new HtmlWhitelistedSanitizer();

	this.getData = function () {
		let key = 0;
		for(key in data.elements) {
			data.elements[key].text = parser.sanitizeString(data.elements[key].text);
		}

		return data;
	};

	this.collectData = function () {

		//Класс отступов
		//section-rd--has-padding-bottom
		if($el.find('.has-padding-bottom').prop('checked')){
			data.hpb = $el.find('.has-padding-bottom').val();
		}else{
			data.hpb = "";
		}

		data.heading = $el.find('input.js-heading').val();
		let trimed = [];

		$el.find('.sp-item').each(function () {
			let item = $(this);
			let data = {};

			data.name = $.trim(item.find('[name="name"]').val());
			data.title = $.trim(item.find('[name="title"]').val());
			data.text = parser.sanitizeString(
				item.find('.sp-text').val()
			);

			trimed.push(data);
		});

		data.elements = trimed;
		return data;
	};

	this.afterRender = function () {

		//Проверяем чекбоксы
		let val = '';

		val = $el.find('.has-padding-bottom').attr('data-selected');
		if(val.length > 0) {
			$el.find('.has-padding-bottom').prop('checked', true);
		}

		let $res = $el.find('.sp-lists-result');

		$res.html(
			landing_editor.renderTemplate('capabilities-items', data)
		);

		$el.on('click', '.sp-lists-add', function () {
			$res.append(
				landing_editor.renderTemplate('capabilities-items', {
					elements: [{
						name: '',
						title: '',
						text: ''
					}]
				})
			);
			renderEditor();
		});

		renderEditor();
	};

	function renderEditor() {
		tinymce.init({
			selector: '.tinymce-18',
			plugins: [
				'advlist autolink link image lists charmap preview hr anchor pagebreak',
				'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
				'table template paste'
			],
			toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | ' +
				'bullist numlist | link image | preview fullscreen |',
			menubar: 'view edit table',
			advlist_bullet_styles: 'default',
			advlist_number_styles: 'default',
			language: 'ru',
			images_upload_url: '/local/modules/landing.editor/admin/assets/tinymce/upload_image.php',
			/* enable automatic uploads of images represented by blob or data URIs*/
			// automatic_uploads: false,
			/*
              URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
              images_upload_url: 'postAcceptor.php',
              here we add custom filepicker only to Image dialog
            */
			file_picker_types: 'image',
			/* and here's our custom image picker*/
			// file_picker_callback: function (cb, value, meta) {
			// 	var input = document.createElement('input');
			// 	input.setAttribute('type', 'file');
			// 	input.setAttribute('accept', 'image/*');
			//
			// 	/*
            //       Note: In modern browsers input[type="file"] is functional without
            //       even adding it to the DOM, but that might not be the case in some older
            //       or quirky browsers like IE, so you might want to add it to the DOM
            //       just in case, and visually hide it. And do not forget do remove it
            //       once you do not need it anymore.
            //     */
			//
			// 	input.onchange = function () {
			// 		var file = this.files[0];
			//
			// 		var reader = new FileReader();
			// 		reader.onload = function () {
			// 			/*
            //               Note: Now we need to register the blob in TinyMCEs image blob
            //               registry. In the next release this part hopefully won't be
            //               necessary, as we are looking to handle it internally.
            //             */
			// 			var id = 'blobid' + (new Date()).getTime();
			// 			var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
			// 			var base64 = reader.result.split(',')[1];
			// 			var blobInfo = blobCache.create(id, file, base64);
			// 			blobCache.add(blobInfo);
			//
			// 			/* call the callback and populate the Title field with the file name */
			// 			cb(blobInfo.blobUri(), { title: file.name });
			// 		};
			// 		reader.readAsDataURL(file);
			// 	};
			//
			// 	input.click();
			// },
			setup: function (editor) {
				editor.on('BeforeSetContent', function (e) {
					var str = e.content;
					let regexpFindImg = /<img [^<>]+>/g;
					let imgTags = str.match(regexpFindImg);

					if (imgTags) {
						imgTags.forEach((element) => {
							var newstr = str.replace(element, '<a href="'+ $(element)[0].src +'" class="js-fancy-media js-zoomib-event">' + element + '</a>');
							e.content = newstr;
						})
					}
				});
			}
		});
	}
});
