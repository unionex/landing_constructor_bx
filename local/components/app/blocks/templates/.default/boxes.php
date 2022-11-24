<? /** @var $block array */ ?>
<? if ($block['noindex']) {
    LazyLoad::includeFile(SITE_DIR .  '/local/components/app/blocks/templates/.default/boxes_external.php', array('block' => $block));
} else {
    include 'boxes_external.php';
} ?>
