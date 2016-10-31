<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="videogallery">
	<div class="video-switching">
		<div class="section-name"><a href="#" class="jcarousel-control-prev"></a> Видеогалерея <a href="#" class="jcarousel-control-next"></a></div>
	</div>
	<div class="jcarousel video-tape">
		<ul>
			<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
				$rand_key = array_rand($arItem["PROPERTIES"]["YOUTUBE"]["VALUE"]);
				$video = $arItem["PROPERTIES"]["YOUTUBE"]["VALUE"][$rand_key];
			?>
			<li class="video-1">
				<iframe width="358" height="202" src="https://www.youtube.com/embed/<?=$video?>" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
			</li>
			<?endforeach;?>
		</ul>
	</div>
</div>
<script type="text/javascript">
(function($) {
    $(function() {
        $('.video-tape')
            .jcarousel({
                // Options go here
            });

		$('.videogallery .jcarousel-control-prev')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '-=3'
            });

        $('.videogallery .jcarousel-control-next')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '+=3'
            });
    });
})(jQuery);
</script>