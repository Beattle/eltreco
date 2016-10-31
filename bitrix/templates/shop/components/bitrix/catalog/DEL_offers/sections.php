<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["USE_COMPARE"]=="Y"):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.compare.list",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NAME" => $arParams["COMPARE_NAME"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
	),
	$component
);?>
<br />
<?endif?>
<?if($arParams["SHOW_TOP_ELEMENTS"]!="N"):?>
<hr />
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.top",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_SORT_FIELD" => $arParams["TOP_ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["TOP_ELEMENT_SORT_ORDER"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
		"ELEMENT_COUNT" => $arParams["TOP_ELEMENT_COUNT"],
		"LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
		"PROPERTY_CODE" => $arParams["TOP_PROPERTY_CODE"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
		"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		//Template parameters
		"LINK_IBLOCK_ID" => $arParams["LINK_IBLOCK_ID"],
		"LINK_PROPERTY_SID" => $arParams["LINK_PROPERTY_SID"],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
	),
$component
);?>
<?endif?>
<div class="shopCatalog">
    <div class="shopCatalogL">
		<?
			if(!$_REQUEST["PAGEN_1"])
			{
				$uri = trim($APPLICATION->GetCurPage(), '/');
				$items = explode('/', $uri);
				if($items[1] == 'catalog' && $_REQUEST['set_filter'] == 'Y')
				{
					$file = str_replace('/', '_', $uri);
					$content = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/include/descriptions/$file.php");
					if($content)
					{
						$description = $content;
					}
				}
				else
				{
					$res = CIBlock::GetByID($arParams["IBLOCK_ID"]);
					if($ar_res = $res->GetNext())
					{
						$description = $ar_res["~DESCRIPTION"];
					}
				}
				
				if($description)
				{
					$arDescription = explode("<hr/>", $description, 3);
					$_REQUEST["BOTTOM_DESCRIPTION"] = trim($arDescription[1]);
					$_REQUEST["MORE_DESCRIPTION"] = trim($arDescription[2]);
				}
			}
		?>
		<?if($arDescription[0]):?>
			<div class="catalog-description-top"><?=$arDescription[0]?></div><br />
		<?endif?>	
		<div class="sort">Показать по цене<br />
			<?if($_REQUEST["sort"] !== "price_asc"):?><a href="<?=$APPLICATION->GetCurPageParam("sort=price_asc", array("sort"))?>"><?endif?>Сначала бюджетные<?if($_REQUEST["sort"] !== "price_asc"):?></a><?endif?>
			|
			<?if($_REQUEST["sort"] !== "price_desc"):?><a href="<?=$APPLICATION->GetCurPageParam("sort=price_desc", array("sort"))?>"><?endif?>Сначала премиум<?if($_REQUEST["sort"] !== "price_desc"):?></a><?endif?>
		</div>
		<? 
			if($_REQUEST["sort"])
			{
				$sortField = "CATALOG_PRICE_1";
				$sortOrder = $_REQUEST["sort"] == "price_asc" ? "ASC" : "DESC";
			}
			else
			{
				$sortField = $arParams["ELEMENT_SORT_FIELD"];
				$sortOrder = $arParams["ELEMENT_SORT_ORDER"];
			}
		?>
		<?if($arParams["IBLOCK_ID"]):?>
			<?
				if($_REQUEST["set_filter"] == "Y"){
					global $arrFilter;
					$arrFilter['PROPERTY'] = $_REQUEST["arrFilter_pf"];
					foreach($arrFilter['PROPERTY'] as $key => $arFilter){
						if($arFilter === 'false')$arrFilter['PROPERTY'][$key] = false;
					}
				}
			?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section",
				"",
				Array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
					"SHOW_ALL_WO_SECTION" => "Y",
					"ELEMENT_SORT_FIELD" => $sortField,
					"ELEMENT_SORT_ORDER" => $sortOrder,
					"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
					"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
					"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
					"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
					"BASKET_URL" => $arParams["BASKET_URL"],
					"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
					"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
					"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
					"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
					"FILTER_NAME" => "arrFilter",
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_FILTER" => $arParams["CACHE_FILTER"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"SET_TITLE" => $arParams["SET_TITLE"],
					"SET_STATUS_404" => $arParams["SET_STATUS_404"],
					"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
					"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
					"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
					"PRICE_CODE" => $arParams["PRICE_CODE"],
					"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
					"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
					"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
					"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
					"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
					"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
					"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
					"PAGER_TITLE" => $arParams["PAGER_TITLE"],
					"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
					"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
					"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
					"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
					"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

					"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
					"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
					"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
					//Template parameters
					"LINK_IBLOCK_ID" => $arParams["LINK_IBLOCK_ID"],
					"LINK_PROPERTY_SID" => $arParams["LINK_PROPERTY_SID"],
					'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
					'CURRENCY_ID' => $arParams['CURRENCY_ID'],
				),
				$component
			);
			?>
		<?else:?>
			<?if($_REQUEST["set_filter"] == "Y"):?>
				<?
					global $arrFilter; 
					$arrFilter = array(
						"NAME" => "%".$_REQUEST["arrFilter_ff"]["NAME"]."%",
						"IBLOCK_TYPE" => "offers"
					);
				?>
				<?$APPLICATION->IncludeComponent(
					"site:catalog.section",
					"",
					Array(
						"AJAX_MODE" => "N",
						"IBLOCK_TYPE" => "offers",
						"IBLOCK_ID" => "",
						"SECTION_ID" => "",
						"SECTION_CODE" => "",
						"SECTION_USER_FIELDS" => array(),
						"ELEMENT_SORT_FIELD" => $sortField,
						"ELEMENT_SORT_ORDER" => $sortOrder,
						"FILTER_NAME" => "arrFilter",
						"INCLUDE_SUBSECTIONS" => "Y",
						"SHOW_ALL_WO_SECTION" => "Y",
						"SECTION_URL" => "",
						"DETAIL_URL" => "",
						"BASKET_URL" => "/personal/basket.php",
						"ACTION_VARIABLE" => "action",
						"PRODUCT_ID_VARIABLE" => "id",
						"PRODUCT_QUANTITY_VARIABLE" => "quantity",
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"SECTION_ID_VARIABLE" => "SECTION_ID",
						"META_KEYWORDS" => "-",
						"META_DESCRIPTION" => "-",
						"BROWSER_TITLE" => "-",
						"ADD_SECTIONS_CHAIN" => "N",
						"DISPLAY_COMPARE" => "N",
						"SET_TITLE" => "Y",
						"SET_STATUS_404" => "N",
						"PAGE_ELEMENT_COUNT" => "10",
						"LINE_ELEMENT_COUNT" => "3",
						"PROPERTY_CODE" => array(),
						"OFFERS_LIMIT" => "5",
						"PRICE_CODE" => array("BASE"),
						"USE_PRICE_COUNT" => "N",
						"SHOW_PRICE_COUNT" => "1",
						"PRICE_VAT_INCLUDE" => "Y",
						"PRODUCT_PROPERTIES" => $arParams["LIST_PROPERTY_CODE"],
						"USE_PRODUCT_QUANTITY" => "N",
						"CACHE_TYPE" => "N",
						"CACHE_TIME" => "36000000",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "Y",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"PAGER_TITLE" => "",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => "",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "Y",
						"CONVERT_CURRENCY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N"
					),
				$component
				);?> 
			<?endif?>
		<?endif?>
	</div>
	<div class="shopCatalogR">
		<?include("right.php")?>
    </div>
</div>
<?
if(!$_GET["PAGEN_1"])
{
	require_once($_SERVER["DOCUMENT_ROOT"].'/include/iblock_properties.php');
	$arUrl = explode('/', trim($_SERVER["REQUEST_URI"], '/'));
	$IBLOCK_CODE = $arUrl[2];
	$arProperties = $_REQUEST["IBLOCK_PROPERTIES"][$IBLOCK_CODE];
	if($arProperties["DESCRIPTION"])$APPLICATION->SetPageProperty("description", $arProperties["DESCRIPTION"]);
	if($arProperties["TITLE"])$APPLICATION->SetTitle($arProperties["TITLE"]);
	if($arProperties["KEYWORDS"])$APPLICATION->SetPageProperty("keywords", $arProperties["KEYWORDS"]);
}
?>