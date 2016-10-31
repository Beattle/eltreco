<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel();
    
    $(".addSliderIn ul li a.preview-picture").hover(function(){
		$('.hidDiv').hide()
		$(this).parent().parent().find('.hidDiv').show()
	});    
	$(".hidDiv").mouseleave(function(){
		$(this).hide();
	});
	$(".addSliderIn ul li a.preview-picture").click(function(){
		$("#fullPic").attr("src", $(this).attr("href"));
		return false;
	});
	$(".addColors a.preview-picture").click(function(){
		selectColor($(this));
		return false;
	});
	$("#colours_select span").click(function(){
		var data = $(this).attr("data");
		var element = $('#color_' + data);
		selectColor(element);
		hs.close($(this).get(0));
		return false;
	});
	function selectColor(element){
		$("#fullPic").attr("src", element.attr("href"));
		var name = element.attr("title");
		$("#color_select").text(name);
		$("#offer_color").attr("value", name);
	}
	$(".add2cart").click(function(){
		addOffer(jQuery.parseJSON($(this).attr("data")));
		return false;
	});
	function addOffer(data){
		var id = 'accessory_' + data[0];
		if($('#'+id).length) return false;
		if(data[3]){
			meta = '<input type="hidden" name="offers[]" value="'+data[0]+'" />';
			parentId = "cart_offers";
		}else{
			meta = '<input type="hidden" name="gifts['+data[0]+']" value="'+data[2]+'" />';
			parentId = "cart_gifts";
			$('#'+parentId).empty();
		}
		$('#'+parentId).append(
			'<a id="'+id+'" class="catClose" data="'+data[1]+'" href="#"><img src="/images/catClose2.png" /></a><p>'+meta+data[2]+(data[3]?' - <b>'+data[3]+'</b>':'')+'</p>'
		);
		$(".catClose").each(function(){
			var events = $(this).data('events');
			if(!events){
				$(this).click(function(){
					del2cart($(this));
					return false;
				});
			};
		});
		updateTotal(data[1]);
	}
	function del2cart(element){
		var price = element.attr("data");
		if(price) updateTotal(-price);
		element.next().remove();
		element.remove();
	}
	function updateTotal(value){
		if(value){
			var total = getTotal();
			total += parseInt(value);
			$("#total_price").attr("data", total);
			$("#total_price").number(total, 1, ',', ' ');
			$("#total_price").append('. -');
		}
	}
	$("#color_select").click(function(){
		hs.htmlExpand(this, { contentId: 'colours_select' });
		return false;
	});
	$("#color-note").click(function(){
		hs.htmlExpand(this, { contentId: 'color-note-dialog' });
		return false;
	});
});
function getTotal(){
	return parseInt($("#total_price").attr("data"));
}
</script>
<div class="shopCatalog">
	<div class="catalog-path"><div><a href="<?=$arResult["SECTION"]["SECTION_PAGE_URL"]?>"><?=$arResult["SECTION"]["NAME"]?></a> <?if($arResult["IBLOCK_ID"] == 18):?> <!--noindex--><a rel="nofollow" class="compare-link" href="/market/compare/<?=$arResult["SECTION"]["ID"]?>/">Сравнить велогибриды данной серии</a><!--/noindex--><?endif?></div><div><?=$arResult["NAME"]?></div></div>
    <h1><?=$arResult["NAME"]?></h1>
    <div class="shopCatalogL">
		<?if(is_array($arResult["PREVIEW_PICTURE"]) || is_array($arResult["DETAIL_PICTURE"])):?>
			<table class="fullPic">
				<tr>
					<td>
						<?if($arResult["IBLOCK_ID"] == 18):?>
							<div class="label">
								<img alt="NANOPROTECH" src="/images/nano.png" class="tip" />
								<div class="tooltip">
									<a href="/nanoprotech/">
										Эта модель уже защищена смазкой NANOPROTECH
									</a>
								</div>
							</div>
						<?endif?>
						<?
							$arPicture = is_array($arResult["DETAIL_PICTURE"]) ? $arResult["DETAIL_PICTURE"] : $arResult["PREVIEW_PICTURE"];
							$width = $arResult["IBLOCK_ID"] == 27 ? "60%" : "100%";
						?>
						<?if($arResult["PROPERTIES"]["STATUS"]["VALUE"]):?>
							<img class="status-icon" src="/images/icons/<?=$arResult["PROPERTIES"]["STATUS"]["VALUE_XML_ID"]?>" />
						<?endif?>
						<img id="fullPic" border="0" src="<?=$arPicture["SRC"]?>" width="<?=$width?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
					</td>
				</tr>
			</table>
		<?endif;?>
		<?if($arResult['ACCESSORY']):?>
		<div class="accessories">
			<div class="addSlider">
				<div class="addSliderT">Подбор аксессуаров</div>
				<div class="addSliderB">
					<div class="addSliderIn" id="mycarousel">
						<ul class="jcarousel-skin-tango">
							<?foreach($arResult['ACCESSORY'] as $arAccessory):?>
							<li>
								<div class="preview-place">
									<a class="preview-picture<?if($arAccessory['DETAIL_PICTURE']['SRC']):?> link<?endif?>"<?if($arAccessory['DETAIL_PICTURE']['SRC']):?> href="<?=$arAccessory['DETAIL_PICTURE']['SRC']?>"<?endif?>>
										<img width="<?=$arAccessory['PREVIEW_PICTURE']['WIDTH']?>" height="<?=$arAccessory['PREVIEW_PICTURE']['HEIGHT']?>" src="<?=$arAccessory['PREVIEW_PICTURE']['SRC']?>" />
									</a>
								</div>
								<div class="hidDiv">
									<div class="hidDivT"><?=$arAccessory['NAME']?></div>
									<div class="hidDivM">&nbsp;</div>
									<div class="hidDivB">
										<p><?=$arAccessory['PRICE']?></p>
										<p><a data='<?=json_encode(array($arAccessory['ID'], $arAccessory['CATALOG_PRICE_1'], $arAccessory['NAME'], $arAccessory['PRICE']))?>' class="add2cart" href="#">Добавить к велогибриду</a></p>
									</div>
								</div>
							</li>
							<?endforeach?>
						</ul>
					</div>
				</div>
			</div>
			<div class="background">
				<div class="image"></div>
			</div>
		</div>
		<?endif?>		
		<?if($arResult["PROPERTIES"]["ACCESSORY"]["VALUE"]):?>
		<div class="accessories">
			<div class="addSlider">
				<div class="addSliderT">Фотографии</div>
				<div class="addSliderB">
					<div class="addSliderIn" id="mycarousel">
						<ul class="jcarousel-skin-tango">
							<?foreach($arResult["PROPERTIES"]["ACCESSORY"]["VALUE"] as $arAccessory):?>
							<li>
								<div class="preview-place">
									<a class="preview-picture<?if($arAccessory['DETAIL_PICTURE']['SRC']):?> link<?endif?>"<?if($arAccessory['DETAIL_PICTURE']['SRC']):?> href="<?=$arAccessory['DETAIL_PICTURE']['SRC']?>"<?endif?>>
										<img width="<?=$arAccessory['PREVIEW_PICTURE']['WIDTH']?>" height="<?=$arAccessory['PREVIEW_PICTURE']['HEIGHT']?>" src="<?=$arAccessory['PREVIEW_PICTURE']['SRC']?>" />
									</a>
								</div>
							</li>
							<?endforeach?>
						</ul>
					</div>
				</div>
			</div>
			<div class="background">
				<div class="image"></div>
			</div>
		</div>
		<?endif?>
		<?if($arResult['COLOUR']):?>
        <div class="addColors">
            <img id="color-note" src="/images/catQuest.png" />
            <span>Доступные цвета:</span>
			<table>
				<tr>
				<?foreach($arResult['COLOUR'] as $arColour):?>
					<td><a title="<?=$arColour['NAME']?>" id="color_<?=$arColour['ID']?>" class="preview-picture<?if($arAccessory['DETAIL_PICTURE']['SRC']):?> link<?endif?>"<?if($arColour['DETAIL_PICTURE']['SRC']):?> href="<?=$arColour['DETAIL_PICTURE']['SRC']?>"<?endif?>><img alt="<?=$arColour['NAME']?>" width="<?=$arColour['PREVIEW_PICTURE']['WIDTH']?>" height="<?=$arColour['PREVIEW_PICTURE']['HEIGHT']?>" src="<?=$arColour['PREVIEW_PICTURE']['SRC']?>" /></a></td>
				<?endforeach?>
				</tr>
			</table>
			<?$message="Нажмите на цвет, для просмотра фотографии модели в выбранном цвете."?>
			<div class="note"><?=$message?></div>
			<div id="color-note-dialog" class="dialog highslide-maincontent">
				<a class="dialog-header control" onclick="return hs.close(this)"><img src="/images/close.png" alt="закрыть" /></a>
				<div class="dialog-content">
					<?=$message?>
				</div>
			</div>
        </div>
		<?endif?>
    </div>
	<form method="post">
		<div class="shopCatalogR">
			<div class="top">
				<div class="blockToBuy">
					<p><b><?=$arResult["NAME"]?> - <?=$arResult["PRICES"]["BASE"]["PRINT_DISCOUNT_VALUE"]?></b></p>
					<div id="cart_offers"></div>
					<div id="cart_gifts"></div>
					<?if($arResult['COLOUR']):?>
						<?$arColour = reset($arResult['COLOUR'])?>
						<p>Цвет - <a href="#" id="color_select"><?=$arColour['NAME']?></a>.</p>
						<input type="hidden" name="color" id="offer_color" value="<?=$arColour['NAME']?>" />
						<div id="colours_select" class="colours-tooltip highslide-maincontent">
							<a onclick="return hs.close(this)" class="dialog-header"><img src="/images/close.png" alt="закрыть" /></a>
							<div class="dialog-content">
								<ul>
								<?foreach($arResult['COLOUR'] as $arColour):?>
									<li><span data="<?=$arColour['ID']?>"><?=$arColour['NAME']?></span></li>
								<?endforeach?>
								</ul>
							</div>
						</div>
					<?endif?>
					<span id="total_price" data="<?=$arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"]?>"><?=$arResult["PRICES"]["BASE"]["PRINT_DISCOUNT_VALUE"]?></span>
					<?if($arResult["PROPERTIES"]["YML_PRESENCE"]["VALUE"]=="Y"):?>
						<div>
							<input type="hidden" name="action" value="BUY" />
							<input type="hidden" name="id" value="<?=$arResult["ID"]?>" />
							<input class="buy-button" type="submit" value="Купить">
							<a class="shopCatalogQuest" href="#"><img src="/images/catQuest2.png" /></a>
							<input type="image" src="/images/catCart2.png" />
						</div>
					<?endif?>
				</div>
				<?if(in_array($arResult["PROPERTIES"]["YML_PRESENCE"]["VALUE_XML_ID"], array("Y", "D"))):?>
					<?if($arResult["PROPERTIES"]["YML_PRESENCE"]["VALUE_XML_ID"]=="Y"):?>
						<img class="offer-available" alt="" src="/images/n1.png" />
					<?elseif($arResult["PROPERTIES"]["YML_PRESENCE"]["VALUE_XML_ID"]=="D"):?>
						<img class="offer-available" alt="" src="/images/n3.png" />
					<?endif?>
					<div class="credit-button">
					  <a href="javascript:;" onclick='yescreditrequest([{MODEL: "<?=htmlspecialchars($arResult["NAME"])?>", COUNT:"1", PRICE:getTotal()}],366748);'>
						<img class="offer-available" alt="" src="/images/credit.png" />
					  </a>
					</div>
					<div class="catalog-detail-buttons"></div>
					<?$APPLICATION->IncludeComponent("site:one.click.buy", "quick", array(
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => "3",
						"ELEMENT_ID" => $arResult["ID"],
						"SEF_FOLDERIX" => "/catalog/",
						"ORDER_FIELDS" => array(
							0 => "FIO",
							1 => "PHONE",
							2 => "PHONE2",
						),
						"REQUIRED_ORDER_FIELDS" => array(
							0 => "FIO",
							1 => "PHONE",
							2 => "PHONE2",
						),
						"DEFAULT_PERSON_TYPE" => "",
						"DEFAULT_DELIVERY" => "0",
						"DEFAULT_PAYMENT" => "0",
						"DEFAULT_CURRENCY" => "RUB",
						"BUY_MODE" => "ALL",
						"PRICE_ID" => "1",
						"DUPLICATE_LETTER_TO_EMAILS" => array(
						),
						"CACHE_TYPE" => "N",
						"CACHE_TIME" => "864000",
						"USE_JQUERY" => "N",
						"INSERT_ELEMENT" => ".catalog-detail-buttons",
						"USE_SKU" => "N"
						),
						$component
					);?>
				<?else:?>
					<img class="offer-available" alt="" src="/images/n2.png" />
				<?endif?>
			</div>
		</div>
	</form>
    <div class="shopCatalogL">
        <div class="fullPicText tab" id="tab_1_cont">
			<div class="description">
				<?
					$text = $arResult["DETAIL_TEXT"] ? $arResult["DETAIL_TEXT"] : $arResult["PREVIEW_TEXT"];
					if($arResult["IBLOCK_ID"] == 18) $text = ReplaceTerms($text);
				?>
				<br /><?=$text?><br />
			</div>
			<table class="features">
				<tbody>
					<tr>
						<th>Основные характеристики</th>
						<th>&nbsp;</th>
					</tr>
					<?foreach($arResult["PROPERTIES"] as $arProperty):?>
						<?if($arProperty["NAME"][0] == "#" || !$arProperty["VALUE"]) continue?>
						<tr>
							<td><span><?=$arResult["IBLOCK_ID"]==18?ReplaceTerms($arProperty["NAME"]):$arProperty["NAME"]?></span></td>
							<td><?=$arResult["IBLOCK_ID"]==18?ReplaceTerms($arProperty["VALUE"]):$arProperty["VALUE"]?></td>
						</tr>
					<?endforeach?>
				</tbody>
			</table>
			<div class="add-info">
				<?if($arResult["PROMO_URL"]):?>
					<p><a href="<?=$arResult["PROMO_URL"]?>">Подробные характеристики см. на промо сайте</a></p>
				<?endif?>
				<p>Вы всегда можете получить подробную консультацию у наших специалистов по тел.: +7 (495) 799 06 46.</p>
			</div>
			<?if($arResult["PROPERTIES"]["PAGE_TEXT"]["VALUE"]["TEXT"]):?>
				<div>
					<br />
					<?=$arResult["PROPERTIES"]["PAGE_TEXT"]["VALUE"]["TEXT"]?>
				</div>
			<?endif?>
        </div>
		<?if($arResult["PROPERTIES"]["GIFT"]["VALUE"]):?>
			<div class="shopGiftCont" class="tab" id="tab_2_cont" style="display:none">
				<?$APPLICATION->IncludeFile(
					$APPLICATION->GetTemplatePath("/include/gift.php"),
					Array(),
					Array("MODE"=>"html")
				);?>
				<?
					global $arrGift; 
					$arrGift = array("IBLOCK_TYPE" => "offers", "ID" => $arResult["PROPERTIES"]["GIFT"]["VALUE"]);
				?>
				<?$APPLICATION->IncludeComponent(
					"site:catalog.section",
					"gift",
					Array(
						"AJAX_MODE" => "N",
						"IBLOCK_TYPE" => "offers",
						"IBLOCK_ID" => "",
						"SECTION_ID" => "",
						"SECTION_CODE" => "",
						"SECTION_USER_FIELDS" => array(),
						"ELEMENT_SORT_FIELD" => "sort",
						"ELEMENT_SORT_ORDER" => "asc",
						"FILTER_NAME" => "arrGift",
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
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "36000000",
						"CACHE_FILTER" => "Y",
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
				$component
				);?> 
			</div>
		<?endif?>
	</div>
	<div class="shopCatalogR">
		<?if($arResult["PROPERTIES"]["GIFT"]["VALUE"]):?>
        <div class="shopCatalogProds tabs">
            <ul>
				<li class="active"><a data="tab_1" href="#">Описание модели</a></li>
				<li><img src="/images/catGift2.png" /><a data="tab_2" href="#">Закажи подарок</a></li>
            </ul>
        </div>
		<?endif?>
		<?if($arResult["SITE_URL"]):?>
        <div class="shopItemInfo">
            <span>Информация на промо-сайтах</span>
            <ul>
                <?if($arResult["SITE_URL"]["MEDIA"]):?><li><a href="<?=$arResult["SITE_URL"]["MEDIA"]?>">Фото и видео</a></li><?endif?>
                <?if($arResult["SITE_URL"]["DETAIL"]):?><li><a href="<?=$arResult["SITE_URL"]["DETAIL"]?>">Фотодетали</a></li><?endif?>
                <?if($arResult["SITE_URL"]["MORE"]):?><li><a href="<?=$arResult["SITE_URL"]["MORE"]?>">Подробности</a></li><?endif?>
                <?if($arResult["SITE_URL"]["ARTICLES"]):?><li><a href="<?=$arResult["SITE_URL"]["ARTICLES"]?>">Статьи</a></li><?endif?>
                <?if($arResult["SITE_URL"]["DISCUSSION"]):?><li><a href="<?=$arResult["SITE_URL"]["DISCUSSION"]?>">Обсуждения</a></li><?endif?>
				<?if($arResult["SITE_URL"]["INFO"]):?><li><a href="<?=$arResult["SITE_URL"]["INFO"]?>">Инфограммы</a></li><?endif?>
            </ul>
        </div>
		<div class="clear"></div>
		<?endif?>
	</div>
</div>
<?if($arResult['NEAR_ELEMENTS'] || $arResult['PROPERTIES']['TUNING']['VALUE']):?>
<div class="shopChoose">
    <div class="shopChooseTabs">
        <ul>
            <?if($arResult['NEAR_ELEMENTS']):?><li class="dot"><a data="near" class="dot active" href="#">Похожие модели</a></li><?endif?>
            <?if($arResult['PROPERTIES']['TUNING']['VALUE']):?><li class="dot"><a data="tuning"<?if(!$arResult['NEAR_ELEMENTS']):?> class=" active"<?endif?> href="#">Тюнинг</a></li><?endif?>
        </ul>
    </div>
	<?if($arResult['NEAR_ELEMENTS']):?>
		<div class="shopChooseCont" id="shopChooseCont_near">
			<?
				global $arrFilter; 
				$arrFilter = array("IBLOCK_TYPE" => "offers", "ID" => $arResult['NEAR_ELEMENTS']);
			?>
			<?$APPLICATION->IncludeComponent(
				"site:catalog.section",
				"small",
				Array(
					"AJAX_MODE" => "N",
					"IBLOCK_TYPE" => "offers",
					"IBLOCK_ID" => "",
					"SECTION_ID" => "",
					"SECTION_CODE" => "",
					"SECTION_USER_FIELDS" => array(),
					"ELEMENT_SORT_FIELD" => "CATALOG_PRICE_1",
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
					"PAGE_ELEMENT_COUNT" => "3",
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
			$component
			);?>
		</div>
	<?endif?>
	<?if($arResult['PROPERTIES']['TUNING']['VALUE']):?>
		<div class="shopChooseCont" id="shopChooseCont_tuning"<?if($arResult['NEAR_ELEMENTS']):?> style="display:none"<?endif?>>
			<?
				global $arrFilter; 
				$arrFilter = array("IBLOCK_TYPE" => "offers", "ID" => $arResult['PROPERTIES']['TUNING']['VALUE']);
			?>
			<?$APPLICATION->IncludeComponent(
				"site:catalog.section",
				"small",
				Array(
					"AJAX_MODE" => "N",
					"IBLOCK_TYPE" => "offers",
					"IBLOCK_ID" => "",
					"SECTION_ID" => "",
					"SECTION_CODE" => "",
					"SECTION_USER_FIELDS" => array(),
					"ELEMENT_SORT_FIELD" => "CATALOG_PRICE_1",
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
					"PAGE_ELEMENT_COUNT" => "3",
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
			$component
			);?>
		</div>
	<?endif?>
</div>
<?endif?>