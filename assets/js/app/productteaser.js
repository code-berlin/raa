var productteaser = {

    iframe: '',
    h: 0,

    init: function() {

        var me = this,
            template = $('body').data('template');

        this.iframe = $('#product-teaser-iframe');

        this.iframe.contents().find('.js-productteaser').flexslider({
            animation: 'fade',
            animationSpeed: 750,
            slideshow: false,
            start: function(slider) {
                me.setCtaHref(slider);
            },
            after: function(slider) {
                me.setCtaHref(slider);
            }
        });

        if (template !== 'article_page') {
            this.iframe.contents().find('.js-product-teaser-h2').remove();
            this.iframe.contents().find('.js-product-teaser-commercial').remove();
        }

        this.iframe.contents().find('.js-duty-text-trigger').on('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            $(this).siblings('.js-duty-text-content').toggleClass('_vis');
        });

        this.iframe.contents().find('.js-duty-text-close').on('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            me.closeDutyText();
        });

        this.iframe.contents().find('.js-duty-text-content').on('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
        });

        this.iframe.contents().find(document).on('click', function(e) {
            if (!$(e.target).hasClass('js-duty-text-content')) {
                me.closeDutyText();
            }
        });

        this.resizeIframe();

        $(window).resize(function() {
            me.resizeIframe();
        });


    },

    closeDutyText: function() {
        this.iframe.contents().find('.js-duty-text-content').removeClass('_vis');
    },

    setCtaHref: function(slider) {
        this.iframe.contents().find(slider).siblings('.js-productteaser-cta').attr('href', this.iframe.contents().find('#jsProductTeaserSlide-' + slider.currentSlide).attr('href'));
    },

    resizeIframe: function() {
        var me = this;
        me.h = 0;
        this.iframe.contents().find('.js-product-teaser-height').each(function() {
            me.h += $(this).outerHeight(true);
        });
        this.iframe.height(this.h + 'px');
    }

};
