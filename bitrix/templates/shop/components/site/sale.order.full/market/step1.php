<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

            <div class="vg-row ">
                <div class="vg-inblock vg-colLeft">
                    <div class="vg-form">
		<table class="sale_order_full_table">
			<tr>
				<td nowrap>
					<?echo GetMessage("STOF_SELECT_PERS_TYPE")?><br /><br />
					<?
					foreach($arResult["PERSON_TYPE_INFO"] as $v)
					{
						?><input type="radio" id="PERSON_TYPE_<?= $v["ID"] ?>" name="PERSON_TYPE" value="<?= $v["ID"] ?>"<?if ($v["CHECKED"]=="Y") echo " checked";?>> <label for="PERSON_TYPE_<?= $v["ID"] ?>"><?= $v["NAME"] ?></label><br /><?
					}
					?>
				</td>
			</tr>
		</table>

                    </div>
                </div>		
                <div class="vg-inblock vg-colRight">
                    <div class="vg-inblock vg-text">	
		<?echo GetMessage("STOF_PROC_DIFFERS")?><br /><br />
		<?echo GetMessage("STOF_PRIVATE_NOTES")?>
                    </div>
                </div>
            </div>

<table>
<tr>
	<td valign="top" width="60%" align="right">
	    <a href="/market/personal/cart/" class="vg-btn vg-btnGreen vg-submit">&lt;&lt; <?echo GetMessage("SALE_BACK_BUTTON")?></a>
		<input type="submit" name="contButton" value="<?= GetMessage("SALE_CONTINUE")?> &gt;&gt;" class="vg-btn vg-btnGreen vg-submit">
	</td>
</tr>
</table>