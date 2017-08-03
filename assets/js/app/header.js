/**
 * SLIDE UP AND SLIDE DOWN OF header ON SCROLL
 */

var header = {

    isInit: false,

    init: function() {

        if (this.isInit) {
            return;
        }

        if ($(window).width() > 768) {
            window.addEventListener("orientationchange", function() {
                this.init();
            }.bind(this));
            return;
        }

        this.refScrollY = window.pageYOffset;
        this.header = $('header');
        this.tolerance = this.header.height() / 4;

        $(window).scroll(function() {

            if (window.pageYOffset > this.refScrollY + this.tolerance && window.pageYOffset > 0) { // window.pageYOffset >= 0 -> ignore bouncing on ios
                this.slideUp();
            }

            if (window.pageYOffset < this.refScrollY - this.tolerance) {
               this.slideDown();
            }

        }.bind(this));

        isInit = true;

    },

    /**
     * will slide-up header
     * trigger event slideUpStart
     */
    slideUp: function() {
        this.header.addClass('_slide-up');
        this.refScrollY = window.pageYOffset;
    },

    /**
     * will slide down header
     * trigger event slideDownStart
     */
    slideDown: function() {
        this.header.removeClass('_slide-up');
        this.refScrollY = window.pageYOffset;
    }

};