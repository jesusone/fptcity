(function ($) {
    "use strict";
    jQuery(document).ready(function ($) {
        var display;
        var no_display;
        $('body').on('click', function (e) {
            var target = $(e.target);
            if (target.parents('.shopping_cart_dropdown').length == 0 && !target.hasClass('shopping_cart_dropdown')) {
                $('.widget_searchform_content,.shopping_cart_dropdown, .widget_cart_search_wrap [data-display]').removeClass('active');
            }
        });
        $('body').on('click', $('.widget_searchform_content,.shopping_cart_dropdown'), function (e) {
            e.stopPropagation();
        });
        $('body').on('click', $('.widget_cart_search_wrap [data-display]'), function (e) {
            var container = $(this).parents('.widget_cart_search_wrap');
            e.stopPropagation();
            var _this = $(this);
            display = _this.attr('data-display');
            no_display = _this.attr('data-no_display');
            _this.toggleClass('active');
            if ($(display, container).hasClass('active')) {
                $(display, container).removeClass('active');
            } else {
                $(display, container).addClass('active');
                $(no_display, container).removeClass('active');
            }
        });
    });

})(jQuery);
jQuery(document).ready(function (e) {
    var _wl = '';
    clickLink('#loginwithajaxwidget-2', '.wg-title');
    clickLink('.widget_searchform_content_wrap', 'a');
    mouseupC(_wl);
    function clickLink(cl, bl) {
        _wl = _wl + cl + ' > div:visible,';
        var el = e(cl + ' ' + bl).next();
        e(cl).click(function () {
            if (!e(el).is(':visible')) {
                el.show().animate({opacity: 1}, 100);
            }
        });
    }

    function mouseupC(cl) {
        e(document).mouseup(function (_e) {
            var t = e(cl + '_');
            if (!(t.is(_e.target) || 0 !== t.has(_e.target).length)) {
                t.animate({opacity: 0}, 100, function () {
                    e(this).hide();
                });
            }
        });
    }
    e('.lwa-links a').click(function () {
        e(".lwa-remember").show();
    });
    e('.lwa-submit-button a').click(function () {
        e(".lwa-remember").hide();
    });
});
