$(document).ready(function() {

    if (helper.isMobile()) {
        $('html').addClass('mobile-device');
    }

    if (helper.isIE()) {
    	$('html').addClass('ie');
    }

});