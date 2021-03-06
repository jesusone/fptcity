<?php

/**
 * Auto create .css file from Theme Options
 * @author Fox
 * @version 1.0.0
 */
class ZoTheme_StaticCss
{

    public $scss;

    function __construct()
    {
        global $smof_data;

        /* scss */
        $this->scss = new scssc();

        /* set paths scss */
        $this->scss->setImportPaths(get_template_directory() . '/assets/scss/');

        /* generate css over time */
        if (isset($smof_data['dev_mode']) && $smof_data['dev_mode']) {
            $this->generate_file();
        } else {
            /* save option generate css */
            add_action("redux/options/smof_data/saved", array(
                $this,
                'generate_file'
            ));
        }
    }

    /**
     * generate css file.
     *
     * @since 1.0.0
     */
    public function generate_file()
    {
        global $smof_data;
        if (! empty($smof_data)) {

            /* write options to scss file */
            file_put_contents(get_template_directory() . '/assets/scss/options.scss', $this->css_render(), LOCK_EX); // Save it

            /* minimize CSS styles */
            if (!$smof_data['dev_mode']) {
                $this->scss->setFormatter('scss_formatter_compressed');
            }

            /* compile scss to css */
            $css = $this->scss_render();

            $file = "static.css";

            if(!empty($smof_data['presets_color']) && $smof_data['presets_color']){
                $file = "presets-".$smof_data['presets_color'].".css";
            }

            /* write static.css file */
            file_put_contents(get_template_directory() . '/assets/css/' . $file, $css, LOCK_EX); // Save it
        }
    }

    /**
     * scss compile
     *
     * @since 1.0.0
     * @return string
     */
    public function scss_render(){
        /* compile scss to css */
        return $this->scss->compile('@import "master.scss"');
    }

    /**
     * main css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $smof_data, $zo_base;
        ob_start();

        /* google fonts. */
        $zo_base->setGoogleFont($smof_data['google-font-1'], $smof_data['google-font-selector-1']);
        $zo_base->setGoogleFont($smof_data['google-font-2'], $smof_data['google-font-selector-2']);
        $zo_base->setGoogleFont($smof_data['google-font-3'], $smof_data['google-font-selector-3']);

        /* local fonts */
        $zo_base->setFontFace($smof_data['local-fonts-1'], $smof_data['local-fonts-selector-1']);
        $zo_base->setFontFace($smof_data['local-fonts-2'], $smof_data['local-fonts-selector-2']);
        /* forward options to scss. */

        echo '$primary_color:'.esc_attr($smof_data['primary_color']).';';
        echo '$link_color:'.esc_attr($smof_data['link_color']).';';
        echo '$link_color_hover:'.esc_attr($smof_data['link_color_hover']).';';
        echo '$header_height:'.esc_attr($smof_data['header_height']['height']).';';
        echo '$sticky_header_height:'.esc_attr($smof_data['menu_sticky_height']['height']).';';
        /* ==========================================================================
           Start Header
        ========================================================================== */
        /* Header Top */
        if($smof_data['header_margin']){
            echo "body.admin-bar #zo-header.zo-header-1 { margin-top: calc(".esc_attr($smof_data['header_margin']['margin-top'])." + 32px );}";
        }
        if($smof_data['bg_header_top_color']){
            echo "body #zo-header-top {background-color:".esc_attr($smof_data['bg_header_top_color']).";}";
        }
        if($smof_data['header_top_color']){
            echo "body #zo-header-top {color:".esc_attr($smof_data['header_top_color']).";}";
        }
        /* End Header Top */

        /* Header Main */
        if($smof_data['header_height']){
            echo "#zo-header-logo a {
                    line-height:".esc_attr($smof_data['header_height']['height']).";
                }";
        }
        if($smof_data['main_logo_height']){
            echo "#zo-header-logo a img {
                        max-height:".esc_attr($smof_data['main_logo_height']['height']).";
                    }";
        }
        if(!empty($smof_data['bg_header']['rgba'])) {
            echo "#zo-header {
                        background-color:".esc_attr($smof_data['bg_header']['rgba']).";
                    }";
        }
        /* End Header Main */

        /* Sticky Header */
        if($smof_data['menu_sticky_height']['height']){
            echo "#zo-header.header-fixed {
                    height:".esc_attr($smof_data['menu_sticky_height']['height']).";
                }";
        }
        if($smof_data['menu_sticky_height']['height']){
            echo "body.fixed-margin-top {
                    margin-top:".esc_attr($smof_data['menu_sticky_height']['height']).";
                }";
        }
        if(!empty($smof_data['bg_sticky_header'])){
            echo "#zo-header.zo-main-header.header-fixed {
                    background-color:".esc_attr($smof_data['bg_sticky_header']['rgba']).";
                }";
        }
        if($smof_data['sticky_logo_height']){
            echo "#zo-header.header-fixed #zo-header-logo a img {
                    max-height:".esc_attr($smof_data['sticky_logo_height']['height']).";
                }";
        }
        if($smof_data['menu_sticky_height']['height']){
            echo "#zo-header.header-fixed #zo-header-logo a,
                #zo-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li {
                    line-height:".esc_attr($smof_data['menu_sticky_height']['height']).";
                }";
        }
        /* End Sticky Header */

        /* Main Menu */
        echo '@media(min-width: 992px) {';
        if($smof_data['menu_position'] == '1') {
            echo "#zo-header-navigation .main-navigation .menu-main-menu,
                    #zo-header-navigation .main-navigation div.nav-menu > ul {
                        text-align: left;
                    }";
        }
        if($smof_data['menu_position'] == '2') {
            echo "#zo-header-navigation .main-navigation .menu-main-menu,
                    #zo-header-navigation .main-navigation div.nav-menu > ul {
                        text-align: right;
                    }";
        }
        if($smof_data['menu_position'] == '3') {
            echo "#zo-header-navigation .main-navigation .menu-main-menu,
                    #zo-header-navigation .main-navigation div.nav-menu > ul {
                        text-align: center;
                    }";
        }
        if($smof_data['menu_color_first_level']){
            echo "#zo-header-navigation .main-navigation .menu-main-menu > li > a,
                          #zo-header-navigation .main-navigation .menu-main-menu > ul > li > a {
                        color:".esc_attr($smof_data['menu_color_first_level']).";
                        line-height:".esc_attr($smof_data['header_height']['height']).";
                    }";
        }
        if($smof_data['menu_color_first_level']){
            echo "#zo-header-navigation .main-navigation .menu-main-menu > li.menu-item-has-children > .zo-menu-toggle {
                        color:".esc_attr($smof_data['menu_color_first_level']).";
                    }";
        }
        if($smof_data['header_height']){
            echo "#zo-header-navigation .main-navigation .menu-main-menu > li,
                          #zo-header-navigation .main-navigation .menu-main-menu > ul > li {
                        line-height:".esc_attr($smof_data['header_height']['height']).";
                    }";
        }
        if($smof_data['menu_color_hover_first_level']){
            echo "#zo-header-navigation .main-navigation .menu-main-menu > li > a:hover,
                          #zo-header-navigation .main-navigation .menu-main-menu >ul > li > a:hover {
                        color:".esc_attr($smof_data['menu_color_hover_first_level']).";
                    }";
        }
        if($smof_data['menu_color_active_first_level']){
            echo "#zo-header-navigation .main-navigation .menu-main-menu > li.current-menu-item > a,
                          #zo-header-navigation .main-navigation .menu-main-menu > li.current-menu-ancestor > a,
                          #zo-header-navigation .main-navigation .menu-main-menu > li.current_page_item > a,
                          #zo-header-navigation .main-navigation .menu-main-menu > li.current_page_ancestor > a,
                          #zo-header-navigation .main-navigation .menu-main-menu > ul > li.current-menu-item > a,
                          #zo-header-navigation .main-navigation .menu-main-menu > ul > li.current-menu-ancestor > a,
                          #zo-header-navigation .main-navigation .menu-main-menu > ul > li.current_page_item > a,
                          #zo-header-navigation .main-navigation .menu-main-menu > ul > li.current_page_ancestor > a {
                            color:".esc_attr($smof_data['menu_color_active_first_level']).";
                    }";
        }
        if($smof_data['menu_first_level_uppercase']){
            echo "#zo-header-navigation .main-navigation .menu-main-menu > li > a,
                          #zo-header-navigation .main-navigation .menu-main-menu > ul > li > a {
                        text-transform: uppercase;
                    }";
        }
        echo '}';
        /* End Main Menu */

        /* Main Menu Header Fixed Only Page */
        if($smof_data['menu_color_first_level']){
            echo "#zo-header.zo-main-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li > a {
                    color:".esc_attr($smof_data['menu_color_first_level']).";
                }";
        }
        if($smof_data['menu_color_hover_first_level']){
            echo "#zo-header.zo-main-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li > a:hover {
                    color:".esc_attr($smof_data['menu_color_hover_first_level']).";
                }";
        }
        if($smof_data['menu_color_active_first_level']){
            echo "#zo-header.zo-main-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li.current-menu-item > a,
                      #zo-header.zo-main-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li.current-menu-ancestor > a,
                      #zo-header.zo-main-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li.current_page_item > a,
                      #zo-header.zo-main-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li.current_page_ancestor > a {
                        color:".esc_attr($smof_data['menu_color_active_first_level']).";
                }";
        }
        /* End  Main Menu Header Fixed Only Page */
        /* Sub Menu */
        if(!empty($smof_data['menu_color_sub_level'])){
            echo "#zo-header-navigation .main-navigation .menu-main-menu > li ul li > a,
                      #zo-header-navigation .main-navigation .menu-main-menu > ul > li ul li a,
                      #zo-header-navigation .main-navigation .menu-main-menu > ul > li ul li .zo-menu-toggle {
                    color:".esc_attr($smof_data['menu_color_sub_level']).";
                }";
        }
        if(!empty($smof_data['menu_color_hover_sub_level'])){
            echo "#zo-header-navigation .main-navigation .menu-main-menu > li ul li:hover > a,
                    #zo-header-navigation .main-navigation .menu-main-menu > li ul li:hover .zo-menu-toggle,
                      #zo-header-navigation .main-navigation .menu-main-menu > li ul a:focus,
                      #zo-header-navigation .main-navigation .menu-main-menu > li ul li.current-menu-item a,
                      #zo-header-navigation .main-navigation .menu-main-menu > ul > li ul li:hover a,
                      #zo-header-navigation .main-navigation .menu-main-menu > ul > li ul a:focus,
                      #zo-header-navigation .main-navigation .menu-main-menu > ul > li ul li.current-menu-item a, #zo-header-navigation .main-navigation .menu-main-menu > li ul li.current-menu-parent > a, #zo-header-navigation .main-navigation .menu-main-menu > li ul li.current-menu-parent > .zo-menu-toggle, #zo-header-navigation .main-navigation .menu-main-menu > li ul li.current-menu-ancestor > a, #zo-header-navigation .main-navigation .menu-main-menu > li ul li.current-menu-ancestor > .zo-menu-toggle {
                        color:".esc_attr($smof_data['menu_color_hover_sub_level']).";
                }";
        }
        if(!empty($smof_data['menu_border_color_bottom'])){
            echo "#zo-header-navigation .main-navigation li ul li a {
                    border-bottom: 1px solid ".esc_attr($smof_data['menu_item_border_color']).";
                }";
        }
        /* End Sub Menu */

        /* ==========================================================================
           End Header
        ========================================================================== */

        /* ==========================================================================
           Start Body
        ========================================================================== */
        /* All Slector - Color Primary */
        if($smof_data['primary_color']) {
            echo ".wg-title,
                .zo-blog-layout1 .zo-blog-header .zo-blog-date,
                #secondary [class*='widget_'] ul li a:hover,
                #secondary [class*='widget-'] ul li a:hover:before,
                #secondary [class*='widget_'] ul li a:hover:before,
                #secondary [class*='widget-'] ul li a:hover:before {
                    color:".esc_attr($smof_data['primary_color']).";
                }";
        }
        if($smof_data['primary_color']) {
            echo ".navigation .page-numbers:hover,
                .navigation .prev.page-numbers:hover:before,
                .navigation .next.page-numbers:hover:after,
                .navigation .page-numbers.current {
                    background:".esc_attr($smof_data['primary_color']).";
                }";
        }
        /* End All Slector - Color Primary */

        /* All Slector - Background Color Secondary */
        if($smof_data['secondary_color']){
            echo ".entry-blog .entry-date, .zo-blog-layout1 .zo-blog-header .zo-blog-date,
                body .mejs-controls .mejs-time-rail .mejs-time-current,
                body .mejs-controls .mejs-time-rail .mejs-time-loaded,
                body .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
                    background-color:".esc_attr($smof_data['secondary_color']).";
                }";
        }
        /* End All Slector - Background Color Secondary */

        /* Title Style Color */
        if(!empty($smof_data['column_style']) && $smof_data['column_style'] == 'title-primary-color'){
            echo ".title-primary-color .wpb_text_column > wpb_wrapper h3 {
                    border-bottom: 1px solid ".esc_attr($smof_data['title-primary-color']).";
                }";
        }
        if(!empty($smof_data['column_style']) && $smof_data['column_style'] == 'title-secondary-color'){
            echo ".title-secondary-color .wpb_text_column > wpb_wrapper h3 {
                    border-bottom: 1px solid ".esc_attr($smof_data['title-secondary-color']).";
                }";
        }
        /* ==========================================================================
           End Body
        ========================================================================== */

        /* ==========================================================================
           Start Footer
        ========================================================================== */
        /* Footer Top */
        if($smof_data['footer_top_color']){
            echo "#zo-footer-top {
                    color:".esc_attr($smof_data['footer_top_color']).";
                }";
        }
        if($smof_data['footer_heading_color']){
            echo "#zo-footer-top .wg-title {
                    color:".esc_attr($smof_data['footer_heading_color']).";
                }";
        }
        if($smof_data['footer_heading_color']){
            echo "#zo-footer-top .wg-title:before {
                    background-color:".esc_attr($smof_data['footer_heading_color']).";
                }";
        }
        if($smof_data['footer_top_link_color']){
            echo "#zo-footer-top a {
                    color:".esc_attr($smof_data['footer_top_link_color']).";
                }";
        }
        if($smof_data['footer_top_link_color_hover']){
            echo "#zo-footer-top a:hover {
                    color:".esc_attr($smof_data['footer_top_link_color_hover']).";
                }";
        }
        /* End Footer Top */

        /* Footer Bottom */
        if($smof_data['footer_bottom_color']){
            echo "#zo-footer-bottom {
                    color:".esc_attr($smof_data['footer_bottom_color']).";
                }";
        }
        /* End Footer Bottom */
        /* ==========================================================================
           End Footer
        ========================================================================== */

        /* ==========================================================================
           Start Button
        ========================================================================== */
        /** Button Default **/
        if($smof_data['btn_default_color']){
            echo ".vc_general.vc_btn3.btn , button.vc_general.vc_btn3, a.vc_general.vc_btn3, .btn, .button, input[type='submit'] {
                    color:".esc_attr($smof_data['btn_default_color']).";
                    background-color:".esc_attr($smof_data['btn_default_bg_color']).";
                    -webkit-border-radius:".esc_attr($smof_data['btn_default_border_radius']['height']).";
                       -moz-border-radius:".esc_attr($smof_data['btn_default_border_radius']['height']).";
                        -ms-border-radius:".esc_attr($smof_data['btn_default_border_radius']['height']).";
                         -o-border-radius:".esc_attr($smof_data['btn_default_border_radius']['height']).";
                            border-radius:".esc_attr($smof_data['btn_default_border_radius']['height']).";
                }";
        }
        if($smof_data['btn_default_color_hover']) {
            echo ".vc_general.vc_btn3.btn:hover, button.vc_general.vc_btn3:hover, a.vc_general.vc_btn3:hover, .btn:hover, .button:hover, input[type='submit']:hover,.vc_general.vc_btn3.btn:focus, button.vc_general.vc_btn3:focus, a.vc_general.vc_btn3:focus, .btn:focus, .button:focus, input[type='submit']:focus {
                    color:".esc_attr($smof_data['btn_default_color_hover']).";
                    background-color:".esc_attr($smof_data['btn_default_bg_color_hover']).";
                }";
        }
        /** Button Primary **/
        if($smof_data['btn_primary_color']){
            echo ".vc_general.vc_btn3.btn.btn-primary, .btn.btn-primary {
                    color:".esc_attr($smof_data['btn_primary_color']).";
                    background-color:".esc_attr($smof_data['btn_primary_bg_color']).";
                    -webkit-border-radius:".esc_attr($smof_data['btn_primary_border_radius']['height']).";
                       -moz-border-radius:".esc_attr($smof_data['btn_primary_border_radius']['height']).";
                        -ms-border-radius:".esc_attr($smof_data['btn_primary_border_radius']['height']).";
                         -o-border-radius:".esc_attr($smof_data['btn_primary_border_radius']['height']).";
                            border-radius:".esc_attr($smof_data['btn_primary_border_radius']['height']).";
                }";
        }
        if($smof_data['btn_primary_color_hover']) {
            echo ".vc_general.vc_btn3.btn.btn-primary:hover, .btn.btn-primary:hover, .vc_general.vc_btn3.btn.btn-primary:focus, .btn.btn-primary:focus {
                    color:".esc_attr($smof_data['btn_primary_color_hover']).";
                    background-color:".esc_attr($smof_data['btn_primary_bg_color_hover']).";
                }";
        }
        if($smof_data['button_text_uppercase'] == '1'){
            echo ".btn , button, .button, a.vc_general.vc_btn3, input[type='submit'] {
                    text-transform: uppercase;
                }";
        }
        /* ==========================================================================
           End Button
        ========================================================================== */

        /* ==========================================================================
           Start Blog
        ========================================================================== */
        if($smof_data['secondary_color']){
            echo ".entry-blog .entry-date .arow-date, .zo-blog-layout1 .zo-blog-header .zo-blog-date .arow-date {
                border-color: transparent ".esc_attr($smof_data['secondary_color'])." ".esc_attr($smof_data['secondary_color'])." transparent;
            }";
        }

        if($smof_data['primary_color']){
            echo ".entry-gallery .carousel-control {
                background: ".esc_attr($smof_data['primary_color']).";
            }";
        }
        if($smof_data['secondary_color']){
            echo ".entry-blog .entry-gallery .carousel-control:hover .fa {
                color: ".esc_attr($smof_data['secondary_color']).";
            }";
        }
        /* ==========================================================================
          End Blog
        ========================================================================== */

        /* ==========================================================================
           Start sidebar
        ========================================================================== */
        /* Widget Tags */
        if($smof_data['primary_color']){
            echo ".tagcloud a {
                    background-color:".esc_attr($smof_data['primary_color']).";
                    border: 1px solid ".esc_attr($smof_data['primary_color']).";
                }";
        }
        if($smof_data['secondary_color']){
            echo ".tagcloud a:hover {
                    background-color:".esc_attr($smof_data['secondary_color']).";
                    color:".esc_attr($smof_data['primary_color']).";
                }";
        }
        /* End Widget Tags */
        /* ==========================================================================
           Start sidebar
        ========================================================================== */
        return ob_get_clean();
    }
}

new ZoTheme_StaticCss();