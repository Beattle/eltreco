<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	$_REQUEST["FOLDER"] = $arResult["FOLDER"];
	$item = $arResult["VARIABLES"]["ELEMENT_CODE"];
	$items = explode(",", $_COOKIE['last']);
	if(count($items))
	{
		$items = array_flip($items);
		unset($items[$item]);
		$items = array_flip($items);
		$items = array_slice($items, -3, 3);
	}
	$items[] = $item;
	setcookie("last", implode(",", $items), time()+3600, "/");
?>
<?/*$APPLICATION->IncludeComponent("site:terms", "", array(
	"URL" => "http://velohybrid.ru/services/terms.php",
	"CACHE_TYPE" => "Y",
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	),
	$component
);*/?>
<?
$_REQUEST["IS_OFFER_PAGE"] = true;
$ElementID=$APPLICATION->IncludeComponent(
	"bitrix:catalog.element",
	"new",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"META_KEYWORDS" => $arParams["DETAIL_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["DETAIL_META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["DETAIL_BROWSER_TITLE"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
		"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
		"LINK_IBLOCK_TYPE" => $arParams["LINK_IBLOCK_TYPE"],
		"LINK_IBLOCK_ID" => $arParams["LINK_IBLOCK_ID"],
		"LINK_PROPERTY_SID" => $arParams["LINK_PROPERTY_SID"],
		"LINK_ELEMENTS_URL" => $arParams["LINK_ELEMENTS_URL"],

		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],

		"OFFERS_FIELDS" => $arParams["OFFERS_FIELDS"],
		"OFFERS_PROPERTIES" => $arParams["OFFERS_PROPERTIES"],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
	),
	$component
);?>

<?$APPLICATION->IncludeComponent(
	"khayr:main.comment", 
	"eltreco", 
	array(
		"OBJECT_ID" => $ElementID,
		"COUNT" => "3",
		"MAX_DEPTH" => "1",
		"JQUERY" => "N",
		"MODERATE" => "N",
		"LEGAL" => "N",
		"LEGAL_TEXT" => "Я согласен с правилами размещения сообщений на сайте.",
		"CAN_MODIFY" => "N",
		"NON_AUTHORIZED_USER_CAN_COMMENT" => "Y",
		"REQUIRE_EMAIL" => "Y",
		"USE_CAPTCHA" => "Y",
		"AUTH_PATH" => "/auth/",
		"ACTIVE_DATE_FORMAT" => "j F Y, G:i",
		"LOAD_AVATAR" => "Y",
		"ADDITIONAL" => array(
		),
		"ALLOW_RATING" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "comments",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
		"PAGER_SHOW_ALL" => "Y"
	),
	false
);?>
<div class="clear"></div>
<div class="boxes">
	<? require($_SERVER["DOCUMENT_ROOT"].'/include/boxes/market-new.php') ?>
</div>

<?if($arParams["USE_REVIEW"]=="Y" && IsModuleInstalled("forum") && $ElementID):?>
<br />
<?$APPLICATION->IncludeComponent(
	"bitrix:forum.topic.reviews",
	"",
	Array(
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
		"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
		"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
		"FORUM_ID" => $arParams["FORUM_ID"],
		"URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
		"SHOW_LINK_TO_FORUM" => $arParams["SHOW_LINK_TO_FORUM"],
		"ELEMENT_ID" => $ElementID,
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
		"POST_FIRST_MESSAGE" => $arParams["POST_FIRST_MESSAGE"],
		"URL_TEMPLATES_DETAIL" => $arParams["POST_FIRST_MESSAGE"]==="Y"? $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"] :"",
	),
	$component
);?>
<?endif?>
<div id="credit-dialog" class="dialog highslide-maincontent">
	<a class="dialog-header control" onclick="return hs.close(this)"><img src="/images/close.png" alt="закрыть" /></a>
	<div class="dialog-content">
		<?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("/include/credit.php"),
			Array(),
			Array("MODE"=>"php")
		);?>
	</div>
</div>
