var link = {

    init: function() {

        $('.js-link-el').on('click', function(e) {
            e.preventDefault();
            window.location = $(this).data('clickurl');
        });

    }


};