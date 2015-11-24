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
			),
		),
		array(
			"type" => "dropdown",
			"heading" => __("Filter Style",'fptcity'),
			"param_name" => "zo_filter_style",
			"value" => array(
                'Default' => '',
                'Dot Style' => 'style-2'
			),
            "template" => array(
                'zo_grid--portfolio-1.php',
                'zo_grid--portfolio-2.php',
                'zo_grid--portfolio-3.php',
                'zo_grid--portfolio-4.php'
            )
		),
        array(
            "type" => "textfield",
            "heading" => __("Team Button More Text",'fptcity'),
            "param_name" => "zo_team_more_text",
            "value" => '',
            'dependency' => array(
                "element"=>"zo_team_more_info",
                "value"=>array(
                    "yes"
                )
            ),
            "template" => array('zo_grid--team-4.php')
        ),
        array(
            "type" => "iconpicker",
            "heading" => __("Team Button More Icon",'fptcity'),
            "param_name" => "zo_team_more_icon",
            "value" => '',
            'settings' => array(
                'emptyIcon' => true, // default true, display an "EMPTY" icon?
                'type' => 'fontawesome',
                'iconsPerPage' => 200, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                "element"=>"zo_team_more_info",
                "value"=>array(
                    "yes"
                )
            ),
            "template" => array('zo_grid--team-4.php')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Team Button Link",'fptcity'),
            "param_name" => "zo_team_more_link",
            "value" =>'',
            'dependency' => array(
                "element"=>"zo_team_more_info",
                "value"=>array(
                    "yes"
                )
            ),
            "template" => array('zo_grid--team-4.php')
        ),
	);
