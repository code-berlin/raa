var search = {

	init: function() {

		var that = this;

		$('.js-search a').on('click', function(e) {
			e.preventDefault();
			that.submitSearchForm();
		});

		$('.js-search input').on('keypress', function (e) {
			if (e.which == 13) {
				e.preventDefault();
				that.submitSearchForm();
			}
		});

		$('.js-searchbar-trigger').on('click', function(e) {
			$('header').toggleClass('_searchbaropen');
		});
	},

	submitSearchForm: function() {
		if ($('.js-search input').val() !== '') {
			$('.js-search').submit();
		}
	}

};