<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
echo ShowError($arResult["ERROR_MESSAGE"]);
//echo GetMessage("STB_ORDER_PROMT"); ?>

<div class="vg-row cart-main-block">
         <div class="vg-row">
             <div class="vg-row ">
                <div class="market-caption">
                <div class="market modern-wrapper">
                    <table class="table">
                        <tbody>
                        <tr>
                           <td style="width:400px;">
                              <div class="caption">Корзина</div>
                           </td>
                           <td>
                              <div class="selName col-white">
                                 Для того чтобы начать оформление заказа, нажмите кнопку "Оформить заказ".
                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                </div>
              </div>
            </div>

<div class="vg-row">
<table class="cart-list">
	<tr>
		<td width="200"></td>
		<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
			<td><?= GetMessage("SALE_NAME")?></td>
		<?endif;?>
		<?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>
			<td><?= GetMessage("SALE_PROPS")?></td>
		<?endif;?>
		<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
			<td><?= GetMessage("SALE_PRICE")?></td>
		<?endif;?>
		<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
			<td><?= GetMessage("SALE_PRICE_TYPE")?></td>
		<?endif;?>
		<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
			<td><?= GetMessage("SALE_DISCOUNT")?></td>
		<?endif;?>
		<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
			<td class="vg-alignc"><?= GetMessage("SALE_QUANTITY")?></td>
		<?endif;?>
		<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
			<td width="260"  class="vg-alignc"><?= GetMessage("SALE_DELETE")?></td>
		<?endif;?>
		<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
			<td><?= GetMessage("SALE_OTLOG")?></td>
		<?endif;?>
		<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
			<td><?= GetMessage("SALE_WEIGHT")?></td>
		<?endif;?>
	</tr>
	<?
	$i=0;
	foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arBasketItems)
	{
		?>
		<tr class="line-green-b">
			
			<td>

				<a href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>" class="a-title"><img src="<?=$arBasketItems["PREVIEW_PICTURE_SRC"]?>" alt="" width="160" /></a></td>
			
			<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
				<td>
				<? 
				if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
					?><a href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>"><?
				endif;
				 ?>
				<b><?=$arBasketItems["NAME"] ?></b><?
				if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
					?></a><?
				endif;
				?></td>
			<?endif;?>
			<?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>
				<td>
				<?
				foreach($arBasketItems["PROPS"] as $val)
				{
					echo $val["NAME"].": ".$val["VALUE"]."<br />";
				}
				?>
				</td>
			<?endif;?>
			<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
				<td class="td-price"><?=$arBasketItems["PRICE_FORMATED"]?></td>
			<?endif;?>
			<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
				<td><?=$arBasketItems["NOTES"]?></td>
			<?endif;?>
			<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
				<td><?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?></td>
			<?endif;?>
			<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
				<td class="vg-alignc">
                     <div class="vg-counts">
                         <input type="text" name="QUANTITY_<?=$arBasketItems["ID"] ?>" value="<?=$arBasketItems["QUANTITY"]?>" id="QUANTITY_CART" value="1" />
                         <a href="" class="vg-count-mp minus">-</a>
                         <a href="" class="vg-count-mp plus">+</a>
<script type="text/javascript">
$(document).ready(function(){
	$('a.vg-count-mp.minus').on('click', function(e){
		count = parseInt($('#QUANTITY_CART').val());
		if (count > 1){count = count - 1;}
		$('#QUANTITY_CART').val(count);
		return false;
	});
	
	$('a.vg-count-mp.plus').on('click', function(e){
		count = parseInt($('#QUANTITY_CART').val());
		count += 1;
		$('#QUANTITY_CART').val(count);
		return false;
	});	
});
</script>						 
                     </div>
					
			</td>
			<?endif;?>
			<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
				<td class="vg-alignc">
<?/*?>
					<input type="checkbox" name="DELETE_<?=$arBasketItems["ID"] ?>" id="DELETE_<?=$i?>" value="Y">
<?*/?>

<?
	if($_REQUEST["action"] == 'delete' && $_REQUEST["id"]){
		CSaleBasket::Delete($_REQUEST["id"]);
	}
?>
					<a href="?action=delete&id=<?=$arBasketItems["ID"] ?>"  class="vg-delete"></a>	
				</td>
			<?endif;?>
			<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
				<td align="center"><input type="checkbox" name="DELAY_<?=$arBasketItems["ID"] ?>" value="Y"></td>
			<?endif;?>
			<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
				<td align="right"><?=$arBasketItems["WEIGHT"] ?> <?=(strlen($arParams["WEIGHT_UNIT"]) > 0 ? $arParams["WEIGHT_UNIT"] : GetMessage("SALE_WEIGHT_G"))?></td>
			<?endif;?>
		</tr>
		<?
		$i++;
	}
	?>
 

 

                     <tr>
                         <td>
                             <input type="submit" value="       обновить       " name="BasketRefresh" class="vg-reload">
                         </td>
						 <td>&nbsp;</td>
                         <td colspan="2">						
			 
						 </td>
						 <td>&nbsp;</td>
                         <td  class="vg-alignc">
                             <div class="vg-result">
                                 <strong>Итого:</strong> 
									<?if ($arParams['PRICE_VAT_SHOW_VALUE'] == 'Y'):?>
										<?=$arResult["allVATSum_FORMATED"]?><br />
									<?endif;?>
									<?
									if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
									{
										echo $arResult["DISCOUNT_PRICE_FORMATED"]."<br />";
									}
									?>
									<?=$arResult["allSum_FORMATED"]?>                                 
                             </div>
                             <input type="submit" class="vg-btn vg-btnGreen vg-submit" name="BasketOrder" value="Оформить заказ"/>
                         </td>
                     </tr>
                 </table>
		</div>             
     </div>
</div>