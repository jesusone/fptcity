<?php

/**
 * Auto create css from Meta Options.
 *
 * @author Fox
 * @version 1.0.0
 */
class ZoTheme_DynamicCss
{

    function __construct()
    {
        add_action('wp_head', array($this, 'generate_css'));
    }

    /**
     * generate css inline.
     *
     * @since 1.0.0
     */
    public function generate_css()
    {
        global $smof_data, $zo_base;
        $css = $this->css_render();
        if (! $smof_data['dev_mode']) {
            $css = $zo_base->compressCss($css);
        }
        echo '<style type="text/css" data-type="zo_shortcodes-custom-css">'.$css.'</style>';
    }

    /**
     * header css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $smof_data, $zo_meta;
        ob_start();

        /* custom css.  */
        if( isset($smof_data['custom_css']) ) {
            echo wp_filter_nohtml_kses(trim($smof_data['custom_css']))."\n";
        }
        /* ==========================================================================
           Start Header
        ========================================================================== */
        /* Header Fixed Only Page */
        if (!empty($zo_meta->_zo_header_fixed_bg_color)) {
            echo "#zo-header.header-fixed-page {
                    background-color: ".esc_attr($zo_meta->_zo_header_fixed_bg_color).";
                }";
        }
        if (!empty($zo_meta->_zo_header_fixed_bg_color)) {
            echo "#zo-header.header-fixed-page {
                    background-color: ".esc_attr($zo_meta->_zo_header_fixed_bg_color).";
                }";
        }
        /* End Header Fixed Only Page */
        /* Custom Menu Color Only Page */
        if (!empty($zo_meta->_zo_header_menu_color)) {
            echo "#zo-header.header-menu-custom #zo-header-navigation .main-navigation .menu-main-menu > li > a, #zo-header.zo-header-1 #zo-menu-mobile-fixed {
                    color: ".esc_attr($zo_meta->_zo_header_menu_color).";
                }";
        }
        if (!empty($zo_meta->_zo_header_menu_color_hover)) {
            echo "#zo-header.header-menu-custom #zo-header-navigation .main-navigation .menu-main-menu > li > a:hover, #zo-header .widget_cart_search_wrap .widget_cart_search_wrap_item > a.icon:hover {
                    color: ".esc_attr($zo_meta->_zo_header_menu_color_hover).";
                }";
        }
        if (!empty($zo_meta->_zo_header_menu_color_active)) {
            echo "#zo-header.header-menu-custom #zo-header-navigation .main-navigation .menu-main-menu > li.current-menu-item > a,
                    #zo-header.header-menu-custom #zo-header-navigation .main-navigation .menu-main-menu > li.current-menu-ancestor > a,
                    #zo-header.header-menu-custom #zo-header-navigation .main-navigation .menu-main-menu > li.current_page_item > a,
                    #zo-header.header-menu-custom #zo-header-navigation .main-navigation .menu-main-menu > li.current_page_ancestor > a, #zo-header .widget_cart_search_wrap .widget_cart_search_wrap_item > a.icon:hover {
                    color: ".esc_attr($zo_meta->_zo_header_menu_color_active).";
                }";
        }
        /* End Custom Menu Color Only Page */

        /* Menu Fixed Only Page */
        if (!empty($zo_meta->_zo_header_fixed_menu_color)) {
            echo "#zo-header.header-fixed-page #zo-header-navigation .main-navigation .menu-main-menu > li > a {
                    color: ".esc_attr($zo_meta->_zo_header_fixed_menu_color).";
                }";
        }
        if (!empty($zo_meta->_zo_header_fixed_menu_color_hover)) {
            echo "#zo-header.header-fixed-page #zo-header-navigation .main-navigation .menu-main-menu > li > a:hover {
                    color: ".esc_attr($zo_meta->_zo_header_fixed_menu_color_hover).";
                }";
        }
        if (!empty($zo_meta->_zo_header_fixed_menu_color_active)) {
            echo "#zo-header.header-fixed-page #zo-header-navigation .main-navigation .menu-main-menu > li.current-menu-item > a,
                    #zo-header.header-fixed-page #zo-header-navigation .main-navigation .menu-main-menu > li.current-menu-ancestor > a,
                    #zo-header.header-fixed-page #zo-header-navigation .main-navigation .menu-main-menu > li.current_page_item > a,
                    #zo-header.header-fixed-page #zo-header-navigation .main-navigation .menu-main-menu > li.current_page_ancestor > a {
                    color: ".esc_attr($zo_meta->_zo_header_fixed_menu_color_active).";
                }";
        }
        /* End Menu Fixed Only Page */
        /* Start Page Title */
        if (!empty($zo_meta->_zo_page_title_margin)) {
            echo "body #page .page-title {
                    margin: ".esc_attr($zo_meta->_zo_page_title_margin).";
                }";
        }
        if (!empty($zo_meta->_zo_page_title_background)) {
            $background = wp_get_attachment_image_src($zo_meta->_zo_page_title_background, 'full');
            echo "body #zo-page-element-wrap {
                    background-image: url('".esc_url($background[0])."');
                }";
        }
        /* End Page Title */
        /* ==========================================================================
           End Header
        ========================================================================== */
        return ob_get_clean();
    }
}

new ZoTheme_DynamicCss();