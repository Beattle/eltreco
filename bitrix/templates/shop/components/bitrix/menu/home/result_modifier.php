<?
$arItems = array();

foreach($arResult as $key => $arItem)
{
	if($arParams["MAX_LEVEL"] < $arItem["PARAMS"]["DEPTH_LEVEL"] || $arItem["PARAMS"]["HIDE"])
	{
		continue;
	}
	
	$path = $_SERVER["DOCUMENT_ROOT"].'/include/prodmenu/'.str_replace('/', '_', trim($arItem['LINK'], '/')).'.php';
	if(file_exists($path))
	{
		$arItem['SUBMENU'] = $path;
	}
	
	$arFilter = Array('IBLOCK_ID'=>9, 'ACTIVE'=>'Y', 'NAME'=>$arItem['TEXT']);
	$db_list = CIBlockSection::GetList(array(), $arFilter, false, array("UF_PROMO_URL"));
	if($ar_result = $db_list->GetNext())
	{
		$arItem['PROMO_URL'] = $ar_result['UF_PROMO_URL'];
	}
	
	if($arItem["PARAMS"]["SECTION_ID"])
	{
		$db_list = CIBlockSection::GetList(array(), Array('IBLOCK_ID'=>4, 'ACTIVE'=>'Y', 'SECTION_ID' => $arItem["PARAMS"]["SECTION_ID"], '!PREVIEW_PICTURE' => false), false, array("ID"));
		$arItem["PARAMS"]["SECTION_COUNT"] = $db_list->SelectedRowsCount();
	}
	
	$arItems[$key] = $arItem;
}
$arResult = $arItems;
?>