<?
foreach($arResult as $key => $arItem)
{
	if($level && $arItem['DEPTH_LEVEL'] > $level) 
	{
		unset($arResult[$key]);
		continue;
	}
	$level = false;
	
	if($arItem['DEPTH_LEVEL'] > 1)continue;
	$path = $_SERVER["DOCUMENT_ROOT"].'/include/topmenu/'.str_replace('/', '_', trim($arItem['LINK'], '/')).'.php';
	if(file_exists($path))
	{
		$arItem['SUBMENU'] = $path;
		if($arItem['IS_PARENT'])
		{
			$arItem['IS_PARENT'] = false;
			$level = $arItem['DEPTH_LEVEL'];
		}
	}
	$arResult[$key] = $arItem;
}
?>