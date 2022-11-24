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

				while (['TEXTPOPUP','DIV'].indexOf(node.nodeName) < 0) {
					node = node.parentNode;
				}

				if (node && node.nodeName === 'TEXTPOPUP') {
					var $span = $(node);
					content = $span.attr('content');
					var range = t.doc.createRange();
					range.selectNode(node);
					documentSelection.removeAllRanges();
					documentSelection.addRange(range);
				}

				t.saveRange();

				t.openModalInsert('Сделать popup', {
					text: {
						label: t.lang.text,
						value: t.getRangeText()
					},
					content: {
						label: 'Содержание (html)',
						value: content,
						textarea: true
					}
				}, function (v) {
					var tooltip = $(['<textpopup content="', $('<div/>').text(v.content).html(), '">', v.text, '</textpopup>'].join(''));
					t.range.deleteContents();
					t.range.insertNode(tooltip[0]);
					return true;
				});
			},
			text: 'Попап',
			hasIcon: false,
			title: 'Всплывающее окно'
		}
	}

	$.extend(true, $.trumbowyg, {
		langs: {
			ru: {
				textpopup: 'Всплывающее окно'
			}
		},
		plugins: {
			textpopup: {
				init: function(trumbowyg) {
					trumbowyg.o.plugins.textpopup = $.extend(true, {},
						defaultOptions,
						trumbowyg.o.plugins.textpopup || {}
					);

					trumbowyg.pasteHandlers.push(function(pasteEvent) {});

					trumbowyg.addBtnDef('textpopup', buildButtonDef(trumbowyg));
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