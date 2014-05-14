(function ($) {
    "use strict";

    var MainMenuWidget = function () {
        this.initialized = false;
        this.threshold = 750;
        this.sideBarSize = 15;

        // Classes
        this.opened = 'sub-menu-opened';
        this.paddingTopZero = 'padding-top-zero';
        this.staticHeader = 'static';
        this.fixedHeader = 'fixed';
    };

    MainMenuWidget.prototype = {
        init: function () {
            if (!this.initialized) {
                this.$trigger = $('#menu-scaled-trigger');
                this.$body = $('body');
                this.$header = $('header');
                this.$mainMenu = $('aside .menu');
                this.$mainContainer = $('#main-container');
                this.$container = $('.container');
                this.$sidebar = $('aside');

                this.bindEvents();

                this.initialized = true;
            }
        },
        handleSidebar: function () {
            var self = this,
                subMenuOpened = this.$mainMenu.hasClass(this.opened),
                leftPosition = 0,
                sidebarWidth = this.$sidebar.width(),
                speed = 500;

            // Make the header static positioned to avoid issues
            // on mobile devices browsers, and open the sidebar.
            if (!subMenuOpened) {
                leftPosition = -1 * (sidebarWidth);
                this.$sidebar.addClass('opened');
            }

            // Animate the sidebar.
            this.$mainContainer.css({
                'left': leftPosition
            });

            // Animate the sidebar.
            this.$header.css({
                'left': leftPosition
            });

            // Let us know when the menu is opened.
            this.$body.toggleClass('hidden');
            this.$mainMenu.toggleClass(this.opened);
        },
        handleResize: function (thisWindow) {
            var $this = $(thisWindow),
                subMenuOpened = this.$mainMenu.hasClass(this.opened),
                containerClosedClass = 'closed';

            this.$sidebar.css('top', 0);

            // Show the regular menu for normal resolutions.
            if ($this.width() <= this.threshold) {
                if (!subMenuOpened) {
                    this.$mainMenu.hide();
                } else {
                    this.$mainMenu.show();
                    this.$body.addClass('hidden');
                }

                this.$mainContainer.removeClass(containerClosedClass);
            } else {
                this.$mainMenu.hide();
                this.$body.removeClass('hidden');

                this.$mainContainer.addClass(containerClosedClass);
            }

            this.$header.addClass(self.fixedHeader);
        },
        bindEvents: function () {
            var self = this;

            $(window).on('resize', function (e) {
                self.handleResize(this);
            });

            // Show the mobile menu (sidebar).
            this.$trigger.on('click', function () {
                self.handleSidebar();
                self.$body.trigger('resize-carousel');
            });
        }
    };

    window.mainMenuWidget = new MainMenuWidget();
})(jQuery);