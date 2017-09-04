var link = {

    init: function() {

        $('.js-link-el').on('click', function(e) {
            e.preventDefault();
            window.location = $(this).data('clickurl');
        });

        $(document).on('click', '.js-teaser-linked', function(e) {
            if ($(e.target).attr('href')) {
                return;
            }
            window.location = $(this).find('a').attr('href');
        });

    }


};