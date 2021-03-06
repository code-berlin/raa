/**
 *Lazy Loader for images
*/
var lazyLoader = {

    // bind appear listener
    init: function() {

        var lazyImages = $('.js-lazy-img'),
            appearTriggableImages = $('.js-appear-triggable'),
            lazySlideshow = $('.js-lazy-slideshow');

        this.attachAppearEventListener(lazyImages);
        this.attachOrientationChangeListener(lazyImages);
        this.attachTriggeredAppearEventListener(appearTriggableImages);
        this.attachOrientationChangeListener(appearTriggableImages);

        if (lazySlideshow.length > 0) {
            this.attachAppearEventListenerForSlideshow(lazySlideshow);
        }

    },

    /**
     * attach appear event listener to jq obejcts for lazy loading
     *
     * @param object jQObj - jquery object to whom the lazy loading is attached
     */
    attachAppearEventListener: function(jQObj) {

        var me = this;

        jQObj.on('appear', function() {
            me.onImageAppear($(this));
        });

        jQObj.initAppear({once:true});

    },

    /**
     * attach event listener to jq obejcts for lazy loading
     *
     * @param object jQObj - jquery object to whom the lazy loading is attached
     */
    attachTriggeredAppearEventListener: function(jQObj) {

        var me = this;

        jQObj.on('triggerAppear', function() {
            me.onImageAppear($(this));
        });

    },

    attachOrientationChangeListener: function(images) {
        $(window).on('orientationchange', function() {
            images.each(function(index, image){
                image = $(image);
                if (!image.hasClass('loaded')) {
                    return;
                }
                this.setImgSrc($(image));
            }.bind(this));
        }.bind(this));
    },

    /*
     * special handling for images in slideshow
     * @param object slideshow - jquery object of the slideshow
     */
    attachAppearEventListenerForSlideshow: function(slideshow) {

        var me = this;

        slideshow.on('appear', function() {

            var slideshow = $(this),
                thumbnails = slideshow.find('.flex-control-thumbs img'),
                placeholder = slideshow.siblings('.js-lazy-slideshow-placeholder');
                devicePixelRatio = typeof window.devicePixelRatio !== 'undefined' ? Math.ceil(window.devicePixelRatio) : 1;

            slideshow.find('.js-slideshow-lazy-img').each(function(i){

                var img = $(this),
                    thumbnail = thumbnails[i] ? $(thumbnails[i]) : false,
                    width = placeholder.width() * devicePixelRatio,
                    height = placeholder.height() * devicePixelRatio;

                src = '/image/preview/' + width + '/' + height + '/' + img.data('src');
                img.attr('src', src);
                img.addClass('loaded');

                if (thumbnail) {
                   thumbnail.attr('src', src);
                   thumbnail.addClass('loaded');
                }

            });

            placeholder.remove();

        });

        slideshow.initAppear({once:true});
    },

    // handle appear
    onImageAppear: function(img) {

        if (img.hasClass('loaded')) {
            return;
        }

        // stay with placeholder, if no image is set
        if (img.data('src') === '') {
            return;
        }

        img.load(function() {
            img.addClass('loaded');
        });

        this.setImgSrc(img);
    },

    setImgSrc: function(img) {

        var devicePixelRatio = typeof window.devicePixelRatio !== 'undefined' ? Math.ceil(window.devicePixelRatio) : 1,
            width = img.width() * devicePixelRatio,
            height,
            src,
            storedWidth = img.data('width'),
            dataSrc = img.data('src');

            // via raa text editor inserted images cannot have data-src, the check for id
            if (!dataSrc) {
                dataSrc = img.attr('id');
            }

        // if bigger img than needen is already loaded -> abort
        if (storedWidth && width <= storedWidth) {
            return;
        }

        height = img.data('height') ? img.data('height') : img.height() * devicePixelRatio;
        src = '/image/preview/' + width +'/' + height + '/' + dataSrc;

        // store image width to ensure that after next orientation change
        // we load new image only if higher resolution is needed
        img.data('width', width);

        img.attr('src', src);
    }

};