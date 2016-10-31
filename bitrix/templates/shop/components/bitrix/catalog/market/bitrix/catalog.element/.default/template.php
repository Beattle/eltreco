<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="shopCatalog">
	<div class="catalog-path">
		<div>
			<a class="section-name" href="<?=$arResult["SECTION"]["SECTION_PAGE_URL"]?>"><?=$arResult["SECTION"]["NAME"]?></a> 
			<?if($arResult["IBLOCK_ID"] == 18):?> <!--noindex--><a rel="nofollow" class="compare-link" href="/market/compare/<?=$arResult["SECTION"]["ID"]?>/">Сравнение моделей данной серии</a><!--/noindex--><?endif?>
			<?if(in_array($arResult["IBLOCK_ID"], array(24, 27))):?> 
			<!--noindex--> 
				<?foreach($arResult['FILTER_GROUPS'] as $arFilter):?>
					<a href="<?=$arFilter["URL"]?>"><?=$arFilter["NAME"]?></a>
				<?endforeach?>
			<!--/noindex-->
			<?endif?>
		</div>
		<div class="clear"><?=$arResult["NAME"]?></div>
	</div>
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
							<div class="status-icon">
								<?$text = $arResult["PROPERTIES"]["STATUS"]["VALUE"]["PREVIEW_TEXT"]?>
								<img <?if($text):?>class="tip"<?endif?> src="<?=$arResult["PROPERTIES"]["STATUS"]["VALUE"]["PREVIEW_PICTURE"]["SRC"]?>" />
								<?if($text):?>
									<div class="tooltip">
										<?=$text?>
									</div>
								<?endif?>
							</div>
						<?endif?>
						<img id="fullPic" border="0" src="<?=$arPicture["SRC"]?>" width="<?=$width?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
					</td>
				</tr>
			</table>
		<?endif;?>
		<?if($arResult["PROPERTIES"]["ACCESSORY"]["VALUE"] || $arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] || ($arResult["COLOUR"] && count($arResult["COLOUR"]) > 1)):?>
		<div class="accessories">
			<div class="addSlider">
				<div class="addSliderTitle">
					<?if($arResult["PROPERTIES"]["ACCESSORY"]["VALUE"]):?><div class="addSliderT" rel="tab_2"><span>Фотографии</span></div><?endif?>
					<?if($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]):?><div class="addSliderT" rel="tab_3"><span>Фотографии модели</span></div><?endif?>
					<?if($arResult["COLOUR"]):?><div class="addSliderT" rel="tab_4"><span>Показать доступные цвета</span></div><?endif?>
				</div>
				<div class="addSliderPages">
					<?if($arResult["PROPERTIES"]["ACCESSORY"]["VALUE"]):?>
						<div class="addSliderB tab_2_page photos">
							<div class="addSliderIn mycarousel">
								<ul class="jcarousel-skin-tango">
									<?foreach($arResult["PROPERTIES"]["ACCESSORY"]["VALUE"] as $arPhoto):?>
									<li style="width:<?=$arPhoto['PREVIEW_PICTURE']['WIDTH']?>px">
										<div class="preview-place <?=$arPhoto["CLASS"]?>">
											<a class="<?=$arPhoto["CLASS"]?> preview-picture<?if($arPhoto['DETAIL_PICTURE']['SRC']):?> link<?endif?>"<?if($arPhoto['DETAIL_PICTURE']['SRC']):?> href="<?=$arPhoto['DETAIL_PICTURE']['SRC']?>"<?endif?>>
												<img width="<?=$arPhoto['PREVIEW_PICTURE']['WIDTH']?>" height="<?=$arPhoto['PREVIEW_PICTURE']['HEIGHT']?>" src="<?=$arPhoto['PREVIEW_PICTURE']['SRC']?>" />
											</a>
										</div>
									</li>
									<?endforeach?>
								</ul>
							</div>
						</div>
					<?endif?>
					<?if($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]):?>
						<div class="addSliderB tab_3_page photos">
							<div class="addSliderIn mycarousel">
								<ul class="jcarousel-skin-tango">
									<?foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $arPhoto):?>
									<li style="width:<?=$arPhoto['PREVIEW_PICTURE']['WIDTH']?>px">
										<div class="preview-place <?=$arPhoto["CLASS"]?>">
											<a class="<?=$arPhoto["CLASS"]?> preview-picture<?if($arPhoto['DETAIL_PICTURE']['SRC']):?> link<?endif?>"<?if($arPhoto['DETAIL_PICTURE']['SRC']):?> href="<?=$arPhoto['DETAIL_PICTURE']['SRC']?>"<?endif?>>
												<img width="<?=$arPhoto['PREVIEW_PICTURE']['WIDTH']?>" height="<?=$arPhoto['PREVIEW_PICTURE']['HEIGHT']?>" src="<?=$arPhoto['PREVIEW_PICTURE']['SRC']?>" />
											</a>
										</div>
									</li>
									<?endforeach?>
								</ul>
							</div>
						</div>
					<?endif?>
					<?if($arResult["COLOUR"]):?>
						<div class="addSliderB tab_4_page photos select-color">
							<div class="addSliderIn mycarousel">
								<ul class="jcarousel-skin-tango">
									<?foreach($arResult['COLOUR'] as $arColour):?>
									<li style="width:<?=$arColour['PREVIEW_PICTURE']['WIDTH']?>px">
										<div class="preview-place">
											<a title="<?=$arColour['NAME']?>" id="color_<?=$arColour['ID']?>" class="preview-picture<?if($arColour['DETAIL_PICTURE']['SRC']):?> link<?endif?>"<?if($arColour['DETAIL_PICTURE']['SRC']):?> href="<?=$arColour['DETAIL_PICTURE']['SRC']?>"<?endif?>>
												<img width="<?=$arColour['PREVIEW_PICTURE']['WIDTH']?>" height="<?=$arColour['PREVIEW_PICTURE']['HEIGHT']?>" src="<?=$arColour['PREVIEW_PICTURE']['SRC']?>" />
											</a>
										</div>
									</li>
									<?endforeach?>
								</ul>
							</div>
						</div>
					<?endif?>
				</div>
			</div>
			<div class="background">
				<div class="image"></div>
			</div>
		</div>
		<?endif?>		
    </div>
	<form method="post">
		<div class="shopCatalogR">
			<div class="top">
				<div class="blockToBuy">
					<p><b id="offer_name" rel="<?=$arResult["ID"]?>"><?=$arResult["NAME"]?></b><b> - <?=$arResult["PRICES"]["BASE"]["PRINT_DISCOUNT_VALUE"]?></b></p>
					<div id="cart_offers"></div>
					<div id="cart_gifts"></div>
					<?if($arResult['COLOUR']):?>
						<?$arColour = reset($arResult['COLOUR'])?>
						<p>Цвет - <a id="color_select"><?=$arColour['NAME']?></a>.</p>
						<?if(count($arResult['COLOUR']) > 1):?>
							<a href="#" class="color_select">Выбрать другой цвет</p>
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
					<?endif?>
					<span id="total_price" data="<?=$arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"]?>"><?=$arResult["PRICES"]["BASE"]["PRINT_DISCOUNT_VALUE"]?></span>
					<?if(in_array($arResult["PROPERTIES"]["YML_PRESENCE"]["VALUE_XML_ID"], array("Y", "D"))):?>
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
						<?if($arResult["PROPERTIES"]["STATUS_TEXT"]["VALUE"]):?>
							<div class="status-text">
								<?echo $arResult["PROPERTIES"]["STATUS_TEXT"]["~VALUE"] ?>
							</div>
						<?else:?>
							<img class="offer-available" alt="" src="/images/n3.png" />
						<?endif?>
					<?endif?>
					<div class="credit-button">
						<a href="#" onclick="return prepareCredit(this)">
							<img class="offer-available" alt="" src="/images/credit2.png" />
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
					<?if($arResult["PROPERTIES"]["SPB_PRESENCE"]["VALUE_XML_ID"]=="Y"):?>
						<div class="spb-available"><? require($_SERVER["DOCUMENT_ROOT"].'/include/spb.php') ?></div>
					<?endif?>
				<?endif?>
			</div>
		</div>
	</form>
	<div class="wide-content">
		<?if($arResult['BLOCKS']):?>
			<div class="blocks">
				<table class="background"><tr><td class="bl">&nbsp;</td><td class="bc">&nbsp;</td><td class="br">&nbsp;</td></tr></table>
				<div class="addSlider2">
					<div class="addSliderB2">
						<div class="addSliderIn2 mycarousel">
							<ul class="jcarousel-skin-tango">
								<?foreach($arResult['BLOCKS'] as $arBlock):?>
								<li>
									<table class="preview-place">
										<?if($arBlock['PREVIEW_TEXT']):?>
											<tr><td>
											<?if($arBlock['PROPERTY_LINK_VALUE']):?>
												<a href="<?=$arBlock['PROPERTY_LINK_VALUE']?>">
											<?endif?>
											<?=$arBlock['PREVIEW_TEXT']?>											
											<?if($arBlock['PROPERTY_LINK_VALUE']):?>
												</a>
											<?endif?>
											</td></tr>
										<?endif?>
										<tr><td class="picture-cell">
											<a style="width: <?=$arBlock['PREVIEW_PICTURE']['WIDTH']?>px" class="preview-picture link"<?if($arBlock['PROPERTY_LINK_VALUE']):?> href="<?=$arBlock['PROPERTY_LINK_VALUE']?>"<?endif?>>
												<img width="<?=$arBlock['PREVIEW_PICTURE']['WIDTH']?>" height="<?=$arBlock['PREVIEW_PICTURE']['HEIGHT']?>" src="<?=$arBlock['PREVIEW_PICTURE']['SRC']?>" />
											</a>
										</td></tr>
									</table>
								</li>
								<?endforeach?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		<?endif?>
		<div class="description">
			<?
				$text = $arResult["DETAIL_TEXT"] ? $arResult["DETAIL_TEXT"] : $arResult["PREVIEW_TEXT"];
				$items = explode("\n", trim($text), 2);
				$text = trim($items[1]);
				if($arResult["IBLOCK_ID"] == 18) ReplaceTerms($text);
			?>
			<?=trim($items[0])?>
			<br /><span class="show-more">Показать полное описание модели</span><span class="show-more2">Скрыть полное описание модели</span>
			<div class="clear"></div>
			<div class="more">
				<?=$text?>
				<?if($arResult["PROPERTIES"]["ARTICLE"]["VALUE"]):?>
					<div>Артикул: <?=$arResult["PROPERTIES"]["ARTICLE"]["VALUE"]?></div>
				<?endif?>
			</div>
		</div>
		<div class="boxes">
			<? require($_SERVER["DOCUMENT_ROOT"].'/include/boxes/market.php') ?>
		</div>
	</div>
</div>