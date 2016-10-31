<? if (!defined ("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

?>
<div class="myorders">
	<?
		$frame = $this->createFrame ('inheadauthform', false)
		              ->begin ();
		$frame->setBrowserStorage (true);
		if ($arResult["FORM_TYPE"] == "login")
		{
			?>
			<a href="<?= $arParams['PROFILE_URL'] ?>"><?= GetMessage ('RSGOPRO_AUTH') ?></a><!--  | <a href="<?= $arParams['PROFILE_URL'] ?>?register=yes"><?= GetMessage ('RSGOPRO_REGISTRATION') ?></a> -->
			<?
		}
		else
		{
			?>
			<a href="<?= $arParams['PROFILE_URL'] ?>"><?= GetMessage ('RSGOPRO_PERSONAL_PAGE') ?></a> | <a href="/?logout=yes"><?= GetMessage ('RSGOPRO_EXIT') ?></a>
			<?
		}
		$frame->beginStub ();
	?>
	<a href="<?= $arParams['PROFILE_URL'] ?>"><?= GetMessage ('RSGOPRO_AUTH') ?></a><!--  | <a href="<?= $arParams['PROFILE_URL'] ?>?register=yes"><?= GetMessage ('RSGOPRO_REGISTRATION') ?></a> -->
	<?
		$frame->end ();

	?>
</div>
