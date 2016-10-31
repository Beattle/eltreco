<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?echo "<pre>";
//print_r($arResult["PROPERTIES"]["MORE_PHOTO"]);
echo "</pre>";
?>
<div class="shopCatalog item">
	<div class="caption">
			<div class="caption-name"><a href="<?=$arResult["SECTION"]["LIST_PAGE_URL"]?>"><?=$arResult["IBLOCK_NAME"]?></a></div>
			<a class="section-name" href="<?=$arResult["SECTION"]["SECTION_PAGE_URL"]?>"><?=$arResult["SECTION"]["NAME"]?></a> 
			<h1><?=$arResult["NAME"]?></h1>
			<?if($arResult["IBLOCK_ID"] == 18):?> <!--noindex--><a rel="nofollow" class="item-compare" href="/market/compare/<?=$arResult["SECTION"]["ID"]?>/">Сравнение моделей данной серии</a><!--/noindex--><?endif?>
			<?if(in_array($arResult["IBLOCK_ID"], array(24, 27))):?> 
			<!--noindex--> 
				<?foreach($arResult['FILTER_GROUPS'] as $arFilter):?>
					<a href="<?=$arFilter["URL"]?>"><?=$arFilter["NAME"]?></a>
				<?endforeach?>
			<!--/noindex-->
			<?endif?>
		<div class="clear"></div>
	</div>

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
						<div class="fullPic-prev"></div>
						<img id="fullPic" border="0" src="<?=$arPicture["SRC"]?>" width="<?=$width?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
						<div class="fullPic-next"></div>
					</td>
				</tr>
			</table>
		<?endif;?>
				
    </div>
	<form method="post">
		<div class="shopCatalogR">
			<div class="top">
				<div class="blockToBuyNew">
					<p style="display:none;"><b id="offer_name" rel="<?=$arResult["ID"]?>"><?=$arResult["NAME"]?></b><b> - <?=$arResult["PRICES"]["BASE"]["PRINT_DISCOUNT_VALUE"]?></b></p>
                                        <?if($arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"]!=$arResult["PRICES"]["BASE"]["VALUE"]):
					$arDiscounts = CCatalogDiscount::GetDiscountByProduct(
						$arResult["ID"],
						$GLOBALS["USER"]->GetUserGroupArray(),
						"N",
						1,
						SITE_ID
					    );

 				        $stmp = MakeTimeStamp($arDiscounts[0]["ACTIVE_TO"], "DD.MM.YYYY HH:MI:SS");
                                        $to = FormatDate("d F",$stmp);

										?>
                                        <div class="old_price strikethrough"><?=str_replace('.-','',$arResult["PRICES"]["BASE"]["PRINT_VALUE"])?><span class="rubznak">a</span></div>
					<div class="action">Акция до <?=$to?></div>
                                        <?endif?>
					<div id="cart_offers"></div>
					<div id="cart_gifts"></div>
					<span id="total_price" data="<?=$arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"]?>"><?=str_replace('.-','',$arResult["PRICES"]["BASE"]["PRINT_DISCOUNT_VALUE"])?><span class="rubznak">c</span></span>
                                        <?if($arResult['COLOUR']):?>
						<?$arColour = reset($arResult['COLOUR']);
                                                  $firstId =  $arColour["ID"];?>
                                                <span class="color">Цвет</span><br/>
						<?if(count($arResult['COLOUR']) > 1):?>
							<input type="hidden" name="color" id="offer_color" value="<?=$arColour['NAME']?>" />
							<div id="colours_select" class="colors">
								<div class="dialog-content">
									<ul>
									<?$i = 0;
									foreach($arResult['COLOUR'] as $arColour):
										//print_r($arColour);
                                                                             $bckgr = '';
if($arColour["COLOR_PIC"]['src']) $bckgr = "background:url('".$arColour["COLOR_PIC"]['src']."') no-repeat;background-size:cover;";
                                                                             if(!$bckgr) $bckgr = $arColour["PROPERTY_HEX_VALUE"]?"background-color:".$arColour["PROPERTY_HEX_VALUE"].";":"background-color:#fff;border:1px solid #ccd9e2;";
									?>
										<li><span title="<?=$arColour["NAME"]?>" class="colli<?=$firstId == $arColour["ID"]?" active":''?>" style="<?=$bckgr?>" data="<?=$arColour['ID']?>" id="<?=$arColour['ID']?>">&nbsp;</span></li>
									<?endforeach?>
									</ul>
                                                                        <div class="clear"></div>
								</div>
							</div>
						<?endif?>
					<?endif?>
					
				</div>
				<?if(in_array($arResult["PROPERTIES"]["YML_PRESENCE"]["VALUE_XML_ID"], array("Y", "D"))):?>
					<?if($arResult["PROPERTIES"]["YML_PRESENCE"]["VALUE_XML_ID"]=="Y"):?>
						<img class="offer-available" alt="" src="/images/instock.png" />
					<?elseif($arResult["PROPERTIES"]["YML_PRESENCE"]["VALUE_XML_ID"]=="D"):?>
						<?if($arResult["PROPERTIES"]["STATUS_TEXT"]["VALUE"]):?>
							<div class="status-text">
								<?echo $arResult["PROPERTIES"]["STATUS_TEXT"]["~VALUE"] ?>
							</div>
						<?else:?>
							<img class="offer-available" alt="" src="/images/n3.png" />
						<?endif?>
					<?endif?>
					<?if(in_array($arResult["PROPERTIES"]["YML_PRESENCE"]["VALUE_XML_ID"], array("Y", "D"))):?>
						<div class="buy">
							<input type="hidden" name="action" value="BUY" />
							<input type="hidden" name="id" value="<?=$arResult["ID"]?>" />
							<input class="buy-button" type="submit" value="Купить">
						</div>
						<?/* Убрать "Купить в рассрочку"
						<div class="paylate-button">
							<img class="paylate-available tip" alt="" src="/images/buy_in_paylate.png" />
							<div class="tooltip">
								<? require($_SERVER["DOCUMENT_ROOT"].'/include/paylate.php') ?>
							</div>
						</div>
						*/?>
					<?endif?>
					<div class="credit-button">
						<a href="#" onclick="return prepareCredit(this)">
							<img class="offer-available" alt="" src="/images/buy_in_credit.png" />
						</a>
					</div>
					<div class="catalog-detail-buttons"></div>
					<?$APPLICATION->IncludeComponent("site:one.click.buy", "eltreco", array(
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => "3",
						"ELEMENT_ID" => $arResult["ID"],
						"SEF_FOLDERIX" => "/catalog/",
						"ORDER_FIELDS" => array(
							0 => "FIO",
							1 => "PHONE",
						),
						"REQUIRED_ORDER_FIELDS" => array(
							0 => "FIO",
							1 => "PHONE",
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
<?if($arResult["PROPERTIES"]["ACCESSORY"]["VALUE"] || $arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] || ($arResult["COLOUR"] && count($arResult["COLOUR"]) > 1)):?>
<?if(!empty($arResult['PROPERTIES']['YOUTUBE']['VALUE'])): $isVideo = true;?><div class="smallSlide"><?endif?>
		<div class="accessories">
			<div class="addSlider">
				<div class="addSliderTitle header">
					<?if($arResult["PROPERTIES"]["ACCESSORY"]["VALUE"]):?><div class="sliderTab" rel="tab_2"><span>Фотографии</span></div><?endif?>
					<?if($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]):?><div class="sliderTab" rel="tab_3"><span>Фотографии модели</span></div><?endif?>
					<?if($arResult["COLOUR"]):?><div class="sliderTab" rel="tab_4"><span>доступные цвета</span></div><?endif?>
				</div>
                                <div class="newslider">
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
					<?if($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]):
						if($isVideo):?>
						<div class="addSliderB tab_3_page photos">
							<div class="addSliderIn divslide mycarousel">
								<ul class="jcarousel-skin-tango">
									<?foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $cell => $arPhoto):?>

									<?if($cell%9 == 0):?><li style="width:420px"><?endif?>
										<div class="slide">
											<a class="<?=$arPhoto["CLASS"]?> preview-picture<?if($arPhoto['DETAIL_PICTURE']['SRC']):?> link<?endif?>"<?if($arPhoto['DETAIL_PICTURE']['SRC']):?> href="<?=$arPhoto['DETAIL_PICTURE']['SRC']?>"<?endif?>>
												<img width="120px" src="<?=$arPhoto['PREVIEW_PICTURE']['SRC']?>" />
											</a>
										</div>
									<?if(++$cell%9 == 0):?></li><?endif?>
									<?endforeach?>
                                                                        <?if($cell%9 != 0):?>
                                                                             <?while(($cell++)%9 != 0):?>
											<div class="slide">&nbsp;</div>
										<?endwhile;?>
										</li>
									<?endif?>
								</ul>
							</div>
						</div>
                                                <?else:?>
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
					<?endif?>
					<?if($arResult["COLOUR"]):?>
                                             <?if($isVideo):?>
						<div class="addSliderB tab_4_page photos select-color">
							<div class="addSliderIn divslide mycarousel">
								<ul class="jcarousel-skin-tango">
									<?$cell = 0;
                                                                         foreach($arResult['COLOUR'] as $arColour):?>

									<?if($cell%9 == 0):?><li style="width:420px"><?endif?>
										<div class="slide">
											<a title="<?=$arColour['NAME']?>" id="color_<?=$arColour['ID']?>" class="preview-picture<?if($arColour['DETAIL_PICTURE']['SRC']):?> link<?endif?>"<?if($arColour['DETAIL_PICTURE']['SRC']):?> href="<?=$arColour['DETAIL_PICTURE']['SRC']?>"<?endif?>>
												<img width="<?=$arColour['PREVIEW_PICTURE']['WIDTH']?>" height="<?=$arColour['PREVIEW_PICTURE']['HEIGHT']?>" src="<?=$arColour['PREVIEW_PICTURE']['SRC']?>" />
											</a>
										</div>
									<?if(++$cell%9 == 0):?></li><?endif?>
									<?endforeach?>
                                                                        <?if($cell%9 != 0):?>
                                                                             <?while(($cell++)%9 != 0):?>
											<div class="slide">&nbsp;</div>
										<?endwhile;?>
										</li>
									<?endif?>
								</ul>
							</div>
						</div>
                                                <?else:?>
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
					<?endif?>
				</div>
                                </div>
			</div>
		</div>
<?if($isVideo):?></div>
        <div class="videoBlock">
		<div class="videocarousel mycarousel">
			<ul class="jcarousel-skin-tango">
		<?foreach($arResult['PROPERTIES']['YOUTUBE']['VALUE'] as $video):?>
		            <li style="width:560px">
			       <iframe class="item" width="560" height="315" src="//www.youtube.com/embed/<?=$video?>?rel=0" frameborder="0" allowfullscreen></iframe>
		           </li>
		<?endforeach?>
			</ul>
		</div>
        <a class="youlink" href="https://www.youtube.com/user/EltrecoRu">Больше видео о продукции Eltreco смотрите на нашем канале</a><br/><br/>
        </div>
<?endif?>                
		<?endif?>
                <div class="clear"></div>
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
			<?if(!empty($arResult["SPEC_PICS"])):?>
			<table class="spec_pics">
				<?foreach($arResult["SPEC_PICS"] as $cell => $specPic):?>
                                <?if($cell%5 == 0):?>
				<tr>
				<?endif;?>
				<td class="spec_img"><img src="<?=$specPic["PREVIEW_PICTURE"]["src"]?>"></td>
				<td class="spec_pic">	<span><?=$specPic["NAME"]?></span><br/>
					<?=$specPic["PREVIEW_TEXT"]?>
                                </td>
                                <?$cell++;
				if($cell%5 == 0):?>
					</tr>
				<?endif?>
				<?endforeach?>
				<?if($cell%5 != 0):?>
				<?while(($cell++)%5 != 0):?>
					<td>&nbsp;</td>
				<?endwhile;?>
				</tr>
				<?endif?>

			</table>
                        <br/>
                        <?endif?>
			<?
				$text = $arResult["DETAIL_TEXT"] ? $arResult["DETAIL_TEXT"] : $arResult["PREVIEW_TEXT"];
				$items = explode("\n", trim($text), 2);
				$text = trim($items[1]);
				if($arResult["IBLOCK_ID"] == 18) {
					$text = ReplaceTerms($text);
				}
			?>
			<div class="clear"></div>
				<?$isspec = false;
                                  foreach($arResult["PROPERTIES"] as $arProperty):
					if($arProperty["NAME"][0] == "#" || !$arProperty["VALUE"]) continue;
					else $isspec = true;
				endforeach?>
                        <?if($isspec):?>
                        <div class="specifications">
		                <div class="header">Технические характеристики</div>
		                        <br/>
					<ul>
					<?foreach($arResult["PROPERTIES"] as $arProperty):?>
						<?if($arProperty["NAME"][0] == "#" || !$arProperty["VALUE"]) continue?>
						<li><span>
													<?=$arResult["IBLOCK_ID"]==18?ReplaceTerms($arProperty["NAME"]):$arProperty["NAME"]?> <?=$arResult["IBLOCK_ID"]==18?ReplaceTerms($arProperty["VALUE"]):$arProperty["VALUE"]?>
						</span></li>
					<?endforeach?>
					</ul>
			</div>
                        <?endif?>
                        <?if($text || $items[0]):?>
			<div class="more<?=$isspec?'':' wide'?>">
		                <div class="header">Описание</div>
                                        <?if($items[0]):?><p><?=trim($items[0])?></p>
                                        <?endif?>
					<?=$text?>
					<?if($arResult["PROPERTIES"]["ARTICLE"]["VALUE"]):?>
						<div>Артикул: <?=$arResult["PROPERTIES"]["ARTICLE"]["VALUE"]?></div>
					<?endif?>
					<div>Вид товара: <?=$arResult["IBLOCK_NAME"]?>, идентификатор: <?=$arResult["ID"]?></div>
			</div>
                        <?endif?>
			<div class="clear"></div>
		</div>
	</div>
</div>
<div class="clear"></div>
