<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="bottom-menu">

<?
$class = " class=\"menu-item-left\"";
foreach($arResult as $arItem):
	$index++;
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?
	if ($index == count($arResult)) 
	{
		$class = " class=\"menu-item-right\"";
	}
	?>
	<?if($arItem["SELECTED"]):?>
		<li<?=$class?>><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></li>
	<?else:?>
		<li<?=$class?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?endif?>
	
<?
unset($class);
endforeach?>
</ul>
<?endif?>