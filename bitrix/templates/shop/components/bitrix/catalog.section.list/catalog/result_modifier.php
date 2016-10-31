<?
	$res = CIBlock::GetByID(13);
	if($ar_res = $res->GetNext())
	{
		if($ar_res["ACTIVE"] == 'Y')
		{
			$arSection["NAME"] = $ar_res["NAME"];
			$arSection["IBLOCK_ID"] = $ar_res["ID"];
			$arSection["ID"] = "";
			$arSection["CODE"] = $ar_res["CODE"];
			$arResult["SECTIONS"][] = $arSection;
		}
	}
?>