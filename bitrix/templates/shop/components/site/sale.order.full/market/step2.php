<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
function PrintPropsForm($arSource=Array(), $PRINT_TITLE = "", $arParams)
{
	if (!empty($arSource))
	{
		if (strlen($PRINT_TITLE) > 0)
		{
			?>
			<b><?= $PRINT_TITLE ?></b><br /><br />
			<?
		}
		?>
		<table class="sale_order_full_table">
		<?
		foreach($arSource as $arProperties)
		{
			if($arProperties["SHOW_GROUP_NAME"] == "Y")
			{
				?>
				<tr>
					<td colspan="2" align="center">
						<b><?= $arProperties["GROUP_NAME"] ?></b>
					</td>
				</tr>
				<?
			}
			?>
			<tr>
				<td align="right" valign="top">
					<div class="vg-title"><?= $arProperties["NAME"] ?>:<?
					if($arProperties["REQUIED_FORMATED"]=="Y")
					{
						?><span class="sof-req">*</span><?
					}
					?>
					</div>
				</td>
				<td>
					<?
					if($arProperties["TYPE"] == "CHECKBOX")
					{
						?>
						<input type="checkbox" name="<?=$arProperties["FIELD_NAME"]?>" value="Y"<?if ($arProperties["CHECKED"]=="Y") echo " checked";?>>
						<?
					}
					elseif($arProperties["TYPE"] == "TEXT")
					{
						?>
						<input type="text" maxlength="250" size="<?=$arProperties["SIZE1"]?>" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" class="vg-input">
						<?
					}
					elseif($arProperties["TYPE"] == "SELECT")
					{
						?>
						<select name="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
						<?
						foreach($arProperties["VARIANTS"] as $arVariants)
						{
							?>
							<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
							<?
						}
						?>
						</select>
						<?
					}
					elseif ($arProperties["TYPE"] == "MULTISELECT")
					{
						?>
						<select multiple name="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
						<?
						foreach($arProperties["VARIANTS"] as $arVariants)
						{
							?>
							<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
							<?
						}
						?>
						</select>
						<?
					}
					elseif ($arProperties["TYPE"] == "TEXTAREA")
					{
						?>
						<textarea rows="<?=$arProperties["SIZE2"]?>" cols="<?=$arProperties["SIZE1"]?>" name="<?=$arProperties["FIELD_NAME"]?>"><?=$arProperties["VALUE"]?></textarea>
						<?
					}
					elseif ($arProperties["TYPE"] == "LOCATION")
					{
						$value = 0;
						foreach ($arProperties["VARIANTS"] as $arVariant)
						{
							if ($arVariant["SELECTED"] == "Y")
							{
								$value = $arVariant["ID"];
								break;
							}
						}

						if ($arParams["USE_AJAX_LOCATIONS"] == "Y"):
							$GLOBALS["APPLICATION"]->IncludeComponent(
								'bitrix:sale.ajax.locations',
								'',
								array(
									"AJAX_CALL" => "N",
									"COUNTRY_INPUT_NAME" => "COUNTRY_".$arProperties["FIELD_NAME"],
									"CITY_INPUT_NAME" => $arProperties["FIELD_NAME"],
									"CITY_OUT_LOCATION" => "Y",
									"ALLOW_EMPTY_CITY" => "N",
									"LOCATION_VALUE" => $value,
								),
								null,
								array('HIDE_ICONS' => 'Y')
							);
						else:
						?>
						<select name="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
						<?
						foreach($arProperties["VARIANTS"] as $arVariants)
						{
							?>
							<option value="<?=$arVariants["ID"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
							<?
						}
						?>
						</select>
						<?
						endif;
					}
					elseif ($arProperties["TYPE"] == "RADIO")
					{
						foreach($arProperties["VARIANTS"] as $arVariants)
						{
							?>
							<input type="radio" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["ID"]?>" value="<?=$arVariants["VALUE"]?>"<?if($arVariants["CHECKED"] == "Y") echo " checked";?>> <label for="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["ID"]?>"><?=$arVariants["NAME"]?></label><br />
							<?
						}
					}

					if (strlen($arProperties["DESCRIPTION"]) > 0)
					{
						?><br /><small><?echo $arProperties["DESCRIPTION"] ?></small><?
					}
					?>

				</td>
			</tr>
			<?
		}
		?>
		</table>
		<?
		return true;
	}
	return false;
}
?>

            <div class="vg-row ">
                <div class="vg-inblock vg-colLeft">
                    <div class="vg-form">
			<?
			$bPropsPrinted = PrintPropsForm($arResult["PRINT_PROPS_FORM"]["USER_PROPS_N"], GetMessage("SALE_INFO2ORDER"), $arParams);

			if(!empty($arResult["USER_PROFILES"]))
			{
				if ($bPropsPrinted)
					echo "<br /><br />";
				?>
				<b><?echo GetMessage("STOF_PROFILES")?></b><br /><br />
				<table class="sale_order_full_table">
					<tr>
						<td colspan="2">
							<?= GetMessage("SALE_PROFILES_PROMT")?>:
							<script language="JavaScript">
							function SetContact(enabled)
							{
								if(enabled)
									document.getElementById('sof-prof-div').style.display="block";
								else
									document.getElementById('sof-prof-div').style.display="none";
							}
							</script>
						</td>
					</tr>
					<?
					foreach($arResult["USER_PROFILES"] as $arUserProfiles)
					{
						?>
						<tr>
							<td valign="top" width="0%">
								<input type="radio" name="PROFILE_ID" id="ID_PROFILE_ID_<?= $arUserProfiles["ID"] ?>" value="<?= $arUserProfiles["ID"];?>"<?if ($arUserProfiles["CHECKED"]=="Y") echo " checked";?> onClick="SetContact(false)">
							</td>
							<td valign="top" width="100%">
								<label for="ID_PROFILE_ID_<?= $arUserProfiles["ID"] ?>">
								<b><?=$arUserProfiles["NAME"]?></b><br />
								<table>
								<?
								foreach($arUserProfiles["USER_PROPS_VALUES"] as $arUserPropsValues)
								{

									if (strlen($arUserPropsValues["VALUE_FORMATED"]) > 0)
									{
										?>
										<tr>
											<td><?=$arResult["PRINT_PROPS_FORM"]["USER_PROPS_Y"][$arUserPropsValues["ORDER_PROPS_ID"]]["NAME"]?>:</td>
											<td><?=$arUserPropsValues["VALUE_FORMATED"]?></td>
										</tr>
										<?
									}
								}
								?>
								</table>
								</label>
							</td>
						</tr>
						<?
					}
					?>
					<tr>
						<td width="0%">
							<input type="radio" name="PROFILE_ID" id="ID_PROFILE_ID_0" value="0"<?if ($arResult["PROFILE_ID"]=="0") echo " checked";?> onClick="SetContact(true)">
						</td>
						<td width="100%"><b><label for="ID_PROFILE_ID_0"><?echo GetMessage("SALE_NEW_PROFILE")?></label></b><br /></td>
					</tr>
				</table>
				<br /><br />
				<?
			}
			else
			{
				?><input type="hidden" name="PROFILE_ID" value="0"><?
			}
			?>
			<div id="sof-prof-div">
			<?
			/*PrintPropsForm($arResult["PRINT_PROPS_FORM"]["USER_PROPS_Y"], GetMessage("SALE_NEW_PROFILE_TITLE"), $arParams);*/
			PrintPropsForm($arResult["PRINT_PROPS_FORM"]["USER_PROPS_Y"], "", $arParams);
			?>
			</div>
			<?
			if ($arResult["USER_PROFILES_TO_FILL"]=="Y")
			{
				?>
				<script language="JavaScript">
					SetContact(<?echo ($arResult["USER_PROFILES_TO_FILL_VALUE"]=="Y" || $arResult["PROFILE_ID"] == "0")?"true":"false";?>);
				</script>
				<?
			}
			?>
                    </div>
                </div>
                <div class="vg-inblock vg-colRight">
                    <div class="vg-inblock vg-text">
			<?echo GetMessage("STOF_CORRECT_NOTE")?><br /><br />
			<?echo GetMessage("STOF_PRIVATE_NOTES")?>
                    </div>
                </div>
	        </div>
<table>
	<tr>
		<td valign="top">
		<?/*if($arResult["SKIP_FIRST_STEP"] == "Y")
		{
			?>
			<a href="<?= $arParams['PATH_TO_BASKET'] ?>" class="vg-btn vg-btnGreen vg-submit">&lt;&lt; <?echo GetMessage("SALE_BACK_BUTTON")?></a>
			<?
		}
		elseif ($arResult['PATH_TO_ORDER']) {
			?>
			<a href="<?= $arResult['PATH_TO_ORDER'] ?>" class="vg-btn vg-btnGreen vg-submit">&lt;&lt; <?echo GetMessage("SALE_BACK_BUTTON")?></a>
			<?
		}
		*/?>
			<input type="submit" name="contButton" value="<?= GetMessage("SALE_CONTINUE")?> &gt;&gt;" class="vg-btn vg-btnGreen vg-submit">
		</td>
	</tr>
</table>