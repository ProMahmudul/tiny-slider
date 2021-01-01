;(function ($) {
    $(document).ready(function () {
        var slider = tns({
            container: '.ts-slider',
            speed: 300,
            autoplayTimeout: 3000,
            items: 1,
            autoplay: true,
            autoHeight: true,
            controls: false,
            nav: false,
            autoplayHoverPause: true,
        });
    });
})(jQuery);