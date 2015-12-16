/**
 *Lazy Loader for images
*/
var lazyLoader = {

    // bind appear listener
    init: function() {

        var lazyImages = $('.js-lazy-img'),
            appearTriggableImages = $('.js-appear-triggable');

        this.attachAppearEventListener(lazyImages);
        this.attachOrientationChangeListener(lazyImages);
        this.attachTriggeredAppearEventListener(appearTriggableImages);
        this.attachOrientationChangeListener(appearTriggableImages);

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

    // handle appear
    onImageAppear: function(img) {

        if (img.hasClass('loaded')) {
            return;
        }

        img.load(function() {
            img.addClass('loaded');
        });

        this.setImgSrc(img);
    },

    setImgSrc: function(img) {

        var width = img.width() * window.devicePixelRatio,
            height,
            src,
            storedWidth = img.data('width');

        // if bigger img than needen is already loaded -> abort
        if (storedWidth && width <= storedWidth) {
            return;
        }

        height = img.height() * window.devicePixelRatio;
        src = '/image/preview/' + width +'/' + height + '/' + img.data('src');

        // store image width to ensure that after next orientation change
        // we load new image only if higher resolution is needed
        img.data('width', width);

        img.attr('src', src);
    }

};