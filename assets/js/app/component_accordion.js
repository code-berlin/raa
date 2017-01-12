var accordionComponent = {

    init: function() {
        var me = this;

        me.allPanels.hide();

        $('.accordion > dt').click(function() {
            $this = $(this);
            $target =  $this.next();

            if (!$target.hasClass('active')) {
                me.allPanels.removeClass('active').slideUp();
                me.allPanelsTitles.removeClass('active');
                $this.addClass('active');
                $target.addClass('active').slideDown();
            }

            return false;
        });
    },

    allPanels: $('.accordion > dd'),

    allPanelsTitles: $('.accordion > dt')

};
