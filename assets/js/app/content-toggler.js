var contentToggler = {

    init: function() {

        var toggler = $('.js-content-toggler');

        toggler.on('click', function(){
            var t = $(this);
            t.next().slideToggle(200);
            t.toggleClass('_open');
        });

    }

};