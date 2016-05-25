var collapsibleTeaser = {

    init: function() {
        var me = this;
        $('.js-teaser-collapsible-btn').on('click', function(e) {
            e.preventDefault();
            var imgRows = $(this).parents('.js-teaser-collapsible').find('.js-teaser-collapsible-closed');
            imgRows.removeClass('dn');
            $(this).remove();
            me.triggerImageLoading(imgRows);
        });
    },

    triggerImageLoading: function(imgRows) {

        var images = imgRows.find('.js-lazy-img'),
            w = $(window);

        images.each(function() {
            var image = $(this);
            if(image.offset().top < (w.height() + w.scrollTop())) {
                image.trigger('appear');
            }

        });
    }

};