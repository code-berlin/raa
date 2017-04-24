var teaserImageAndDropdown = {

	init: function() {

		var jQImageAndDropdownSelect = $('.js-image-and-dropdown-select'),
			disableSearch,
			me;

		if (jQImageAndDropdownSelect.length === 0) {
			return;
		}

		me = this;
		disableSearch = jQImageAndDropdownSelect.data('search') !== 1;

		jQImageAndDropdownSelect.chosen({
			disable_search: disableSearch,
			width: '100%'
		});

		jQImageAndDropdownSelect.on('change', function(){
			me.onSelectChange($(this));
		});

	},

	onSelectChange: function(jQSelect) {

		var jQTeaserSwitch = jQSelect.siblings('.js-image-and-dropdown-switch'),
			data = jQSelect.find('option:selected').data();

			// template: teaser_image_dropdown_switch -> teaser content switch on dropdown change is enabled 
			if (jQTeaserSwitch.length === 1) {
				this.switch(jQTeaserSwitch, data);
				return;
			}
			
			// template: teaser_image_dropdown -> link to page on dropdown change
			window.open(data.slug, data.target);

	},

	switch: function(jQTeaserSwitch, data) {
		var jQImage = jQTeaserSwitch.find('.js-image-and-dropdown-img'),
			imageSrc = jQImage.attr('src');
		imageSrc = imageSrc.split('/');
		imageSrc[imageSrc.length-1] = data.image;
		imageSrc = imageSrc.join('/');
		jQImage.attr('src', imageSrc);
		jQImage.attr('alt', data.title);
		jQTeaserSwitch.attr('href', data.slug);
		jQTeaserSwitch.attr('target', data.target);
		jQTeaserSwitch.find('.js-image-and-dropdown-title').html(data.title);
		jQTeaserSwitch.find('.js-image-and-dropdown-text').html(data.text);
	}

};