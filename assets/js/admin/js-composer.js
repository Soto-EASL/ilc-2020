(function ($) {
    var toHide = [
        "vc_custom_heading",
        "vc_tta_pageable",
        "vc_wp_search",
        "vc_gutenberg",
        "vc_wp_recentcomments",
        "vc_wp_calendar",
        "vc_wp_tagcloud",
        "vc_wp_custommenu",
        "vc_wp_posts",
        "vc_wp_archives",
        "vc_wp_rss",
        "templatera",
        "vc_acf",
        "staff_social",
        "vc_masonry_media_grid",
        "vc_masonry_grid",
        "vc_media_grid",
        "vc_basic_grid",
        "vc_line_chart",
        "vc_round_chart",
        "vc_pie",
        "vc_progress_bar",
        "vc_flickr",
        "vc_widget_sidebar",
        "vc_cta",
        "vc_btn",
        "vc_pinterest",
        "vc_tweetmeme",
        "vc_facebook",
        "vc_hoverbox",
        "vc_message",
        "vc_text_separator",
        "vc_zigzag",
        "vc_icon",
        "vcex_animated_text",
        "vcex_author_bio",
        "vcex_blog_carousel",
        "vcex_blog_grid",
        "vcex_breadcrumbs",
        "vcex_bullets",
        "vcex_button",
        "vcex_callout",
        "vcex_countdown",
        "vcex_divider_dots",
        "vcex_divider_multicolor",
        "vcex_divider",
        "vcex_feature_box",
        "vcex_form_shortcode",
        "vcex_heading",
        "vcex_icon_box",
        "vcex_icon",
        "vcex_image",
        "vcex_image_banner",
        "vcex_image_ba",
        "vcex_image_carousel",
        "vcex_image_flexslider",
        "vcex_image_galleryslider",
        "vcex_image_grid",
        "vcex_image_swap",
        "vcex_leader",
        "vcex_list_item",
        "vcex_login_form",
        "vcex_milestone",
        "vcex_multi_buttons",
        "vcex_navbar",
        "vcex_newsletter_form",
        "vcex_portfolio_carousel",
        "vcex_portfolio_grid",
        "vcex_post_comments",
        "vcex_post_content",
        "vcex_post_media",
        "vcex_post_meta",
        "vcex_post_next_prev",
        "vcex_post_series",
        "vcex_post_terms",
        "vcex_post_type_archive",
        "vcex_post_type_carousel",
        "vcex_post_type_grid",
        "vcex_post_type_flexslider",
        "vcex_pricing",
        "vcex_recent_news",
        "vcex_searchbar",
        "vcex_shortcode",
        "vcex_skillbar",
        "vcex_social_links",
        "vcex_social_share",
        "vcex_spacing",
        "vcex_staff_carousel",
        "vcex_staff_grid",
        "vcex_teaser",
        "vcex_terms_carousel",
        "vcex_terms_grid",
        "vcex_testimonials_carousel",
        "vcex_testimonials_grid",
        "vcex_testimonials_slider",
        "vcex_users_grid",
        "vcex_woocommerce_carousel",
        "vcex_woocommerce_loop_carousel"
    ];
    var tabsToHide = [
        'Content',
        'Social',
        'Structure',
        'Total',
        'Deprecated',
        'WordPress Widgets'
    ];
    $('body').on('vcPanel.shown', function (e) {
        $('.vc_edit-form-tab-control', $(e.target)).each(function () {
            // Do things on Shortcode Editor
        });
    });
    //vc.edit_element_block_view
    vc && vc.events && vc.events.on('app.render', function () {
        vc.add_element_block_view.on('afterRender', function () {
            this.$el.find('[data-vc-ui-element="panel-tab-control"]').each(function () {
                var $element = $(this);
                if (-1 !== _.indexOf(tabsToHide, $.trim($element.text()))) {
                    $element.closest('li.vc_edit-form-tab-control').addClass('ilc-wbp-hide');
                }
            });
            $('[data-vc-ui-element="add-element-button"]', this.$content).each(function () {
                var $element = $(this);
                var sc = $element.data('element');
                if (sc && (-1 !== _.indexOf(toHide, sc))) {
                    $element.addClass('ilc-wbp-hide');
                }
            });
        });
    });
})(jQuery);