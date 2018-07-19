(function($) {
    "use strict";

    // Debounce from (underscore JS)
    var debounce = function(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this,
                args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    /**
     * remove the attributes and classes from collapsible navbar when the window is resized
     */

    $(window).on('resize', debounce(function() {
        if (Modernizr.mq('(min-width: 992px)')) {
            $('#mentalpress-navbar-collapse')
                .removeAttr('style')
                .removeClass('in');
        }
    }, 500));

    /**
     * Maps
     */

    $('.js-where-we-are').each(function() {
        new SimpleMap($(this), {
            latLng: $(this).data('latlng'),
            markers: $(this).data('markers'),
            zoom: $(this).data('zoom'),
            type: $(this).data('type'),
            styles: $(this).data('style'),
        }).renderMap();
    });

    /**
     * Image Popup
     */

    $('.lightbox').each(function() {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true
            }
        });
    });

    /**
     * Footer widgets fix
     */

    $('[class*="col-md-%d"]').removeClass('col-md-%d').addClass('col-md-3');

    /**
     * Tooltips from BS
     */

    $('[data-toggle="tooltip"]').tooltip();

})(jQuery);
/* End Strict */
