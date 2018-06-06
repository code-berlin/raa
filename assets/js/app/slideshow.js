/*

Slideshow Teaser -> Important notes:

usage: 

add slideshow.init() in your <theme>/main js file

if you like add options as paramater like

slideshow.init({
    animation: 'fade',
    animationSpeed: 750,
    controlNav: 'thumbnails',
    thumbnailTitle: true
})

Default Options are

{
    animation: 'fade',
    animationSpeed: 750,
    controlNav: 'thumbnails',
    thumbnailTitle: false
}

Attention --> lazyLoader.init(); musst be called after slideshow.init();

*******************************************

placeholder img (must be in /assets/images/themes/<theme>/ph-slideshow.png) set the rendered size if the images


*/

var slideshow = {

    /**
     * @param  {object} options
     */
    init: function(options) {

        var slideshow = $('.js-flexslider'),
            slideshowLiEls,
            thumbnailLiEls,
            me = this;

        if (slideshow.length === 0) {
            return;
        }

        // default options
        if (!options) {
            options = {
                animation: 'fade',
                animationSpeed: 750,
                controlNav: 'thumbnails',
                thumbnailTitle: false
            };
        }

        slideshow.flexslider(options);

        if (options.thumbnailTitle) {
            
            // add title to thumbnails
            slideshowLiEls = slideshow.find('.slides li');
            thumbnailLiEls = slideshow.find('.flex-control-thumbs li');

            slideshowLiEls.each(function(i){

                var slideshowLiEl = $(this),
                    thumbnailLiEl = $(thumbnailLiEls[i]),
                    anchor = slideshowLiEl.find('a'),
                    html = '';

                if (anchor.length > 0) {
                    html += '<div class="__mask"></div>';
                    html += '<div class="__title _link js-slideshow-title js-slideshow-title-link" data-link="'+ anchor.attr('href') + '" data-target="' + anchor.attr('target') + '" >';
                    html += slideshowLiEl.data('title');
                    html += '</div>';
                } else {
                    html += '<div class="__mask"></div>';
                    html += '<div class="__title js-slideshow-title">';
                    html += slideshowLiEl.data('title');
                    html += '</div>';
                }

                thumbnailLiEl.append(html);

            });

            // thumbnail user action handling
            $('.js-slideshow-title').on('mouseover', function(){
                me.onThumbnailHover($(this));
            });

            $('.js-slideshow-title-link').on('click', function(){
                me.onThumbnailClick($(this));
            });

        }

        // add thumbs class to center arrows vertically in slideshow image
        if (options.controlNav === 'thumbnails') {
            $('.js-teaser-slideshow').addClass('_w-thumbs');
        }

    },

    /**
     * change active slide if user really hover thumbnail
     * @param (jQuery Object) titleEl
     */
    onThumbnailHover: function(titleEl) {

        if (helper.isMobile()) {
            return;
        }

        /* titleEl.addClass('_hover');

        titleEl.one('mouseout', function(){
            titleEl.removeClass('_hover');
        });

        setTimeout(function(){
            if (titleEl.hasClass('_hover')) {
                titleEl.siblings('img').click();
            }
        }, 130); */

        titleEl.siblings('img').click();

    },

    /**
     * on thumbnail click - open link (on desktop) or change slide (on mobile)
     * @param (jQuery Object) titleEl
     */
    onThumbnailClick: function(titleEl) {

        var data = titleEl.data();

        if (!helper.isMobile()) {
            window.open(data.link, data.target);
            return;
        }

        titleEl.siblings('img').click();

    }

};