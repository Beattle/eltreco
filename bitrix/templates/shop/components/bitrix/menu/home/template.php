<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<table class="catalog-menu" id="prodmenu">
	<tr>
<?
$width = round(100 / count($arResult));
$i = 1;
$class = 'first';
foreach($arResult as $arItem):
?>
	<td width="<?=$width?>%" class="<?=$class?>">
		<div class="item-name">
			<a class="text" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
			<?if($arItem["SUBMENU"] || $arItem["PARAMS"]["SECTION_COUNT"]):?>
				<div class="submenu-container">
					<div class="submenu-top"></div>
					<table class="submenu"> 
						<tr>
							<td>
								<?$APPLICATION->IncludeComponent("site:catalog.section.list", "menu", Array(
									"IBLOCK_TYPE" => "catalog",	// Тип инфо-блока
									"IBLOCK_ID" => "4",	// Инфо-блок
									"SECTION_ID" => $arItem["PARAMS"]["SECTION_ID"],	// ID раздела
									"SECTION_CODE" => "",	// Код раздела
									"SECTION_URL" => $arItem["LINK"]."#SECTION_CODE#/",	// URL, ведущий на страницу с содержимым раздела
									"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
									"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
									"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
									"CACHE_TYPE" => "N",	// Тип кеширования
									"CACHE_TIME" => "3600",	// Время кеширования (сек.)
									"CACHE_GROUPS" => "N",	// Учитывать права доступа
									),
									$component
								);?>
								<?if($arItem["SUBMENU"]):?>
									<?include($arItem["SUBMENU"])?>
								<?endif?>
								<?if($arItem['PROMO_URL']):?>
									<ul>
										<li><a href="http://<?=$arItem['PROMO_URL']?>/"><span class="submenu-item">Промо-сайт<br /><?=$arItem['PROMO_URL']?></span></a></li>
									</ul>
								<?endif?>
							</td>
						</tr>
					</table>
					<div class="submenu-bottom"></div>
				</div>
			<?endif?>
		</div>
		<div class="line"><div class="item-line"><div class="circle"><a href="<?=$arItem["LINK"]?>"><?=$i?></a></div></div></div>
	</td>
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
</tr>
<tr>
<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] < $arItem["DEPTH_LEVEL"]) 
		continue;
?>
	<td>
		<?if(is_array($arItem["PARAMS"]["PICTURE"])):?><a href="<?=$arItem["LINK"]?>"><img class="no-border" src="<?=$arItem["PARAMS"]["PICTURE"]["SRC"]?>" width="<?=$arItem["PARAMS"]["PICTURE"]["WIDTH"]?>" height="<?=$arItem["PARAMS"]["PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a><?endif;?>
	</td>
<?endforeach?>
	</tr>
</table>
<script type="text/javascript">
	$("#prodmenu .item-name > .text").hover(function(){
		var menu = $(this).next();
		if(menu.hasClass('submenu-container'))
		{
			menu.show();
			$(this).addClass('submenu-open');
		}
	});
	$("#prodmenu .submenu-container").mouseleave(function(){
		$(this).hide();
		var item = $(this).prev();
		if(item.hasClass('submenu-open'))
		{
			item.removeClass('submenu-open');
		}
	});
</script>
<?endif?>