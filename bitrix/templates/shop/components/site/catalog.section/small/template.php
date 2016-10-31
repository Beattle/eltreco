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
			<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
				<em><?=$arElement["PRICES"]["BASE"]["PRINT_DISCOUNT_VALUE"]?></em>
			</a>
		</div>
	</div>
<?endforeach?>