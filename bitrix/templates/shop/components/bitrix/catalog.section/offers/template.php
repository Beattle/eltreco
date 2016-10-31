<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog-section">
<?if($arParams["SET_TITLE"] == "Y"):?>
	<table class="section-details">
		<tr>
			<td><?=$arResult["DESCRIPTION"]?></td>
			<td class="section-picture"><?if(is_array($arResult["DETAIL_PICTURE"])):?><img border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" /><?endif;?></td>
		</tr>
	</table>
<!--noindex-->
	<?
		$SECTION_ID = $arResult["IBLOCK_SECTION_ID"] ? $arResult["IBLOCK_SECTION_ID"] : $arResult["ID"];
		$SECTION_URL = $arResult["IBLOCK_SECTION_ID"] ? "../#SECTION_CODE#/" : "#SECTION_CODE#/";
	?>
	<?$APPLICATION->IncludeComponent("site:catalog.section.list", "line", Array(
				"IBLOCK_TYPE" => "catalog",	// Тип инфо-блока
				"IBLOCK_ID" => "4",	// Инфо-блок
				"SECTION_ID" => $SECTION_ID,	// ID раздела
				"SECTION_CODE" => "",	// Код раздела
				"SECTION_URL" => $SECTION_URL,	// URL, ведущий на страницу с содержимым раздела
				"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
				"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
				"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
				"CACHE_TYPE" => "N",	// Тип кеширования
				"CACHE_TIME" => "3600",	// Время кеширования (сек.)
				"CACHE_GROUPS" => "N",	// Учитывать права доступа
				"CURRENT_SECTION_ID" => $arResult["ID"],
				),
				$component
	);?>
	<h2>Продукция <?if($arResult["IBLOCK_SECTION_ID"]):?><?=$arResult["NAME"]?><?endif?></h2>
<?endif?>
<ul>
		<? $i = 0 ?>
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>

		<?if($i++==3):$i=1?><li class="clear" /><?endif?>
		<li>
			<table class="offer-item" id="item_<?=$arElement["CODE"]?>">
				<tr>
					<td class="offer-picture"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a></td>
				</tr>
				<tr>
					<td class="offer-name"><a class="link" href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></td>
				</tr>
				<tr>
					<td class="offer-description"><?=$arElement["PREVIEW_TEXT"]?></td>
				</tr>
			</table>
		</li>

		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>

</ul>
<div class="clear"></div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
<!--/noindex-->