/* --------------------------------------------- 
* Filename:     custom.js
* Version:      1.0.0 (2016-06-19)
				1.0.2 (2024-01-09)
* Website:      https://www.zymphonies.com
* Description:  Global Script
* Author:       Zymphonies Team
                info@zymphonies.com
-----------------------------------------------*/

jQuery(document).ready(function($){

	//Main menu
	$('#main-menu').smartmenus();
	
	//Mobile menu toggle
	$('.navbar-toggle').click(function(){
		$('.region-primary-menu').slideToggle();
	});

	//Mobile dropdown menu
	if ( $(window).width() < 767) {
		$(".region-primary-menu li a:not(.has-submenu)").click(function () {
			$('.region-primary-menu').hide();
	    });
	}

	//Mobile menu
	$('.navbar-toggle').click(function(){
	  $(this).toggleClass('openMenu');
	});

	
});