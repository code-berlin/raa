var menu = {

	init: function() {

		if (helper.isMobile()) {
			$('.js-main-menu').superfish({
				autoArrows:  true,
				delay: 0,
				speed : 1,
				speedOut: 1
			});
		}

		// TRIGGER ACTIVE STATE
		$('#mobnav-btn').click(function() {
			$('.sf-menu').toggleClass("xactive");
			$('.sf-menu li').removeClass("xpopdrop");
		});

		// CLOSE MENU ON MOBILE IF JUMPMARK LINK IS CLICKED
		$('.js-jumpmark').click(function() {
			if ($('#mobnav-btn').is(':visible')) {
				$('.sf-menu').removeClass("xactive");
			}
		});

		// TRIGGER DROP DOWN SUBS
		$('.mobnav-subarrow').click(function() {
			$(this).parent().toggleClass("xpopdrop");
		});

		// if we have a submenu with images, trigger lazy load
		$('.js-images-menu-item').hover(function(){
			$(this).find('.js-appear-triggable').each(function(index, image){
            	$(image).trigger('triggerAppear');
        	});
		});

	}

};

