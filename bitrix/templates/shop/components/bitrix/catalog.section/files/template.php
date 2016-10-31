<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="files">
<table>
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>

		<?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCT_ELEMENT_DELETE_CONFIRM')));
		$arElement["DETAIL_PAGE_URL"] = "/services/download.php?id=" . $arElement["ID"];
		?>

		<?if($cell%$arParams["LINE_ELEMENT_COUNT"] == 0):?>
		<tr>
		<?endif;?>

		<td valign="top" width="<?=round(100/$arParams["LINE_ELEMENT_COUNT"])?>%" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
			<table>
				<tr>
					<?if(is_array($arElement["PREVIEW_PICTURE"])):?>
						<td valign="top">
						<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" target="_blank"><img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a>
						</td>
					<?elseif(is_array($arElement["DETAIL_PICTURE"])):?>
						<td valign="top">
						<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" target="_blank"><img border="0" src="<?=$arElement["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arElement["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arElement["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a>
						</td>
					<?endif?>
					<td valign="top">
						<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" target="_blank"><?=$arElement["NAME"]?></a>
						<?if($arElement["PREVIEW_TEXT"]):?>
						<div>
							<?=$arElement["PREVIEW_TEXT"]?>
						</div>
						<?endif?>
					</td>
				</tr>
			</table>
		</td>

		<?$cell++;
		if($cell%$arParams["LINE_ELEMENT_COUNT"] == 0):?>
			</tr>
		<?endif?>

		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>

		<?if($cell%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
			<?while(($cell++)%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
				<td>&nbsp;</td>
			<?endwhile;?>
			</tr>
		<?endif?>

</table>
</div>
