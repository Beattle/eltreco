<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog-section">
  <?if($arResult["UF_PROMO_TEXT"]):?>
    <div class="promo-link">
      <a href="http://<?=$arResult["UF_PROMO_URL"]?>"><?=$arResult["UF_PROMO_TEXT"]?></a>
    </div>
    <div class="clear"></div>
  <?endif?>
	<ul>
		<? $i = 0 ?>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<? $j = 0; unset($sProperties); ?>
			<?foreach($arItem["COMPLETE"] as $arElement):?>
				<?
				if ($arElement["CODE"]) $arElement["DETAIL_PAGE_URL"] = rtrim($arItem["DETAIL_PAGE_URL"], '/') . "/" . $arElement["CODE"] . "/";
				
				if (!$arElement["PROPERTIES"]["FEATURES"]["VALUE"]) $arElement["PROPERTIES"]["FEATURES"]["VALUE"] = Array(); 
				if (!$arElement["PROPERTIES"]["FEATURES2"]["VALUE"]) $arElement["PROPERTIES"]["FEATURES2"]["VALUE"] = Array();
				$arProperties = array_merge($arElement["PROPERTIES"]["FEATURES"]["VALUE"], $arElement["PROPERTIES"]["FEATURES2"]["VALUE"]);

				if ($j++ == 0)
				{
					$arBase = $arProperties;
				}
				else
				{
					$arFeatures = Array();
					foreach(array_diff($arProperties, $arBase) as $propertyId)
					{
						$arFeatures[] = $_REQUEST["FEATURES"][$propertyId]["NAME"];
					}
					$sProperties = implode($arFeatures, ', ');
				}
				?>
				<?if($i++==3):$i=1?><li class="clear" /><?endif?>
				<li>
					<table class="offer-item">
						<tr>
							<? $arPicture = $arElement["PREVIEW_PICTURE"] ? $arElement["PREVIEW_PICTURE"] : $arItem["PREVIEW_PICTURE"]; ?>
							<? if (!$arPicture) $arPicture = array("SRC" => "/images/process.jpg", "WIDTH" => 190, "HEIGHT" => 190);  ?>
							<td class="offer-picture">
								<?if($arElement["DETAIL_PAGE_URL"]):?>
									<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arPicture["SRC"]?>" width="<?=$arPicture["WIDTH"]?>" height="<?=$arPicture["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a>
								<?else:?>
									<img border="0" src="<?=$arPicture["SRC"]?>" width="<?=$arPicture["WIDTH"]?>" height="<?=$arPicture["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
								<?endif?>
							</td>
						</tr>
						<tr>
							<td class="offer-name">
								<?if($arElement["DETAIL_PAGE_URL"]):?>
									<a class="link" href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a>
								<?else:?>
									<?=$arElement["NAME"]?>
								<?endif?>
								<div class="price"><?if($arElement["PRICES"]["BASE"]["DISCOUNT_VALUE"] > 1) echo "Цена: <b>" . $arElement["PRICES"]["BASE"]["PRINT_DISCOUNT_VALUE"] . "</b>" ?></div>
							</td>
						</tr>
						<?if($arElement["PREVIEW_TEXT"]):?>
						<tr>
							<td class="offer-description"><?=$arElement["PREVIEW_TEXT"]?></td>
						</tr>
						<?endif?>						
						<?if($sProperties):?>
						<tr>
							<td class="offer-description"><?=$sProperties?></td>
						</tr>
						<?endif?>
						<tr>
							<td class="incart">
								<form method="post" action="<?=$arElement["DETAIL_PAGE_URL"]?>">
									<?if($arElement["DETAIL_PAGE_URL"]):?>
										<input type="hidden" name="action" value="BUY2" />
									<?else:?>
										<input type="hidden" name="action" value="BUY" />
									<?endif?>
									<input type="hidden" name="id" value="<?=$arElement["ID"]?>" />
									<div class="submit">
										<input type="submit" value="Купить в Интернет-магазине" />
									</div>
								</form>
							</td>
						</tr>
						<tr>
							<td class="offer-available">
								<div class="available available_<?=$arElement["AVAILABLE"]["VALUE"]?>">
									<?=$arElement["AVAILABLE"]["TEXT"]?>
								</div>
							<td>
						</tr>	
					</table>
				</li>
			<?endforeach;?>
		<?endforeach;?>
	</ul>
	<div class="clear"></div>
</div>
