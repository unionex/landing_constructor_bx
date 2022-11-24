<?php
namespace App\Editor\Blocks;
use App\Editor\Tools\Image as ImageTools;

class Image
{

    static public function getImage($block, $resizeParams = array()){
        if (empty($block['file'])){
            return array();
        }
        $resizeParams = array_merge(array(
            'width' => 1024,
            'height' => 768,
            'exact' => 0,
        ), $resizeParams);

        $aItem = ImageTools::resizeImage2($block['file']['ID'],$resizeParams);

        $aItem['DESCRIPTION'] = htmlspecialchars($block['desc']);
        return $aItem;
    }

}
