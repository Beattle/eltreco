<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? 
	$uri = $APPLICATION->GetCurPage();
	$items = explode('/', $uri);
	$isHome = $uri == '/market/' || $uri == '/';
	
    $refurl = $_SERVER['HTTP_REFERER'];
    if ($refurl)
    {
        $host = explode("/", $refurl); 
        if ($host[2] != $_SERVER["SERVER_NAME"])
        {
            setcookie("REFERER", substr($refurl, 0, 200), time() + 3600000, '/');
        }
    }
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/services/add2cart_core.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
<title><?$APPLICATION->ShowTitle()?></title>
<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
<script src="/yescredit/js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="/yescredit/js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
<script src="/yescredit/js/yescredit.js" type="text/javascript"></script>
<?if(IsFrame()){?><script src="https://vk.com/js/api/xd_connection.js?2" type="text/javascript"></script><?}?>
<link href="/yescredit/css/cupertino/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
<?/*link type="text/css" rel="stylesheet" href="http://www.eltreco.ru/scripts/sitemap/style.css?20130217" */?>
<script src="/scripts/jquery/jquery.blueberry.js?20121212" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="//greenconnect.ru/services/external/common.css" />
<script language="javascript" type="text/javascript" src="/scripts/jcarousel/jquery.jcarousel.min.js"></script>
<link type="text/css" rel="stylesheet" href="/scripts/jcarousel/skins/tango/skin.css" />
<script language="javascript" type="text/javascript" src="/scripts/jquery.tinycarousel.min.js"></script>
<link type="text/css" rel="stylesheet" href="/scripts/jquery/jquery.compat.cluetip.css" />
<script language="javascript" type="text/javascript" src="/scripts/jquery/jquery.cluetip.all.min.js"></script>
<?$APPLICATION->SetAdditionalCSS("/bitrix/templates/.default/styles.css");?>
<?$APPLICATION->AddHeadScript("/scripts/jquery/cookies.js", true);?>
<?$APPLICATION->AddHeadScript("/scripts/page.js", true);?>
<?$APPLICATION->ShowHead();?>
<?IncludeTemplateLangFile(__FILE__);?>
<script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=O9Mz4xiD9D2ZJo93lwvVO6ducezeX2pZVoSdIXZlDq4FRzod8uwQK4Bf26IneNeuxxpYTUKzIxNK8E/1mpJBHPwm7q0pUHUjHdvgwMP352kF/saXpkL88vR9YyzHuEFbeI0vvMhXlatrbdSN5jUaL/PPLrWnT9BLaNIdWy5B9KY-&pixel_id=1000028735';</script>
</head>
<body<?if($isHome):?> class="home"<?endif?>>	
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>
	<div class="header-menu-place">
		<table class="header-menu-table">
			<tr>
				<td class="header-menu-logo">
					<a href="/">
						<img alt="" src="/images/header_logo.png" />
					</a>
				</td>
				<td>
					<table id="top-menu">
						<tr>
						  <?/*<td>
							<div id="promo-menu">
							  <span class="link">Промо-сайты</span>
							  <?$APPLICATION->IncludeComponent("bitrix:menu", "links", array(
								"ROOT_MENU_TYPE" => "promo",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_USE_GROUPS" => "N",
								"MENU_CACHE_GET_VARS" => "",
								"MAX_LEVEL" => "1",
								"CHILD_MENU_TYPE" => "",
								"USE_EXT" => "N",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "N"
								)
							  );?>
							</div>
						  </td>*/?>
						  <td>
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
						  </td>
						</tr>
					</table>
					<span id="show_sites">Показать карту сайтов</span>
				</td>
			</tr>
		</table>
	</div>
	<div id="intro-place">
		<div id="intro">

		</div>
	</div>
	<div id="page">
		<div id="top-menu-place" class="shopMenu">
			<div class="logoShop">
				<a<?if(!$isHome):?> href="/"<?endif?>>
					<img id="logo" alt="Eltreco" src="/images/logo2.png"  />
				</a>
			</div>
			<div class="header-basket-line">
				<?if(!$isHome):?>
					<a data-type="top" class="link-top-block" id="show_block">
						<span class="show">Показать акции магазина</span>
						<span class="hide">Скрыть акции магазина</span>
					</a>
				<?endif?>
				<a class="myorders" href="/personal/order/">Вход для покупателей</a>
				<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", ".default", Array(
					"PATH_TO_BASKET" => SITE_DIR."personal/cart/",	// Страница корзины
					"PATH_TO_PERSONAL" => SITE_DIR."personal/",	// Персональный раздел
					"SHOW_PERSONAL_LINK" => "N",	// Отображать ссылку на персональный раздел
					),
					false
				);?>
			</div>
            <div class="headPhones">
                <div>+7 (495)<span>799 06 46</span></div>
                <div><a href="#"><img src="/images/headPhone1.png" /><span class="link call-back" onclick="return hs.htmlExpand(this, { contentId: 'feedback-content', width: '240', height: '400' })">Заказать обратный звонок</span></a></div>
                <div><a href="#" onclick="return hs.htmlExpand(this, { contentId: 'benefits-dialog' })"><img src="/images/headPhone2.png" /><span>Наши преимущества!</span></a></div>
				<div class="contact">
					<div><a class="link" href="/contacts/"><span>Магазин-салон в Москве</span></a></div>
					<div>
						<a data-type="map" class="link-top-block" id="show_map">
							<span class="show">Показать карту</span>
							<span class="hide">Скрыть карту</span>
						</a>
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
		<?if($isHome):?>
			<?$APPLICATION->IncludeComponent("bitrix:catalog.section", "slider", Array(
				"IBLOCK_TYPE" => "services",	// Тип инфоблока
				"IBLOCK_ID" => "17",	// Инфоблок
				"SECTION_ID" => "",	// ID раздела
				"SECTION_CODE" => "market",	// Код раздела
				"SECTION_USER_FIELDS" => "",
				"ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем элементы
				"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки элементов
				"FILTER_NAME" => "",	// Имя массива со значениями фильтра для фильтрации элементов
				"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
				"SHOW_ALL_WO_SECTION" => "N",	// Показывать все элементы, если не указан раздел
				"PAGE_ELEMENT_COUNT" => "30",	// Количество элементов на странице
				"LINE_ELEMENT_COUNT" => "30",	// Количество элементов выводимых в одной строке таблицы
				"PROPERTY_CODE" => array(	// Свойства
					0 => "LINK",
					1 => "",
				),
				"OFFERS_LIMIT" => "",	// Максимальное количество предложений для показа (0 - все)
				"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
				"DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
				"BASKET_URL" => "/personal/basket.php",	// URL, ведущий на страницу с корзиной покупателя
				"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
				"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
				"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
				"SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
				"AJAX_MODE" => "N",	// Включить режим AJAX
				"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
				"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
				"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
				"CACHE_TYPE" => "A",	// Тип кеширования
				"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
				"CACHE_GROUPS" => "N",	// Учитывать права доступа
				"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
				"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
				"BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
				"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
				"DISPLAY_COMPARE" => "N",	// Выводить кнопку сравнения
				"SET_TITLE" => "N",	// Устанавливать заголовок страницы
				"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
				"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
				"PRICE_CODE" => "",	// Тип цены
				"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
				"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
				"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
				"PRODUCT_PROPERTIES" => "",	// Характеристики товара
				"USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
				"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
				"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
				"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
				"PAGER_TITLE" => "Товары",	// Название категорий
				"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
				"PAGER_TEMPLATE" => "",	// Название шаблона
				"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
				"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
				"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
				),
				false
			);?>
		<?endif?>
	<table class="wide">
		<tr>
			<td>
				<div id="header">
					<div id="top">

					</div>
				</div>
				<div id="content">
					<div id="content-body">
						<? $template = $isHome ? "production" : "shop"; ?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu",
							$template,
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
						<? echo $APPLICATION->ShowProperty("PageTitle"); ?>