		/*====================================
		03. Sticky Header JS
		======================================*/ 
		jQuery(window).on('scroll', function() {
			if ($(this).scrollTop() > 200) {
				$('.home-content').addClass("sticky");
			} else {
				$('.home-content').removeClass("sticky");
			}
		});


