<?
$arItem = array(
	'TITLE' => $arResult['NAME'], 
	'CATEGORY' => $arResult['SECTION']['NAME'], 
);
$_REQUEST['OFFER'] = $arItem;

$GLOBALS["arResult"] = $arResult;

?>
