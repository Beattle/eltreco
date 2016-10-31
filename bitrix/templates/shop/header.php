<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
    <?

    include_once ('functions.php');
    setDefaultPageElementCount();

	$uri = $APPLICATION->GetCurPage();
	$items = explode('/', $uri);
	//$isHome = $uri == '/market/';
	$isHome = in_array($uri, array('/', '/testovyy-razdel/'));

    $refurl = $_SERVER['HTTP_REFERER'];
    if ($refurl)
    {
        $host = explode("/", $refurl);
        if ($host[2] != $_SERVER["SERVER_NAME"])
        {
            setcookie("REFERER", substr($refurl, 0, 200), time() + 3600000, '/');
        }
    }

	if($_REQUEST['source'] == 'vk'){
		$_SESSION['frame'] = true;
	}

	$class[] = 'body';
	if($isHome){
		$class[] = 'home';
	}
	/*
	if(IsFrame()){
		$class[] = 'frame';
		$APPLICATION->AddHeadScript("/scripts/vk.js", true);
	}
	*/
	$isOld = false;
	if($isOld){
		include '_header.php';
	}else{
?>
        <?require($_SERVER["DOCUMENT_ROOT"]."/services/add2cart_core.php");?>
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">

            <head>
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <meta name="viewport" content="width=device-width, initial-scale=1" />
                <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
                <title>
                    <?$APPLICATION->ShowTitle()?>
                </title>
                <script src="//yandex.st/share/share.js" type="text/javascript" charset="utf-8"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.4.0/jquery-migrate.js"></script>
                <script src="/yescredit/js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
                <script src="/yescredit/js/yescredit.js" type="text/javascript"></script>
				<?if(IsFrame()){?><script src="https://vk.com/js/api/xd_connection.js?2" type="text/javascript"></script><?}?>
                <!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
                <link href="/yescredit/css/cupertino/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
                <?/*link type="text/css" rel="stylesheet" href="/scripts/sitemap/style.css?20130217" */?>
                <script src="/scripts/jquery/jquery.blueberry.js?20121212" type="text/javascript"></script>
                <?/*link type="text/css" rel="stylesheet" href="//greenconnect.ru/services/external/common.css" */?>
                <script language="javascript" type="text/javascript" src="/scripts/jcarousel/jquery.jcarousel.min.js"></script>
                <link type="text/css" rel="stylesheet" href="/scripts/jcarousel/skins/tango/skin.css" />
                <script language="javascript" type="text/javascript" src="/scripts/jquery.tinycarousel.min.js"></script>
                <link type="text/css" rel="stylesheet" href="/scripts/jquery/jquery.compat.cluetip.css" />
                <script language="javascript" type="text/javascript" src="/scripts/jquery/jquery.cluetip.all.min.js"></script>
                <!-- Latest compiled and minified JavaScript -->
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

                <?$APPLICATION->SetAdditionalCSS("/bitrix/templates/shop/styles.css");?>
				<?$APPLICATION->SetAdditionalCSS("/bitrix/templates/shop/template_styles.css");?>
				<?$APPLICATION->SetAdditionalCSS("/bitrix/templates/.default/styles.css");?>
				<?$APPLICATION->ShowHead();?>
				<?$APPLICATION->SetAdditionalCSS("/bitrix/templates/shop/modern_styles.css");?>
				<?$APPLICATION->AddHeadScript("/scripts/jquery/cookies.js", true);?>
				<?$APPLICATION->AddHeadScript("/scripts/page.js", true);?>
				<?$APPLICATION->AddHeadScript("/bitrix/templates/shop/modern_page.js", true);?>
				<?$APPLICATION->AddHeadScript("/scripts/vk.js", true);?>
				<link type="text/css" rel="stylesheet" href="/css/vg-custom.css" />

                                        <?IncludeTemplateLangFile(__FILE__);?>
                                            <?/*
global $USER;
if($USER->GetID()== 1 || $USER->GetID()== 2){?>
                                                <style type="text/css">
                                                    .top-shop-menu {
                                                        display: none !important;
                                                    }
                                                </style>
                                                <?}*/?>
            </head>
            <body class="<?=implode(' ', $class)?>">
                    <div id="panel">
                        <?$APPLICATION->ShowPanel();?>
                    </div>
                    <div class="header-menu-place">
                        <div class="header-menu-table">
                          <span class="header-menu-logo">
                              <a href="/">
                                  <img alt="" src="/images/header_logo.png" />
                              </a>
                          </span>
                          <div id="top-menu">
                            <?$APPLICATION->IncludeComponent("bitrix:menu", "header", array(
                							  "ROOT_MENU_TYPE" => "header",
                							  "MENU_CACHE_TYPE" => "A",
                							  "MENU_CACHE_TIME" => "3600",
                							  "MENU_CACHE_USE_GROUPS" => "N",
                							  "MENU_CACHE_GET_VARS" => "",
                							  "MAX_LEVEL" => "1",
                							  "CHILD_MENU_TYPE" => "left",
                							  "USE_EXT" => "N",
                							  "DELAY" => "N",
                							  "ALLOW_MULTI_SELECT" => "N"
                							  ),
                							  false
                							);?>
                          </div>
                          <?/*<span id="show_sites">Показать карту сайтов</span>*/?>

                        </div>
                    </div>
                    <div id="intro-place">
                        <div id="intro">

                        </div>
                    </div>
                    <div id="page">
                        <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "sale.basket.line.fixed", Array(
                            "PATH_TO_BASKET" => SITE_DIR."personal/cart/",  // Страница корзины
                            "PATH_TO_PERSONAL" => SITE_DIR."personal/", // Персональный раздел
                            "SHOW_PERSONAL_LINK" => "N",    // Отображать ссылку на персональный раздел
                            ),
                            false
                        );?>
                        <div id="top-menu-place" class="shopMenu">
                            <div class="logoShop">
                                <a<?if(!$isHome):?> href="/market/"<?endif?>>
                									<img id="logo" alt="Eltreco" src="/images/logo.gif" />
                								</a>
                            </div>
                            <div class="header-basket-line">
                                <a data-type="top" class="link-top-block" id="show_block">
                                    <span class="show">Большой ассортимент - это важно!</span>
                                    <span class="hide">Скрыть баннер</span>
                                </a>
                                <!--
                                <a class="myorders" href="/personal/profile/">Вход для покупателей</a>
                                 -->
                                <!-- Ссылки на вход и выход пользователей -->
                                        <?
                                        $APPLICATION->IncludeComponent(
                                            "bitrix:system.auth.form",
                                            "inheader",
                                            array(
                                                "REGISTER_URL" => "/personal/profile/",
                                                "PROFILE_URL" => "/personal/profile/"
                                            )
                                        );
                                        ?>
                                <!-- /Ссылки на вход и выход пользователей -->

                                <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", ".default", Array(
                                    "PATH_TO_BASKET" => SITE_DIR."personal/cart/",  // Страница корзины
                                    "PATH_TO_PERSONAL" => SITE_DIR."personal/", // Персональный раздел
                                    "SHOW_PERSONAL_LINK" => "N",    // Отображать ссылку на персональный раздел
                                    ),
                                    false
                                );?>
                            </div>
                            <div class="headPhones">
                                <div><a href="tel:+7(495)7990646">+7 (495) 799 06 46</a></div>
                                <div class="feedback">
                                    <a href="#"><img alt="" src="/images/headPhone.png" /><span class="link call-back" onclick="return hs.htmlExpand(this, { contentId: 'feedback-content', width: '240', height: '400' })">Заказать обратный звонок</span></a>
                                </div>
                                
                                
                                <div class="call_to_director">
                                    <a class="ctd_link" href="#">Позвонить директору</a>
                                    <?$APPLICATION->IncludeFile(
                                        "/include/call_director.php",
                                        Array(),
                                        Array("MODE"=>"php")
                                    );?>
                                </div>      
                                <div class="contact">
                                    <div class="location"><span>магазин-салон</span>
                                        <a class="link" href="/contacts/"><img alt="" src="/images/location.png" /><span>схема проезда</span></a>
                                    </div>
                                </div>
                            </div>
                            <?$APPLICATION->IncludeComponent("bitrix:menu", "top", Array(
              								"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
              								"MENU_CACHE_TYPE" => "A",	// Тип кеширования
              								"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
              								"MENU_CACHE_USE_GROUPS" => "N",	// Учитывать права доступа
              								"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
              								"MAX_LEVEL" => "2",	// Уровень вложенности меню
              								"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
              								"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
              								"DELAY" => "N",	// Откладывать выполнение шаблона меню
              								"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
              								),
              								false
              							);?>
                        </div>
                        <div class="shopMenu-mob text-center row">
                            <div class="col-md-12">
                               <div class="logoShop">
                                    <a<?if(!$isHome):?> href="/market/"<?endif?>>
                                        <img id="logo" alt="Eltreco" src="/images/logo.gif" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12">
                               <div class="header-basket-line">
                                    <a class="myorders" href="/personal/order/">Вход для покупателей</a>
                                    <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", ".default", Array(
                                        "PATH_TO_BASKET" => SITE_DIR."personal/cart/",  // Страница корзины
                                        "PATH_TO_PERSONAL" => SITE_DIR."personal/", // Персональный раздел
                                        "SHOW_PERSONAL_LINK" => "N",    // Отображать ссылку на персональный раздел
                                        ),
                                        false
                                    );?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="headPhones">
                                    <div><a href="tel:+7(495)7990646">+7 (495) 799 06 46</a></div>
                                    <div class="feedback">
                                        <a href="#"><img alt="" src="/images/headPhone.png" /><span class="link call-back" onclick="return hs.htmlExpand(this, { contentId: 'feedback-content', width: '240', height: '400' })">Заказать обратный звонок</span></a>
                                    </div>
                                    <div class="contact">
                                        <div class="location"><span>магазин-салон</span>
                                            <a class="link" href="/contacts/"><img alt="" src="/images/location.png" /><span>схема проезда</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <nav class="navbar navbar-default mob_main_menu">
                            <div class="container">
                                <div class="navbar-header">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <a class="navbar-brand" data-toggle="collapse" data-target="#mobmenu" aria-expanded="false" id="mobmenu-toogle">
                                            <button type="button" class="navbar-toggle collapsed" >
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                          </button>
                                          Меню</a>
                                        </div>
                                        <div class="col-xs-7">
                                            <a class="navbar-brand" data-toggle="collapse" data-target="#mobcatalog" aria-expanded="false">
                                              <button type="button" class="navbar-toggle collapsed" >
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                              </button>
                                              Каталог товаров</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse navbar-collapse" id="mobmenu">
                                    <?$APPLICATION->IncludeComponent("bitrix:menu", "mobmenu", Array(
                                        "ROOT_MENU_TYPE" => "top",  // Тип меню для первого уровня
                                        "MENU_CACHE_TYPE" => "A",   // Тип кеширования
                                        "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                                        "MENU_CACHE_USE_GROUPS" => "N", // Учитывать права доступа
                                        "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                                        "MAX_LEVEL" => "2", // Уровень вложенности меню
                                        "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                                        "USE_EXT" => "Y",   // Подключать файлы с именами вида .тип_меню.menu_ext.php
                                        "DELAY" => "N", // Откладывать выполнение шаблона меню
                                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                                        ),
                                        false
                                    );?>
                                </div>
                                <div class="collapse navbar-collapse" id="mobcatalog">
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:menu",
                                        "mob_home_shop",
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
                        </nav>

                        <div class="wide">
                          <div id="header">
                              <div id="top">

                              </div>
                          </div>
                          <?$APPLICATION->IncludeComponent(
                    				"bitrix:menu",
                    				"home_shop",
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
                        <?if(!strstr($APPLICATION->GetCurPage(), "personal/cart2")):?>
                            <div id="content">
                                <div id="content-body">
                                    <?if($isHome){?>
                                        <?$APPLICATION->IncludeComponent(
                        							"bitrix:catalog.section",
                        							"banner_dealer_slide",
                        							Array(
                        								"IBLOCK_TYPE" => "services",
                        								"IBLOCK_ID" => "17",
                        								"SECTION_ID" => "",
                        								"SECTION_CODE" => "modern",
                        								"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
                        								"ELEMENT_SORT_FIELD" => "sort",
                        								"ELEMENT_SORT_ORDER" => "asc",
                        								"FILTER_NAME" => "",
                        								"INCLUDE_SUBSECTIONS" => "Y",
                        								"SHOW_ALL_WO_SECTION" => "N",
                        								"PAGE_ELEMENT_COUNT" => "30",
                        								"LINE_ELEMENT_COUNT" => "3",
                        								"PROPERTY_CODE" => array(0=>"LINK",1=>"",),
                        								"OFFERS_LIMIT" => "4",
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
                        								"PRICE_CODE" => "",
                        								"USE_PRICE_COUNT" => "N",
                        								"SHOW_PRICE_COUNT" => "1",
                        								"PRICE_VAT_INCLUDE" => "Y",
                        								"PRODUCT_PROPERTIES" => "",
                        								"USE_PRODUCT_QUANTITY" => "N",
                        								"CONVERT_CURRENCY" => "N",
                        								"DISPLAY_TOP_PAGER" => "N",
                        								"DISPLAY_BOTTOM_PAGER" => "N",
                        								"PAGER_TITLE" => "Товары",
                        								"PAGER_SHOW_ALWAYS" => "N",
                        								"PAGER_TEMPLATE" => "",
                        								"PAGER_DESC_NUMBERING" => "N",
                        								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        								"PAGER_SHOW_ALL" => "N",
                        								"AJAX_OPTION_ADDITIONAL" => ""
                        							)
                        						);?>
                                  <?}?>
                                      <? echo $APPLICATION->ShowProperty("PageTitle"); ?>

                                          <?endif?>
                                              <?}?>