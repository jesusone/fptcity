<?php
/**
 * Add tabs params
 * 
 * @author Fox
 * @since 1.0.0
 */
if (shortcode_exists('vc_tab')) {
    vc_add_param("vc_tab", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Tab Background Color", 'fptcity'),
        "param_name" => "zo_tab_bg_color",
        "value" => ""
    ));
    vc_add_param("vc_tab", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Tab Border Color", 'fptcity'),
        "param_name" => "zo_tab_border_color",
        "value" => ""
    ));
    vc_add_param("vc_tab", array(
        "type" => "textfield",
        "heading" => __("Tab Icon", 'fptcity'),
        "param_name" => "zo_tab_icon"
    ));
}