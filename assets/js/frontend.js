(function($){
	// fix cover designer
	$('#container-online-designer').detach().appendTo('body');
	if (typeof wopotk == 'undefined'){
		return;
	}
	if (typeof wopotk.wopotk_show_popup_after_process != "undefined"){
		$(document).on('after_show_design_thumbnail',function(){
			$([document.documentElement, document.body]).animate({
		        scrollTop: $("#nbdesigner_frontend_area").offset().top
		    }, 2000);
			$('#cmdialog').modal({
				fadeDuration: 100
			});
		});
	}
	if (typeof wopotk.wopotk_nbdesigner_checkbox_label != "undefined"){
		$('.nbo-checkbox').each(function(){
			$(this).text($(this).attr('title'));
		});
	}
	if (typeof wopotk.wopotk_nbdesigner_move_design_button != "undefined"){
		$('.nbdesigner_frontend_container').detach().insertBefore('.nbo-clear-option-wrap');
	}
	if (typeof wopotk.wopotk_teepro_click_outside_usermenu_hide != "undefined"){
		$(document).click(function (event) {
			var clickover = $(event.target);
	        var _opened = $(".site-header .top-section-wrap .header_top_right_menu .data_user").hasClass("open");
	        if (_opened === true && clickover.parents(".data_user").length ===0) {
	            $('.site-header .top-section-wrap .header_top_right_menu .data_user').removeClass('open');
	        }
		});
	}
	if (typeof wopotk.wopotk_nbdesigner_move_design_category_to_top != "undefined"){
		$('.nbd-gallery-con .nbd-sidebar-h3:contains(Design Category)').parent().detach().prependTo('.nbd-gallery-con .nbd-sidebar');
	}
	if (typeof wopotk.wopotk_nbdesigner_hide_products_widget != "undefined"){
		$('.nbd-gallery-con .nbd-sidebar-h3:contains(Products)').parent().hide();
	}
	if (typeof wopotk.wopotk_nbdesigner_alway_on_top != "undefined"){
		if ($('#container-online-designer').length){
			$('#container-online-designer').detach().appendTo('body');
		}
	}
	if (typeof wopotk.wopotk_teepro_variation_form_2_start_design != "undefined"){
		jQuery('.variations_form.cart').detach().insertBefore('#triggerDesign');
	}	
}(window.jQuery));