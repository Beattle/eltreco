<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

            <div class="vg-row ">
                <div class="vg-inblock vg-colLeft">
                    <div class="vg-form">

		<?
		if(!empty($arResult["ORDER_PROPS_PRINT"]))
		{
			?>
			<b><?echo GetMessage("STOF_ORDER_PARAMS")?></b><br /><br />
			<table class="sale_order_full_table">
				<?
				foreach($arResult["ORDER_PROPS_PRINT"] as $arProperties)
				{
					if ($arProperties["SHOW_GROUP_NAME"] == "Y")
					{
						?>
						<tr>
							<td colspan="2" align="center"><b><?= $arProperties["GROUP_NAME"] ?></b></td>
						</tr>
						<?
					}
					if(strLen($arProperties["VALUE_FORMATED"])>0)
					{
						?>
						<tr>
							<td width="50%" align="right" valign="top">
								<?= $arProperties["NAME"] ?>:
							</td>
							<td width="50%"><?=$arProperties["VALUE_FORMATED"]?></td>
						</tr>
						<?
					}
				}
				?>
			</table>
			<?
		}
		?>
		<br /><br />
		<b><?echo GetMessage("STOF_PAY_DELIV")?></b><br /><br />

		<table class="sale_order_full_table">
			<tr>
				<td width="50%" align="right"><?= GetMessage("SALE_DELIV_SUBTITLE")?>:</td>
				<td width="50%">
					<?
					//echo "<pre>"; print_r($arResult); echo "</pre>";
					if (is_array($arResult["DELIVERY"]))
					{
						echo $arResult["DELIVERY"]["NAME"];
						if (is_array($arResult["DELIVERY_ID"]))
						{
							echo " (".$arResult["DELIVERY"]["PROFILES"][$arResult["DELIVERY_PROFILE"]]["TITLE"].")";
						}
					}
					elseif ($arResult["DELIVERY"]=="ERROR")
					{
						echo ShowError(GetMessage("SALE_ERROR_DELIVERY"));
					}
					else
					{
						echo GetMessage("SALE_NO_DELIVERY");
					}
					?>
				</td>
			</tr>
			<?if(is_array($arResult["PAY_SYSTEM"]) || $arResult["PAY_SYSTEM"]=="ERROR" || $arResult["PAYED_FROM_ACCOUNT"] == "Y")
			{
				?>
				<tr>
					<td width="50%" align="right"><?= GetMessage("SALE_PAY_SUBTITLE")?>:</td>
					<td width="50%">
						<?
						if (is_array($arResult["PAY_SYSTEM"]))
						{
							echo $arResult["PAY_SYSTEM"]["PSA_NAME"];
						}
						elseif ($arResult["PAY_SYSTEM"]=="ERROR")
						{
							echo ShowError(GetMessage("SALE_ERROR_PAY_SYS"));
						}
						elseif($arResult["PAYED_FROM_ACCOUNT"] != "Y")
						{
							echo GetMessage("STOF_NOT_SET");
						}
						if($arResult["PAYED_FROM_ACCOUNT"] == "Y")
							echo " (".GetMessage("STOF_PAYED_FROM_ACCOUNT").")";
						?>				
					</td>
				</tr>
				<?
			}
			?>
		</table>

		<br /><br />
		<b><?= GetMessage("SALE_ORDER_CONTENT")?></b><br /><br />

		<table class="sale_order_full data-table">
			<tr>
				<th><?echo GetMessage("SALE_CONTENT_NAME")?></th>
				<th><?echo GetMessage("SALE_CONTENT_PROPS")?></th>
				<th><?echo GetMessage("SALE_CONTENT_QUANTITY")?></th>
				<th><?echo GetMessage("SALE_CONTENT_PRICE")?></th>
			</tr>
			<?
			foreach($arResult["BASKET_ITEMS"] as $arBasketItems)
			{
				?>
				<tr>
					<td><?=$arBasketItems["NAME"]?></td>
					<td>
						<?
						foreach($arBasketItems["PROPS"] as $val)
						{
							echo $val["NAME"].": ".$val["VALUE"]."<br />";
						}
						?>
					</td>
					<td><?=$arBasketItems["QUANTITY"]?></td>
					<td align="right"><?=$arBasketItems["PRICE_FORMATED"]?></td>
				</tr>
				<?
			}
			?>
			<tr>
				<td align="right"><b><?=GetMessage("SALE_CONTENT_PR_PRICE")?>:</b></td>
				<td align="right" colspan="6"><?=$arResult["ORDER_PRICE_FORMATED"]?></td>
			</tr>
			<?
			if (doubleval($arResult["DISCOUNT_PRICE_FORMATED"]) > 0)
			{
				?>
				<tr>
					<td align="right"><b><?echo GetMessage("SALE_CONTENT_DISCOUNT")?>:</b></td>
					<td align="right" colspan="6"><?echo $arResult["DISCOUNT_PRICE_FORMATED"]?>
						<?if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0):?>
							(<?echo $arResult["DISCOUNT_PERCENT_FORMATED"];?>)
						<?endif;?>
					</td>
				</tr>
				<?
			}
			if (doubleval($arResult["VAT_PRICE"]) > 0)
			{
				?>
				<tr>
					<td align="right">
						<b><?echo GetMessage("SALE_CONTENT_VAT")?>:</b>
					</td>
					<td align="right" colspan="6"><?=$arResult["VAT_PRICE_FORMATED"]?></td>
				</tr>
				<?
			}
			if(!empty($arResult["arTaxList"]))
			{
				foreach($arResult["arTaxList"] as $val)
				{
					?>
					<tr>
						<td align="right"><?=$val["NAME"]?> <?=$val["VALUE_FORMATED"]?>:</td>
						<td align="right" colspan="6"><?=$val["VALUE_MONEY_FORMATED"]?></td>
					</tr>
					<?
				}
			}
			if (doubleval($arResult["DELIVERY_PRICE"]) > 0)
			{
				?>
				<tr>
					<td align="right">
						<b><?echo GetMessage("SALE_CONTENT_DELIVERY")?>:</b>
					</td>
					<td align="right" colspan="6"><?=$arResult["DELIVERY_PRICE_FORMATED"]?></td>
				</tr>
				<?
			}
			?>
			<tr>
				<td align="right"><b><?= GetMessage("SALE_CONTENT_ITOG")?>:</b></td>
				<td align="right" colspan="6"><b><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></b>
				</td>
			</tr>
			<?
			if (doubleval($arResult["PAYED_FROM_ACCOUNT_FORMATED"]) > 0)
			{
				?>
				<tr>
					<td align="right"><b><?echo GetMessage("STOF_PAY_FROM_ACCOUNT1")?></b></td>
					<td align="right" colspan="6"><?=$arResult["PAYED_FROM_ACCOUNT_FORMATED"]?></td>
				</tr>
				<?
			}
			?>
		</table>

		<br /><br />
		<b><?= GetMessage("SALE_ADDIT_INFO")?></b><br /><br />

		<table class="sale_order_full_table">
			<tr>
				<td width="50%" align="right" valign="top">
					<?= GetMessage("SALE_ADDIT_INFO_PROMT")?>
				</td>
				<td width="50%" valign="top">
					<textarea rows="4" cols="40" name="ORDER_DESCRIPTION"><?=$arResult["ORDER_DESCRIPTION"]?></textarea>
				</td>
			</tr>
		</table>

                    </div>
                </div>		
                <div class="vg-inblock vg-colRight">
                    <div class="vg-inblock vg-text">	
		<?echo GetMessage("STOF_CORRECT_PROMT_NOTE")?><br /><br />
		<?echo GetMessage("STOF_CONFIRM_NOTE")?><br /><br />
		<?echo GetMessage("STOF_CORRECT_ADDRESS_NOTE")?><br /><br />
		<?echo GetMessage("STOF_PRIVATE_NOTES")?>
                    </div>
                </div>
            </div>

<table>
<tr>
	<td valign="top" width="60%" align="right">
		<?if(!($arResult["SKIP_FIRST_STEP"] == "Y" && $arResult["SKIP_SECOND_STEP"] == "Y" && $arResult["SKIP_THIRD_STEP"] == "Y" && $arResult["SKIP_FORTH_STEP"] == "Y"))
		{
			?>
			<input type="submit" name="backButton" value="&lt;&lt; <?echo GetMessage("SALE_BACK_BUTTON")?>" class="vg-btn vg-btnGreen vg-submit">
			<?
		}
		?>
		<input type="submit" name="contButton" value="<?= GetMessage("SALE_CONFIRM")?>" class="vg-btn vg-btnGreen vg-submit">
	</td>
</tr>
</table>

<!-- Окно "Обратите внимание" -->
<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$("input[name=contButton]").click(function (e) {
			e.preventDefault();
			hs.htmlExpand(this, { contentId: 'make-order-dialog', width: '270', height: '500' });
		});
		$(".make-order-dialog-continue").click(function(){
			var form = $('form[name=order_form]');
			var input = $("<input>")
				.attr("type", "hidden")
				.attr("name", "BasketOrder").val("Оформить заказ");
			form.append($(input));
			form[0].submit();
		});
		$("#pack_items .links a:first-child").click(function(){
			var name = $(this).closest(".item-place").find("span");
			hs.htmlExpand(this, { contentId: 'pack-dialog', width: '300', height: '80' });
			$(".pack-dialog-continue").attr("href", $(this).attr("href"));
			$(".pack_name").text(name.text());
			return false;
		});
	});
</script>
<div id="make-order-dialog" class="make-order-dialog dialog highslide-maincontent">
	<a class="dialog-header control" onclick="return hs.close(this)"><img src="/images/close.png" alt="закрыть" /></a>
	<div class="dialog-content" style="line-height: 15px;">
		<p><b>Внимание!</b></p>
		<p>Обратите внимание, что упаковка товара заказывается и оплачивается отдельно. Выбрать и заказать упаковку можно <a href="http://www.eltreco.ru/market/catalog/related/">в нашем ИМ</a>.</p>
		<p>При оплате через Ассист или Яндекс Деньги требуется подтверждение вашего заказа менеджером нашего магазина. После подтверждения заказа на указанную при оформлении заказа почту вы получите ссылку, по которой сможете осуществить оплату.</p>
		<p>При оплате через Ассист или Яндекс Деньги платеж приходит на наш счет в течение 1-2 рабочих дней.</p>
		<p>Все вопросы связанные с оплатой и отправкой товара решаются только в рабочее время банков и ТК, с понедельника по пятницу с 9 до 18 часов.</p>
		<p>Подробно с условиями доставки и оплаты товара вы можете ознакомиться на нашем сайте.</p>
		<p>Оформляя заказ в нашем магазине, Вы подтверждаете свое согласие с действующими <a href="/market/help/delivery/" target="_blank">условиями</a> доставки и оплаты товаров.</p>
		<input id="make-order-dialog-continue" class="make-order-dialog-continue" type="button" value="Продолжить >>" />
	</div>
</div>
<div id="pack-dialog" class="dialog highslide-maincontent">
	<a class="dialog-header control" onclick="return hs.close(this)"><img src="/images/close.png" alt="закрыть" /></a>
	<div class="dialog-content">
		<?include($_SERVER["DOCUMENT_ROOT"]."/include/pack.php");?>
		<a class="pack-dialog-continue" href=""><input style="float:right;margin-top:10px" type="button" value="Подтверждаю" /></a>
	</div>
</div>
<!-- /Окно "Обратите внимание" -->
