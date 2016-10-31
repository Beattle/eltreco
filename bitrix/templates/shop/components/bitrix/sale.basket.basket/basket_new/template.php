<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (StrLen($arResult["ERROR_MESSAGE"])<=0)
{
	if(is_array($arResult["WARNING_MESSAGE"]) && !empty($arResult["WARNING_MESSAGE"]))
	{
		foreach($arResult["WARNING_MESSAGE"] as $v)
		{
			echo ShowError($v);
		}
	}
	
	?>
	<form name="basket_form" method="POST" action="/personal/makeorder/">
		<?
		if ($arResult["ShowReady"]=="Y")
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items.php");
		}

		if ($arResult["ShowDelay"]=="Y")
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_delay.php");
		}

		if ($arResult["ShowNotAvail"]=="Y")
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_notavail.php");
		}
		?>
	</form>
	<?
}
else
	ShowError($arResult["ERROR_MESSAGE"]);
?>