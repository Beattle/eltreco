<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<table border="0" cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td valign="top" width="60%" align="right">

	</td>
	<td valign="top" width="5%" rowspan="3">&nbsp;</td>
	<td valign="top" width="35%" rowspan="3">
		
	</td>
</tr>
<tr>
	<td valign="top" width="60%">
		<table class="sale_order_full_table" width="100%">
			<tr>
				<td nowrap>
					<?include($_SERVER["DOCUMENT_ROOT"]."/include/pack.php");?>
					<input type="hidden" id="SKIP_STEP_0" name="SKIP_STEP_0" value="Y" />
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td valign="top" width="60%" align="right">
		<input type="submit" name="contButton" value="<?= GetMessage("SALE_CONTINUE")?> &gt;&gt;">
	</td>
</tr>
</table>