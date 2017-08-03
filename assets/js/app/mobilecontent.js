/**
 * hide most of mobile content and show all on btn click
 */

var mobilecontent = {

    jQContentInnerEls: null,
    jQMobileReadmoreHidden: null,

    /** 
     * @param  {number} visibleH2s (optional)
     */
    init: function(visibleH2s) {

        this.jQContentInnerEls = $('#jsContent > *');
        this.jQMobileReadmoreHidden = $('.js-mobile-readmore-hidden');

        this.hideInitial(visibleH2s);

        $('#jsMobileReadmoreBtn').on('click', function() {
            this.jQContentInnerEls.removeClass('mobile-hidden');
            this.jQMobileReadmoreHidden.removeClass('mobile-hidden');
            $('.js-mobile-readmore').remove();
        }.bind(this));

    },

    /**
     * hide all content after (incl) first unvisible set h2 and other marked elements
     * @param  {number} visibleH2s (optional) - how many h2s should be visible
     */
    hideInitial: function(visibleH2s) {
        
        var h2Count = 0;
        
        visibleH2s = typeof visibleH2s !== 'undefined' ? visibleH2s : 1;

        $.each(this.jQContentInnerEls, function(index, element){
            var jQElement = $(element);
            if (jQElement.prop('tagName') === 'H2') {
                h2Count++;
            }
            if (h2Count > visibleH2s && !jQElement.hasClass('js-mobile-readmore')) {
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