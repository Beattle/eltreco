<?
if ($arResult["IBLOCK_ID"] == 9) 
{
	$arItems = $_REQUEST["CATALOG"];
}
else
{
	$arItems = $arResult["ITEMS"];
}

foreach($arResult["ITEMS"] as $arElement)
{
	if (!$arElement["PROPERTIES"]["YML_PRESENCE"]["VALUE"])
	{
		$arElement["AVAILABLE"]["VALUE"] = "N";
		$arElement["AVAILABLE"]["TEXT"] = "Нет в наличии";
	}
	else
	{
		$arElement["AVAILABLE"]["VALUE"] = "Y";
		$arElement["AVAILABLE"]["TEXT"] = "Есть в наличии";
	}
	
	if ($arResult["IBLOCK_ID"] == 9)
	{
		$id = $arElement["~IBLOCK_SECTION_ID"];
		$arItem = $arItems[$id];
		if (!$arItem || $arElement["PRICES"]["BASE"]["DISCOUNT_VALUE"] == 1) continue;
		$arItem["COMPLETE"][] = $arElement;
		$arItems[$id] = $arItem;
	}
	else
	{
		unset($arElement["CODE"]);
		unset($arElement["DETAIL_PAGE_URL"]);
		$arItems[$arElement["ID"]]["COMPLETE"][] = $arElement;
	}
}
$arResult["ITEMS"] = $arItems;
?>