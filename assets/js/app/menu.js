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
		});

		// TRIGGER DROP DOWN SUBS
		$('.mobnav-subarrow').click(function() {
			$(this).parent().toggleClass("xpopdrop");
		});

	}

};

