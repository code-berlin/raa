/**
 * hide most of mobile content and show all on btn click
 */

var mobilecontent = {

    jQContentInnerEls: null,
    jQMobileReadmoreHidden: null,

    init: function() {

        this.jQContentInnerEls = $('#jsContent > *');
        this.jQMobileReadmoreHidden = $('.js-mobile-readmore-hidden');

        this.hideInitial();

        $('#jsMobileReadmoreBtn').on('click', function() {
            this.jQContentInnerEls.removeClass('mobile-hidden');
            this.jQMobileReadmoreHidden.removeClass('mobile-hidden');
            $('.js-mobile-readmore').remove();
        }.bind(this));

    },

    /**
     * hide all content after (incl) 2nd h2 and other marked elements
     */
    hideInitial: function() {
        var h2Count = 0;
        $.each(this.jQContentInnerEls, function(index, element){
            var jQElement = $(element);
            if (jQElement.prop('tagName') === 'H2') {
                h2Count++;
            }
            if (h2Count > 1 && !jQElement.hasClass('js-mobile-readmore')) {
                this.hide(jQElement);
            }
        }.bind(this));
        this.hide(this.jQMobileReadmoreHidden);
    },

    /**
     * hide jQ Element(s) on mobile
     * @param  {jQuery Object} jQElement
     */
    hide: function(jQElement) {
        jQElement.addClass('mobile-hidden');
    }

};