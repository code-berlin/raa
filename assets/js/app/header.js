/**
 * SLIDE UP AND SLIDE DOWN OF header ON SCROLL
 */

var header = {

    isInit: false,

    init: function() {

        if ($(window).width() > 768 || this.isInit) {
            window.addEventListener("orientationchange", function() {
                this.init();
            }.bind(this));
            return;
        }

        this.refScrollY = window.scrollY;
        this.header = $('header');
        this.tolerance = this.header.height() / 4;

        $(window).scroll(function() {

            if (window.scrollY > this.refScrollY + this.tolerance && window.scrollY > 0) { // window.scrollY >= 0 -> ignore bouncing on ios
                this.slideUp();
            }

            if (window.scrollY < this.refScrollY - this.tolerance) {
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
        this.refScrollY = window.scrollY;
    },

    /**
     * will slide down header
     * trigger event slideDownStart
     */
    slideDown: function() {
        this.header.removeClass('_slide-up');
        this.refScrollY = window.scrollY;
    }

};