<?php
	$params = array(
		array(
			"type" => "dropdown",
			"heading" => __("Title Size",'fptcity'),
			"param_name" => "zo_title_size",
			"value" => array(
					"H2" => "h2",
					"H3" => "h3",
					"H4" => "h4",
					"H5" => "h5",
					"H6" => "h6"
			)
		),
		array(
			"type" => "colorpicker",
			"heading" => __("Icon - Color",'fptcity'),
			"param_name" => "zo_fancybox_icon_color",
			"value" => "transparent",
		),
        array(
            "type" => "colorpicker",
            "heading" => __("Icon - Border Color",'fptcity'),
            "param_name" => "zo_fancybox_border_color",
            "value" => "transparent",
        ),
		array(
            "type" => "textfield",
            "heading" => __("Icon - Font size",'fptcity'),
            "param_name" => "zo_fancybox_icon_size",
            "value" => "",
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Icon - Border Size",'fptcity'),
            "param_name" => "zo_fancybox_border_size",
            "value" => array(
                'Default' => '',
                'Large' => 'large'
            ),
            "template" => array('zo_fancybox--layout-1.php')
        ),
        array(
			"type" => "colorpicker",
			"heading" => __("Title Color",'fptcity'),
			"param_name" => "zo_fancybox_title_color",
			"value" => "#000",
		),
		array(
			"type" => "colorpicker",
			"heading" => __("Content Color",'fptcity'),
			"param_name" => "zo_fancybox_content_color",
			"value" => "#909090",
		),
        array(
            "type" => "colorpicker",
            "heading" => __("Fancybox Border Bottom Color",'fptcity'),
            "param_name" => "zo_fancybox_border_bottom_color",
            "value" => "transparent",
            "template" => array('zo_fancybox--layout-2.php')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Fancybox Style",'fptcity'),
            "param_name" => "zo_fancybox_font_style",
            "value" => array(
                'Default' => '',
                'Style 1' => 'style-1'
            ),
            "template" => array('zo_fancybox--layout-2.php')
        ),
        //custom button more
        array(
            "type" => "dropdown",
            "heading" => __("Custom Color Text More Info",'fptcity'),
            "param_name" => "text_more_info",
            "value" => array(
                'No' => '',
                'Yes' => 'yes'
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Color",'fptcity'),
            "param_name" => "text_more_info_color",
            'dependency' => array(
                "element"=>"text_more_info",
                "value"=>array(
                    "yes"
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Color Hover",'fptcity'),
            "param_name" => "text_more_info_color_hover",
            'dependency' => array(
                "element"=>"text_more_info",
                "value"=>array(
                    "yes"
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Custom Color Button More Info",'fptcity'),
            "param_name" => "button_more_info",
            "value" => array(
                'No' => '',
                'Yes' => 'yes'
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Border Color",'fptcity'),
            "param_name" => "button_more_info_border_color",
            'dependency' => array(
                "element"=>"button_more_info",
                "value"=>array(
                    "yes"
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Border Color Hover",'fptcity'),
            "param_name" => "button_more_info_border_color_hover",
            'dependency' => array(
                "element"=>"button_more_info",
                "value"=>array(
                    "yes"
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color",'fptcity'),
            "param_name" => "button_more_info_bg_color",
            'dependency' => array(
                "element"=>"button_more_info",
                "value"=>array(
                    "yes"
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color Hover",'fptcity'),
            "param_name" => "button_more_info_bg_color_hover",
            'dependency' => array(
                "element"=>"button_more_info",
                "value"=>array(
                    "yes"
                )
            )
        ),
	);
