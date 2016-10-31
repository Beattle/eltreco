<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog">
<? $i = 1; foreach($arResult["SECTIONS"] as $arItem):?>
	<div class="item" id="r_<?=$arItem["CODE"]?>">
		<?if($arItem["UF_PROMO_TEXT"]):?><div class="promo-link"><a href="http://<?=$arItem["UF_PROMO_URL"]?>"><?=$arItem["UF_PROMO_TEXT"]?></a></div><?endif?>
		<div class="item-name"><h1><?=$arItem["NAME"]?></h1></div>
		<div class="line"><div class="item-line"><div class="circle"><?=$i++?></div></div></div>
		<?$APPLICATION->IncludeComponent("bitrix:catalog.section", "complete", array(
			"IBLOCK_TYPE" => "catalog",
			"IBLOCK_ID" => $arItem["IBLOCK_ID"],
			"SECTION_ID" => $arItem["ID"],
			"SECTION_CODE" => "",
			"SECTION_USER_FIELDS" => array(
				0 => "",
				1 => "",
			),
			"ELEMENT_SORT_FIELD" => "sort",
			"ELEMENT_SORT_ORDER" => "asc",
			"FILTER_NAME" => "arrFilter",
			"INCLUDE_SUBSECTIONS" => "Y",
			"SHOW_ALL_WO_SECTION" => "Y",
			"PAGE_ELEMENT_COUNT" => "9999",
			"LINE_ELEMENT_COUNT" => "3",
			"PROPERTY_CODE" => array(
				0 => "FEATURES",
				1 => "FEATURES2",
			),
			"SECTION_URL" => "",
			"DETAIL_URL" => "",
			"BASKET_URL" => "/personal/cart/",
			"ACTION_VARIABLE" => "action",
			"PRODUCT_ID_VARIABLE" => "id",
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_SHADOW" => "Y",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "N",
			"CACHE_TIME" => "3600",
			"CACHE_GROUPS" => "N",
			"META_KEYWORDS" => "UF_PAGE_KEYWORDS",
			"META_DESCRIPTION" => "UF_PAGE_DESCRIPTION",
			"BROWSER_TITLE" => "",
			"ADD_SECTIONS_CHAIN" => "N",
			"DISPLAY_COMPARE" => "N",
			"SET_TITLE" => "N",
			"SET_STATUS_404" => "Y",
			"CACHE_FILTER" => "N",
			"PRICE_CODE" => array(
				0 => "BASE"
			),
			"USE_PRICE_COUNT" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"PRICE_VAT_INCLUDE" => "Y",
			"PRODUCT_PROPERTIES" => array(
				0 => "FEATURES",
				1 => "FEATURES2",
			),
			"USE_PRODUCT_QUANTITY" => "N",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_TITLE" => "",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"AJAX_OPTION_ADDITIONAL" => ""
			),
			$component->GetParent()
		);?>		
	</div>
<?endforeach?>
</div>