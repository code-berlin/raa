var videoTrack = {	

	init: function() {

		var me = this;

		$('.js-track-video').on('play', function (e) {
		    me.trackEvent('play', e);
		});

		$('.js-track-video').on('pause', function (e) {
		    me.trackEvent('pause', e);
		});

		$('.js-track-video').on('error', function (e) {
		    me.trackEvent('error', e);
		});

	},

	trackEvent: function(action, e) {
		
		try {
			ga('send', {
				hitType: 'event',
				eventCategory: 'video',
				eventAction: action,
				eventLabel: href.location,
				eventValue: parseInt($(e).get(0).currentTime)
			});
		} catch(ex) {
			console.log('ERROR: sending ga event');
		}
		
	}

};