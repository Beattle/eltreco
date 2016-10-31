<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="comments-section">
<?
$rand_keys = array_rand($arResult["ITEMS"]);
$arElement = $arResult["ITEMS"][$rand_keys];
?>
	<div>
		<?/*
		<div class="switch">
			<a href="<?=$APPLICATION->GetCurPageParam("type=comments", array("type"))?>">
				<span<?if($arResult["TYPE"]=="comments"):?> class="selected"<?endif?>>Обращения</span>
			</a>
			<span class="split"></span> 
			<a href="<?=$APPLICATION->GetCurPageParam("type=video", array("type"))?>">
			<span<?if($arResult["TYPE"]=="video"):?> class="selected"<?endif?>>Видео</span>
			</a>
		<div>
		*/?>
		<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td colspan="2">
					<div class="item-name"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></div>
					<div class="item-position"><?=$arElement["DISPLAY_PROPERTIES"]["POSITION"]["VALUE"]?></div>
				</td>
			</tr>
			<tr>
				<td valign="top">
					<?if($arElement["PREVIEW_PICTURE"]["SRC"]):?>
						<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a>
					<?endif?>
				</td>
				<td valign="top">
					<?if($arElement["PROPERTIES"]["VIDEO"]["VALUE"]["path"]):?>
						<?$APPLICATION->IncludeComponent(
						   "bitrix:player",
						   "",
						   Array(
							  "PLAYER_TYPE" => "auto", 
							  "USE_PLAYLIST" => "N", 
							  "PATH" => $arElement["PROPERTIES"]["VIDEO"]["VALUE"]["path"],
							  "PREVIEW" => $arElement["DISPLAY_PROPERTIES"]["PREVIEW"]["FILE_VALUE"]["SRC"],
							  "WIDTH" => "630", 
							  "HEIGHT" => "456", 
							  "FULLSCREEN" => "Y", 
							  "SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins", 
							  "SKIN" => "bitrix.swf", 
							  "CONTROLBAR" => "bottom", 
							  "WMODE" => "transparent", 
							  "HIDE_MENU" => "N", 
							  "SHOW_CONTROLS" => "Y", 
							  "SHOW_STOP" => "N", 
							  "SHOW_DIGITS" => "Y", 
							  "CONTROLS_BGCOLOR" => "FFFFFF", 
							  "CONTROLS_COLOR" => "000000", 
							  "CONTROLS_OVER_COLOR" => "000000", 
							  "SCREEN_COLOR" => "000000", 
							  "AUTOSTART" => "N", 
							  "REPEAT" => "N", 
							  "VOLUME" => "90", 
							  "DISPLAY_CLICK" => "play", 
							  "MUTE" => "N", 
							  "HIGH_QUALITY" => "Y", 
							  "ADVANCED_MODE_SETTINGS" => "N", 
							  "BUFFER_LENGTH" => "10", 
							  "DOWNLOAD_LINK_TARGET" => "_self" 
						   )
						);?>
					<?endif?>
					<?if($arElement["PREVIEW_TEXT"]):?>
						<?=$arElement["PREVIEW_TEXT"]?>
					<?endif?>
					<div class="all-link"><a href="/comments/">Обращения и комментарии</a></div>
				</td>
			</tr>
		</table>
	</div>
</div>
