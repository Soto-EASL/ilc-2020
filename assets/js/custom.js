(function ($) {
    function ilcStickyFooterMsg() {
        var $sf = $('#ilc-sticky-footer-message-wrap');
        if ($sf.length < 1) {
            return false;
        }
        $('#outer-wrap').css('padding-bottom', $sf.outerHeight() + 'px');
        $sf.addClass('ilc-fms-sticky-enabled');
    }

    $(document).ready(function () {
        ilcStickyFooterMsg();

        $('#ilc-close-stikcy-message').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: ILC.ajaxUrl,
                data: {
                    action: 'ilc_save_closed_footer_message'
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                },
                fail: function () {
                    console.log('Failed');
                }
            });
            $(this).closest('#ilc-sticky-footer-message-wrap').slideUp(250, function () {
                $('#outer-wrap').css('padding-bottom', '0px');
                $(this).remove();
            });
            return false;
        });


        $('.ilc-toggle-text-trigger').on('click', function (e) {
            e.preventDefault();
            var $button = $(this),
                $con = $button.prev('.ilc-toggle-text');
            if ($con.is(':animated')) {
                return false;
            }
            if ($con.hasClass('ilc-active')) {
                $con.removeClass('ilc-active').slideUp(250);
                $button.html($button.data('more'));
            } else {
                $con.addClass('ilc-active').slideDown(250);
                $button.html($button.data('less'));
            }
        });
    });
})(jQuery);