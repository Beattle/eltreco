<?
if(!$arResult["DESCRIPTION"] || !$arResult["DETAIL_PICTURE"])
{
	$res = CIBlockSection::GetByID($arResult["IBLOCK_SECTION_ID"]);
	if($ar_res = $res->GetNext())
	{
		if(!$arResult["DESCRIPTION"] && $ar_res["DESCRIPTION"]) 
		{
			$arResult["DESCRIPTION"] = $ar_res["DESCRIPTION"];
		}
		if(!$arResult["DETAIL_PICTURE"] && $ar_res["DETAIL_PICTURE"]) 
		{
			$arResult["DETAIL_PICTURE"] = CFile::GetFileArray($ar_res["DETAIL_PICTURE"]);
		}
	}
}
foreach($arResult["ITEMS"] as $cell=>$arElement)
{
	if (!$arElement["PREVIEW_PICTURE"])
	{
		$arResult["ITEMS"][$cell]["PREVIEW_PICTURE"] = array("SRC" => "/images/process.jpg", "WIDTH" => 190, "HEIGHT" => 190);
	}
}
?>