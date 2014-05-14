(function ($) {
    "use strict";

    var Carousel = function () {
        var variables = [];

        this.interval = '';
        this.animationSpeed = 600;
        this.carouselSliding = false;
        this.slidingInterval = 5000;
        this.chariotsAmount = 0;
        this.animationEasing = 'easeInOutCubic';
        this.sliding = false;

        /*
        * Sets a variable inside the private variables container
        */
        this._set = function (variable, value) {
            variables[variable] = value;
        };

        /*
        * Retrieves a variable from the private variables container
        */
        this._get = function (variable) {
            return variables[variable];
        };
    };

    Carousel.prototype = {
        // Properties.
        $body: $('body'),
        $mainContainer: $('.carousel-container'),
        $container: $('.carousel'),
        cleanTrigger: '.buttons',
        trigger: '.buttons:not(.animating)',
        element: '.chariots',
        currentBodyWidth: 0,

        // Methods.
        init: function () {
            var self = this;

            // Bind events
            if (!this._get('eventsBinded')) {
                this.bindEvents();
                this._set('eventsBinded', true);
            }

            this.getNumberOfSlides();
            this.resizeImages();
            this.adjustContainerWidth();
            this.makeCarouselInfinite();
        },
        getNumberOfSlides: function () {
            this.chariotsAmount = this.$container.find('.chariots').length;
        },
        makeCarouselInfinite: function () {
            var self = this;

            // In case we have more than one slide, copy the first item
            // and append it at the last position to have a nice
            // infinite carousel effect...
            this.$container.each(function () {
                var $this = $(this);

                if (self.chariotsAmount > 1) {
                    if ($this.hasClass('infinite-carousel')) {
                        var $firstItem = $this.find(self.element + ':first-child'),
                            $firstItemClone = $firstItem.clone();

                        $firstItem.addClass('active');
                        $firstItemClone.attr('data-id', self.chariotsAmount);
                        $firstItemClone.addClass('cloned');

                        $this.append($firstItemClone);
                    }

                    self.startSliding();
                }
            });
        },

        /*
        * Makes images as wide as the body.
        *
        * The images container is huge in order to have a carousel,
        * so we can't make images 100% wide, we need to do it
        * this way (also for window resize).
        */
        resizeImages: function () {
            this.currentBodyWidth = this.$body.width();
            $(this.element).width(this.currentBodyWidth);
        },
        adjustContainerWidth: function () {
            this.$container.width((this.chariotsAmount * this.currentBodyWidth) + this.currentBodyWidth);
        },
        getPosition: function (coordinate) {
            var position = 0;

            if (coordinate === 'top') {
                position = this.$container.position().top;
            }

            return $('.carousel-wrapper').position().top;
        },
        getHeight: function () {
            return this.$container.height();
        },

        /*
        * Slides the carousel.
        *
        * Salides the carousel with or without animation to the desired position
        */
        slide: function ($elementsContainer, position, animate) {
            var self = this,
                $container = this.$mainContainer;

            if (animate !== undefined && animate) {
                $container.animate({
                    marginLeft: position
                }, this.animationSpeed, this.animationEasing, function () {
                      self.removeSafetyLock();
                      self.$body.trigger('resize-carousel');
                });
            } else {
                $container.css('margin-left', position);
            }
        },
        startSliding: function () {
            var self = this;

            this.carouselSliding = true;

            this.interval = setInterval(function () {
                self.$body.trigger('move-carousel');
            }, this.slidingInterval);
        },
        stopSliding: function () {
            clearInterval(this.interval);
            this.carouselSliding = false;
        },
        isSliding: function () {
            return this.carouselSliding;
        },
        reverseSlide: function ($elementsContainer, currentPosition, parentWidth) {
            var $container = $elementsContainer || this.$container;

            this.slide($container, currentPosition, false);

            return currentPosition + parentWidth;
        },

        /*
        * Resets carousel position.
        *
        * This is helpful when resizing the browser window or the images size.
        */
        resetCarouselPosition: function () {
            var self = this;

            this.$container.each(function () {
                var $activeCarousel = $(this),
                    $activeWidget = $activeCarousel.find(self.element + '.active'),
                    activeWidgetWidth = $activeWidget.width(),
                    activeWidgetId = $activeWidget.attr('data-id'),
                    position = -(activeWidgetWidth * activeWidgetId);

                self.adjustContainerWidth();

                if ($activeWidget.hasClass('cloned')) {
                    position = -((activeWidgetWidth * activeWidgetId));
                }

                self.slide($activeCarousel, position, false);
            });
        },
        slideManually: function (element, slideId) {
            var chariotID = slideId || $(element).attr('data-slide-id'),
                $chariots = $(this.element),
                $chariot =  $chariots.filter('[data-id="'+chariotID+'"]'),
                chariotWidth = $chariot.width(),
                position = -(chariotWidth * chariotID);

            $chariots.removeClass('active');
            $chariot.addClass('active');

            if ($chariot.hasClass('cloned')) {
                position = -((chariotWidth * chariotID));
            }

            this.slide({}, position, true);
        },
        moveElements: function ($element) {
            var $thisContainer = $('.carousel-container'),
                direction = 'right',
                widgetSelector = this.element,
                activeClassName = 'active',
                $widgetActive = $thisContainer.find(widgetSelector + '.'+activeClassName),
                $widgets = $thisContainer.find(widgetSelector),
                $sibling = $(),
                parentWidth = $widgetActive.width(),
                totalElements = $widgets.length,
                maxStep = parseInt(totalElements, 10) * parentWidth,
                currentPosition = parseInt($thisContainer.css('margin-left'), 10),
                step = (direction === 'right') ? -parentWidth : parentWidth,
                nextPosition = parseInt(step + currentPosition, 10),
                buttonID = 0;

            // Remove active status on all widgets containers.
            this.$container.removeClass(activeClassName);

            // Remove the active class on all widgets.
            $widgets.removeClass(activeClassName);

            // Note: when we are on the last or first item, we need to do the trick of moving the
            // container without any animation to the dummy slide, and then animate to the
            // right position.
            if (direction === 'right') {
                if (nextPosition > -maxStep) {
                    $sibling = $widgetActive.next(widgetSelector);
                    currentPosition += step;
                } else {
                    $sibling = $thisContainer.find(widgetSelector+':first-child').next(widgetSelector);
                    currentPosition = this.reverseSlide($thisContainer, 0, -parentWidth);
                }
            } else {
                if (nextPosition <= 0) {
                    $sibling = $widgetActive.prev(widgetSelector);
                    currentPosition += step;
                } else {
                    $sibling = $thisContainer.find(widgetSelector+':last-child').prev(widgetSelector);
                    currentPosition = this.reverseSlide($thisContainer, -(maxStep - parentWidth), parentWidth);
                }
            }

            // Add the active class to current selected widget. If it's the next after the last
            // add the class to its right sibling. If it's the previous before the first, add the
            // class to its left sibling.
            $sibling.addClass(activeClassName);

            // Add active status on current widgets container for further use
            // when the browser is resized.
            $thisContainer.addClass(activeClassName);

            // Select corresponding button.
            if ($sibling.attr('data-id') < this.chariotsAmount) {
                buttonID = $sibling.attr('data-id');
            }

            this.selectButton($(this.cleanTrigger + '[data-slide-id="'+buttonID+'"]'));

            // Animate the carousel.
            this.slide($thisContainer, parseInt(currentPosition, 10), true);
        },
        selectButton: function ($element) {
            $(this.trigger).removeClass('selected');
            $element.addClass('selected');
        },
        addSafetyLock: function () {
            $(this.trigger).addClass('animating');
        },
        removeSafetyLock: function () {
            $(this.cleanTrigger).removeClass('animating');
        },

        /*
        * Binds events.
        */
        bindEvents: function () {
            var self = this;

            this.$mainContainer.on('mouseenter', '.chariots', function () {
                self.stopSliding();
            }).on('mouseleave', '.chariots', function () {
                if (!self.isSliding()) {
                    self.startSliding();
                }
            });

            this.$body.on('move-carousel', function (e) {
                self.moveElements();
            });

            this.$body.on('select-chariot', function (e, element) {
                self.slideManually(element);
            });

            this.$body.on('resize-carousel', function () {
                self.resizeImages();
                self.resetCarouselPosition();
            });
        }
    };

    window.carousel = new Carousel();
})(jQuery);