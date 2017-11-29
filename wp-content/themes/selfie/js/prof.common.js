jQuery(document).ready(function($){

"use strict";
	
	$(".identity-single-row").each(function() {
		$(this).wrapInner("<div class='homepage-container-design-inner'></div>");
	});
	
	$(".wpb_accordion_header").each(function() {
		$(this).prepend("<em class='icon-fixed-width fa fa-plus'></em>");
	});	
	
 	$(".wpb_toggle").each(function() {
		$(this).append("<i class='fa fa-plus pull-right'></i>");
	});
	
	$(".dropdown.cart-nav").mouseover(function() {
		$(this).find(".widget_shopping_cart_content").addClass("widget_shopping_cart_content_hover");
	  }).mouseout(function(){	
		$(this).find(".widget_shopping_cart_content").removeClass("widget_shopping_cart_content_hover");	  
	});		

	 
	
});

