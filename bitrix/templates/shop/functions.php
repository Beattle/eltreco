<?
	/**
	 * ��������� ������������� ������������� �� ���������
	 */
	function setDefaultPageElementCount ()
	{
		global $pageCountList;
		global $arParams;
		$pageCountList = Array(
			10,
			20,
			50,
			100,
			100000,
		);

		// ���� �� ����� ������ �������, �� ������� ���������� ������������� � �������� �������, ��� 100000
		if (!isset($_GET['SHOWALL_1']) && $_SESSION['DEFAULT_PAGE_ELEMENT_COUNT'] == 100000) {
			$_REQUEST['SET_PAGE_COUNT'] = $pageCountList[ count($pageCountList) - 2 ];
		}
		// /���� �� ����� ������ �������, �� ������� ���������� ������������� � �������� �������, ��� 100000

		if ($_REQUEST['SET_PAGE_COUNT'] && in_array ($_REQUEST['SET_PAGE_COUNT'], $pageCountList))
		{
			$_SESSION['DEFAULT_PAGE_ELEMENT_COUNT'] = $_REQUEST['SET_PAGE_COUNT'];
		}
		if (!$_SESSION['DEFAULT_PAGE_ELEMENT_COUNT'] && $arParams["PAGE_ELEMENT_COUNT"])
		{
			$_SESSION['DEFAULT_PAGE_ELEMENT_COUNT'] = $arParams["PAGE_ELEMENT_COUNT"];
		}
	}
