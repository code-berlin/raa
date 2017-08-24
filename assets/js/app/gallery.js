var gallery = {

    init: function() {

        // get all gallery elements
        var jQGallery = $('.js-gallery'),
            me = this;

        if (jQGallery.length === 0) {
            return;
        }

        $.each(jQGallery, function(){
            me.create($(this));
        });

    },

    /**
     * Create a gallery
     * @param {jQuery Object} jQGallery
     */
    create: function(jQGallery) {

        var jQGalleryTitle = jQGallery.siblings('.js-gallery-title'),
            jQGalleryText = jQGallery.siblings('.js-gallery-text'),
            jQGalleryNavBtn = jQGallery.siblings('.js-gallery-nav').find('.js-gallery-nav-btn');

        // load images
        jQGallery.find('.js-appear-triggable').each(function(index, image) {
            $(image).trigger('triggerAppear');
        });

        jQGallery.removeClass('images-unloaded');

        jQGallery.flexslider({
            slideshow: false,
            before: function(slider) {
                var data = $(slider.slides[slider.animatingTo]).data();
                jQGalleryTitle.html(data.title);
                jQGalleryText.html(data.text);
            }
        });

        jQGalleryNavBtn.on('click', function() {
            jQGallery.flexslider($(this).data('direction'));
        });

    }

};
