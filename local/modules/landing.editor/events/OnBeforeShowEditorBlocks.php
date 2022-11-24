<?php

AddEventHandler('landing.editor', 'OnBeforeShowEditorBlocks', function (&$blocks) {
    /**
     * Обработчик восстанавливает превьюшки в админке для блоков "Галерея" и "Картинка",
     * если они удалились из /upload/iblock/resize_cache/
     */

    foreach ($blocks as &$block) {
        if ($block['name'] == 'image') {
            if (!empty($block['file']['ID'])) {
                $block['file'] = App\Editor\Tools\Image::resizeImage2($block['file']['ID'], array(
                    'width' => 200,
                    'height' => 200,
                    'exact' => 1
                ));
            }
        }
    }

	CModule::IncludeModule('CAdminFileDialog');
    // Модуль для вывода "Менеджера файлов"
	CAdminFileDialog::ShowScript(Array
		(
			"event" => "OpenImage",
			"arResultDest" => Array("FUNCTION_NAME" => "SetImageUrl"),
			"arPath" => Array('PATH' => '/upload'),
			"select" => 'F',
			"operation" => 'O',
			"showUploadTab" => true,
			"showAddToMenuTab" => false,
			"fileFilter" => 'jpg,jpeg,png,gif,bpm,svg',
			"allowAllFiles" => false,
			"saveConfig" => true
		)
	);

    // Модуль для вывода "Менеджера файлов в режиме выбора иконок"
    CAdminFileDialog::ShowScript(Array
        (
            "event" => "OpenIcon",
            "arResultDest" => Array("FUNCTION_NAME" => "SetIconUrl"),
            "arPath" => Array('PATH' => '/bitrix/images/main/icons'),
            "select" => 'F',
            "operation" => 'O',
            "showUploadTab" => true,
            "showAddToMenuTab" => false,
            "fileFilter" => 'jpg,jpeg,png,gif,bpm,svg',
            "allowAllFiles" => false,
            "saveConfig" => false
        )
    );
});
