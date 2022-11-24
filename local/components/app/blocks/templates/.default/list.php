<? /** @var $block array */ ?>

<? if ($block['noindex']) {
    LazyLoad::includeFile(SITE_DIR .  '/local/components/app/blocks/templates/.default/list_external.php', array('block' => $block));
} else {
    include 'list_external.php';
} ?>
