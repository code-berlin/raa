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
						console.log(event);
						if (event.isEmpty === false) {
							var slot = (event.slot.A != 'null'?event.slot.A:event.slot.B);
	                    	$('[data-dfpname="'+slot+'"] .cis_head').show();
	                    	$('[data-dfpname="'+slot+'"]').addClass('loaded');
	                    }
	            });
				googletag.enableServices();
				$(dfpslots).each(function(){
					var cis_content = $(this).find('.cis_content');
					googletag.display(cis_content.data('slot'));
				});
			});
		}
	}

};