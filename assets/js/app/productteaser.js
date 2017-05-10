var productteaser = {
    
    init: function() {

        var me = this;

        $('.js-productteaser').flexslider({
            animation: 'fade',
            animationSpeed: 750,
            slideshow: false
        });

        $('.js-duty-text-trigger').on('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            $(this).siblings('.js-duty-text-content').toggleClass('_vis');
        });

        $('.js-duty-text-close').on('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            me.closeDutyText();
        });

        $('.js-duty-text-content').on('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
        });

        $(document).on('click', function(e) {
            if (!$(e.target).hasClass('js-duty-text-content')) {
                me.closeDutyText();
            }
        });

        
        
    },

    closeDutyText: function() {
        $('.js-duty-text-content').removeClass('_vis');
    }

};
