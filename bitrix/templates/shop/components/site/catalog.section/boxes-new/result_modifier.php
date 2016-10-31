<?
foreach($arResult["ITEMS"] as $cell=>$arElement) {

	if($GLOBALS["BOXES"][$arElement["ID"]] == "tune") $arNewItems[0] = $arElement;
	elseif($GLOBALS["BOXES"][$arElement["ID"]] == "accessory") $arNewItems[1] = $arElement;
	elseif($GLOBALS["BOXES"][$arElement["ID"]] == "interest") $arNewItems[2] = $arElement;
	elseif($GLOBALS["BOXES"][$arElement["ID"]] == "sale") $arNewItems[3] = $arElement;
}
ksort($arNewItems);
if(!empty($arNewItems)) $arResult["ITEMS"] = $arNewItems;

?>
