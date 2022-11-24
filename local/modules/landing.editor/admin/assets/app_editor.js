var wait_editor = {
    _templates: {},
    _parameters: {},
    _registered: {},
    _events: {},
    _entries: {},
    _uidcounter: 0,

    registerBlock: function (name, method) {
        this._registered[name] = method;
    },

    registerTemplates: function (templates) {
        this._templates = templates
    },

    registerParameters: function (parameters) {
        this._parameters = parameters
    },

    registerTemplate: function (name, html) {
        this._templates[name] = html;
    },

    hasBlockMethod: function (name) {
        return !!this._registered[name];
    },

    getBlockMethod: function (name) {
        return (this._registered[name]) ? this._registered[name] : false;
    },

    hasBlockParams: function (name) {
        return !!this._parameters[name];
    },

    getBlockParams: function (name) {
        return (this._parameters[name]) ? this._parameters[name] : false;
    },

    getBlockWebPath: function (blockName) {
        var values = this.getBlockParams(blockName);
        return '/local/modules/landing.editor/admin/' + values.groupname + '/' + values.name;
    },

    renderTemplate: function (name, data) {
        if (window.doT && this._templates[name]) {
            var tempfn = window.doT.template(this._templates[name]);
            return tempfn(data);
        } else {
            return '';
        }
    },

    initblock: function ($, $el, name, blockData) {
        name = wait_editor.hasBlockMethod(name) ? name : 'dump';

        var method = wait_editor.getBlockMethod(name);
        var entry = new method($, $el, blockData);

        var html = wait_editor.renderTemplate(name, entry.getData());
        $el.html(html).addClass('sp-block-' + name);

        if (typeof entry.afterRender == 'function') {
            entry.afterRender();
        }

        return entry;
    },

    initblockAreas: function ($, $el, entry) {
        if (entry && typeof entry.getAreas == 'function') {
            var areas = entry.getAreas();
            var entryData = entry.getData();
            for (var prop in areas) {
                if (areas.hasOwnProperty(prop)) {
                    var area = areas[prop];
                    area.block = wait_editor.initblock($, $el.find(area.container), area.blockName, entryData[area.dataKey]);
                }
            }
        }
    },

    collectData: function (entry) {
        var blockData = {};

        if (entry && typeof entry.collectData == 'function') {
            blockData = entry.collectData();

            if (typeof entry.getAreas === 'function') {
                var areas = entry.getAreas();

                for (var prop in areas) {
                    if (areas.hasOwnProperty(prop)) {
                        var area = areas[prop];
                        blockData[area.dataKey] = area.block.collectData();
                    }
                }
            }
        }

        return blockData;
    },

    fireEvent: function (type) {
        if (!this._events[type]) {
            this._events[type] = [];
        }

        for (var prop in this._events[type]) {
            if (this._events[type].hasOwnProperty(prop)) {
                var event = this._events[type][prop];
                if (typeof event === 'function') {
                    event();
                }
            }
        }
    },

    listenEvent: function (type, callback) {
        if (!this._events[type]) {
            this._events[type] = [];
        }
        this._events[type].push(callback);
    },

    copyToClipboard: function (uid) {
        if (window.localStorage && wait_editor._entries[uid]) {

            var blockData = wait_editor.collectData(wait_editor._entries[uid]);
            var val = JSON.parse(
                localStorage.getItem('wait-editor-cb01')
            );

            val = (val) ? val : {};

            if (val[uid]) {
                delete val[uid];
            } else {
                val[uid] = blockData;
            }

            localStorage.setItem("wait-editor-cb01", JSON.stringify(val));
            this.fireEvent('copy');
        }


    },

    clearClipboard: function () {
        if (window.localStorage) {
            localStorage.removeItem('wait-editor-cb01');
            this.fireEvent('copy');
        }

    },

    getClipboard: function () {
        var val = {};
        if (window.localStorage) {
            val = JSON.parse(
                localStorage.getItem('wait-editor-cb01')
            );
        }

        return (val) ? val : {};
    },

    makeUid: function () {
        var uniq = Math.random().toString(36).substring(2, 12);
        this._uidcounter++;

        return 'sp-x-' + this._uidcounter + uniq;
    },

    create: function ($, params) {
        var $editor = $('.sp-x-editor' + params.uniqid);
        var $inputresult = $('.sp-x-result' + params.uniqid);
        var $form = $editor.closest('form').first();

        if (!params.jsonValue) {
            params.jsonValue = {};
        }

        if (!params.jsonValue.blocks) {
            params.jsonValue.blocks = [];
        }

        if (!params.jsonValue.layouts) {
            params.jsonValue.layouts = [];
        }

        if (!params.jsonUserSettings) {
            params.jsonUserSettings = {};
        }

        $.each(params.jsonValue.layouts, function (index, columns) {
            layoutAdd(columns);
        });

        $.each(params.jsonValue.blocks, function (index, block) {
            blockAdd(block);
        });


        wait_editor.listenEvent('focus', function () {
            checkClipboardButtons();
        });

        wait_editor.listenEvent('copy', function () {
            checkClipboardButtons();
        });


        checkLayoutButtons();
        checkClipboardButtons();

        $form.on('submit', function (e) {

            var blocks = [];
            var layouts = [];

            var index = 0;

            $editor.find('.sp-x-lt-grid').each(function (gindex) {
                var columns = [];

                $(this).find('.sp-x-lt-col').each(function (cindex) {

                    var text = $(this).find('.sp-x-lt-curtype').text();
                    columns.push(text);

                    $(this).find('.sp-x-box').each(function () {

                        var uid = $(this).data('uid');

                        if (!wait_editor._entries[uid]) {
                            return true;
                        }

                        var blockData = wait_editor.collectData(
                            wait_editor._entries[uid]
                        );


                        var $boxsett = $(this).find('.sp-x-box-settings');
                        var settarr = $boxsett.find("select,input").serializeArray();

                        delete blockData.settings;
                        if (settarr.length > 0) {
                            blockData.settings = {};
                            $.each(settarr, function () {
                                blockData.settings[this.name] = this.value;
                            });
                        }

                        blockData.layout = gindex + ',' + cindex;
                        blocks.push(blockData);
                        index++;

                    });

                });

                layouts.push(columns);
            });

            var resultString = '';

            if (layouts.length > 0) {
                var post = {
                    blocks: blocks,
                    layouts: layouts
                };

                resultString = JSON.stringify(post);
                resultString = resultString.replace(/\\n/g, "\\n")
                    .replace(/\\'/g, "\\'")
                    .replace(/\\"/g, '\\"')
                    .replace(/\\&/g, "\\&")
                    .replace(/\\r/g, "\\r")
                    .replace(/\\t/g, "\\t")
                    .replace(/\\b/g, "\\b")
                    .replace(/\\f/g, "\\f");
            }


            $editor.find('input,textarea,select').removeAttr('name');
            $inputresult.val(resultString);
        });

        if (params.enableChange) {

            $('body').on('click', '.sp-x-layout-toggle', function (e) {
                if ($editor.hasClass('sp-x-layout-mode')) {
                    $editor.removeClass('sp-x-layout-mode');
                } else {
                    $editor.addClass('sp-x-layout-mode');
                }
            });

            $editor.on('click', '.sp-x-lt-copy', function (e) {
                e.preventDefault();
                var $col = $(this).closest('.sp-x-lt-col');
                $col.find('.sp-x-box').each(function () {
                    wait_editor.copyToClipboard($(this).data('uid'));
                });
            });

            $editor.on('click', '.sp-x-lt-paste', function (e) {
                e.preventDefault();

                var $grid = $(this).closest('.sp-x-lt-grid');
                var $col = $(this).closest('.sp-x-lt-col');

                var gindex =  $editor.find('.sp-x-lt-grid').index($grid);
                var cindex = $grid.find('.sp-x-lt-col').index($col);

                var clipboardData = wait_editor.getClipboard();

                $.each(clipboardData, function (blockUid, blockData) {
                    blockData.layout = gindex + ',' + cindex;
                    blockAdd(blockData);
                });

                wait_editor.clearClipboard();
            });

            $editor.on('click', '.sp-x-box-copy', function (e) {
                e.preventDefault();
                wait_editor.copyToClipboard($(this).closest('.sp-x-box').data('uid'));
            });

            $('body').on('click', '.sp-x-box-add', function (e) {
            	var name = $('body').find('.sp-x-box-select').val();
                var numberTinyBefore = $('.tox-tinymce').length;
                if (name.indexOf('layout_') === 0) {
                    name = name.substr(7);
                    layoutEmptyAdd(name);
                } else {
                    blockAdd({name: name});
                }
                // Костыль. Правит баг, что редактор не сохраняет значение с первого сохранения WAIT-4024
                setTimeout(function () {
					var numberTinyAfter = $('.tox-tinymce').length;
                    if (!numberTinyBefore && numberTinyBefore < numberTinyAfter) {
                        $( "#apply" ).trigger( "click" );
                    }
				}, 500);

            });

            $editor.on('click', '.sp-x-box-up', function (e) {
                e.preventDefault();
                var block = $(this).closest('.sp-x-box');
                var nblock = block.prev('.sp-x-box');
                if (nblock.length > 0) {
                    block.insertBefore(nblock);
                }
            });

            $editor.on('click', '.sp-x-box-dn', function (e) {
                e.preventDefault();
                var block = $(this).closest('.sp-x-box');
                var nblock = block.next('.sp-x-box');
                if (nblock.length > 0) {
                    block.insertAfter(nblock);
                }
            });

            $editor.on('click', '.sp-x-box-del', function (e) {
                e.preventDefault();
                var $target = $(this).closest('.sp-x-box');
                $target.hide(250, function () {
                    $target.remove();
                });
            });

            $editor.on('click', '.sp-x-box-switch', function (e) {
                let block = $(this).closest('.sp-x-box');
                if (block.hasClass('sp-x-layout-mode-block')) {
                    block.removeClass('sp-x-layout-mode-block');
                } else {
                    block.addClass('sp-x-layout-mode-block');
                }
            });

            $editor.on('click', '.sp-x-lt-del', function (e) {
                e.preventDefault();
                var $grid = $(this).closest('.sp-x-lt-grid');
                var $col = $(this).closest('.sp-x-lt-col');

                var colcount = $grid.find('.sp-x-lt-col').length;
                var newcount = colcount - 1;
                if (newcount > 0){
                    $col.hide(250, function () {
                        $col.remove();
                        $grid.attr('class', 'sp-x-lt-grid').addClass('sp-x-lt-type' + newcount);
                    });
                } else {
                    $grid.hide(250, function () {
                        $grid.remove();
                    });
                }
            });

            $editor.on('click', '.sp-x-lt-types span', function (e) {
                var $span = $(this);

                var $xcol = $span.closest('.sp-x-lt-col');
                var $cursize = $xcol.find('.sp-x-lt-curtype');
                var $sizes = $xcol.find('.sp-x-lt-types');

                $span.siblings('span').removeClass('active');

                if ($span.hasClass('active')) {
                    $span.removeClass('active');
                } else {
                    $span.addClass('active');
                }

                var result = [];
                $sizes.find('.active').each(function () {
                    var tmp = $(this).text();
                    tmp = $.trim(tmp);
                    result.push(tmp);
                });

                $cursize.text(result.join(' '));

            });

            $editor.on('click', '.sp-x-lt-title', function (e) {
                var $title = $(this);
                var $xcol = $title.closest('.sp-x-lt-col');
                var $sizes = $xcol.find('.sp-x-lt-types');
                if ($sizes.length > 0) {
                    if ($title.hasClass('active')) {
                        $sizes.hide(250);
                        $title.removeClass('active');
                    } else {
                        $editor.find('.sp-x-lt-types').not($sizes).hide();
                        $editor.find('.sp-x-lt-title').not($title).removeClass('active');

                        var cursizes = $xcol.find('.sp-x-lt-curtype').text();
                        cursizes = cursizes.split(' ');
                        $sizes.find('span').each(function () {
                            var stext = $(this).text();
                            stext = $.trim(stext);
                            if (stext && $.inArray(stext, cursizes) >= 0) {
                                $(this).addClass('active');
                            }
                        });

                        $sizes.show(250);
                        $title.addClass('active');
                    }
                }
            });

            $editor.on('click', '.sp-x-columns-handle', function (e) {
                var $container = $(this).closest('.sp-x-lt-grid');
                if($container.hasClass('sp-x-lt-type2')) {
					$.each($container.find('.sp-x-lt-col:nth-child(2) .sp-x-box'), function (index, block) {
						$container.find('.sp-x-lt-col:nth-child(1)').append(block);
					});
					$container.find('.sp-x-lt-col:nth-child(2)').remove();
					$container.removeClass('sp-x-lt-type2').addClass('sp-x-lt-type1');
                    renderType('type1', $container);
					$container.find('.sp-x-lt-title').trigger('click');

                } else if($container.hasClass('sp-x-lt-type1')) {
                    renderType('type2', $container);
					$container.find('.sp-x-lt-title').trigger('click');
					$container.append(wait_editor.renderTemplate('box-column', []));
					renderType('type2', $container.find('.sp-x-lt-col:nth-child(2)'));
					$container.removeClass('sp-x-lt-type1').addClass('sp-x-lt-type2');
                }
				if (params.enableChange) {
					var $allcolls = $editor.find('.sp-x-lt-col');
					$allcolls.sortable({
						items: ".sp-x-box",
						connectWith: $allcolls,
						handle: ".sp-x-box-handle",
						placeholder: "sp-x-box-placeholder"
					});

					// задаем сортируемость колонкам
					var $allcolls = $editor.find('.sp-x-boxes');
					$allcolls.sortable({
						items: ".sp-x-lt-grid",
						connectWith: $allcolls,
						handle: ".sp-x-box-handle",
						placeholder: "sp-x-box-placeholder"
					});
				}

				checkLayoutButtons();
				checkClipboardButtons();
			});
        }

        function checkClipboardButtons() {
            var clipboardData = wait_editor.getClipboard();

            var cntBlocks = 0;
            $editor.find('.sp-x-box-copy').removeClass('active');

            $.each(clipboardData, function (blockUid, blockData) {
                var $block = $editor.find('[data-uid=' + blockUid + ']');
                if ($block.length > 0) {
                    $block.find('.sp-x-box-copy').addClass('active');
                }
                cntBlocks++;
            });

            if (cntBlocks > 0) {
                $editor.find('.sp-x-lt-paste').show();
            } else {
                $editor.find('.sp-x-lt-paste').hide();
            }
        }

        function layoutEmptyAdd(colCnt) {
            var ltname = 'type' + colCnt;

            var columns = [];
            var defaultclass = '';

            if (params.jsonUserSettings && params.jsonUserSettings.layout_defaults) {
                if (params.jsonUserSettings.layout_defaults[ltname]) {
                    defaultclass = params.jsonUserSettings.layout_defaults[ltname];
                }
            }

            for (var index = 1; index <= colCnt; index++) {
                columns.push(defaultclass)
            }

            layoutAdd(columns);
        }

        function layoutAdd(columns) {
            var ltname = 'type' + columns.length;
            var renderVars = {
                enableChange: params.enableChange,
                columns: columns
            };

            if (params.jsonUserSettings && params.jsonUserSettings.layout_classes) {
                if (params.jsonUserSettings.layout_classes[ltname]) {
                    if (params.jsonUserSettings.layout_classes[ltname].length > 0) {
                        renderVars.classes = params.jsonUserSettings.layout_classes[ltname]
                    }
                }
            }

            $editor.find('.sp-x-boxes').append(
                wait_editor.renderTemplate('box-layout', renderVars)
            );

            if (params.enableChange) {
                var $allcolls = $editor.find('.sp-x-lt-col');
                $allcolls.sortable({
                    items: ".sp-x-box",
                    connectWith: $allcolls,
                    handle: ".sp-x-box-handle",
                    placeholder: "sp-x-box-placeholder"
                });

                // задаем сортируемость колонкам
                var $allcolls = $editor.find('.sp-x-boxes');
                $allcolls.sortable({
                    items: ".sp-x-lt-grid",
                    connectWith: $allcolls,
                    handle: ".sp-x-box-handle",
                    placeholder: "sp-x-box-placeholder"
                });
            }

            checkLayoutButtons();
            checkClipboardButtons();
        }

        function checkLayoutButtons() {
            if ($editor.find('.sp-x-lt-col').length <= 0) {
                $editor.find('.sp-x-layout-toggle').hide();
            } else {
                $editor.find('.sp-x-layout-toggle').show();
            }
        }

        function blockAdd(blockData) {
            if (!blockData.name || !wait_editor.hasBlockParams(blockData.name)) {
                return false;
            }
            var blockParams = wait_editor.getBlockParams(blockData.name);
            blockParams.uid = wait_editor.makeUid();
            blockParams.showSortButtons = params.showSortButtons;
            blockParams.enableChange = params.enableChange;

            blockParams.settings = {};
            if (params.jsonUserSettings && params.jsonUserSettings.block_settings) {
                if (params.jsonUserSettings.block_settings[blockData.name]) {
                    blockParams.settings = params.jsonUserSettings.block_settings[blockData.name];
                }
            }

            blockParams.compiled = compileSettings(blockParams, blockData);

            var html = wait_editor.renderTemplate('box', blockParams);

            if ($editor.find('.sp-x-lt-col').length <= 0) {
                layoutEmptyAdd(1);
            }

            var $column = false;
            if (blockData.layout) {
                var pos = blockData.layout.split(',');
                var $grid = $editor.find('.sp-x-lt-grid').eq(pos[0]);
                $column = $grid.find('.sp-x-lt-col').eq(pos[1]);
            }

            if (!$column || $column.length <= 0) {
                $column = $editor.find('.sp-x-lt-col').last();
            }

            $column.append(html);

            var $el = $column.find('.sp-x-box-block').last();
            var entry = wait_editor.initblock($, $el, blockData.name, blockData);
            wait_editor.initblockAreas($, $el, entry);
            wait_editor._entries[blockParams.uid] = entry;
        }

        function compileSettings(blockParams, blockData) {
            var compiled = [];

            if (!blockParams.settings) {
                return compiled;
            }

            $.each(blockParams.settings, function (setName, setSet) {

                if (!setSet.value || !setSet.type || setSet.type != 'select') {
                    return true;
                }

                var value = [];
                var valSel = 0;

                $.each(setSet.value, function (valVal, valTitle) {

                    valSel = (
                        blockData.settings &&
                        blockData.settings[setName] &&
                        blockData.settings[setName] == valVal
                    ) ? 1 : 0;

                    value.push({
                        title: valTitle,
                        value: valVal,
                        selected: valSel
                    })
                });
                compiled.push({
                    name: setName,
                    value: value
                })
            });
            return compiled;
        }

		function renderType (ltname, container) {
            var renderVars = [];
			if (params.jsonUserSettings && params.jsonUserSettings.layout_classes) {
				if (params.jsonUserSettings.layout_classes[ltname]) {
					if (params.jsonUserSettings.layout_classes[ltname].length > 0) {
						renderVars.classes = params.jsonUserSettings.layout_classes[ltname]
					}
				}
			}
			container.find('.sp-x-lt-curtype').empty();
			container.find('.sp-x-lt-types').empty().append(wait_editor.renderTemplate('box-types', renderVars));

		}

    },
};
