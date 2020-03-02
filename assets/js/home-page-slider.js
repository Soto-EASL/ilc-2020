(function ($) {
    $(document).ready(function () {
        if ('function' == typeof $.fn.revolution) {
            $(".ilc-homepage-slider").each(function () {
                var $slider = $(this);
                var autoplay = $slider.data('autoplay');
                var delay = $slider.data('delay');
                autoplay = autoplay || true;
                delay = delay || 6000;

                var options = {
                    delay: delay,
                    sliderLayout: "fullwidth",
                    responsiveLevels: [1660, 1366, 1024, 480],
                    gridwidth: [2000, 1366, 1024, 480],
                    gridheight: [495, 400, 400, 250]
                };

                if (!autoplay) {
                    options.stopLoop = "on";
                    options.stopAfterLoops = 0;
                    options.stopAtSlide = 1;
                }

                var api = $slider.show().revolution(options);
                var $wrap = $slider.closest('.ilc-home-page-slider-wrap');
                $wrap.find(".ilc-hps-nav-arrow-left").on('click', function (e) {
                    e.preventDefault();
                    api.revprev();
                });
                $wrap.find(".ilc-hps-nav-arrow-right").on('click', function (e) {
                    e.preventDefault();
                    api.revnext();
                });
                $wrap.find(".ilc-hps-nav-dot-item").on('click', function (e) {
                    var n = $(this).data('slidenumber');
                    e.preventDefault();
                    if (!$(this).hasClass('ilc-hps-dot-current')) {
                        api.revnext(n);
                        $wrap.find(".ilc-hps-dot-current").removeClass('ilc-hps-dot-current');
                        $(this).addClass('ilc-hps-dot-current');
                    }
                }).eq(0).addClass("ilc-hps-dot-current");
                api.on('revolution.slide.onchange', function(event, data) {
                    $wrap.find(".ilc-hps-dot-current").removeClass('ilc-hps-dot-current');
                    $wrap.find(".ilc-hps-nav-dot-item").eq(data.slideLIIndex).addClass('ilc-hps-dot-current');

                });
            });
        }
    });
})(jQuery);