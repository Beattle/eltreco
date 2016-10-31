$(function(){
	var timing = -1171;
	var interval;
	var current = 1;

	function startCycle() {
		interval = setInterval(function() {
			timing = timing + 1;
			$('.control').css({backgroundPosition: timing});
			var controlPos;
			$('.control div').each(function(){
				controlPos = parseInt($(this).position().left);
				if ((timing + 1170) == controlPos) {
					$('.banner>.clickable').hide();
					var current = $(this).attr('id').replace('control','');
					$('#banner' + current).show();
				}
			});
			if (timing >= 0) {
				clearInterval(interval);
				timing = -1171;
				$('.control').css({backgroundPosition: timing});
				startCycle();
			}
			if($('.control').is(":visible") == false){
				clearInterval(interval);
			}
		}, 20);
	}

	if($('.bannerCont').length > 0){
		startCycle();
	}
	
	var control_width_full = 1170;
	var control_count = $('.bannerCont .control div').length;

	if (control_count > 1)
	{
		var control_width = Math.floor(control_width_full / control_count) - 1;
		$('.bannerCont .control div').css({width: control_width+'px'});
	}
	else
	{
		$('.bannerCont .control div').css({width: control_width_full+'px'});
	}

	function select(ban){
		var position = parseInt(ban.position().left);
		var relpos = position - 1170;
		clearInterval(interval);
		timing = relpos;
		$('.banner>.clickable').hide();
		$('#banner' + ban.attr('id').replace('control','')).show();
		$('.control').css({backgroundPosition: relpos});		
	}
	
	function selectCurrent(){
		if(current > control_count) current = 1;
		if(current < 1) current = control_count;
		select($('#control' + current));
	}
	
	$('.control div').click(function(){
		select($(this));
	});
	
	$('.controls .left span').click(function(){
		clearInterval(interval);
		current--;
		selectCurrent();
	});
	
	$('.controls .right span').click(function(){
		clearInterval(interval);
		current++;
		selectCurrent();
	});
	
	var startDrag = 0;
    var isDragging = false;
    $(".bannerCont .banner img")
	.mousedown(function(e) {
        isDragging = true;
		startDrag = e.clientX;
		clearInterval(interval);
    })
    .mousemove(function(e) {
		var delta = startDrag - e.clientX;
		if(isDragging && Math.abs(delta) > 20){
			if(delta > 0){
				current++;
			}
			else{
				current--;
			}
			isDragging = false;
			selectCurrent();
		}
     })
    .mouseup(function() {
        isDragging = false;
    })
	.on("swipeleft", function(){
		current--;
		selectCurrent();
	})
	.on("swiperight",function(){
		current++;
		selectCurrent();
	});
});

$(function(){
	$(".catalog-place .name").click(function(){
		if($(".prodmenu-content").css("display") == "none"){
			return true;
		}
		var items = $(".catalog-place .name");
		var index = items.index($(this));
		var contents = $(".prodmenu-content .submenu-container");
		if (contents.length < index + 1) return true;
		contents.removeClass("active");
		items.removeClass("active");
		$(this).addClass("active");
		contents.eq(index).addClass("active");
		$('html,body').animate({
			scrollTop: $('#offers').offset().top
		}, 1000);			
		return false;
	});
	function showMap(type){
		$(".map-place").hide();
		var id = "map_" + type;
		$("#" + id).show();
		if($("#" + id).html() != ""){
			return;
		}
		var s = document.createElement("script");
		s.type = "text/javascript";
		s.src = type == "msk"
			? "//api-maps.yandex.ru/services/constructor/1.0/js/?sid=ankoP-epwLIi4R6KYnTNu6Qxj9gKdUqL&id=map_msk"
			: "//api-maps.yandex.ru/services/constructor/1.0/js/?sid=im8mWf9qSzNkOIo9PamY8e7wMChsGhHI&id=map_spb"
		$("head").append(s);
	}
	$(".link-map").click(function(){
		$(".link-map").removeClass("active");
		$(this).addClass("active");
		showMap($(this).data("type"));
	});
	showMap("msk");
	/*
	$('.allItem > a').click(function(){
		var hid = $(this).parent().find('.allItemHid');
		if(hid.length){
			hid.show('slow');
			$(this).parent().addClass('hov');
		}
	});
	$(".allItemHid").click(function(){
		$(this).hide('slow');
		$(this).parent().removeClass('hov');
	});
	*/
	$(".hov a").click(function(){
		$(this).parent().find('.allItemHid').hide('slow');
		$(this).parent().removeClass('hov');
	});	
	var hover = false;
	$("#prodmenu .item-name .item-place > .text").hover(function(){
		var menu = $(this).next();
		
		$("#prodmenu .submenu-container").hide();
		$("#prodmenu .item-name .item-place > .text").removeClass('submenu-open');
		
		if(menu.hasClass('submenu-container'))
		{
			menu.show();
			$(this).addClass('submenu-open');
		}
	});
	$("#prodmenu .item-name .item-place > .text").mouseleave(function(){
		var item = $(this);
		setTimeout(function(){
			if(hover)return;
			var menu = item.next();
			menu.hide();
			item.removeClass('submenu-open');
			hover = false;
			}, 10);
	});
	$("#prodmenu .submenu-container").hover(function(){
		hover = true;
	});
	$("#prodmenu .submenu-container").mouseleave(function(){
		$(this).hide();
		var item = $(this).prev();
		item.removeClass('submenu-open');
		hover = false;
	});
});