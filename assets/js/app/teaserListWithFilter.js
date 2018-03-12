var teaserListWithFilter = {

	jQFilterBtns: undefined,

	init: function() {

		var me = this;

		this.jQFilterBtns = $('.js-teaser-list-with-filter-button');

		if (this.jQFilterBtns.length === 0) {
			return;
		}
		
		this.jQFilterBtns.on('click', function(){
			me.onFilterClick($(this));
		});

	},

	onFilterClick: function(jQFilterBtn) {

		var jQTeaserItems = jQFilterBtn.parents('.js-teaser-list-with-filter').find('.js-teaser-list-with-filter-item'),
			selectedArticleGroupId = jQFilterBtn.data('articleGroupId');
		
		$.each(this.jQFilterBtns, function(){
			var jQFilterBtn = $(this);
			if (jQFilterBtn.data('articleGroupId') === selectedArticleGroupId) {
				jQFilterBtn.addClass('_active');
			} else {
				jQFilterBtn.removeClass('_active');
			}
		});

		$.each(jQTeaserItems, function(){
			var jQTeaserItem = $(this);
			if (jQTeaserItem.data('articleGroupId') === selectedArticleGroupId) {
				jQTeaserItem.show();
				jQTeaserItem.find('.js-appear-triggable').trigger('triggerAppear');
			} else {
				jQTeaserItem.hide();
			}
		});

	}

	
};