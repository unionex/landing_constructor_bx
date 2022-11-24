<? /** @var $block array */ ?>

<? if ($block['noindex']) {
    LazyLoad::includeFile(SITE_DIR .  '/local/components/app/blocks/templates/.default/stages_external.php', array('block' => $block));
} else {
    include 'stages_external.php';
} ?>
