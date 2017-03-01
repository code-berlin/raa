var cisLoader = {

	init: function() {
		var dfpslots = $('.cis_container').filter(function() { return ($(this).parent().css('display') == 'none' ? false : true); }),
		i=0,
		slot = [];		

		if (dfpslots.length) {
			googletag.cmd.push(function() {
				$(dfpslots).each(function(){
					var cis_content = $(this).find('.cis_content');
					slot[i] = googletag.defineSlot('/75836183/'+cis_content.data('name'), cis_content.data('map'), cis_content.data('slot')).addService(googletag.pubads()).setCollapseEmptyDiv(true,true);
					i++;
				});
				googletag.pubads().addEventListener('slotRenderEnded', function(event) {
						if (event.isEmpty === false) {
							var slotId = event.slot.getSlotElementId(),
								parent = $('#' + slotId).closest('.js-cis_container');
							parent.children('.js-cis_head').show();
	                    	parent.addClass('loaded');
	                    }
	            });
				googletag.enableServices();
				$(dfpslots).each(function(){
					var cis_content = $(this).find('.cis_content');
					googletag.display(cis_content.data('slot'));
				});
			});
		}
	},

	reviceAdMessage: function(event) {
		if (!event || !event.data || typeof event.data !== 'string' ||  event.data.indexOf('&') == -1) return;

		var origin = event.origin,
			messageData = event.data.split('&');

		if (messageData[0] !== 'reviceAdMessage' || origin !== "https://tpc.googlesyndication.com")
			return;

		switch(messageData[1]) {
			case 'resize':
				$('#' + messageData[2] + ' .cis_content iframe').height(messageData[3]);
				helper.gaTrack('AdResize', 'expand', window.location.href, event);
				break;
		}

	}

};

window.addEventListener("message", cisLoader.reviceAdMessage, false);