var menu = {

	init: function() {

		var me = this;

		if (helper.isMobile()) {
			$('.js-main-menu').superfish({
				autoArrows:  true,
				delay: 0,
				speed : 1,
				speedOut: 1,
				onShow: function () {
					var menuItem = $('.js-images-menu-item.sfHover');
					// submenu with images, trigger lazy load
					me.appearImages(menuItem);
					// delete style attr "display:block" from superfish to let css flex work
					// TODO -> rebuild menu, that this is not neccessary (one <li>)
					menuItem.find('ul').attr('style', '');
				}
			});

			// dirty fix because menu top level anchors dont work without this
			//$('a.sf-with-ul').click(function(e){
				//e.preventDefault();
				//me.handleMobileMenuTopLevelClick($(this));
			//});

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

		if (!helper.isMobile()) {
			// submenu with images, trigger lazy load on hover
			$('.js-images-menu-item').hover(function(){
				me.appearImages($(this));
			});
		}

	},

	/*handleMobileMenuTopLevelClick: function(jQelement) {

		console.log('handleMobileMenuTopLevelClick()');

		// desktop mobile menu
		if ($(window).width() > 800) {
			if (jQelement.parents('li').hasClass('sfHover')) {
				window.location = jQelement.attr('href');
			}
		// phone mobile menu
		} else {
			window.location = jQelement.attr('href');
		}


	},*/

	appearImages: function(menuItem) {
		menuItem.find('.js-appear-triggable').each(function(index, image){
        	$(image).trigger('triggerAppear');
    	});
	}

};

