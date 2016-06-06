var search = {

	init: function() {

		var that = this;

		$('.js-search a').on('click', function(e) {
			e.preventDefault();
			that.submitSearchForm($(this).parents('.js-search'));
		});

		$('.js-search input').on('keypress', function (e) {
			if (e.which == 13) {
				e.preventDefault();
				that.submitSearchForm($(this).parents('.js-search'));
			}
		});

		$('.js-searchbar-trigger').on('click', function(e) {
			$('header').toggleClass('_searchbaropen');
		});
	},

	submitSearchForm: function(jQsearch) {
		if (jQsearch.find('input').val() !== '') {
			jQsearch.submit();
		}
	}

};