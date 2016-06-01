$(document).ready(function() {

    if (helper.isMobile()) {
        $('html').addClass('mobile-device');
    }

    $('.js-scrollup-btn').on('click', function(){

        var distance = $('body').scrollTop(),
            speed = distance/3;

        $('body, html').animate({
            'scrollTop': 0
        }, speed);

    });

});