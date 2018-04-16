$(document).ready(function() {

    if (helper.isMobile()) {
        $('html').addClass('mobile-device');
    }

    console.log("HUHU!");
    if (helper.isIE()) {
    	$('html').addClass('ie');
    }

});