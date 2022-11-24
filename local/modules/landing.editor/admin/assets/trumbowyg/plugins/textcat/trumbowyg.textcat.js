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

				while (['TEXTCAT','DIV'].indexOf(node.nodeName) < 0) {
					node = node.parentNode;
				}

				if (node && node.nodeName === 'TEXTCAT') {
					var $span = $(node);
					content = $span.attr('content');
					var range = t.doc.createRange();
					range.selectNode(node);
					documentSelection.removeAllRanges();
					documentSelection.addRange(range);
				}

				t.saveRange();

				t.openModalInsert('Сделать подкат', {
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
					var tooltip = $(['<textcat content="', $('<div/>').text(v.content).html(), '">', v.text, '</textcat>'].join(''));
					t.range.deleteContents();
					t.range.insertNode(tooltip[0]);
					return true;
				});
			},
			text: 'Подкат',
			hasIcon: false,
			title: 'Текст подкатом'
		}
	}

	$.extend(true, $.trumbowyg, {
		langs: {
			ru: {
				textcat: 'Текст подкатом'
			}
		},
		plugins: {
			textcat: {
				init: function(trumbowyg) {
					trumbowyg.o.plugins.textcat = $.extend(true, {},
						defaultOptions,
						trumbowyg.o.plugins.textcat || {}
					);

					trumbowyg.pasteHandlers.push(function(pasteEvent) {});

					trumbowyg.addBtnDef('textcat', buildButtonDef(trumbowyg));
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