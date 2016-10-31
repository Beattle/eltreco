$(document).ready(function(){
	$(".catalog-compare-result th").each(function(){
		$(this).height($(this).parent().height() - 8 + "px");
	});
	function setCompareWidth(){
		$(".catalog-compare-result .scrollable").width($("#horizontal-multilevel-menu").width()-250+"px");
	}
	$( window ).resize(function(){
		setCompareWidth();
	});
	setCompareWidth();
});