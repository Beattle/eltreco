<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if ($arResult["ID"] == 28)
{
	$section = $arResult["SECTION"]["PATH"][1];
	$result = CIBlockSection::GetList 
	( 
		array('CODE' => 'ASC'), 
		array('IBLOCK_ID' => $section["IBLOCK_ID"], 'depth_level' => 2, '>CODE' => $section['CODE'], 'ACTIVE' => 'Y', 'CNT_ACTIVE' => 'Y'), 
		true
	); 
	while($item = $result->GetNext())  
	{    
		if ($item['ELEMENT_CNT'] > 0) 
		{
			$next = $item;
			break;
		}
	}

	$result = CIBlockSection::GetList 
	( 
		array('CODE' => 'DESC'), 
		array('IBLOCK_ID' => $section["IBLOCK_ID"], 'depth_level' => 2, '<CODE' => $section['CODE'], 'ACTIVE' => 'Y', 'CNT_ACTIVE' => 'Y'),
		true
	); 
	while($item = $result->GetNext())  
	{    
		if ($item['ELEMENT_CNT'] > 0)
		{
			$prev = $item;
			break;
		}
	}
}
?>
<div class="news-list">
<?if($arResult["ID"]==28):?>
<table class="news-date"><tr><td class="pager"><?if(is_array($prev)):?><a href="../<?=$prev['CODE']?>/"><img class="no-border" alt="" src="/images/prev.png" /></a><?endif?></td><td><h2><?=$section["NAME"] . " " . $arResult["SECTION"]["PATH"][0]["NAME"] . " года" ?></h2></td><td class="pager"><?if(is_array($next)):?><a href="../<?=$next['CODE']?>/"><img alt="" class="no-border" src="/images/next.png" /></a><?endif?></td></tr></table>
<?endif?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<p class="news-item">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="float:left" /></a>
			<?else:?>
				<img class="preview_picture" border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="float:left" />
			<?endif;?>
		<?endif?>
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<div class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<div class="news-name"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></div>
			<?else:?>
				<div class="news-name"><?echo $arItem["NAME"]?></div>
			<?endif;?>
		<?endif;?>
		<?if(isset($arItem["DISPLAY_PROPERTIES"]["POSITION"]["VALUE"])):?>
			<div class="item-position"><?=$arItem["DISPLAY_PROPERTIES"]["POSITION"]["VALUE"]?></div>
		<?endif?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
		<?foreach($arItem["FIELDS"] as $code=>$value):?>
			<small>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			</small><br />
		<?endforeach;?>
	</p>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
