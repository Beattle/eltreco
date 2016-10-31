<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<table class="catalog-menu">
<?
$width = round(100 / count($arResult));
$i = 1;
$class = 'first';
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["SELECTED"]):?>
		<td width="<?=$width?>%" class="<?=$class?> selected"><div class="item-name"><h1><?=$arItem["TEXT"]?></h1></div><div class="line"><div class="item-line"><div class="circle"><?=$i?></div></div></div></td>
	<?else:?>
		<td width="<?=$width?>%" class="<?=$class?>"><div class="item-name"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></div><div class="line"><div class="item-line"><div class="circle"><a href="<?=$arItem["LINK"]?>"><?=$i?></a></div></div></div></td>
	<?endif?>
<?
	if(++$i == count($arResult)) 
	{
		$class = 'last';
	}
	else
	{
		$class = '';
	}
endforeach?>
</table>
<?endif?>