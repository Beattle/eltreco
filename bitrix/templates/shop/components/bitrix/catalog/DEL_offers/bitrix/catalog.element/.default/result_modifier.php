<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

if($arResult["PROPERTIES"]["CODE_PROMO"]["VALUE"]){
	
	$code = $arResult["PROPERTIES"]["CODE_PROMO"]["VALUE"];
	
	
	switch($arResult["IBLOCK_ID"])
	{
		case 18:
			$site = "velohybrid.ru";
			$arResult["SITE_URL"] = Array(
				"MEDIA" => "http://$site/media/$code/",
				"ARTICLES" => "http://$site/item/$code/#tab_articles",
				"INFO" => "http://$site/help/terms/?type=info",
			);
			break;
		case 19;
			$site = "www.ecomobilik.ru";
			break;
		case 20;
			$site = "www.ecogolf.ru";
			break;
		case 21;
			$site = "www.eltrecoair.ru";
			break;
	}
	
	if($site)
	{
		if(!$arResult["SITE_URL"]["MEDIA"])$arResult["SITE_URL"]["MEDIA"] = "http://$site/item/$code/";
		$arResult["PROMO_URL"] = "http://$site/item/$code/#tab_features";
		$arResult["SITE_URL"]["MORE"] = "http://$site/item/$code/#tab_description";
		$arResult["SITE_URL"]["DETAIL"] = "http://$site/item/$code/";
	}
}
elseif($arResult["PROPERTIES"]["CODE_CATALOG"]["VALUE"])
{
	$code = $arResult["PROPERTIES"]["CODE_CATALOG"]["VALUE"];
	$arResult["SITE_URL"]["MEDIA"] = "/item/$code/";
	$arResult["SITE_URL"]["MORE"] = "/item/$code/";
	$arResult["SITE_URL"]["DETAIL"] = "/item/$code/";
}

if($arResult["PROPERTIES"]["CODE_GREEN"]["VALUE"]){
	$arResult["SITE_URL"]["DISCUSSION"] = "http://greenconnect.ru/articles/official/public/?sort=models&tag=".$arResult["PROPERTIES"]["CODE_GREEN"]["VALUE"];
}

//Дополнительные фотографии
if($arResult["PROPERTIES"]["ACCESSORY"]["VALUE"])
{
	$arResult["PROPERTIES"]["ACCESSORY"]["VALUE"][] = $arResult["DETAIL_PICTURE"]["ID"];
}
foreach($arResult["PROPERTIES"]["ACCESSORY"]["VALUE"] as $key => $value)
{
	$picture = CFile::GetFileArray($value);
	if($picture)
	{
		$arFields = array('DETAIL_PICTURE' => $picture);
		
		$w = $picture['WIDTH'];
		$h = $picture['HEIGHT'];
		$k = $w / $h;
		if($w > $h)
		{
			$w = 95;
			$h = IntVal($w/$k);
		}
		if($h > 89)
		{
			$h = 89;
			$w = IntVal($h/$k);
		}
	
		$arFileTmp = CFile::ResizeImageGet(
			$picture,
			array("width" => $w, 'height' => $h),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			false
		);
		$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
	
		$arFields['PREVIEW_PICTURE'] = array(
			'SRC' => $arFileTmp["src"],
			'WIDTH' => IntVal($arSize[0]),
			'HEIGHT' => IntVal($arSize[1]),
		);
		
		$arResult["PROPERTIES"]["ACCESSORY"]["VALUE"][$key] = $arFields;
	}
}

foreach($arResult["PROPERTIES"] as $key => $arPropery)
{
	$arKeys = explode('_', $key);
	if($arKeys[0] == 'ACCESSORY' && count($arKeys) == 3)
	{
		$arValue = $arPropery['VALUE'];
		
		if(!$arValue) continue;

		if($arKeys[2] == 'ELEMENT')
		{
			$arElements[$arKeys[1]] = $arPropery['VALUE'];
		}
		else if($arKeys[2] == 'PHOTO' && $arPropery['VALUE'])
		{
			$arValue = CFile::GetFileArray($arValue);
		}

		$arResult[$arKeys[0]][$arKeys[1]][$arKeys[2]] = $arValue;
	}
	
	if($arKeys[0] == 'COLOUR' && count($arKeys) == 3)
	{
		$arValue = $arPropery['VALUE'];
		
		if(!$arValue || $arResult["PROPERTIES"]["COLOUR_$arKeys[1]_ACTIVE"]["VALUE"] != "Y") continue;

		if($arKeys[2] == 'ELEMENT')
		{
			$arColours[$arKeys[1]] = $arPropery['VALUE'];
		}
		else if($arKeys[2] == 'PHOTO' && $arPropery['VALUE'])
		{
			$arValue = CFile::GetFileArray($arValue);
		}

		$arResult[$arKeys[0]][$arKeys[1]][$arKeys[2]] = $arValue;
	}
}

if($arElements){
	$res = CIBlockElement::GetList (
	   Array(),
	   Array("ID" => $arElements),
	   false,
	   false,
	   Array('ID', 'NAME', 'PREVIEW_PICTURE', 'CATALOG_GROUP_1')
	);
	while($arFields = $res->GetNext())
	{
		$index = array_search($arFields['ID'], $arElements);
		if($arResult['ACCESSORY'][$index]['PHOTO'])
		{
			$arFields['DETAIL_PICTURE'] = $arResult['ACCESSORY'][$index]['PHOTO'];
			$arFields['PREVIEW_PICTURE'] = $arFields['DETAIL_PICTURE'];
		}
		else
		{
			if($arFields['PREVIEW_PICTURE'])
			{
				$arFields['PREVIEW_PICTURE'] = CFile::GetFileArray($arFields['PREVIEW_PICTURE']);
			}
		}

		$arFields['PRICE'] = FormatCurrency($arFields['CATALOG_PRICE_1'], $arFields['CATALOG_CURRENCY_1']);
		
		if($arFields['PREVIEW_PICTURE'])
		{
			$w = $arFields['PREVIEW_PICTURE']['WIDTH'];
			$h = $arFields['PREVIEW_PICTURE']['HEIGHT'];
			$k = $w / $h;
			if($w > $h)
			{
				$w = 95;
				$h = IntVal($w/$k);
			}
			if($h > 89)
			{
				$h = 89;
				$w = IntVal($h/$k);
			}
		
			$arFileTmp = CFile::ResizeImageGet(
				$arFields['PREVIEW_PICTURE'],
				array("width" => $w, 'height' => $h),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				false
			);
			$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);
		
			$arFields['PREVIEW_PICTURE'] = array(
				'SRC' => $arFileTmp["src"],
				'WIDTH' => IntVal($arSize[0]),
				'HEIGHT' => IntVal($arSize[1]),
			);
		}
		
		unset($arResult['ACCESSORY'][$index]['PHOTO']);
		$arResult['ACCESSORY'][$index] = $arFields;
	}
}

if($arColours){
	$res = CIBlockElement::GetList (
	   Array(),
	   Array("ID" => $arColours),
	   false,
	   false,
	   Array('ID', 'NAME', 'PREVIEW_PICTURE')
	);
	while($arFields = $res->GetNext())
	{
		$index = array_search($arFields['ID'], $arColours);
		if($arResult['COLOUR'][$index]['PHOTO'])
		{
			$arFields['DETAIL_PICTURE'] = $arResult['COLOUR'][$index]['PHOTO'];
		}
		if($arFields['PREVIEW_PICTURE'])
		{
			$arFields['PREVIEW_PICTURE'] = CFile::GetFileArray($arFields['PREVIEW_PICTURE']);
		}
		
		unset($arResult['COLOUR'][$index]['PHOTO']);
		$arResult['COLOUR'][$index] = $arFields;
	}
}

if(!in_array($arResult['IBLOCK_ID'], array(24,26,27))){
	$arFilter = array("<=CATALOG_PRICE_1"=>$arResult["PRICES"]["BASE"]["VALUE"], '!ID' => $arResult['ID'], 'IBLOCK_ID' => $arResult['IBLOCK_ID'], 'ACTIVE' => 'Y');
	$res = CIBlockElement::GetList(
		array('CATALOG_PRICE_1' => 'desc'),
		$arFilter,
		false,
		array('nPageSize' => 3),
		array('ID')
	);
	while ($arElem = $res->GetNext()) {
		if ($arElem['ID'] == $arResult['ID']) continue;
		$left[] = $arElem['ID'];
	}

	$arFilter = array(">CATALOG_PRICE_1"=>$arResult["PRICES"]["BASE"]["VALUE"], '!ID' => $arResult['ID'], 'IBLOCK_ID' => $arResult['IBLOCK_ID'], 'ACTIVE' => 'Y');
	$res = CIBlockElement::GetList(
		array('CATALOG_PRICE_1' => 'asc'),
		$arFilter,
		false,
		array('nPageSize' => 3),
		array('ID')
	);
	while ($arElem = $res->GetNext()) {
		$right[] = $arElem['ID'];
	}
	for($i=0;$i<3;$i++){
		if(count($left) > $i)
			$arResult['NEAR_ELEMENTS'][] = $left[$i];
		if(count($arResult['NEAR_ELEMENTS']) > 2)
			break;
		if(count($right) > $i)
			$arResult['NEAR_ELEMENTS'][] = $right[$i];
		if(count($arResult['NEAR_ELEMENTS']) > 2)
			break;
	}
}
?>