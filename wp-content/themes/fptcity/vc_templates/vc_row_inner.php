<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row_Inner
 */
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass( $el_class );
$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_inner',
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

/* Link Color */
$link_style = "";
$uqid = uniqid();
$class_link = ' .zo_'.$uqid;
if($row_link_color || $row_link_color_hover || $row_head_color || $row_color){
    $link_style .= '<style type="text/css" scoped>';
    if($row_color){
        $link_style .= "".$class_link."{color: $row_color}";
    }
    if($row_head_color){
        $link_style .= "".$class_link." h1,".$class_link." h2,".$class_link." h3,".$class_link." h4,".$class_link." h5,".$class_link." h6 {color: $row_head_color}";
    }
    if($row_link_color){
        $link_style .= "".$class_link." a{color: $row_link_color}";
    }
    if($row_link_color_hover){
        $link_style .= "".$class_link." a:hover{color: $row_link_color_hover}";
    }
    $link_style .= '</style>';
}
/* End Link Color */
$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$css_class .=  ' zo_'. $uqid;
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= $link_style;
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= $after_output;
$output .= $this->endBlockComment( $this->getShortcode() );

echo $output;