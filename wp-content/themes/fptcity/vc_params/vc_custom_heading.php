<?php
/**
 * Add custom heading params
 * 
 * @author Fox
 * @since 1.0.0
 */
if (shortcode_exists('vc_custom_heading')) {
    vc_add_param("vc_custom_heading", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Custom Heading Style", 'fptcity'),
        "admin_label" => true,
        "param_name" => "zo_custom_heading",
        "value" => array(
            "Default" => 'default',
            "Default Style 2" => 'default-2',
            "Title Line Bottom - Style 1" => "style-1",
            "Title Line Bottom - Style 2" => "style-2",
			"Title Line Bottom - Style 3" => "style-3",
			"Title Line Bottom - Style 4" => "style-4",
			"Title Line Bottom - Style 5" => "style-5",
            "Sub Title Highlight" => "subtitle-highlight",
            "Title icon" => "title-icon"
        )
    ));
    vc_add_param("vc_custom_heading", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Sub Title", 'fptcity'),
        "admin_label" => true,
        "param_name" => "zo_subtitle",
        "value" => '',
        'dependency' => array(
            "element"=>"zo_custom_heading",
            "value"=>array(
                "default-2",
                "style-1",
                "style-2",
				"style-3",
				"style-4",
				"style-5",
                "subtitle-highlight"
            )
        )
    ));
    vc_add_param("vc_custom_heading", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Font Size", 'fptcity'),
        "admin_label" => true,
        "param_name" => "zo_subtitle_size",
        "value" => '',
        'dependency' => array(
            "element"=>"zo_custom_heading",
            "value"=>array(
                "default-2",
                "style-1",
                "style-2",
				"style-3",
				"style-4",
				"style-5",
                "subtitle-highlight"
            )
        )
    ));
    vc_add_param("vc_custom_heading", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Font Weight", 'fptcity'),
        "admin_label" => true,
        "param_name" => "zo_subtitle_font_weight",
        "value" => '',
        'dependency' => array(
            "element"=>"zo_custom_heading",
            "value"=>array(
                "default-2",
                "style-1",
                "style-2",
				"style-3",
				"style-4",
				"style-5",
                "subtitle-highlight"
            )
        )
    ));
    vc_add_param("vc_custom_heading", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Letter Spacing", 'fptcity'),
        "admin_label" => true,
        "param_name" => "zo_subtitle_letter_spacing",
        "value" => '',
        'dependency' => array(
            "element"=>"zo_custom_heading",
            "value"=>array(
                "default-2",
                "style-1",
                "style-2",
				"style-3",
				"style-4",
				"style-5",
                "subtitle-highlight"
            )
        )
    ));
    vc_add_param("vc_custom_heading", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Line height", 'fptcity'),
        "admin_label" => true,
        "param_name" => "zo_subtitle_lineheight",
        "value" => '',
        'dependency' => array(
            "element"=>"zo_custom_heading",
            "value"=>array(
                "default-2",
                "style-1",
                "style-2",
				"style-3",
				"style-4",
				"style-5",
                "subtitle-highlight"
            )
        )
    ));
    vc_add_param("vc_custom_heading", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Text Align", 'fptcity'),
        "admin_label" => true,
        "param_name" => "zo_subtitle_textalign",
        "value" => array(
            'Left' => 'left',
            'Center' => 'center',
            'Right' => 'right'
        ),
        'dependency' => array(
            "element"=>"zo_custom_heading",
            "value"=> array(
                "default-2",
                "style-1",
                "style-2",
				"style-3",
				"style-4",
				"style-5",
                "subtitle-highlight"
            )
        )
    ));

    vc_add_param("vc_custom_heading", array(
        'type' => 'iconpicker',
        'heading' => __( 'Title icon', 'fptcity' ),
        'param_name' => 'zo_custom_heading_icon',
        'value' => '',
        'settings' => array(
            'emptyIcon' => true, // default true, display an "EMPTY" icon?
            'iconsPerPage' => 200, // default 100, how many icons per/page to display
        ),
        'dependency' => array(
            "element"=>"zo_custom_heading",
            "value"=>array(
                "title-icon",
            )
        ),
        'description' => __( 'Select icon from library.', 'fptcity' ),
    ));

}