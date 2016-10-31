<?if(!$isHome){
	include '_footer.php';
}else{?>
   </div>
	</div>
<?if($isHome){?>
	<div class="market modern-wrapper padding home-news">
		<div class="container-fluid">
			<div class="row">
				<div class="left-column market-home col-md-4 col-sm-4">
					<?$APPLICATION->IncludeFile(
						$APPLICATION->GetTemplatePath("/include/modern/home.php"),
						Array(),
						Array("MODE"=>"html")
					);?>
				</div>
				<div class="news-place padding col-md-4 col-sm-4">
					<div class="news-block">
						<table class="news-header">
							<tr>
								<td class="place-header"><a href="/news/">Новости</a></td>
								<td class="news-subscribe"><span onclick="return hs.htmlExpand(this)">Подписаться</span></td>
							</tr>
						</table>
						<?$APPLICATION->IncludeComponent("bitrix:news.line", "bottom", array(
							"IBLOCK_TYPE" => "services",
							"IBLOCKS" => array(
								0 => "1",
							),
							"NEWS_COUNT" => "3",
							"FIELD_CODE" => array(
								0 => "",
								1 => "",
							),
							"SORT_BY1" => "ACTIVE_FROM",
							"SORT_ORDER1" => "DESC",
							"SORT_BY2" => "SORT",
							"SORT_ORDER2" => "ASC",
							"DETAIL_URL" => "",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "300",
							"CACHE_GROUPS" => "N",
							"ACTIVE_DATE_FORMAT" => "d.m.Y"
							),
							false
						);?>
						<div class="all-link"><a href="/news/">Все новости</a></div>
					</div>
					<div class="video-place">
						<?$APPLICATION->IncludeFile(
							$APPLICATION->GetTemplatePath("/include/modern/video.php"),
							Array(),
							Array("MODE"=>"html")
						);?>
					</div>
				</div>
				<div class="right-column col-md-4 col-sm-4">
					<div class="column-content">
						<table class="table dealer-place">
							<tr>
								<td style="width:245px;"><div class="caption">Дилерам</div></td>
								<td class="links">
									<a href="/dealer#login">Войти в раздел</a>
								</td>
							</tr>
						</table>
						<div class="dealer-block">
							<?$APPLICATION->IncludeFile(
								$APPLICATION->GetTemplatePath("/include/modern/dealer.php"),
								Array(),
								Array("MODE"=>"html")
							);?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="market"></div>
	<div class="market-caption">
		<div class="market modern-wrapper">
			<table class="table">
				<tr>
					<td style="width:400px;"><div class="caption">Интернет-магазин</div></td>
					<td>
						<div class="selName">
							<form action="/search/" method="get">
								<input placeholder="поиск по наименованиям товаров в магазине" name="q" class="selText2" type="text" src="/bitrix/images/fileman/htmledit2/php.gif" border="0" />
								<input name="set_filter" type="hidden" value="Y" />
								<input class="selSub" type="submit" value="" />
							</form>
<?
	/*
?>
							<!-- на фильтр по названию
							<form action="/market/catalog/" method="get">
								<input placeholder="поиск по наименованиям товаров в магазине" name="arrFilter_ff[NAME]" class="selText2" type="text" src="/bitrix/images/fileman/htmledit2/php.gif" border="0" />
								<input name="set_filter" type="hidden" value="Y" />
								<input class="selSub" type="submit" value="" />
							</form>
							 -->
<?
	*/
?>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<div class="market modern-wrapper">
		<div class="catalog-place">
			<?$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"home_production",
				Array(
					"ROOT_MENU_TYPE" => "left",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_USE_GROUPS" => "N",
					"MENU_CACHE_GET_VARS" => array(),
					"MAX_LEVEL" => "1",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "Y",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "N"
				),
				false
			);?>
		</div>
	</div>

	<div class="market modern-wrapper padding" id="main-bottom-market">
		<div class="container-fluid">
			<div class="row">
				<div class="left-column col-md-4 market-home">
					<?$APPLICATION->IncludeFile(
						$APPLICATION->GetTemplatePath("/include/modern/market.php"),
						Array(),
						Array("MODE"=>"html")
					);?>
				</div>
				<div class="reviews-place padding col-md-4">
					<?$APPLICATION->IncludeComponent("bitrix:catalog.section", "reviews_small", array(
						"IBLOCK_TYPE" => "services",
						"IBLOCK_ID" => "29",
						"SECTION_ID" => "",
						"SECTION_CODE" => "",
						"SECTION_USER_FIELDS" => array(
							0 => "",
							1 => "",
						),
						"ELEMENT_SORT_FIELD" => "ACTIVE_FROM",
						"ELEMENT_SORT_ORDER" => "desc",
						"FILTER_NAME" => "",
						"INCLUDE_SUBSECTIONS" => "Y",
						"SHOW_ALL_WO_SECTION" => "Y",
						"PAGE_ELEMENT_COUNT" => "2",
						"LINE_ELEMENT_COUNT" => "3",
						"PROPERTY_CODE" => array(
							0 => "",
							1 => "",
						),
						"OFFERS_LIMIT" => "3",
						"SECTION_URL" => "",
						"DETAIL_URL" => "",
						"BASKET_URL" => "/personal/basket.php",
						"ACTION_VARIABLE" => "action",
						"PRODUCT_ID_VARIABLE" => "id",
						"PRODUCT_QUANTITY_VARIABLE" => "quantity",
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"SECTION_ID_VARIABLE" => "SECTION_ID",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "36000000",
						"CACHE_GROUPS" => "N",
						"META_KEYWORDS" => "-",
						"META_DESCRIPTION" => "-",
						"BROWSER_TITLE" => "-",
						"ADD_SECTIONS_CHAIN" => "N",
						"DISPLAY_COMPARE" => "N",
						"SET_TITLE" => "N",
						"SET_STATUS_404" => "N",
						"CACHE_FILTER" => "N",
						"PRICE_CODE" => array(
						),
						"USE_PRICE_COUNT" => "N",
						"SHOW_PRICE_COUNT" => "1",
						"PRICE_VAT_INCLUDE" => "Y",
						"PRODUCT_PROPERTIES" => array(
						),
						"USE_PRODUCT_QUANTITY" => "N",
						"CONVERT_CURRENCY" => "N",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"PAGER_TITLE" => "Отзывы",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => "",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"AJAX_OPTION_ADDITIONAL" => ""
						),
						false
					);?>
				</div>
				<div  class="right-column comments-place col-md-4">
					<div class="column-content">
						<div id="addform">
						<h2>Добавить отзыв</h2>
						<?$APPLICATION->IncludeComponent("bitrix:iblock.element.add.form", "partner", array(
							"IBLOCK_TYPE" => "services",
							"IBLOCK_ID" => "29",
							"STATUS_NEW" => "NEW",
							"LIST_URL" => "",
							"USE_CAPTCHA" => "Y",
							"USER_MESSAGE_EDIT" => "",
							"USER_MESSAGE_ADD" => "Отзыв отправлен, спасибо. После проверки модератором Ваш отзыв будет опубликован.",
							"DEFAULT_INPUT_SIZE" => "30",
							"RESIZE_IMAGES" => "N",
							"PROPERTY_CODES" => array(
								0 => "NAME",
								1 => "PREVIEW_TEXT",
								2 => "377",
							),
							"PROPERTY_CODES_REQUIRED" => array(
								0 => "NAME",
								1 => "PREVIEW_TEXT",
								2 => "377",
							),
							"GROUPS" => array(
								0 => "2",
							),
							"STATUS" => "INACTIVE",
							"ELEMENT_ASSOC" => "CREATED_BY",
							"MAX_USER_ENTRIES" => "100000",
							"MAX_LEVELS" => "100000",
							"LEVEL_LAST" => "N",
							"MAX_FILE_SIZE" => "0",
							"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
							"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
							"SEF_MODE" => "N",
							"SEF_FOLDER" => "/market/reviews/",
							"CUSTOM_TITLE_NAME" => "Вас зовут",
							"CUSTOM_TITLE_TAGS" => "",
							"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
							"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
							"CUSTOM_TITLE_IBLOCK_SECTION" => "",
							"CUSTOM_TITLE_PREVIEW_TEXT" => "Текст отзыва",
							"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
							"CUSTOM_TITLE_DETAIL_TEXT" => "",
							"CUSTOM_TITLE_DETAIL_PICTURE" => ""
							),
							false
						);?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?}?>
	<?if(!$_REQUEST["SETTINGS"]["HIDE_BOTTOM"]):?>
		<?
			$last = $_COOKIE['last'];
			if(substr_count($last,","))
				$lastOffers = explode(",", $last);


			if (CModule::IncludeModule("sale"))
			{
			   $arBasketItems = array();
			   $dbBasketItems = CSaleBasket::GetList(
							  array("NAME" => "ASC","ID" => "ASC"),
							  array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"),
							  false,
							  false,
							  array("PRODUCT_ID"));
			   while ($arItems=$dbBasketItems->Fetch())
			   {
					$cartOffers[] = $arItems["PRODUCT_ID"];
			   }
			}
		?>

		<div class="shopChoose noback">
		<?global $USER;?>
		<?if(($lastOffers || !$_REQUEST["IS_OFFER_PAGE"])):?>
			<div class="shopChooseTabs header">
				<div class="market modern-wrapper">
				<ul>
					<?if($lastOffers):?>
						<li class="dot">
							<a class="active" data="1" href="#">Вы смотрели</a>&nbsp;
						</li>
					<?endif?>
					<?if(!$_REQUEST["IS_OFFER_PAGE"]):?>
						<?if($cartOffers):?>
							<li class="dot">
								<a<?if(!$lastOffers):?> class="active"<?endif?> data="2" href="#">Отложенные товары</a>&nbsp;
							</li>
							<li>
								<a href="/market/compare/">Сравнить отложенные</a>
							</li>
						<?else:?>
							<li class="dot">
								<a<?if(!$lastOffers):?> class="active"<?endif?> data="2" href="#">Сравнить отложенные</a>&nbsp;
							</li>
						<?endif?>
					<?endif?>
				</ul>
				</div>
			</div>
			 <?endif?>
			<?if($lastOffers):?>
				<div id="shopChooseCont_1" class="shopChooseCont">
					<?
						global $arrFilter;
						$arrFilter = array("IBLOCK_TYPE" => "offers", "CODE" => $lastOffers);

						$tmpl = "small-new";
						$count = "4";
					?>
					<?$APPLICATION->IncludeComponent(
						"site:catalog.section",
						$tmpl,
						Array(
							"AJAX_MODE" => "N",
							"IBLOCK_TYPE" => "offers",
							"IBLOCK_ID" => "",
							"SECTION_ID" => "",
							"SECTION_CODE" => "",
							"SECTION_USER_FIELDS" => array(),
							"ELEMENT_SORT_FIELD" => "sort",
							"ELEMENT_SORT_ORDER" => "asc",
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
							"SET_TITLE" => "N",
							"SET_STATUS_404" => "N",
							"PAGE_ELEMENT_COUNT" => $count,
							"LINE_ELEMENT_COUNT" => $count,
							"PROPERTY_CODE" => array(),
							"OFFERS_LIMIT" => "5",
							"PRICE_CODE" => array("BASE"),
							"USE_PRICE_COUNT" => "N",
							"SHOW_PRICE_COUNT" => "1",
							"PRICE_VAT_INCLUDE" => "Y",
							"PRODUCT_PROPERTIES" => array(),
							"USE_PRODUCT_QUANTITY" => "N",
							"CACHE_TYPE" => "N",
							"CACHE_TIME" => "36000000",
							"CACHE_FILTER" => "N",
							"CACHE_GROUPS" => "N",
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
					$false
					);?>
				</div>
			<?endif?>
			<?if(!$_REQUEST["IS_OFFER_PAGE"]):?>
				<div id="shopChooseCont_2" class="shopChooseCont"<?if($lastOffers):?> style="display:none"<?endif?>>
					<?if($cartOffers):?>
						<?
							global $arrFilter;
							$arrFilter = array("IBLOCK_TYPE" => "offers", "ID" => $cartOffers);
						?>
						<?$APPLICATION->IncludeComponent(
							"site:catalog.section",
							"small-new",
							Array(
								"AJAX_MODE" => "N",
								"IBLOCK_TYPE" => "offers",
								"IBLOCK_ID" => "",
								"SECTION_ID" => "",
								"SECTION_CODE" => "",
								"SECTION_USER_FIELDS" => array(),
								"ELEMENT_SORT_FIELD" => "sort",
								"ELEMENT_SORT_ORDER" => "asc",
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
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"PAGE_ELEMENT_COUNT" => "999",
								"LINE_ELEMENT_COUNT" => "3",
								"PROPERTY_CODE" => array(),
								"OFFERS_LIMIT" => "5",
								"PRICE_CODE" => array("BASE"),
								"USE_PRICE_COUNT" => "N",
								"SHOW_PRICE_COUNT" => "1",
								"PRICE_VAT_INCLUDE" => "Y",
								"PRODUCT_PROPERTIES" => array(),
								"USE_PRODUCT_QUANTITY" => "N",
								"CACHE_TYPE" => "N",
								"CACHE_TIME" => "36000000",
								"CACHE_FILTER" => "N",
								"CACHE_GROUPS" => "N",
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
						$false
						);?>
					<?else:?>
						<h3 style="padding-left:70px">Чтобы сравнить товары между собой, просто добавьте интересующие вас модели в корзину.</h3>
					<?endif?>
				</div>
			<?else:?>
				<?
					$count = count($cartOffers);
					if ($count > 1 && $count < 5) $end = "а";
					if ($count > 4 || $count == 0) $end = "ов";
					$cartOffersString = $count." товар".$end;
				?>
				<script type="text/javascript">
					window.CartOffers = <?=count($cartOffers)?>;
					window.CartOffersString = '<?=$cartOffersString?>';
				</script>
				<?if($cartOffers):?>
				<?
					global $arrFilter;
					$arrFilter = array("IBLOCK_TYPE" => "offers", "ID" => $cartOffers);
				?>
					<div id="boxes_stub" style="display:none">
						<div class="offers">
							<?$APPLICATION->IncludeComponent(
								"site:catalog.section",
								"cart_boxes",
								Array(
									"AJAX_MODE" => "N",
									"IBLOCK_TYPE" => "offers",
									"IBLOCK_ID" => "",
									"SECTION_ID" => "",
									"SECTION_CODE" => "",
									"SECTION_USER_FIELDS" => array(),
									"ELEMENT_SORT_FIELD" => "sort",
									"ELEMENT_SORT_ORDER" => "asc",
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
									"SET_TITLE" => "N",
									"SET_STATUS_404" => "N",
									"PAGE_ELEMENT_COUNT" => "999",
									"LINE_ELEMENT_COUNT" => "3",
									"PROPERTY_CODE" => array(),
									"OFFERS_LIMIT" => "5",
									"PRICE_CODE" => array("BASE"),
									"USE_PRICE_COUNT" => "N",
									"SHOW_PRICE_COUNT" => "1",
									"PRICE_VAT_INCLUDE" => "Y",
									"PRODUCT_PROPERTIES" => array(),
									"USE_PRODUCT_QUANTITY" => "N",
									"CACHE_TYPE" => "N",
									"CACHE_TIME" => "36000000",
									"CACHE_FILTER" => "N",
									"CACHE_GROUPS" => "N",
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
							$false
							);?>
							<div class="clear"></div>
						</div>
					</div>
				<?endif?>
			<?endif?>
		</div>
	<?endif?>
	<?if($isHome){?>
	<div class="videogallery">
		<div class="market modern-wrapper">
			<div class="links">
				<div class="youtube">
					<a href="/links.php?go=https://www.youtube.com/user/EltrecoRu" target="_blank" rel="nofollow" class="icon-youtube"></a>
					<a href="/links.php?go=https://www.youtube.com/user/EltrecoRu" target="_blank" rel="nofollow" class="link">Наш канал на youtube</a>
				</div>
				<div class="social">
					<span>Мы в социальных сетях</span>
					<a class="icon-vk" href="/links.php?go=http://vk.com/eltrecogroup" target="_blank" rel="nofollow"></a>
					<a class="icon-twitter" href="/links.php?go=http://twitter.com/#!/eltreco" target="_blank" rel="nofollow"></a>
					<a class="icon-facebook" href="/links.php?go=http://facebook.com/eltreco.ru" target="_blank" rel="nofollow"></a>
					<a class="icon-instagram" href="/links.php?go=http://instagram.com/eltreco/" target="_blank" rel="nofollow"></a>
					<a class="icon-livejournal" href="/links.php?go=http://eltreco-ru.livejournal.com/" target="_blank" rel="nofollow"></a>
				</div>
			</div>
			<div class="caption">Видеогалерея</div>
				<?
					$arFilter = Market::GetOffersFilter();
					$arFilter["!PROPERTY_YOUTUBE"] = false;
					$GLOBALS["arrVideoFilter"] = $arFilter;
				?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"home_video",
					Array(
						"DISPLAY_DATE" => "Y",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "Y",
						"AJAX_MODE" => "N",
						"IBLOCK_TYPE" => "services",
						"IBLOCK_ID" => "",
						"NEWS_COUNT" => "5",
						"SORT_BY1" => "RAND",
						"SORT_ORDER1" => "ASC",
						"SORT_BY2" => "SORT",
						"SORT_ORDER2" => "ASC",
						"FILTER_NAME" => "arrVideoFilter",
						"FIELD_CODE" => array(),
						"PROPERTY_CODE" => array("YOUTUBE"),
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"PREVIEW_TRUNCATE_LEN" => "",
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"SET_TITLE" => "N",
						"SET_BROWSER_TITLE" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_STATUS_404" => "N",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"INCLUDE_SUBSECTIONS" => "Y",
						"CACHE_TYPE" => "Y",
						"CACHE_TIME" => "3600",
						"CACHE_FILTER" => "Y",
						"CACHE_GROUPS" => "N",
						"PAGER_TEMPLATE" => ".default",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"PAGER_TITLE" => "Новости",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N"
					),
				false
				);?>
			<div class="more">Больше видео по каждой модели ищите на карточках моделей</div>
		</div>
	</div>

	<div class="market modern-wrapper home-comments">
	<!--noindex-->
	<div id="bottom" class="footer-wide table container-fluid">
		<div class="row">
			<div class="left-column news-place col-md-5">
				<?$APPLICATION->IncludeComponent("site:content", ".default", array(
					"URL" => "https://greenconnect.ru/services/external/articles_popular.php",
					"CACHE_TYPE" => "Y",
					"CACHE_TIME" => "600"
					),
					false
				);?>
			</div>
			<div class="col-md-2">
				<h3>Опрос</h3>
				<?$APPLICATION->IncludeComponent("site:polls", ".default", array(
					"ELEMENT_COUNT" => "1",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"ARCHIVE" => "N",
					"PAGE_ELEMENT_COUNT" => "20",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "3600"
					),
					false
				);?>
			</div>
			<div class="right-column comments-place col-md-5">
				<h3>Обращения и комментарии</h3>
				<div class="column-content">
				<?
					if ($_REQUEST["IS_HOME_PAGE"])
					{
						global $arrComments;
						$arrComments = Array("PROPERTY_HOME_VALUE" => "Y");
					}
				?>
				<?$APPLICATION->IncludeComponent("bitrix:catalog.section", "comments", array(
					"IBLOCK_TYPE" => "services",
					"IBLOCK_ID" => "2",
					"SECTION_ID" => "",
					"SECTION_CODE" => "",
					"SECTION_USER_FIELDS" => array(
						0 => "",
						1 => "",
					),
					"ELEMENT_SORT_FIELD" => "sort",
					"ELEMENT_SORT_ORDER" => "asc",
					"FILTER_NAME" => "arrComments",
					"INCLUDE_SUBSECTIONS" => "Y",
					"SHOW_ALL_WO_SECTION" => "Y",
					"PAGE_ELEMENT_COUNT" => "0",
					"LINE_ELEMENT_COUNT" => "0",
					"PROPERTY_CODE" => array(
						0 => "POSITION",
						1 => "VIDEO",
						2 => "PREVIEW",
					),
					"SECTION_URL" => "",
					"DETAIL_URL" => "",
					"BASKET_URL" => "/personal/cart/",
					"ACTION_VARIABLE" => "action",
					"PRODUCT_ID_VARIABLE" => "id",
					"PRODUCT_QUANTITY_VARIABLE" => "quantity",
					"PRODUCT_PROPS_VARIABLE" => "prop",
					"SECTION_ID_VARIABLE" => "SECTION_ID",
					"AJAX_MODE" => "Y",
					"AJAX_OPTION_SHADOW" => "Y",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => "N",
					"CACHE_TIME" => "3600",
					"CACHE_GROUPS" => "N",
					"META_KEYWORDS" => "-",
					"META_DESCRIPTION" => "-",
					"BROWSER_TITLE" => "-",
					"ADD_SECTIONS_CHAIN" => "N",
					"DISPLAY_COMPARE" => "N",
					"SET_TITLE" => "N",
					"SET_STATUS_404" => "N",
					"CACHE_FILTER" => "Y",
					"PRICE_CODE" => array(
					),
					"USE_PRICE_COUNT" => "N",
					"SHOW_PRICE_COUNT" => "1",
					"PRICE_VAT_INCLUDE" => "Y",
					"PRODUCT_PROPERTIES" => array(
					),
					"USE_PRODUCT_QUANTITY" => "N",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"PAGER_TITLE" => "Товары",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => "",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"AJAX_OPTION_ADDITIONAL" => ""
					),
					false
				);?>
				</div>
			</div>
		</div>
	</div>
	<!--/noindex-->
	</div>
	<?}?>
	<div id="footer">
		<table class="table">
			<tr>
				<td>
					<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", array(
						"ROOT_MENU_TYPE" => "bottom",
						"MENU_CACHE_TYPE" => "A",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "N",
						"MENU_CACHE_GET_VARS" => array(
						),
						"MAX_LEVEL" => "1",
						"CHILD_MENU_TYPE" => "left",
						"USE_EXT" => "N",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N"
						),
						false
					);?>
				</td>
			</tr>
			<tr>
				<td>
					<div class="copyright-place">
						<?$APPLICATION->IncludeFile(
							"/include/modern/copyright.php",
							Array(),
							Array("MODE"=>"html")
						);?>
					</div>
					<div class="table">
						<div class="row">
							<div class="left-column address-place col-md-6">
								<!--noindex-->
								<?$APPLICATION->IncludeFile(
									"/include/modern/address_msk.php",
									Array(),
									Array("MODE"=>"php")
								);?>
								<div class="call_to_director">
                                    <a class="ctd_link" href="#">Позвонить директору</a>
                                    <?$APPLICATION->IncludeFile(
                                        "/include/call_director.php",
                                        Array(),
                                        Array("MODE"=>"php")
                                    );?>
                                </div>
								<button data-type="msk" class="link-map active">Посмотреть на карте</button>
								<!--/noindex-->
							</div>
							<div class="right-column address-place col-md-6">
								<!--noindex-->
								<?$APPLICATION->IncludeFile(
									"/include/modern/address_spb.php",
									Array(),
									Array("MODE"=>"php")
								);?>
								<button data-type="spb" class="link-map">Посмотреть на карте</button>
								<!--/noindex-->
							</div>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<a href="#" class="scrolltotop">
		<img src="/img/arrow_top.png" alt="">
		<span>Наверх</span>
	</a>
	</div>

	<div class="map-place" id="map_msk"></div>
	<div class="map-place" id="map_spb"></div>

	<div class="tooltip" id="add2message">
		<div class="completed">
			<strong>Ваш товар добавлен в корзину</strong><br />
			<a href="/personal/cart/">Оформить заказ</a><br />
			<a id="add2close" href="">Продолжить покупки</a>
		</div>
		<div class="loading"><img src="/images/loading.gif" /></div>
		<div class="error"></div>
	</div>
	<div id="subscribe-dialog" class="highslide-maincontent">
		<a class="subscribe-dialog-header control" onclick="return hs.close(this)"><img src="/images/close.png" alt="закрыть" /></a>
		<?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("/include/subscribe.php"),
			Array(),
			Array("MODE"=>"html")
		);?>
	</div>
	<div id="cart-dialog" class="dialog highslide-maincontent">
		<a class="dialog-header control" onclick="return hs.close(this)"><img src="/images/close.png" alt="закрыть" /></a>
		<div class="dialog-content">
			<?$APPLICATION->IncludeFile(
				$APPLICATION->GetTemplatePath("/include/cart.php"),
				Array(),
				Array("MODE"=>"html")
			);?>
		</div>
	</div>
	<div id="acc-dialog" class="dialog highslide-maincontent">
		<a class="dialog-header control" onclick="return hs.close(this)"><img src="/images/close.png" alt="закрыть" /></a>
		<div class="dialog-content">
			<?$APPLICATION->IncludeFile(
				$APPLICATION->GetTemplatePath("/include/acc.php"),
				Array(),
				Array("MODE"=>"html")
			);?>
		</div>
	</div>
	  <div id="feedback-content" class="feedback-tooltip highslide-maincontent">
		<a onclick="return hs.close(this)" class="dialog-header"><img src="/images/close.png" alt="закрыть" /></a>
		  <div class="dialog-content">
			  <?$APPLICATION->IncludeComponent("site:main.feedback", ".default", array(
				"USE_CAPTCHA" => "Y",
				"OK_TEXT" => "Спасибо, ваше сообщение принято.",
				"EXT_FIELDS" => array("PHONE"=>"Ваш телефон"),
				"EMAIL_TO" => "info@eltreco.ru",
				"REQUIRED_FIELDS" => array(
				  0 => "NAME",
				  1 => "MESSAGE",
				  2 => "PHONE",
				),
				"EVENT_MESSAGE_ID" => array(
				  0 => "5",
				),
				"AJAX_MODE" => "Y",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "N",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"DEFAULT_VALUE" => array(),
				),
				false
			  );?>
		  </div>

	  </div>
	<div id="before-close">
		<div class="cover"></div>
		<div class="content">
			<a class="dialog-close"><img src="/images/close.png" alt="закрыть" />&nbsp;</a>
			<?$APPLICATION->IncludeFile(
				"/include/close.php",
				Array(),
				Array("MODE"=>"html")
			);?>
		</div>
	</div>
	<div class="top-block">
		<?$APPLICATION->IncludeFile(
			"/include/top.php",
			Array(),
			Array("MODE"=>"php")
		);?>
	</div>
	<script language="javascript" type="text/javascript">pageLoad()</script>
	<?/*require($_SERVER["DOCUMENT_ROOT"].'/services/sitemap.php')*/?>
	<script type='text/javascript'>
		window['li'+'v'+'eT'+'e'+'x'] = true,
		window['l'+'iveT'+'exI'+'D'] = 35632,
		window['liv'+'eTex'+'_o'+'bject'] = true;
		(function() {
		var t = document['creat'+'e'+'E'+'lem'+'e'+'n'+'t']('script');
		t.type ='text/javascript';
		t.async = true;
		t.src = '//cs1'+'5.liv'+'et'+'ex'+'.'+'ru/js/client'+'.js';
		var c = document['getElem'+'ent'+'sByTag'+'Name']('script')[0];
		if ( c ) c['p'+'arent'+'Nod'+'e']['inse'+'r'+'tB'+'ef'+'or'+'e'](t, c);
		else document['d'+'ocume'+'ntE'+'l'+'emen'+'t']['f'+'i'+'rstCh'+'ild']['appen'+'dC'+'hi'+'ld'](t);
		})();
	</script>
	<script>

		$('#mobmenu').on('shown.bs.collapse', function () {
		  if ($('#mobcatalog').is(':visible')) {
		  	$('#mobcatalog').collapse('hide')
		  }
		})
		$('#mobcatalog').on('shown.bs.collapse', function () {
		  if ($('#mobmenu').is(':visible')) {
		  	$('#mobmenu').collapse('hide')
		  }
		})
	</script>
<script async="async" src="https://w.uptolike.com/widgets/v1/zp.js?pid=1515324" type="text/javascript"></script>
<script src="https://mc.yandex.ru/metrika/watch.js" type="text/javascript"></script>
<script type="text/javascript">
try {
    var yaCounter37097720 = new Ya.Metrika({
        id:37097720,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
    });
} catch(e) { }
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/37097720" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<?$APPLICATION->IncludeFile(
						$APPLICATION->GetTemplatePath("/bitrix/components/bitrix/bitrixcloud.mobile.monitoring.list/data/1.php"),
						Array(),
						Array("MODE"=>"html")
					);?>
	<!-- Google Tag Manager -->
	<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-T2N28J"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-T2N28J');</script>
	<!-- End Google Tag Manager -->
</body>
</html>
<?}?>
<?
	UpdateKeywordsForPage($APPLICATION->GetCurPage());
	$pageTitle = '<div class="content-title"><h1 id="pagetitle">'.$APPLICATION->GetTitle(false).'</h1></div>';
	$APPLICATION->SetPageProperty('PageHeader', $pageTitle);
	if(!$_REQUEST["SETTINGS"]["HIDE_PAGE_TITLE"]) $APPLICATION->SetPageProperty('PageTitle', $pageTitle);
	if($_REQUEST["SETTINGS"]["BACKGROUND"]) {
		$APPLICATION->SetPageProperty('PageBackground', '<div id="custom-bg" style="background-image: url(\''.$_REQUEST["SETTINGS"]["BACKGROUND"].'\')"><div id="top-bg"><div id="inner-bg"></div></div></div>');
		$APPLICATION->SetPageProperty('PageClass', ' class="custom-background"');
	}
?>