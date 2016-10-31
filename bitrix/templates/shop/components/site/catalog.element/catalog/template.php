<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$section = $arResult["SECTION"]["IBLOCK_SECTION_ID"] ? $arResult["SECTION"]["IBLOCK_SECTION_ID"] : $arResult["IBLOCK_SECTION_ID"];
$result = CIBlockElement::GetList 
( 
    array('sort' => 'asc', 'modified' => 'desc'),
    array('IBLOCK_ID' => $arResult["IBLOCK_ID"], 'SECTION_ID' => $section, 'ACTIVE' => 'Y', 'INCLUDE_SUBSECTIONS' => 'Y'), 
    null, 
    array('nElementID' => $arResult['ID'], 'nPageSize' => 1),
	array('ID', 'CODE', 'NAME')
);
$isNext = false;
while($arFields = $result->GetNext())
{  
	if ($arFields['ID'] == $arResult['ID'])
	{	
		$isNext = true;
	}
	else
	{
		if ($isNext)
		{
			$next = $arFields;
		}
		else
		{
			$prev = $arFields;
		}
	}
}
//$next = $result->Fetch();

/*
$result = CIBlockElement::GetList 
( 
    array('NAME' => 'DESC'), 
    array('IBLOCK_ID' => $arResult["IBLOCK_ID"], 'SECTION_ID' => $arResult["IBLOCK_SECTION_ID"], '<NAME'=> $arResult['NAME'], 'ACTIVE' => 'Y'),
    null, 
    array('nTopCount' => 1),
	array('CODE', 'NAME')
); 
$prev = $result->Fetch();
*/
?>

<div class="catalog-element">

	<table class="pager-table"><tr><td class="pager"><?if(is_array($prev)):?><a href="/item/<?=$prev['CODE']?>/"><img title="<?=$prev["NAME"]?>" class="no-border" alt="" src="/images/prev.png" /></a><?endif?></td><td><h1><?=$arResult["NAME"]?></h1></td><td class="pager"><?if(is_array($next)):?><a href="/item/<?=$next['CODE']?>/"><img alt="" title="<?=$next["NAME"]?>" class="no-border" src="/images/next.png" /></a><?endif?></td></tr></table>
	
	<table class="wide">
		<tr>
			<td class="left-column">
				<?if(count($arResult["MORE_PHOTO"])>0):?>
					<? $index = 1 ?>
					<?foreach($arResult["MORE_PHOTO"] as $PHOTO):?>
						<?if($index == 1):?>
							<div class="image">
								<img id="photo" class="first photo" src="<?=$PHOTO["SRC"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
							</div>
						<?endif?>
						<?if(count($arResult["MORE_PHOTO"]) > 1):?>
							<?if($index == 1):?>
								<table id="photos" class="first photos">
									<tr>
										<td class="border-left"></td>
							<?endif?>
										<td class="item"><table class="block<?=$index==1?' select':''?>"><tr><td class="arrow"></td></tr><tr><td class="box"><img id="photo_<?=$index?>" class="<?if($index==1):?>first <?endif?>photo" border="0" onclick="sf(this)" style="height:65px;width:auto" src="<?=$PHOTO["SRC"]?>" width="<?=$PHOTO["WIDTH"]?>" height="<?=$PHOTO["HEIGHT"]?>" alt="" /></td></tr></table></td>
							<?if($index++==count($arResult["MORE_PHOTO"])):?>
										<td class="border-right"></td>
									</tr>
								</table>
							<?endif?>
						<?endif?>
					<?endforeach?>
				<?endif?>
			</td>
			<td class="links">

			</td>
		</tr>
	</table>

	<table class="wide details">
		<tr>
			<td class="features">
				<?
					global $arrFeatures;
					$arrFeatures["ID"] = $arResult["PROPERTIES"]["FEATURES"]["VALUE"];
					if ($arrFeatures["ID"] != ""):
				?>
				<?$APPLICATION->IncludeComponent("bitrix:catalog.section", "list", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "5",
	"SECTION_ID" => "",
	"SECTION_CODE" => "",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"FILTER_NAME" => "arrFeatures",
	"INCLUDE_SUBSECTIONS" => "Y",
	"SHOW_ALL_WO_SECTION" => "Y",
	"PAGE_ELEMENT_COUNT" => "300",
	"LINE_ELEMENT_COUNT" => "3",
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"SECTION_URL" => "",
	"DETAIL_URL" => "",
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "300",
	"CACHE_GROUPS" => "Y",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"ADD_SECTIONS_CHAIN" => "N",
	"DISPLAY_COMPARE" => "N",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"CACHE_FILTER" => "Y",
	"PRICE_CODE" => array(
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_PROPERTIES" => array(
	),
	"USE_PRODUCT_QUANTITY" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
	<?endif?>
	
				<?if(count($arResult["DISPLAY_PROPERTIES"]["FILES"]["VALUE"]) > 0):?>
					<div class="documents">
					<?
					if (count($arResult["DISPLAY_PROPERTIES"]["FILES"]["VALUE"]) > 1) {
						$arDocuments = $arResult["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"];
					}
					else {
						$arDocuments[] = $arResult["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"];
					}
					?>
					<?foreach($arDocuments as $file):?>
						<div class="document"><img align="bottom" alt="" src="/images/<?=substr($file['SRC'], strrpos($file['SRC'], '.') + 1)?>.gif" /><br /><a href="<?=$file['SRC']?>" target="_blank"><?=$file['DESCRIPTION']?></a></div>
					<?endforeach?>
					</div>
				<?endif?>
				<div class="clear"></div>
			</td>
			<td>
				<?if($arResult["DETAIL_TEXT"] || $arResult["PREVIEW_TEXT"]):?>
					<h2>Описание товара</h2>
					<div class="offer-description">
						<?if($arResult["DETAIL_TEXT"]):?>
						<br /><?=$arResult["DETAIL_TEXT"]?><br />
						<?elseif($arResult["PREVIEW_TEXT"]):?>
							<br /><?=$arResult["PREVIEW_TEXT"]?><br />
						<?endif;?>
					</div>
				<?endif?>
			</td>
		</tr>
	</table>
</div>