<?
$arSections = array();
foreach($arResult["SECTIONS"] as $key => $arSection){
	if(!$arSection["ELEMENT_CNT"]) continue;
	$arSections[$key] = $arSection;
}
$arResult["SECTIONS"] = $arSections;

$res = CIBlock::GetProperties($arParams["IBLOCK_ID"], Array("SORT" => "ASC"), Array("CODE" => "SELECT_%"));
while($res_arr = $res->Fetch()){
	$db_enum_list = CIBlockProperty::GetPropertyEnum($res_arr["ID"]);
	$key = strtolower(substr($res_arr["CODE"], 7));
	$isItem = substr($key, 0, 5) == "item_";
	if($isItem)
	{
		$arSubitems = array();
		while($ar_enum_list = $db_enum_list->GetNext()){
			$arSubitems[$ar_enum_list["ID"]] = $ar_enum_list["VALUE"];
		}
		$arSubitems["all"] = "Показать все";
		$arSelect[$key] = array("NAME" => trim($res_arr["NAME"], "#"), "ITEMS" => $arSubitems);
	}
	else
	{
		$arSelect = array();
		while($ar_enum_list = $db_enum_list->GetNext()){
			$arSelect[$ar_enum_list["ID"]] = $ar_enum_list["VALUE"];
		}
		$name = $key;
		$arResult["SELECT"][$name]["NAME"] = trim($res_arr["NAME"], "#");
	}
	$arResult["SELECT"][$name]["ITEMS"] = $arSelect;
}
?>