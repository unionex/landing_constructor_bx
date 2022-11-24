<? /** @var $block array */ ?>
<?
$countTable = count($block["tables"]);
$i = 0;
?>
<section class="section-rd <?if($block['hpb']) :?><?=$block['hpb'];?><?endif;?>"  data-attr="section-end-block">
    <div class="container-rd">
        <h2 class="section-rd__h2"><?=$block['title']?></h2>
        <? foreach ($block["tables"] as $table) : ?>
            <? $i++; ?>
            <div class="more-info" data-partially-hidden="true">
                <table class="table-rd table-rd--transformed-on-mobile  table-rd--four-columns more-info__container-partially-hidden">
                    <tbody>
                        <? $j = 0;
                        $cnt = 5;
                        $cntAll = false;
                        foreach ($table as $row){
                            if (array_key_exists('cnt', $row) && array_key_exists('cntAll', $row)){
                                $cnt = !empty($row['cnt']) ? $row['cnt'] : $cnt;
                                $cntAll = $row['cntAll'] == 'Y' ? true : false;
                            }
                        }
                            ?>
                        <? foreach ($table as $row) :
                            if (array_key_exists('cnt', $row) && array_key_exists('cntAll', $row)){
                               continue;
                            } elseif($row["th"]){?>
                                <tr class="gray" <?if($j >= $cnt && !$cntAll):?> class="hide"<?endif;?>>
                                    <td colspan="4" class="no-center"><?=$row["th"];?></td>
                                </tr>
                                <?$j++;?>
                            <?} else {?>
                                <tr <?if($j >= $cnt && !$cntAll):?> class="hide"<?endif;?>>
                                    <td><?=$row["td0"];?></td>
                                    <td>
										<div class="table-rd__td-images">
											<?foreach ($row["td1"] as $img) :?>
												<img src="<?=$img[0]['src']?>" title="<?=$img[0]['alt']?>"
													 alt="<?=$img[0]['alt']?>">
											<?endforeach;?>
										</div>
                                    </td>
                                    <td><?=$row["td2"];?></td>
                                    <td>
										<? if ($row["td3"]["type"] == 'basket_button'): ?>
											<a href="javascript:void(0);"  class="default-link js-add-to-basket" data-product="<?= $row["td3"]["link"] ?>" <?= !empty($row['td3']['nofollow'])? 'rel="nofollow"' : '' ?>><? if ($row["td3"]["name"] != ''): ?><?= $row["td3"]["name"] ?><? else: ?>Купить<? endif; ?></a>
										<? else: ?>
											<a href="<?if($row["td3"]["type"] == 'form' && $row["td3"]["link"] == '') :?>#callback-new<?else:?><?=$row["td3"]["link"];?><?endif;?>" class="default-link <?if($row["td3"]["type"] != '') :?>pupop<?endif;?>" <?if($row["td3"]["type"] != '') :?>onclick="<?=FormHelper::getFormOnclickFunctionForConstructor($row["td3"]["link"], $row["td3"]["head"], $row["td3"]["head"].' '.$row["td0"].' '.$row["td2"]);?>"<?endif;?> <?= !empty($row['td3']['nofollow'])? 'rel="nofollow"' : '' ?>><? if ($row["td3"]["name"] == 'undefined' || empty($row["td3"]["name"])): ?>Купить<? else: ?><?= $row["td3"]["name"] ?><? endif; ?></a>
										<? endif; ?>
									</td>
                                </tr>
                                <?$j++;?>
                            <?}?>
                        <?endforeach;?>
                    </tbody>
                </table>
                <?if($j > $cnt && !$cntAll):?><a href="#" class="dotted-link more-info__link">Подробнее</a><?endif;?>
            </div>
            <? if ($countTable > $i): ?><br><? endif; ?>
        <? endforeach; ?>
    </div>
</section>
