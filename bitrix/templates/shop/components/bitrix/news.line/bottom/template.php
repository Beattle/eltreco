<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="bottom-news-line">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="news-item">
			<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
			<div class="news-name"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></div>
		</div>
	<?endforeach;?>
</div>
