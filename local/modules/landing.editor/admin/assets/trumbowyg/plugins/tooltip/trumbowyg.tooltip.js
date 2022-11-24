(function ($) {
	'use strict';

	var defaultOptions = {
	};

	function buildButtonDef(trumbowyg) {
		return {
			fn: function() {
				var t = trumbowyg,
					documentSelection = t.doc.getSelection(),
					node = documentSelection.focusNode,
					content;

				while (['TOOLTIP','DIV'].indexOf(node.nodeName) < 0) {
					node = node.parentNode;
				}

				if (node && node.nodeName === 'TOOLTIP') {
					var $span = $(node);
					content = $span.attr('content');
					var range = t.doc.createRange();
					range.selectNode(node);
					documentSelection.removeAllRanges();
					documentSelection.addRange(range);
				}

				t.saveRange();

				t.openModalInsert('Сделать подсказку', {
					text: {
						label: t.lang.text,
						value: t.getRangeText()
					},
					content: {
						label: t.lang.title,
						value: content
					}
				}, function (v) {
					var tooltip = $(['<tooltip content="', v.content, '">', v.text, '</tooltip>'].join(''));
					t.range.deleteContents();
					t.range.insertNode(tooltip[0]);
					return true;
				});
			},
			text: 'Подсказка',
			hasIcon: false,
			title: 'Всплывающая подсказка'
		}
	}

	$.extend(true, $.trumbowyg, {
		langs: {
			ru: {
				tooltip: 'Всплывающая подсказка'
			}
		},
		plugins: {
			tooltip: {
				init: function(trumbowyg) {
					trumbowyg.o.plugins.tooltip = $.extend(true, {},
						defaultOptions,
						trumbowyg.o.plugins.tooltip || {}
					);

					trumbowyg.pasteHandlers.push(function(pasteEvent) {});

					trumbowyg.addBtnDef('tooltip', buildButtonDef(trumbowyg));
				},
				tagHandler: function(element, trumbowyg) {
					return [];
				},
				destroy: function() {
				}
			}
		}
	})
})(jQuery);