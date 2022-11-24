<? /** @var $block array */ ?>
<? $elementCount = count($block['elements']); ?>
<section class="section-rd section-rd--has-padding-bottom interface-widget">
	<div class="container-rd section-rd__last-block">
		<div class="interface-widget__slider">
			<div class="interface-widget__slider-first js-interface-widget-slider-first">
				<?foreach ($block['elements'] as $element):?>
					<div class="interface-widget__slider-text">
						<h3 class="section-rd__h3 interface-widget__title"><?=$element['title'];?></h3>
						<p class="interface-widget__desc">
							<?=$element['text'];?>
						</p>
					</div>
				<?endforeach;?>
			</div>
			<div class="interface-widget__slider-second js-interface-widget-slider-second">
				<? $is_retina = (isset($_COOKIE["device_pixel_ratio"]) && ($_COOKIE["device_pixel_ratio"] >= 2)); ?>
				<?foreach ($block['elements'] as $element):?>
					<div class="interface-widget__slider-image">
						<?
						if ($is_retina && !empty($element['img_retina'])) {
							$filename = $_SERVER['DOCUMENT_ROOT'] . $element['img_retina'];
						}  else{
							$filename = $_SERVER['DOCUMENT_ROOT'] . $element['img'];
						}
						$info = getimagesize($filename);
						switch ($info['mime']) {
							case 'image/png':
								$source = imagecreatefrompng($filename);
								$ext = '.png';
								break;
							case 'image/jpeg':
								$source = imagecreatefromjpeg($filename);
								$ext = '.jpg';
								break;
							case 'image/gif':
								$source = imagecreatefromgif($filename);
								$ext = '.gif';
						}
						list($width, $height) = $info;
						$destination = imagecreatetruecolor(952, 574);
						$img = imagecopyresampled($destination, $source, 0, 0, 0, 0, 952, 574, $width, $height);
						//						$resize_image = '/tmp/'.randString(7).$ext; // для сохранения файла
						//						$path = $_SERVER["DOCUMENT_ROOT"] .$resize_image; //для сохранения файла
						ob_start();
						imagejpeg($destination, null, 100);
						imagejpeg($img);
						$resize_image = ob_get_contents();
						ob_end_clean();
						imagedestroy($img);
						?>
						<a href="<?=$element['img']?>" class="js-fancy-media">
							<?="<img src='data:image/jpeg;base64," . base64_encode( $resize_image )."'>";?>
							<!--							width="952" height="574"-->
						</a>
					</div>
				<?endforeach;?>
			</div>
		</div>
	</div>
</section>
