<?php
vc_map(array(
    "name" => 'ZO Google Map',
    "base" => "zo_googlemap",
    "icon" => "zo_icon_for_vc",
    "category" => __('ZoTheme Shortcodes', 'fptcity'),
    "description" => __('Map API V3 Unlimited Style', 'fptcity'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __('API Key', 'fptcity'),
            "param_name" => "api",
            "value" => '',
            "description" => __('Enter you api key of map, get key from (https://console.developers.google.com)', 'fptcity')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Address', 'fptcity'),
            "param_name" => "address",
            "value" => 'New York, United States',
            "description" => __('Enter address of Map', 'fptcity')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Coordinate', 'fptcity'),
            "param_name" => "coordinate",
            "value" => '',
            "description" => __('Enter coordinate of Map, format input (latitude, longitude)', 'fptcity')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Click Show Info window', 'fptcity'),
            "param_name" => "infoclick",
            "value" => array(
                __("Yes, please", 'fptcity') => true
            ),
            "description" => __('Click a marker and show info window (Default Show).', 'fptcity')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Marker Coordinate', 'fptcity'),
            "param_name" => "markercoordinate",
            "value" => '',
            "description" => __('Enter marker coordinate of Map, format input (latitude, longitude)', 'fptcity')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Marker Title', 'fptcity'),
            "param_name" => "markertitle",
            "value" => '',
            "description" => __('Enter Title Info windows for marker', 'fptcity')
        ),
        array(
            "type" => "textarea",
            "heading" => __('Marker Description', 'fptcity'),
            "param_name" => "markerdesc",
            "value" => '',
            "description" => __('Enter Description Info windows for marker', 'fptcity')
        ),
        array(
            "type" => "attach_image",
            "heading" => __('Marker Icon', 'fptcity'),
            "param_name" => "markericon",
            "value" => '',
            "description" => __('Select image icon for marker', 'fptcity')
        ),
        array(
            "type" => "textarea_raw_html",
            "heading" => __('Marker List', 'fptcity'),
            "param_name" => "markerlist",
            "value" => '',
            "description" => __('[{"coordinate":"41.058846,-73.539423","icon":"","title":"title demo 1","desc":"desc demo 1"},{"coordinate":"40.975699,-73.717636","icon":"","title":"title demo 2","desc":"desc demo 2"},{"coordinate":"41.082606,-73.469718","icon":"","title":"title demo 3","desc":"desc demo 3"}]', 'fptcity')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Info Window Max Width', 'fptcity'),
            "param_name" => "infowidth",
            "value" => '200',
            "description" => __('Set max width for info window', 'fptcity')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Map Type", 'fptcity'),
            "param_name" => "type",
            "value" => array(
                "ROADMAP" => "ROADMAP",
                "HYBRID" => "HYBRID",
                "SATELLITE" => "SATELLITE",
                "TERRAIN" => "TERRAIN"
            ),
            "description" => __('Select the map type.', 'fptcity')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style Template", 'fptcity'),
            "param_name" => "style",
            "value" => array(
                "Default" => "",
                "Custom" => "custom",
                "Light Monochrome" => "light-monochrome",
                "Blue water" => "blue-water",
                "Midnight Commander" => "midnight-commander",
                "Paper" => "paper",
                "Red Hues" => "red-hues",
                "Hot Pink" => "hot-pink"
            ),
            "description" => 'Select your heading size for title.'
        ),
        array(
            "type" => "textarea_raw_html",
            "heading" => __('Custom Template', 'fptcity'),
            "param_name" => "content",
            "value" => '',
            "description" => __('Get template from http://snazzymaps.com', 'fptcity')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Zoom', 'fptcity'),
            "param_name" => "zoom",
            "value" => '13',
            "description" => __('zoom level of map, default is 13', 'fptcity')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Width', 'fptcity'),
            "param_name" => "width",
            "value" => 'auto',
            "description" => __('Width of map without pixel, default is auto', 'fptcity')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Height', 'fptcity'),
            "param_name" => "height",
            "value" => '350px',
            "description" => __('Height of map without pixel, default is 350px', 'fptcity')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Scroll Wheel', 'fptcity'),
            "param_name" => "scrollwheel",
            "value" => array(
                __("Yes, please", 'fptcity') => true
            ),
            "description" => __('If false, disables scrollwheel zooming on the map. The scrollwheel is disable by default.', 'fptcity')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Pan Control', 'fptcity'),
            "param_name" => "pancontrol",
            "value" => array(
                __("Yes, please", 'fptcity') => true
            ),
            "description" => __('Show or hide Pan control.', 'fptcity')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Zoom Control', 'fptcity'),
            "param_name" => "zoomcontrol",
            "value" => array(
                __("Yes, please", 'fptcity') => true
            ),
            "description" => __('Show or hide Zoom Control.', 'fptcity')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Scale Control', 'fptcity'),
            "param_name" => "scalecontrol",
            "value" => array(
                __("Yes, please", 'fptcity') => true
            ),
            "description" => __('Show or hide Scale Control.', 'fptcity')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Map Type Control', 'fptcity'),
            "param_name" => "maptypecontrol",
            "value" => array(
                __("Yes, please", 'fptcity') => true
            ),
            "description" => __('Show or hide Map Type Control.', 'fptcity')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Street View Control', 'fptcity'),
            "param_name" => "streetviewcontrol",
            "value" => array(
                __("Yes, please", 'fptcity') => true
            ),
            "description" => __('Show or hide Street View Control.', 'fptcity')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Over View Map Control', 'fptcity'),
            "param_name" => "overviewmapcontrol",
            "value" => array(
                __("Yes, please", 'fptcity') => true
            ),
            "description" => __('Show or hide Over View Map Control.', 'fptcity')
        )
    )
));

class WPBakeryShortCode_zo_googlemap extends ZoShortcode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>