var googleMapCustom = {

	lat: 52.520007,
	lng: 13.404954,
	api_key: '',
	search_phrase: '',
	iframe: '',
	input: '',

	init: function() {

		var me = this,
			searchPhrase = $('.js-search-map-phrase').data('phrase');

		this.api_key = $('.js-map-embed-key').data('key');
		this.search_phrase = $('.js-map-embed-phrase').data('phrase');
		this.iframe = $('.js-map-container');
		this.input = $('.js-map-embed-search-input');

		$('.js-map-embed-search-btn').on('click', function (e) {
		    me.searchMap(me.input.val(), e);
		    e.preventDefault();
		});

		this.input.on('keypress', function (e) {
			if (e.which == 13) {
				e.preventDefault();
				me.searchMap($(this).val(), e);
			}
		});

		// will only work on secure origins, see https://goo.gl/rStTGz
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
		        me.lat = position.coords.latitude;
		        me.lng = position.coords.longitude;
		    });
		}

		this.iframe.attr('src', 'https://www.google.com/maps/embed/v1/view?key=' + this.api_key + '&zoom=9&center=' + this.lat + '%2C' + this.lng);

	},

	searchMap: function(searchString, e) {

		this.iframe.attr('src', 'https://www.google.com/maps/embed/v1/search?key=' + this.api_key + '&q=' + encodeURI(this.search_phrase + searchString));

	}

};