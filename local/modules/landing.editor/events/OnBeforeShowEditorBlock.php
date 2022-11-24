<?php

AddEventHandler('landing.editor', 'OnBeforeShowEditorBlock', function (&$block) {
if ($block['name'] == 'base_image') {
        if (!empty($block['file']['ID'])) {
            $block['file'] = App\Editor\Tools\Image::resizeImage2(
                $block['file']['ID'], ['width' => 200, 'height' => 200, 'exact' => 1]
            );
        }
    }
});
