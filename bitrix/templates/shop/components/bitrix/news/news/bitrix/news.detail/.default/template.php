<div style="text-align:right">
Поделись информацией с друзьями.
<div class="yashare"><div class="yashare-auto-init"
		data-yashareL10n="ru" 
		data-yashareType="none" 
		data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,lj,moikrug">
</div></div></div>
<br />
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$url = trim($_SERVER["REQUEST_URI"], '/');
$items = explode('/', $url);
?>
<div class="news-detail">
	<?if(isset($arResult["DISPLAY_PROPERTIES"]["POSITION"]["VALUE"])):?><h2 class="item-position"><?=$arResult["DISPLAY_PROPERTIES"]["POSITION"]["VALUE"]?></h2><?endif?>
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
	<?endif?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arResult["PROPERTIES"]["VIDEO"]["VALUE"]["path"]):?>
		<?$APPLICATION->IncludeComponent(
		   "bitrix:player",
		   "",
		   Array(
			  "PLAYER_TYPE" => "auto", 
			  "USE_PLAYLIST" => "N", 
			  "PATH" => $arResult["PROPERTIES"]["VIDEO"]["VALUE"]["path"],
			  "PREVIEW" => $arResult["DISPLAY_PROPERTIES"]["PREVIEW"]["FILE_VALUE"]["SRC"],
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
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
 	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
 	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):?>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			<br />
	<?endforeach;?>
	<?if($items[0] == "news"):?>
	<a href="<?=$arResult["SECTION"]["PATH"][1]["SECTION_PAGE_URL"]?>">Возврат к списку</a>
	<?endif?>
	<?
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
</div>
