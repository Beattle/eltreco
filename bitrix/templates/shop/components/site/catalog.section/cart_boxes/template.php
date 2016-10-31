<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
	<div class="catalog-item">
		<div class="item-place">
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
			<em><?=$arElement["PRICES"]["BASE"]["PRINT_DISCOUNT_VALUE"]?></em>
		</div>
	</div>
<?endforeach?>
<div id="cart_offers_stub" style="display:none">
	<ul>
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
			<li><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a> <?=$arElement["PRICES"]["BASE"]["PRINT_DISCOUNT_VALUE"]?></li>
		<?endforeach?>
	</ul>
</div>