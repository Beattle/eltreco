jQuery(document).ready(function() {

    jQuery('.mycarousel').jcarousel({});

    $(".show-more").click(function(){

		$('.more').toggle();

		$(this).hide();

		$(".show-more2").show();

	});

	var boxes_stub = $("#boxes_stub");

	if (boxes_stub.length > 0){

		$("#cart_stub").append(boxes_stub.html());

		if(window.CartOffers > 0){

			$("#cart_offers_count").text(' ('+window.CartOffers+')');

			$("#cart_offers_string").text('Вы выбрали '+window.CartOffersString+'.');

			$("#cart_offers_items").prepend($("#cart_offers_stub").html());

		}

		if(window.CartOffers > 1){

			$(".compare_link").show();

			$("#compare_no_link").hide();

		}

	}

	else{

		$("#items_in_cart").hide();

		$("#cart_offers_items").hide();

	}

    $(".show-more2").click(function(){

		$('.more').toggle();

		$(this).hide();

		$(".show-more").show();

	});

    $(".addSliderIn ul li a.preview-picture").hover(function(){

		$('.hidDiv').hide()

		$(this).parent().parent().find('.hidDiv').show()

		$(this).addClass('active');

	});

	$(".hidDiv").mouseleave(function(){

		$(this).parent().parent().find('a.preview-picture').removeClass('active')

		$(this).hide();

	});

	$(".addSliderIn ul li a.preview-picture").click(function(){

		if($(this).parent().hasClass("select")) {

			return false;

		}

		var picture = $("#fullPic");

		picture.hide();

		if($(this).hasClass('add-picture')){

			picture.addClass('add-picture');

		}

		else{

			picture.removeClass('add-picture');

		}

		picture.attr("src", $(this).attr("href"));



		$(this).parent().parent().parent().find('div.select').removeClass("select")

		$(this).parent().addClass("select");



		picture.one('load', function() {

			$(this).show();

		});



		return false;

	});

	$(".select-color a.preview-picture").click(function(){

		selectColor($(this));

		return false;

	});

	$("#colours_select span").click(function(){

		var data = $(this).attr("data");

		var element = $('#color_' + data);

		selectColor(element);

		hs.close($(this).get(0));

		return false;

	});

	$(".addSliderTitle .addSliderT:first-child").addClass("active");

	$(".addSliderTitle .addSliderT").click(function(){

		var key = $(this).attr("rel");

		$(".addSliderPages .addSliderB").hide();

		$(".addSliderTitle .addSliderT").removeClass("active");

		$(".addSliderPages .addSliderB."+key+"_page").show();

		$(this).addClass("active");

		$(".addSliderPages .addSliderB."+key+"_page .mycarousel").jcarousel();

	});

	function selectColor(element){

		$("#fullPic").attr("src", element.attr("href"));

		var name = element.attr("title");

		$("#color_select").text(name);

		$("#offer_color").attr("value", name);

	}

	$(".add2cart").click(function(){

		addOffer(jQuery.parseJSON($(this).attr("data")));

		return false;

	});

	function addOffer(data){

		var id = 'accessory_' + data[0];

		$("#acc_" + data[0]).removeClass('add2cart');

		if($('#'+id).length) return false;

		if(data[3]){

			meta = '<input type="hidden" name="offers[]" value="'+data[0]+'" />';

			parentId = "cart_offers";

		}else{

			meta = '<input type="hidden" name="gifts['+data[0]+']" value="'+data[2]+'" />';

			parentId = "cart_gifts";

			$('#'+parentId).empty();

		}

		$('#'+parentId).append(

			'<div><a id="'+id+'" class="catClose" rel="'+data[0]+'" data="'+data[1]+'" href="#"><img src="/images/catClose2.png" /></a><p>'+meta+'<b class="accessory-name">'+data[2]+'</b>'+(data[3]?' - <b>'+data[3]+'</b>':'')+'</p></div>'

		);

		$(".catClose").each(function(){

			var events = $(this).data('events');

			if(!events){

				$(this).click(function(){

					del2cart($(this));

					return false;

				});

			};

		});

		updateTotal(data[1]);

	}

	function del2cart(element){

		var price = element.attr("data");

		var id = element.attr("rel");

		$("#acc_" + id).addClass('add2cart');

		if(price) updateTotal(-price);

		element.next().remove();

		element.remove();

	}

	function updateTotal(value){

		if(value){

			var total = getTotal();

			total += parseInt(value);

			$("#total_price").attr("data", total);

			$("#total_price").number(total, 1, ',', ' ');

			$("#total_price").append('. -');

		}

	}

	$(".color_select").click(function(){

		hs.htmlExpand(this, { contentId: 'colours_select' });

		return false;

	});

	$(".tab-link").click(function(){

		var key = $(this).attr("rel");

		var parent = $(".boxes");

		parent.find('div.select').removeClass("select");

		$("."+key+"-link").addClass('select');

		parent.find("."+key).addClass('select');

		return false;

	});

	function resize_boxes(){

		$(".shopCatalog .boxes .border").each(function(){

			$(this).width($(this).parent().width() - 5);

		});

	}

	$(window).resize(function() {

		resize_boxes();

	});

	resize_boxes();

});

function getTotal(){

	return parseInt($("#total_price").attr("data"));

}

function getOffers(){

	var offers = [];

	offers.push($("#offer_name").attr("rel"));

	$("#cart_offers div").each(function(){

		offers.push($(this).find("a").attr("rel"));

	});

	return offers;

}

function prepareCredit(element){

	$.getScript(

		'/services/kupivcredit.php?offers='+getOffers(),

		function( data,textStatus,jqxhr){

			$("#credit_loading").hide();

			if(jqxhr.status == 200){

				$("#credit_list").show();

				CreateVkredit();

			}

		}

	);

	return hs.htmlExpand(element, { contentId: 'credit-dialog' });

}

function OpenVkredit(){

	console.log(vkredit.params);

	hs.close();

	vkredit.openWidget();

}