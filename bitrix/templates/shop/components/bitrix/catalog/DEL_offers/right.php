<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"COUNT_ELEMENTS" => "Y",
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	),
	$component
);?>
<form action="/market/catalog/" method="get">
	<div class="shopCatalogSearch">
		<div class="label">поиск по наименованиям товаров</div>
		<input name="arrFilter_ff[NAME]" type="text" class="selText2" value="<?=$_REQUEST["arrFilter_ff"]["NAME"]?>" />
		<input name="set_filter" type="hidden" value="Y" />
		<input type="submit" class="selSub" value="" />
	</div>
</form>
<?$APPLICATION->IncludeComponent("bitrix:catalog.section", "banner_catalog", Array(
	"IBLOCK_TYPE" => "services",	// Тип инфоблока
	"IBLOCK_ID" => "17",	// Инфоблок
	"SECTION_ID" => "",	// ID раздела
	"SECTION_CODE" => "catalog",	// Код раздела
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
	"CACHE_TYPE" => "N",	// Тип кеширования
	"CACHE_TIME" => "60",	// Время кеширования (сек.)
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
	$component
);?>
<div class="shopCatalogLinks">
	<div>
		<a href="/assist.php">
			<img src="/images/visa.png" />
		</a> 
	</div>   
	<div class="link1">
	<a href="/market/help/credit/">
		<img src="/images/icon1.png" />
		<span>Кредит</span>
	</a>
	</div>
	<div class="link1">
	<a href="/market/help/delivery/">
		<img src="/images/icon2.png" />
		<span>Доставка</span>
	</a>
	</div>
</div>