<?php
/**
 * Add custom heading params
 *
 * @author Fox
 * @since 1.0.0
 */
if (shortcode_exists('vc_images_carousel')) {

    vc_add_param("vc_images_carousel", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Carousel Libraries", 'fptcity'),
        "admin_label" => true,
        "param_name" => "zo_carousel_lib",
        "value" => array(
            'Default' => '',
            'ZO Carousel' => 'zo'
        )
    ));

    vc_add_param("vc_images_carousel", array(
        "type" => "checkbox",
        "class" => "",
        "heading" => __("Show Pagination With Image", 'fptcity'),
        "admin_label" => true,
        "param_name" => "zo_page_image",
        "value" => array('Yes' => 'yes'),
        'dependency' => array(
            "element"=>"zo_carousel_lib",
            "value"=> array(
                'zo'
            )
        )
    ));

    vc_add_param("vc_images_carousel", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Number Image For Pagination", 'fptcity'),
        "admin_label" => true,
        "param_name" => "zo_page_image_count",
        "value" => 3,
        'dependency' => array(
            "element"=>"zo_carousel_lib",
            "value"=> array(
                'zo'
            )
        )
    ));

}