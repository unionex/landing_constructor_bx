<? /** @var $block array */ ?>
<?$columns = count(array_filter($block['header']))?>
<section class="section-rd <?if($block['hpb']) :?><?=$block['hpb'];?><?endif;?> section-rd--gray"  data-attr="section-end-block">
    <div class="container-rd">
        <h2 class="section-rd__h2 section-rd__h2--center"><?=$block['title']?></h2>
        <table class="table-rd
        <? if ($columns == 3) : ?>
        table-rd--four-columns
        <? elseif ($columns == 2) : ?>
        table-rd--three-columns
        <? endif; ?>
        table-rd--toggle-color table-rd--no-border-md table-rd--transformed-on-mobile">
            <thead>
            <tr class="gray">
                <th class="no-center hide-up-to-md lg"><?=$block['firstFooterTitle']?></th>
				<? $i=1; ?>
                <? foreach ($block['header'] as $th) : ?>
					<?if((in_array($i, [2,3]) && $block['settingColumn']['td'.$i] == true) || $i==1) :?>
                    	<th class="lg"><?= $th ?></th>
					<?endif;?>
					<? $i++; ?>
                <? endforeach; ?>
            </tr>
            </thead>
            <tbody>

            <?foreach ($block['body'] as $items) :?>
				<? $i=0; ?>
                <tr>
                    <?foreach ($items as $item) :?>
						<?if((in_array($i, [2,3]) && $block['settingColumn']['td'.$i] == true) || in_array($i, [0,1])) :?>
							<?if($item == '✓') :?>
								<td class="yes-icon"></td>
							<?elseif ($item == '—') :?>
								<td> — </td>
							<?else :?>
								<td><?=$item?></td>
							<?endif;?>
						<?endif;?>
						<? $i++; ?>
                    <?endforeach;?>
                </tr>
            <?endforeach;?>

            <tr class="gray table-rd__price">
                <td class="hide-up-to-md"></td>
				<? $i=1; ?>
                <?foreach ($block['footer'] as $item) :?>
					<?if((in_array($i, [2,3]) && $block['settingColumn']['td'.$i] == true) || $i==1) :?>
                    	<td><?=$item['price']?></td>
					<?endif;?>
					<? $i++; ?>
                <?endforeach;?>
            </tr>

            <tr class="gray table-rd__buttons">
                <td class="hide-up-to-md"></td>
				<?$i = 1;?>
                <?foreach ($block['footer'] as $item) :?>
					<?if((in_array($i, [2,3]) && $block['settingColumn']['td'.$i] == true) || $i==1) :?>
						<td class="has-btn">
							<?if($item['name']) :?>
								<? if ($item['form']['type'] == 'basket_button'): ?>
									<button class="button js-add-to-basket" data-product="<?= $item['link'] ?>"><?= $item['name'] ?></button>
								<?// elseif ($item['form']['type'] == 'basket_link'): ?>
<!--									<a class="default-link js-add-to-basket" data-product="--><?//= $item['link'] ?><!--" href="javascript:void(0);">--><?//= $item['name'] ?><!--</a>-->
								<? else: ?>
									<a href="<?if($item['form']['type'] == 'form' && $item['link'] == '') :?>#callback-new<?else :?><?=$item['link']?><?endif;?>" class="button <?if($item['form']['type'] != '') :?>pupop<?endif;?>" <?if($item['form']['type'] != '') :?>onclick="<?=FormHelper::getFormOnclickFunctionForConstructor($item['link'], $item['form']['title'], $item['form']['title'].' '.$block['header']['th'.$i].' '.$item['price']);?>"<?endif;?> <?= !empty($item['nofollow'])? 'rel="nofollow"' : '' ?>><?=$item['name']?></a>
								<? endif; ?>
							<?endif;?>
						</td>
					<?endif;?>
					<?$i++;?>
                <?endforeach;?>
            </tr>

            </tbody>
        </table>

    </div>
</section>
