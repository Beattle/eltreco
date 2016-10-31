<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
function market_catalog_resize_preview($picture, $height = 89, $width = 195)
{
	global $_SERVER;
	$w = $picture['WIDTH'];
	$h = $picture['HEIGHT'];
	$k = $w / $h;
	if($w > $h)
	{
		$w = $width;
		$h = IntVal($w/$k);
	}
	if($h > $height)
	{
		$h = $height;
		$w = IntVal($h * $k);
	}

	$arFileTmp = CFile::ResizeImageGet(
		$picture,
		array("width" => $w, 'height' => $h),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		false
	);
	$arSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$arFileTmp["src"]);

	return array(
		'SRC' => $arFileTmp["src"],
		'WIDTH' => IntVal($arSize[0]),
		'HEIGHT' => IntVal($arSize[1]),
	);
}

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
		$arResult["SITE_URL"]["PROMO"] = "http://$site/";
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

//Фотографии
if($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"])
{
	array_unshift($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"], $arResult["DETAIL_PICTURE"]["ID"]);
}
foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $value)
{
	$picture = CFile::GetFileArray($value);
	if($picture)
	{
		$arFields = array('DETAIL_PICTURE' => $picture);
		if($value == $arResult["DETAIL_PICTURE"]["ID"]){
			$arFields['CLASS'] = 'main-picture select';
		}
		else{
			$arFields['CLASS'] = 'add-picture';
		}
		$arFields['PREVIEW_PICTURE'] = market_catalog_resize_preview($picture, 85);
		$arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"][$key] = $arFields;
	}
}

//Дополнительные фотографии
if($arResult["PROPERTIES"]["ACCESSORY"]["VALUE"])
{
	array_unshift($arResult["PROPERTIES"]["ACCESSORY"]["VALUE"], $arResult["DETAIL_PICTURE"]["ID"]);
}
foreach($arResult["PROPERTIES"]["ACCESSORY"]["VALUE"] as $key => $value)
{
	$picture = CFile::GetFileArray($value);
	if($picture)
	{
		$arFields = array('DETAIL_PICTURE' => $picture);
		if($value == $arResult["DETAIL_PICTURE"]["ID"]){
			$arFields['CLASS'] = 'main-picture select';
		}
		else{
			$arFields['CLASS'] = 'add-picture';
		}
		$arFields['PREVIEW_PICTURE'] = market_catalog_resize_preview($picture, 85);
		$arResult["PROPERTIES"]["ACCESSORY"]["VALUE"][$key] = $arFields;
	}
}

foreach($arResult["PROPERTIES"] as $key => $arPropery)
{
	$arKeys = explode('_', $key);
	/*if($arKeys[0] == 'ACCESSORY' && count($arKeys) == 3)
	{
		$arValue = $arPropery['VALUE'];
		
		if(!$arValue) continue;

		if($arKeys[2] == 'ELEMENT')
		{
			$arElements[$arKeys[1]] = $arPropery['VALUE'];
			continue;
		}
		else if($arKeys[2] == 'PHOTO' && $arPropery['VALUE'])
		{
			$arValue = CFile::GetFileArray($arValue);
		}

		$arResult[$arKeys[0]][$arKeys[1]][$arKeys[2]] = $arValue;
	}*/
	
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
	
	if($arKeys[0] == 'SELECT')
	{
		if($key == 'SELECT_TYPE')
		{
			if(count($arPropery["VALUE"])){
				$name = $arPropery["VALUE"][0];
				$arResult['FILTER_GROUPS'][] = array('NAME' => $name, 'URL' => "{$arResult[LIST_PAGE_URL]}filter/type/{$arPropery[VALUE_ENUM_ID][0]}/");
			}
		}
		else
		{	
			if(!is_array($arPropery["VALUE"])){
				$arPropery["VALUE"] = array($arPropery["VALUE"]);
				$arPropery["VALUE_ENUM_ID"] = array($arPropery["VALUE_ENUM_ID"]);
			}
			
			if($arPropery["VALUE"][0])
			{			
				$code = mb_strtolower($key);
				$code = substr($code, 7);
				
				foreach($arPropery["VALUE"] as $index => $VALUE){
					$VALUE_ENUM_ID = $arPropery["VALUE_ENUM_ID"][$index];
					$name = trim($arPropery["~NAME"].' '.$VALUE, '#');
					$arResult['FILTER_GROUPS'][] = array('NAME' => $name, 'URL' => "{$arResult[LIST_PAGE_URL]}filter/$code/{$VALUE_ENUM_ID}/");
				}
			}
		}
	}
}

//if($arElements){
	$res = CIBlockElement::GetList (
	   Array("SORT" => "ASC"),
	   //Array("ACTIVE" => "Y", "ID" => $arElements), //Теперь товары будут привязываться к аксессуарам
	   Array("ACTIVE" => "Y", "IBLOCK_ID" == 24, "PROPERTY_RELATED.ID" => $arResult["ID"]),
	   false,
	   false,
	   Array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'CATALOG_GROUP_1', 'DETAIL_PAGE_URL', 'LIST_PAGE_URL', 'PROPERTY_SELECT_TYPE')
	);
	while($arFields = $res->GetNext())
	{
		//$index = array_search($arFields['ID'], $arElements);
		$index = $arFields['ID'];
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
			$arFields['PREVIEW_PICTURE'] = market_catalog_resize_preview($arFields['PREVIEW_PICTURE'], 177, 250);
		}
		
		if($arFields["IBLOCK_ID"] == 24) {
			if($arFields["PROPERTY_SELECT_TYPE_VALUE"]){
				$name = $arFields["PROPERTY_SELECT_TYPE_VALUE"];
				$arFields['FILTER_GROUPS'][] = array('NAME' => "Раздел $name", 'URL' => "{$arFields[LIST_PAGE_URL]}filter/type/{$arFields[PROPERTY_SELECT_TYPE_ENUM_ID]}/");
			}
			else{
				$arFields['FILTER_GROUPS'][] = array('NAME' => 'Все аксессуары', 'URL' => $arFields['LIST_PAGE_URL']);
			}
		}
		
		unset($arResult['ACCESSORY'][$index]['PHOTO']);
		$arResult['ACCESSORY'][$index] = $arFields;
	}
//}


if($arColours){
	$res = CIBlockElement::GetList (
	   Array(),
	   Array("ID" => $arColours),
	   false,
	   false,
	   Array('ID', 'NAME', 'PREVIEW_PICTURE',"PROPERTY_HEX")
	);
	while($arFields = $res->GetNext())
	{
		$index = array_search($arFields['ID'], $arColours);
                if($arFields["PREVIEW_PICTURE"]) $arFields['COLOR_PIC'] = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array('width'=>21, 'height'=>21), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		if($arResult['COLOUR'][$index]['PHOTO'])
		{
			$arFields['DETAIL_PICTURE'] = $arResult['COLOUR'][$index]['PHOTO'];
			$arFields['PREVIEW_PICTURE'] = market_catalog_resize_preview($arFields['DETAIL_PICTURE'], 85);
		}
		unset($arResult['COLOUR'][$index]['PHOTO']);
		$arResult['COLOUR'][$index] = $arFields;
	}
}

if(!in_array($arResult['IBLOCK_ID'], array(24,26,27))){
	$arFilter = array("<=CATALOG_PRICE_1"=>$arResult["PRICES"]["BASE"]["VALUE"], '!ID' => $arResult['ID'], 'IBLOCK_ID' => $arResult['IBLOCK_ID'], 'ACTIVE' => 'Y', '!PROPERTY_YML_PRESENCE_VALUE' => false);
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

	$arFilter = array(">CATALOG_PRICE_1"=>$arResult["PRICES"]["BASE"]["VALUE"], '!ID' => $arResult['ID'], 'IBLOCK_ID' => $arResult['IBLOCK_ID'], 'ACTIVE' => 'Y', '!PROPERTY_YML_PRESENCE_VALUE' => false);
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

if(count($arResult['PROPERTIES']['BLOCKS']['VALUE'])){
	$res = CIBlockElement::GetList (
			Array(),
			Array("IBLOCK_ID" => 33, "ID" => $arResult['PROPERTIES']['BLOCKS']['VALUE']),
			false,
			false,
			Array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'PROPERTY_LINK')
	);
	while($arFields = $res->GetNext())
	{
		if($arFields['PREVIEW_PICTURE'])
		{
			$arFields['PREVIEW_PICTURE'] = CFile::GetFileArray($arFields['PREVIEW_PICTURE']);
			
			$w = $arFields['PREVIEW_PICTURE']['WIDTH'];
			$h = $arFields['PREVIEW_PICTURE']['HEIGHT'];
			$k = $w / $h;
			if($w > $h)
			{
				$w = 250;
				$h = IntVal($w/$k);
			}
			if($h > 260)
			{
				$h = 260;
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

		$arResult['BLOCKS'][] = $arFields;
	}
}

if($arResult["PROPERTIES"]["STATUS"]["VALUE"])
{
	$res = CIBlockElement::GetList(Array(), Array("ACTIVE" => "Y", "ID" => $arResult["PROPERTIES"]["STATUS"]["VALUE"], "IBLOCK_ID" => 35), false, false, Array('ID', 'PREVIEW_TEXT', 'PREVIEW_PICTURE'));
	if($ar_res = $res->GetNext())
	{
		$arResult["PROPERTIES"]["STATUS"]["VALUE"] = array(
			"PREVIEW_PICTURE" => CFile::GetFileArray($ar_res["PREVIEW_PICTURE"]),
			"PREVIEW_TEXT" => $ar_res["PREVIEW_TEXT"],
		);
	}
	else
	{
		unset($arResult["PROPERTIES"]["STATUS"]["VALUE"]);
	}
}

if(!empty($arResult["PROPERTIES"]["FEATURES"]["VALUE"])) {
	$arFilter = array("IBLOCK_ID" => 5, 'ID' => $arResult["PROPERTIES"]["FEATURES"]["VALUE"], "!PREVIEW_PICTURE"=>false);
	$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
	     $arFields = $ob->GetFields();
             $file = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array('width'=>61, 'height'=>61), BX_RESIZE_IMAGE_PROPORTIONAL, true);                		     $arFields["PREVIEW_PICTURE"] = $file;
             $arResult["SPEC_PICS"][] = $arFields;
	}

}

$res = CIBlock::GetByID($arResult["IBLOCK_ID"]);
if($ar_res = $res->GetNext()){
	$arResult["IBLOCK_NAME"] = $ar_res['NAME'];
}

$this->__component->SetResultCacheKeys(array(
   "ACCESSORY",
   "PROPERTIES",
   "NEAR_ELEMENTS",
));
?>
