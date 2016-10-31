<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="partner-documents">
	<?if(count($arResult["DISPLAY_PROPERTIES"]["FILES"]["VALUE"]) > 0):?>
		<div class="documents">
		<?
		if (count($arResult["DISPLAY_PROPERTIES"]["FILES"]["VALUE"]) > 1) {
			$arDocuments = $arResult["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"];
		}
		else {
			$arDocuments[] = $arResult["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"];
		}
		?>
		<table>
		<?foreach($arDocuments as $file):?>
			<tr><td class="document-image"><img align="bottom" class="no-border" alt="" src="/images/<?=substr($file['SRC'], strrpos($file['SRC'], '.') + 1)?>.gif" /></td><td class="document-title"><a href="<?=$file['SRC']?>" target="_blank"><?=$file['DESCRIPTION']?></a></td></tr>
		<?endforeach?>
		</table>
		</div>
	<?endif?>
</div>
