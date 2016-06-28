var helper = {

    isMobile: function() {
        if( navigator.userAgent.match(/Android/i) ||
            navigator.userAgent.match(/webOS/i) ||
            navigator.userAgent.match(/iPhone/i) ||
            navigator.userAgent.match(/iPad/i) ||
            navigator.userAgent.match(/iPod/i) ||
            navigator.userAgent.match(/BlackBerry/i) ||
            navigator.userAgent.match(/Windows Phone/i))
        {
            return true;
        } else {
            return false;
        }
    },

    gaTrack: function(eventCategory, eventAction, eventLabel, e) {
        try {
            var trackerName = ga.getAll()[0].get('name');
            ga(trackerName + '.send', {
                hitType: 'event',
                eventCategory: eventCategory,
                eventAction: eventAction,
                eventLabel: eventLabel,
                eventValue: parseInt($(e).get(0).timeStamp)
            });
        } catch(ex) {
            console.log(ex);
        }
    }


};