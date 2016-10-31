<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="reviews">
	<?foreach($arResult["ITEMS"] as $arElement):?>
		<div class="item" id="r<?=$arElement["ID"]?>">
			<h2 class="item-name"><?=$arElement["NAME"]?></h2>
			<? $time = CIBlockFormatProperties::DateFormat("d M Y", MakeTimeStamp($arElement["ACTIVE_FROM"], CSite::GetDateFormat()));?>
			<small class="item-date-time"><?echo $time?></small>
			<div><?=$arElement["PREVIEW_TEXT"]?></div>
		</div>
	<?endforeach?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
</div>
