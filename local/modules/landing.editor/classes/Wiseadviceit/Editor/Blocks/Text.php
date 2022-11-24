<?php

namespace App\Editor\Blocks;

use \DOMElement;
use \DOMDocument;

/**
 * Class Text
 *
 * @package App\Editor\Blocks
 */
class Text
{

	static private $iPopup = 0;
	static protected $notAddNoIndexTag = false;

	/**
	 * @param $block
	 *
	 * @return string
	 */
	static public function getValue($block, $name='value')
	{
		/** @var $APPLICATION Application|\CAllMain|\CMain */
		global $APPLICATION;
		if(empty($name)){
			$name = 'value';
		}
		if (empty($block[$name])) {
			return '';
		}

		$content = $block[$name];
		self::$notAddNoIndexTag =  $block['no_index_not_add']? true : false;

		if (strpos($content, 'tooltip') !== false || strpos($content, 'textcat') !== false || strpos($content, 'textpopup') !== false || strpos($content, 'table') !== false) {

			$oHtml                     = new \DOMDocument();
			$encodeContent             = $content;
			$oHtml->preserveWhiteSpace = false;
			$oHtml->formatOutput       = true;
			@$oHtml->loadHTML('<?xml encoding="utf-8" ?>' . $encodeContent);

			if (strpos($content, 'tooltip') !== false) {
				$arTooltips = $oHtml->getElementsByTagName('tooltip');
				$length     = $arTooltips->length;

				if ($length > 0) {
					for ($i = $length - 1; $i > -1; $i--) {
						$tooltip     = $arTooltips->item($i);
						$spanTooltip = $oHtml->createElement('span', $tooltip->getAttribute('content'));
						$spanTooltip->setAttribute('class', 'text-tooltip');
						$spanTooltip->setAttribute('title', $tooltip->nodeValue);
						$tooltip->parentNode->replaceChild($spanTooltip, $tooltip);
					}
				}
			}

			if (strpos($content, 'textcat') !== false) {
				$arTextcats = $oHtml->getElementsByTagName('textcat');
				$length     = $arTextcats->length;

				if ($length > 0) {
					for ($i = $length - 1; $i > -1; $i--) {
						$textcat        = $arTextcats->item($i);
						$textcatContent = $textcat->getAttribute('content');
						$spanTextcat    = $oHtml->createElement('span', $textcatContent);
						$spanTextcat->setAttribute('class', 'text-cat');
						$spanTextcat->setAttribute('title', $textcat->nodeValue);
						$textcat->parentNode->replaceChild($spanTextcat, $textcat);
					}
				}
			}

			if (strpos($content, 'textpopup') !== false) {
				$arTextpopups = $oHtml->getElementsByTagName('textpopup');
				$length       = $arTextpopups->length;

				if ($length > 0) {
					for ($i = $length - 1; $i > -1; $i--) {
						$popupId = 'geditor_popup_' . ++static::$iPopup;
						$textpopup        = $arTextpopups->item($i);
						$textpopupContent = $textpopup->getAttribute('content');
						$linkElement    = $oHtml->createElement('a', $textpopup->nodeValue);
						$linkElement->setAttribute('href', '#' . $popupId);
						$linkElement->setAttribute('class', 'js-fancy-text dashed');
						$textpopup->parentNode->replaceChild($linkElement, $textpopup);
						$popupElement = '<div class="modal" id="'.$popupId.'">'.$textpopupContent.'</div>';
						$APPLICATION->AddViewContent('popups',$popupElement);
					}
				}
			}

			if(strpos($content, 'table') !== false) {
				$arTables = $oHtml->getElementsByTagName('table');
				$length = $arTables->length;

				if($length > 0) {
					foreach ($arTables as $arTable) {
						/**
						 * @var $arTable DOMElement
						 */
						$params['classname'] = str_replace('table', '', $arTable->getAttribute('class'));
						$newTable = $oHtml->importNode(Text::buildTable(Text::getTableContent($arTable), $params), true);
						$arTable->parentNode->replaceChild($newTable, $arTable);


					}
				}
			}

			$body    = $oHtml->getElementsByTagName('body');
			$res     = self::DOMinnerHTML($body->item(0));
			$content = $res;

		}

		return $content;
	}

	/**
	 * @param \DOMElement $element
	 *
	 * @return string
	 */
	static public function DOMinnerHTML(\DOMElement $element)
	{

		$innerHTML = "";
		$children  = $element->childNodes;

		foreach ($children as $child) {
			$innerHTML .= $element->ownerDocument->saveHTML($child);
		}

		return $innerHTML;
	}

	private static function getTableContent(DOMElement $arTable) : array {
		$rows = $arTable->getElementsByTagName('tbody')->item(0)->childNodes;
		$arRows = null;
		foreach ($rows as $row) {
			if($row instanceof DOMElement) {
				/**
				 * @var $row DOMElement
				 */


				$cols = $row->getElementsByTagName('td');
				$arCol = [];
				foreach ($cols as $col) {
					/**
					 * @var $col DOMElement
					 */
					$arCol[] = $col->textContent;
				}
				$arRows[] = $arCol;
			}
		}
		return $arRows;
	}

	private static function buildTable(array $arRows, array $params = []) : DOMElement {

		$oDom = new DOMDocument();
		$tableWrapper = $oDom->createElement('div');
		$tableWrapper->setAttribute('class', 'table-block _mobile-change ' . $params['classname']);
		if (!self::$notAddNoIndexTag) {
            $noIndex = $oDom->createElement('noindex');
        }
		$table = $oDom->createElement('table');
		$thead = $oDom->createElement('thead');
		$tbody = $oDom->createElement('tbody');
		$mobileWrapper = $oDom->createElement('div');
		$mobileWrapper->setAttribute('class', 'mobile-wrapper');

		$headers = array_shift($arRows);
		foreach ($headers as $th) {
			$thead->appendChild($oDom->createElement('th', $th));
		}
		$table->appendChild($thead);
		foreach ($arRows as $row) {
			$tr = $oDom->createElement('tr');
			$mobileUl = $oDom->createElement('ul');
			$mobileUl->setAttribute('class', 'content-list');

			$colIndex = 0;
			foreach ($row as $col) {
				if($colIndex == 0) {
					$td = $oDom->createElement('td');
					$td->appendChild($oDom->createElement('b', $col));
					$tr->appendChild($td);
					$mobileWrapper->appendChild($oDom->createElement('h4', $col));
				}
				else {
					$tr->appendChild($oDom->createElement('td', $col));
					$li = $oDom->createElement('li');
					$li->appendChild($oDom->createElement('b', $headers[$colIndex] . ': '));
					$li->appendChild($oDom->createTextNode($col));
					$mobileUl->appendChild($li);
				}
				$colIndex += 1;
				$tbody->appendChild($tr);
				$mobileWrapper->appendChild($mobileUl);
			}
			$table->appendChild($tbody);
		}
        if (!self::$notAddNoIndexTag) {
            $noIndex->appendChild($table);
            $tableWrapper->appendChild($noIndex);
        } else {
            $tableWrapper->appendChild($table);
        }
		$tableWrapper->appendChild($mobileWrapper);

		return $tableWrapper;
	}

}
