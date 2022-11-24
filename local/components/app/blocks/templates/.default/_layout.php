<?
/**
 * @var $this    \AppEditorBlocksComponent
 * @var $columns array
 *
 */
?>
<?
    $isSection = false;
    $regex = '/(section--bright-gray|section--gray)/';
?>
<? if (preg_match($regex, $columns[0], $matches)): ?>
    <div class="section <?=$matches[1]?>">
    <?
        $isSection = true;
        $columns[0] = preg_replace($regex, '', $columns[0]);
    ?>
<? endif; ?>
    <? if (count($columns) == 1): ?>
        <? if (!empty($columns[0])) : ?>
            <div class="<?= $columns[0] ?>">
        <? endif; ?>
        <? $this->includeLayoutBlocks(0) ?>
        <? if (!empty($columns[0])) : ?>
            </div>
        <? endif; ?>
    <? else: ?>
        <div class="container">
            <div class="row-md">
                <? foreach ($columns as $columnIndex => $columnCss): ?>
                    <div class="<?= $columnCss ?>"><? $this->includeLayoutBlocks($columnIndex) ?></div>
                <? endforeach; ?>
            </div>
        </div>
    <? endif ?>
<? if ($isSection): ?>
    </div>
<? endif; ?>
