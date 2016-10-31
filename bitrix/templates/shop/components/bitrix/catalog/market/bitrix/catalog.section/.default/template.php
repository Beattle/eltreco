<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!count($arResult["ITEMS"])):?>
	<h2 class="notfound">Ничего не найдено, необходимо изменить параметры поиска</h2>
<?else:?>
	<?/*
	<script type="text/javascript">
	jQuery(document).ready(function() {
		$(".shopCatalogItemT").click(function(){
			var hid = $(this).parent().find('.shopCatalogHid');
			if(hid.length > 0){
				hid.show('slow');
				return false;
			}
		});
		$(".shopCatalogHid .catClose").click(function(){
			$(this).parent().hide('slow');
			return false;
		});
	});
	</script>
	*/?>
	<?if($arParams["DISPLAY_TOP_PAGER"]):?>
		<div class="clear"><?=$arResult["NAV_STRING"]?></div>
	<?endif;?>
	<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
		<div class="shopCatalogItem">
			<div class="item-place">
				<?if($arElement["PROPERTIES"]["STATUS"]["VALUE"]):?>
					<div class="status-icon">
						<?$text = $arElement["PROPERTIES"]["STATUS"]["VALUE"]["PREVIEW_TEXT"]?>
						<img <?if($text):?>class="tip"<?endif?> src="<?=$arElement["PROPERTIES"]["STATUS"]["VALUE"]["PREVIEW_PICTURE"]["SRC"]?>" />
						<?if($text):?>
							<div class="tooltip">
								<?=$text?>
							</div>
						<?endif?>
					</div>
				<?endif?>
				<div class="shopCatalogItemT">
					<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
						<?if($arElement["PREVIEW_PICTURE"]):?>
							<img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
						<?else:?>
							<img border="0" src="/images/noimg.jpg" width="250" height="190" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
						<?endif?>
						<span><?=$arElement["NAME"]?></span>
					</a>
				</div>
				<div class="shopCatalogItemB">
					<div class="shopCatalogPrice"><?=$arElement["PRICES"]["BASE"]["PRINT_DISCOUNT_VALUE"]?></div>
					<?if($arElement["PROPERTIES"]["GIFT"]["VALUE"]):?>
						<img src="/images/catGift.png" />
					<?endif?>
					<?if(in_array($arElement["PROPERTIES"]["YML_PRESENCE"]["VALUE_XML_ID"], array("Y", "D"))):?>
						<a class="shopCatalogCart" href="<?echo $arElement["BUY_URL"]?>" rel="nofollow"><img src="/images/catCart.png" /></a>
						<a class="shopCatalogQuest" href="#"><img src="/images/catQuest.png" /></a>
					<?else:?>
						<?if($arElement["PROPERTIES"]["SPB_PRESENCE"]["VALUE_XML_ID"]=="Y"):?>
							<div class="spb-available"><? require($_SERVER["DOCUMENT_ROOT"].'/include/spb.php') ?></div>
						<?else:?>
							<strong class="not-available">Нет в наличии</strong>
						<?endif?>
					<?endif?>
					<?unset($features)?>
					<?$counter=0?>
					<?foreach($arElement["PROPERTIES"] as $arProperty){
						if($arProperty["NAME"][0] == "#" || !$arProperty["VALUE"]) continue;
						$features .= "<p>$arProperty[NAME]: $arProperty[VALUE]</p>";
						if($counter++ > 2) break;
					}?>
					<?/*if($features):?>
						<div class="shopCatalogHid">
							<a class="catClose" href="#"><img src="/images/catClose.png" /></a>
							<p><b>Характеристики:</b></p>
							<?=$features?>
							<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">Узнать больше</a>
						</div>
					<?endif*/?>
				</div>
			</div>
		</div>
	<?endforeach?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<div class="clear"><?=$arResult["NAV_STRING"]?></div>
	<?endif;?>
<?endif;?>