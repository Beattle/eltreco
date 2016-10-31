<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach($arResult["ITEMS"] as $arElement):?>
	<p><?=$arElement["NAME"]?></p>
<?endforeach;?>