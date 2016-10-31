<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<table id="horizontal-multilevel-menu">
	<tr>
<?
$previousLevel = 0;
$class = " item-left";
foreach($arResult as $arItem)
{
	if ($arItem["DEPTH_LEVEL"] == 1) $counter++;
}
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] < $arItem["DEPTH_LEVEL"])
		continue;
?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></td>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<td <?=$width?> class="menu-item<?=$class?><?if ($arItem["SELECTED"]):?> selected<?endif?>"><a<?if(strpos($arItem["LINK"], '/-')!==0):?> href="<?=$arItem["LINK"]?>"<?endif?> class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><span class="menu-split"><?=$arItem["TEXT"]?><i></i></span></a>
				<ul>
		<?else:?>
			<li <?if ($arItem["SELECTED"]):?> class="menu-item selected"<?endif?>><a<?if(strpos($arItem["LINK"], '/-')!==0):?> href="<?=$arItem["LINK"]?>"<?endif?> class="parent"><span class="submenu-item"><?=$arItem["TEXT"]?></span></a>
				<ul>
		<?endif?>

	<?else:?>

		<?if($arItem["DEPTH_LEVEL"] == 1):?>
			<td <?=$width?> class="menu-item<?=$class?><?if($arItem["SELECTED"]):?> selected<?endif?>"><a<?if(strpos($arItem["LINK"], '/-')!==0):?> href="<?=$arItem["LINK"]?>"<?endif?> class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><span class="icon"></span><span class="menu-split"><?=$arItem["TEXT"]?><?if($arItem["SUBMENU"]):?><i></i><?endif?></span></a>
				<?if($arItem["SUBMENU"]):?>
					<?include($arItem["SUBMENU"])?>
				<?endif?>
			</td>
		<?else:?>
			<li <?if ($arItem["SELECTED"]):?> class="menu-item selected"<?endif?>><a<?if(strpos($arItem["LINK"], '/-')!==0):?> href="<?=$arItem["LINK"]?>"<?endif?>><span class="icon"></span><span class="submenu-item"><?=$arItem["TEXT"]?></span></a></li>
		<?endif?>

	<?endif?>
	
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?
	if ($arItem["DEPTH_LEVEL"] == 1)
	{
		$width = ' width="'.round(100 / $counter - 1).'%"';
		if ($arItem["SELECTED"])
		{
			$class = " item-next"; 
			continue;
		}
		unset($class);
	}
endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></td>", ($previousLevel-1) );?>
<?endif?>
	<td class="menu-item item-right<?=$class?>"><div class="menu-split"><a href="/sitemap/">&nbsp;&nbsp;</a></div></td>
	</tr>
</table>
<?endif?>
<div class="menu-clear-left"></div>
<script type="text/javascript">
	jshover();
</script>