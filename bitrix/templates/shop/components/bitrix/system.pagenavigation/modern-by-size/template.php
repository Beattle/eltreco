<?
	if (!defined ("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	{
		die();
	}

	// для раздела "запчасти" убрана ссылка "все"
	// TODO: наверное, лучше сделать зависимость не от определённого раздела, а от $arResult['NavRecordCount'], например, > 500
	if (preg_match ("/^\/market\/catalog\/spares/", $APPLICATION->GetCurUri ()))
	{
		$arResult["bShowAll"] = false;
	}
	// /для раздела "запчасти" убрана ссылка "все"


	if (!$arResult["NavShowAlways"])
	{
		if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		{
			return;
		}
	}
?>
<div class="modern-page-navigation">
	<?

		$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
		$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
	?>
	<span class="modern-page-title"><?= GetMessage ("pages") ?></span>
	<?
		if ($arResult["bDescPageNumbering"] === true):
			$bFirst = true;
			if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
				if ($arResult["nStartPage"] < $arResult["NavPageCount"]):
					$bFirst = false;
					if ($arResult["bSavePage"]):
						?>
						<a rel="nofollow" class="modern-page-first" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>">1</a>
						<?
					else:
						?>
						<a rel="nofollow" class="modern-page-first" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">1</a>
						<?
					endif;
					if ($arResult["nStartPage"] < ($arResult["NavPageCount"] - 1)):
						?>
						<a rel="nofollow" class="modern-page-dots" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= intVal ($arResult["nStartPage"] + ($arResult["NavPageCount"] - $arResult["nStartPage"]) / 2) ?>">...</a>
						<?
					endif;
				endif;
			endif;
			do
			{
				$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;

				if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
					?>
					<span class="<?= ($bFirst ? "modern-page-first " : "") ?>modern-page-current"><?= $NavRecordGroupPrint ?></span>
					<?
				elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):
					?>
					<a rel="nofollow" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>" class="<?= ($bFirst ? "modern-page-first" : "") ?>"><?= $NavRecordGroupPrint ?></a>
					<?
				else:
					?>
					<a rel="nofollow" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"<?
					?> class="<?= ($bFirst ? "modern-page-first" : "") ?>"><?= $NavRecordGroupPrint ?></a>
					<?
				endif;

				$arResult["nStartPage"]--;
				$bFirst = false;
			} while ($arResult["nStartPage"] >= $arResult["nEndPage"]);

			if ($arResult["NavPageNomer"] > 1):
				if ($arResult["nEndPage"] > 1):
					if ($arResult["nEndPage"] > 2):
						?>
						<a rel="nofollow" class="modern-page-dots" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= round ($arResult["nEndPage"] / 2) ?>">...</a>
						<?
					endif;
					?>
					<a rel="nofollow" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"><?= $arResult["NavPageCount"] ?></a>
					<?
				endif;

			endif;

		else:
			$bFirst = true;

			if ($arResult["NavPageNomer"] > 1):
				if ($arResult["nStartPage"] > 1):
					$bFirst = false;
					if ($arResult["bSavePage"]):
						?>
						<a rel="nofollow" class="modern-page-first" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1">1</a>
						<?
					else:
						?>
						<a rel="nofollow" class="modern-page-first" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">1</a>
						<?
					endif;
					if ($arResult["nStartPage"] > 2):
						?>
						<a rel="nofollow" class="modern-page-dots" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= round ($arResult["nStartPage"] / 2) ?>">...</a>
						<?
					endif;
				endif;
			endif;

			do
			{
				if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
					?>
					<span class="<?= ($bFirst ? "modern-page-first " : "") ?>modern-page-current"><?= $arResult["nStartPage"] ?></span>
					<?
				elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
					?>
					<a rel="nofollow" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>" class="<?= ($bFirst ? "modern-page-first" : "") ?>"><?= $arResult["nStartPage"] ?></a>
					<?
				else:
					?>
					<a rel="nofollow" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"<?
					?> class="<?= ($bFirst ? "modern-page-first" : "") ?>"><?= $arResult["nStartPage"] ?></a>
					<?
				endif;
				$arResult["nStartPage"]++;
				$bFirst = false;
			} while ($arResult["nStartPage"] <= $arResult["nEndPage"]);

			if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
				if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
					if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):
						?>
						<a rel="nofollow" class="modern-page-dots" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= round ($arResult["nEndPage"] + ($arResult["NavPageCount"] - $arResult["nEndPage"]) / 2) ?>">...</a>
						<?
					endif;
					?>
					<a rel="nofollow" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"><?= $arResult["NavPageCount"] ?></a>
					<?
				endif;
			endif;
		endif;
	?>
	<?
		global $pageCountList;
		if ($pageCountList)
		{
			?>
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class="modern-page-title"><?= GetMessage ('on_page') ?>:</span>
			<?
			foreach ($pageCountList as $pageCount)
			{
				$value = ($pageCount == 100000 ? GetMessage ("nav_all") : $pageCount);
				if ($pageCount == 100000 && !$arResult["bShowAll"])
				{
					continue;
				}
				if (
					$arParams['NAV_RESULT']->NavPageSize == $pageCount ||
					($pageCount == 100000 && $_GET['SHOWALL_' . $arResult["NavNum"]])// Все
				)
				{
					?>
					<span class="modern-page-current"><?= $value ?></span>
					<?
				}
				else
				{
					?>
					<a rel="nofollow" href="<?= $APPLICATION->GetCurPageParam ("SET_PAGE_COUNT=" . $pageCount . '&SHOWALL_' . $arResult["NavNum"] . '=' . ($pageCount == 100000 ? 1 : 0), Array(
						'PAGEN_1',
						'PAGEN_2',
						($_GET['SET_PAGE_COUNT'] ? 'SET_PAGE_COUNT' : ''),
						'SHOWALL_' . $arResult["NavNum"],
					)) ?>"><?= $value ?></a>
					<?
				}
			}
		}
	?>
</div>
