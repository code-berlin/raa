var scrollUp = {

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

        $(window).scroll(function(){
            var scrollTop = $('body').scrollTop();
            if (scrollTop > 300) {
                $('.js-scrollup-btn').fadeIn();
            } else {
                $('.js-scrollup-btn').fadeOut();
            }
        });

        $('.js-scrollup-btn').on('click', function(){

            var distance = $('body').scrollTop(),
                speed = distance/3;

            $('body, html').animate({
                'scrollTop': 0
            }, speed);

        });

        isInit = true;

    }


};