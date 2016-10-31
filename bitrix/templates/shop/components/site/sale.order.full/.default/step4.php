<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

            <div class="vg-row vg-order vg-payment">
                <h6><?echo GetMessage("STOF_PAYMENT_WAY")?></h6>
            <div class="vg-row ">
                 <div class="vg-inblock vg-colLeft">
                    <div class="vg-text">
					<?echo GetMessage("STOF_PAYMENT_HINT")?>
					</div>
                    <div class="vg-form">
		<?
		if ($arResult["PAY_FROM_ACCOUNT"]=="Y")
		{
			?>
			<input type="hidden" name="PAY_CURRENT_ACCOUNT" value="N">
			<input type="checkbox" name="PAY_CURRENT_ACCOUNT" id="PAY_CURRENT_ACCOUNT" value="Y"<?if($arResult["PAY_CURRENT_ACCOUNT"]!="N") echo " checked";?>> <label for="PAY_CURRENT_ACCOUNT"><b><?echo GetMessage("STOF_PAY_FROM_ACCOUNT")?></b></label><br />
			<?=GetMessage("STOF_ACCOUNT_HINT1")?> <b><?=$arResult["CURRENT_BUDGET_FORMATED"]?></b> <?echo GetMessage("STOF_ACCOUNT_HINT2")?>
			<?
		}
		?>
		<?
		if(count($arResult["PAY_SYSTEM"])>0)
		{
			?>
			<table>
				<?
				foreach($arResult["PAY_SYSTEM"] as $arPaySystem)
				{
					$arPaySystem['IMG_LOGO'] = array();
					if (strlen($arPaySystem['PSA_LOGOTIP'])):
					    $rsFile = CFile::GetByID($arPaySystem['PSA_LOGOTIP']);
						$arPaySystem['IMG_LOGO'] = $rsFile->Fetch();
						$arPaySystem['IMG_LOGO']['SRC'] = '/upload/'.$arPaySystem['IMG_LOGO']["SUBDIR"]."/".$arPaySystem['IMG_LOGO']["FILE_NAME"];
					endif;
					
					?>
					<tr>
						<td valign="top" width="30">
							<input type="radio" id="ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>" name="PAY_SYSTEM_ID" value="<?= $arPaySystem["ID"] ?>"<?if ($arPaySystem["CHECKED"]=="Y") echo " checked";?> class="vg-radio">
						</td>
						<td valign="top">
							<label for="ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>" class="vg-title">
							<?= $arPaySystem["PSA_NAME"] ?>
							</label>
							<? if (isset($arPaySystem['IMG_LOGO']['SRC'])):?>
							<img src="<?php echo $arPaySystem['IMG_LOGO']['SRC']; ?>">
							<? endif; ?>
							<?
							if (strlen($arPaySystem["DESCRIPTION"])>0)
							{
								?>
								<div class="vg-text">
								<?=$arPaySystem["DESCRIPTION"]?>
								</div>
								<?
							}
							?>
							
							
						</td>
					</tr>
                             <tr>
                                 <td colspan="2" height="40"></td>
                             </tr>					
					<?
				}
				?>
			</table>
		<?
		}
		if ($arResult["HaveTaxExempts"]=="Y")
		{
			?>
			<br />
			<input type="checkbox" name="TAX_EXEMPT" value="Y" checked> <b><?echo GetMessage("STOF_TAX_EX")?></b><br />
			<?echo GetMessage("STOF_TAX_EX_PROMT")?>
			<br /><br />
			<?
		}
		?>
                    </div>
                </div>					
                <div class="vg-inblock vg-colRight">
                     <div class="vg-inblock vg-text">	
		<?echo GetMessage("STOF_PRIVATE_NOTES")?>
                     </div>
                </div>
             </div>
             </div>				

<table>
<tr>
	<td valign="top" width="60%" align="right">
	<?if(!($arResult["SKIP_FIRST_STEP"] == "Y" && $arResult["SKIP_SECOND_STEP"] == "Y" && $arResult["SKIP_THIRD_STEP"] == "Y"))
	{
		?>
		<input type="submit" name="backButton" value="&lt;&lt; <?echo GetMessage("SALE_BACK_BUTTON")?>" class="vg-btn vg-btnGreen vg-submit">
		<?
	}
	?>
		<input type="submit" name="contButton" value="<?= GetMessage("SALE_CONTINUE")?> &gt;&gt;" class="vg-btn vg-btnGreen vg-submit">
	</td>
</tr>
</table>
