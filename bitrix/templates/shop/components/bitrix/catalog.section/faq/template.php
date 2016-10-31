<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="faq">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>
<?if(count($arResult["ITEMS"])>0):?>
	<ul>
	<?foreach($arResult["ITEMS"] as $arElement):?>
	<li onclick="clearFaq('faq');setElementClass(this,'sel')"><span class='name'><?=$arElement["NAME"]?></span><div class='description'><?=$arElement["PREVIEW_TEXT"]?></div></li>
	<?endforeach;?>
    </ul>
<?endif?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>
</div>