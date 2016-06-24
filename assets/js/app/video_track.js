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
			var trackerName = ga.getAll()[0].get('name');
			ga(trackerName + '.send', {
				hitType: 'event',
				eventCategory: 'video',
				eventAction: action,
				eventLabel: window.location.href,
				eventValue: parseInt($(e).get(0).timeStamp)
			});
		} catch(ex) {
			console.log(ex);
		}
		
	}

};