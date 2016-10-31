<?
/*
if(!$_POST["SKIP_STEP_0"] && $arResult["CurrentStep"] == 1){
	$dbBasketItems = CSaleBasket::GetList(
		 array(),
		 array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"),
		 false,
		 false,
		 array("PRODUCT_ID")
	);
	$offersIds = array();
	while ($arItems = $dbBasketItems->Fetch())
	{
		$offersIds[] = $arItems["PRODUCT_ID"];
	}
	$arSelect = Array("NAME");
	$arFilter = Array("ID"=>$offersIds, "ACTIVE"=>"Y", "IBLOCK_ID" => "26", "!PROPERTY_SELECT_PACK" => false);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>999), $arSelect);
	while($arFields = $res->GetNext())
	{
		$arPack[] = $arFields["NAME"];
	}
	if(count($arPack))
	{
		$arResult["PACK"] = implode(", ", $arPack);
		$arResult["CurrentStep"] = 0;
	}
	else
	{
		$arResult["CurrentStep"] = 1;
	}
}
*/
	$arResult['SKIP_FIRST_STEP'] = 'Y';
	$arResult['SKIP_THIRD_STEP'] = 'Y'; // TODO: где-то третий шаг пропускается, а вот где - не найдено... наверное, потому что на момент написания был только самовывоз
?>