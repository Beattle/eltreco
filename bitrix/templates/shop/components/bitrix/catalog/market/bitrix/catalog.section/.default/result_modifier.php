<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
/*
$nav = $arResult["NAV_RESULT"];
if($nav->NavPageNomer == 1){
	$res = CIBlock::GetByID($arResult["IBLOCK_ID"]);
	if($ar_res = $res->GetNext())
	  $arResult["PAGE_TEXT"] = $ar_res["DESCRIPTION"];
}
*/
?>
<?
foreach($arResult["ITEMS"] as $key => $arItem)
{
	if($arItem["PROPERTIES"]["STATUS"]["VALUE"])
	{
		$res = CIBlockElement::GetList(Array(), Array("ACTIVE" => "Y", "ID" => $arItem["PROPERTIES"]["STATUS"]["VALUE"], "IBLOCK_ID" => 35), false, false, Array('ID', 'PREVIEW_TEXT', 'PREVIEW_PICTURE'));
		if($ar_res = $res->GetNext())
		{
			$arItem["PROPERTIES"]["STATUS"]["VALUE"] = array(
				"PREVIEW_PICTURE" => CFile::GetFileArray($ar_res["PREVIEW_PICTURE"]),
				"PREVIEW_TEXT" => $ar_res["PREVIEW_TEXT"],
			);
		}
		else
		{
			unset($arItem["PROPERTIES"]["STATUS"]["VALUE"]);
		}
	}
	$arResult["ITEMS"][$key] = $arItem;
}
?>