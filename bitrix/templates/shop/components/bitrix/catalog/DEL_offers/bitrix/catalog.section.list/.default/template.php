<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript">
	$(function () {
		$('.shopCatalogProds a').each(function(){
			var location = window.location.href;
			var link = this.href;
			if($(this).hasClass('parent')){
				$(this).click(function(){
					$('.shopCatalogProds li.open').removeClass('open');
					var parent = $(this).parent('li');
					parent.addClass('open');
					return false;
				});
			}
			if($(this).hasClass('all')){
				selected = location == link;
			}
			else{
				selected = location.indexOf(link) == 0;
			}
			if(selected){
				var parent = $(this).parent('li');
				parent.addClass('active open');
			}
		});
	});
</script>
<div class="shopCatalogProds">
	<?foreach($arResult["SELECT"] as $key => $arSelect):?>
	<div style="margin-bottom:30px">
		<div style="margin:0 0 10px 35px">
			<strong><?=$arSelect["NAME"]?></strong>
		</div>
		<ul>
			<?foreach($arSelect["ITEMS"] as $code => $arSelectItem):?>
				<?if(is_array($arSelectItem["ITEMS"])):?>
					<li class="subitem">
						<a class="parent" href="<?=dirname($arParams['SECTION_URL'])?>/filter/<?=$code?>/">
							<?=$arSelectItem["NAME"]?>
						</a>
						<ul>
							<?foreach($arSelectItem["ITEMS"] as $itemCode => $arSubitem):?>
								<li>
									<? if($itemCode != "all"):?>
										<a href="<?=dirname($arParams['SECTION_URL'])?>/filter/<?=$code?>/<?=$itemCode?>/")>
											<?=$arSubitem?>
										</a>
									<?else:?>
										<a class="all" href="<?=dirname($arParams['SECTION_URL'])?>/filter/<?=$code?>/")>
											<?=$arSubitem?>
										</a>									
									<?endif?>
								</li>
							<?endforeach?>
						</ul>
					</li>
				<?else:?>
					<li>
						<a href="<?=dirname($arParams['SECTION_URL'])?>/filter/<?=$key?>/<?=$code?>/">
							<?=$arSelectItem?>
						</a>
					</li>
				<?endif?>
			<?endforeach?>
		</ul>
	</div>
	<?endforeach?>
	<ul>
		<li><a href="<?=dirname($arParams['SECTION_URL'])?>/">Все производители</a></li>
	<?
	$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	foreach($arResult["SECTIONS"] as $arSection):
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
		if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
			echo "<ul>";
		elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"])
			echo str_repeat("</ul>", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);
		$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
	?>
		<li id="<?=$this->GetEditAreaId($arSection['ID']);?>">
			<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
		</li>
	<?endforeach?>
	</ul>
</div>
