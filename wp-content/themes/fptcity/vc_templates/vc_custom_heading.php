<?php
/**
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */
extract( shortcode_atts( array(
    'zo_custom_heading' => '',
    'zo_subtitle' => '',
    'zo_custom_heading_icon' => '',
    'zo_subtitle_size' => '',
    'zo_subtitle_font_weight' => '',
    'zo_subtitle_letter_spacing' => '',
    'zo_subtitle_lineheight' => '',
    'zo_subtitle_textalign' => ''
), $atts ) );
$output = $text = $google_fonts = $font_container = $el_class = $css = $google_fonts_data = $font_container_data = '';
extract( $this->getAttributes( $atts ) );
extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );
$settings = get_option( 'wpb_js_google_fonts_subsets' );
$subsets = '';
if ( is_array( $settings ) && ! empty( $settings ) ) {
    $subsets = '&subset=' . implode( ',', $settings );
}
if ( ! empty( $google_fonts_data ) && isset( $google_fonts_data['values']['font_family'] ) ) {
    wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}

$style = '';
if ( ! empty( $styles ) ) {
    $style = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
}

$sub_styles = array();
$sub_style = '';
if( !empty($zo_subtitle_size)) $sub_styles[] = 'font-size: ' . $zo_subtitle_size;
if( !empty($zo_subtitle_font_weight)) $sub_styles[] = 'font-weight: ' . $zo_subtitle_font_weight;
if( !empty($zo_subtitle_letter_spacing)) $sub_styles[] = 'letter-spacing: ' . $zo_subtitle_letter_spacing;
if( !empty($zo_subtitle_lineheight)) $sub_styles[] = 'line-height: ' . $zo_subtitle_lineheight;
if( !empty($zo_subtitle_textalign)) $sub_styles[] = 'text-align: ' . $zo_subtitle_textalign;
if( !empty($sub_styles) ) $sub_style = 'style="' . esc_attr( implode( ';', $sub_styles ) ) . '"';

//Subtitle Highlight
if( !empty($zo_custom_heading) ) {
    if($zo_custom_heading == 'subtitle-highlight') {
        $css_class .= ' zo-subtitle-highlight';

        $output .= '<div class="zo-custom-heading '. esc_attr( $css_class ) . '">';

        $output .= '<div class="zo-custom-heading-title" '. $style .'>' . $text . '</div>';

        if( !empty($zo_subtitle)) {
            $output .= '<' . $font_container_data['values']['tag'] . ' class="zo-custom-heading-subtitle" '.$sub_style.'>' . $zo_subtitle . '</' . $font_container_data['values']['tag'] . '>';
        }

        $output .= '</div>';

    } elseif( $zo_custom_heading == 'style-1' || $zo_custom_heading == 'style-2' ) {

        $css_class .= ' zo-title-line-bottom';
        $output .= '<div class="zo-custom-heading '. esc_attr( $css_class ) . '">';
        $output .= '<' . $font_container_data['values']['tag'] . ' class="zo-custom-heading-title zo-custom-heading-title" '.$style.'>' . $text . '</' . $font_container_data['values']['tag'] . '>';
        $output .= "<div class='zo-line-{$zo_custom_heading} {$zo_subtitle_textalign}'><span></span></div>";
        if( !empty($zo_subtitle)) {
            $output .= "<div class='zo-custom-heading-subtitle' {$sub_style} ><span>{$zo_subtitle}</span></div>";
        }
        $output .= '</div>';

    } elseif( $zo_custom_heading == 'style-3' ) {
		
		$css_class .= ' zo-title-line-bottom '.$zo_custom_heading;
		$output .= '<div class="zo-custom-heading '. esc_attr( $css_class ) . '">';
		if($text){
			$output .= '<' . $font_container_data['values']['tag'] . ' class="zo-custom-heading-title zo-custom-heading-title-' .$zo_custom_heading. '" '.$style.'>' . $text . '</' . $font_container_data['values']['tag'] . '>';
		}
		if( !empty($zo_subtitle)) {
            $output .= "<div class='zo-custom-heading-subtitle-{$zo_custom_heading}' {$sub_style} ><span>{$zo_subtitle}</span></div>";
        }
		$output .= "<div class='zo-line-{$zo_custom_heading} {$zo_subtitle_textalign}'><span></span></div>";
        $output .= '</div>';
		
    } elseif( $zo_custom_heading == 'style-4' || $zo_custom_heading == 'style-5' ) {

		$css_class .= ' zo-title-line-bottom '.$zo_custom_heading;
		$output .= '<div class="zo-custom-heading '. esc_attr( $css_class ) . '">';
		$output .= '<' . $font_container_data['values']['tag'] . ' class="zo-custom-heading-title zo-custom-heading-title-' .$zo_custom_heading. '" '.$style.'>' . $text . '</' . $font_container_data['values']['tag'] . '>';
		$output .= "<div class='zo-line-{$zo_custom_heading} {$zo_subtitle_textalign}'><span></span></div>";
		if( !empty($zo_subtitle)) {
            $output .= "<div class='zo-custom-heading-subtitle zo-custom-heading-subtitle-{$zo_custom_heading}' {$sub_style} ><span>{$zo_subtitle}</span></div>";
        }
        $output .= '</div>';

    } elseif( $zo_custom_heading == 'title-icon' ) {

        $css_class .= ' zo-title-icon';
        $icon = !empty($zo_custom_heading_icon) ? '<i class="fa '.$zo_custom_heading_icon.'"></i>' : '';
        $output .= '<div class="zo-custom-heading '. esc_attr( $css_class ) . '">';
        $output .= '<' . $font_container_data['values']['tag'] . ' class="zo-custom-heading-title" '. $style .'>' . $icon
            . $text . '</' . $font_container_data['values']['tag'] . '>';
        $output .= '</div>';

    } elseif( $zo_custom_heading == 'default-2') {

        $css_class .= ' zo-custom-heading-style-2';
        $output .= '<div class="zo-custom-heading '. esc_attr( $css_class ) . '">';
        $output .= '<' . $font_container_data['values']['tag'] . ' class="zo-custom-heading-title" '. $style .'>' . $text . '</' . $font_container_data['values']['tag'] . '>';
        if( !empty($zo_subtitle)) {
            $output .= "<div class='zo-custom-heading-subtitle {$zo_subtitle_textalign}' {$sub_style}><span>{$zo_subtitle}</span></div>";
        }
        $output .= '</div>';

    }
} else {

    $output .= '<div class="zo-custom-heading '. esc_attr( $css_class ) . '">';

    $output .= '<' . $font_container_data['values']['tag'] . ' class="zo-custom-heading-title" '. $style .'>' . $text . '</' . $font_container_data['values']['tag'] . '>';

    if( !empty($zo_subtitle)) {
        $output .= "<div class='zo-custom-heading-subtitle {$zo_subtitle_textalign}'><span>{$zo_subtitle}</span></div>";
    }

    $output .= '</div>';

}

echo do_shortcode($output);