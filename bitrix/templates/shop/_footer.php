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

							<div class="shopChoose noback shopChoose-pages">

                                                        <?global $USER;?>

							<?if(($lastOffers || !$_REQUEST["IS_OFFER_PAGE"])):?>

								<div class="shopChooseTabs header">

									<ul>

										<?if($lastOffers):?>

											<li class="dot">

												<a class="dot active" data="1" href="#">Последние просмотренные товары</a>

											</li>

										<?endif?>

										<?if(!$_REQUEST["IS_OFFER_PAGE"]):?>

											<?if($cartOffers):?>

												<li class="dot<?if(!$lastOffers):?> active<?endif?>">

													<a<?if(!$lastOffers):?> class=" active"<?endif?> data="2" href="#">Отложенные товары</a>

												</li>

												<li>

													<a href="/market/compare/">Сравнить отложенные</a>

												</li>

											<?else:?>

												<li class="dot<?if(!$lastOffers):?> active<?endif?>">

													<a<?if(!$lastOffers):?> class=" active"<?endif?> data="2" href="#">Сравнить отложенные</a>

												</li>

											<?endif?>

										<?endif?>

									</ul>

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

												"SET_TITLE" => "Y",

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

													"SET_TITLE" => "Y",

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

														"SET_TITLE" => "Y",

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

												$false

												);?>

												<div class="clear"></div>

											</div>

										</div>

									<?endif?>

								<?endif?>

							</div>

						<?endif?>

						<?if($_REQUEST["BOTTOM_DESCRIPTION"]):?>

							<div class="bottom-description">

								<?=$_REQUEST["BOTTOM_DESCRIPTION"]?>

								<?if($_REQUEST["MORE_DESCRIPTION"]):?>

									<div class="description-more"><span class="more">Читать дальше...</span>

										<div class="description"><?=$_REQUEST["MORE_DESCRIPTION"]?></div>

									</div>

								<?endif?>

							</div>

						<?endif?>



<?if(!strstr($APPLICATION->GetCurPage(), "personal/cart2")):?>

					</div>

				</div>

<?endif?>

			</td>

		</tr>

	</table>

	<?/*

	$APPLICATION->IncludeFile(

			$APPLICATION->GetTemplatePath("/include/menu_float.php"), Array(), Array("MODE" => "html")

	);

	*/?>

	<script language="javascript" type="text/javascript">

		$(window).load(function(){

			$(document).ready(function(){

				function windowHeight() {

					var de = document.documentElement;

					return self.innerHeight || ( de && de.clientHeight ) || document.body.clientHeight;

				}



				$('#page .menu_float').css({

					'top': windowHeight()/2 - $('#page .menu_float').outerHeight(true)/2 +'px'

				}).show();



				$('#page .menu_float li').mouseover(function(){

					$(this).find('.hint').show();

				});

				$('#page .menu_float li').mouseout(function(){

					$(this).find('.hint').hide();

				});

			});

		});

	</script>
</div>
	<hr class="footer-line" />

	<div id="footer">


				<div class="container-fluid">
					<div class="table">

						<div class="row">

							<div class="col-md-12">

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

							</div>

						</div>



								<div id="footer-bottom">
									<div class="row">
										<div class="left-column copyright-place col-md-7">

											<?$APPLICATION->IncludeFile(

												"/include/copyright.php",

												Array(),

												Array("MODE"=>"html")

											);?>

											<!--noindex-->

											<?$APPLICATION->IncludeFile(

															"/include/address.php",

															Array(),

															Array("MODE"=>"php")

														);?>

											<!--/noindex-->

										</div>

										<div class="right-column address-place col-md-5">

											<div class="right-column news-block news-place">

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

													"NEWS_COUNT" => "2",

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

											<table class="address-table">

												<tr>

													<td>

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

															"OFFERS_LIMIT" => "5",

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

															"SET_TITLE" => "Y",

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

													</td>

												</tr>

											</table>

										</div>
									</div>




								</div>





					</div>
				</div>
	</div>



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

	<div id="benefits-dialog" class="dialog highslide-maincontent">

		<a class="dialog-header control" onclick="return hs.close(this)"><img src="/images/close.png" alt="закрыть" /></a>

		<div class="dialog-content">

			<?$APPLICATION->IncludeFile(

				$APPLICATION->GetTemplatePath("/include/benefits.php"),

				Array(),

				Array("MODE"=>"html")

			);?>

		</div>

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

<script async="async" src="https://w.uptolike.com/widgets/v1/zp.js?pid=1515324" type="text/javascript"></script>

<script src="https://mc.yandex.ru/metrika/watch.js" type="text/javascript"></script>
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
<a href="#" class="scrolltotop">
	<img src="/img/arrow_top.png" alt="">
	<span>Наверх</span>
</a>
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