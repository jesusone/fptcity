<?php
/**
 * @var $this WPBakeryShortCode_VC_Btn
 * @var $atts
 * @var $style
 * @var $shape
 * @var $color
 * @var $custom_background
 * @var $custom_text
 * @var $size
 * @var $align
 * @var $link
 * @var $title
 * @var $button_block
 * @var $el_class
 * @var $inline_css
 * @var $button_type
 * @var $padding //Vu Edit
 * @var $border //Vu Edit
 * @var $style //Vu Edit
 * @var $letter_spacing //Vu Edit
 * @var $add_icon
 * @var $i_align
 * @var $i_type
 *
 * ///
 * @var $a_href
 * @var $a_title
 * @var $a_target
 */
$defaults = array(
	'button_type' => '',
	'padding' => '',
	'border' => '',
	'style' => '',
	'align' => 'inline',
	'link' => '',
	'title' => '',
	'letter_spacing' => '',
	'radius' => '0',
	'button_block' => '',
	'el_class' => '',
	'add_icon' => '',
	'i_align' => 'left',
	'i_icon_pixelicons' => '',
	'i_type' => 'fontawesome',
	'i_icon_fontawesome' => 'fa fa-adjust',
	'i_icon_openiconic' => 'vc-oi vc-oi-dial',
	'i_icon_typicons' => 'typcn typcn-adjust-brightness',
	'i_icon_entypo' => 'entypo-icon entypo-icon-note',
	'i_icon_linecons' => 'vc_li vc_li-heart',
	'css_animation' => '',
);
$inline_css = '';
$icon_wrapper = false;
$icon_html = false;

$atts = shortcode_atts( $defaults, $atts );
extract( $atts );
//parse link
$link = ( $link == '||' ) ? '' : $link;
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
	$use_link = true;
	$a_href = $link['url'];
	$a_title = $link['title'];
	$a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
}

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' vc_btn3-container ' . $el_class, $this->settings['base'], $atts );
$css_class .= $this->getCSSAnimation( $css_animation );
$button_html = $title;
$button_class = '';
if ( '' == trim( $title ) ) {
	$button_class .= ' vc_btn3-o-empty';
	$button_html = '<span class="vc_btn3-placeholder">&nbsp;</span>';
}
if ( 'true' == $button_block && 'inline' != $align ) {
	$button_class .= ' vc_btn3-block';
}
if ( 'true' === $add_icon ) {
	$button_class .= ' vc_btn3-icon-' . $i_align;
	vc_icon_element_fonts_enqueue( $i_type );

	if ( isset( ${"i_icon_" . $i_type} ) ) {
		if ( 'pixelicons' === $i_type ) {
			$icon_wrapper = true;
		}
		$iconClass = ${"i_icon_" . $i_type};
	} else {
		$iconClass = 'fa fa-adjust';
	}

	if ( $icon_wrapper ) {
		$icon_html = '<i class="vc_btn3-icon"><span class="vc_btn3-icon-inner ' . esc_attr( $iconClass ) . '"></span></i>';
	} else {
		$icon_html = '<i class="vc_btn3-icon ' . esc_attr( $iconClass ) . '"></i>';
	}


	if ( $i_align == 'left' ) {
		$button_html = $icon_html . ' ' . $button_html;
	} else {
		$button_html .= ' ' . $icon_html;
	}
}
?>	
	<div class="zo_button <?php echo esc_attr( trim( $css_class ) ); ?> vc_btn3-<?php echo esc_attr( $align ); ?>"><?php
if ( $use_link ):
	?><a class="vc_general vc_btn3 <?php echo esc_attr( $button_type ); ?> <?php echo esc_attr( trim( $button_class ) ); ?> <?php echo esc_attr($border);?> <?php echo esc_attr($style);?>"
	     href="<?php echo esc_url( $a_href ); ?>"
	     title="<?php echo esc_attr( $a_title ); ?>"
	     target="<?php echo trim( esc_attr( $a_target ) ); ?>"
		style="<?php echo isset($padding) ? 'padding: ' . esc_attr($padding): '';?>; 
		 <?php echo isset($letter_spacing) ? 'letter-spacing: ' . esc_attr($letter_spacing): '';?>; 
		 <?php echo isset($radius) ? 'border-radius: ' . esc_attr($radius): '';?>; ">
	<?php echo do_shortcode($inline_css); ?>><?php echo do_shortcode($button_html); ?></a><?php
else:
	?>
	<button  class="vc_general vc_btn3 <?php echo esc_attr( $button_type ); ?> <?php echo esc_attr( $button_class ); ?> <?php echo esc_attr($border);?> <?php echo esc_attr($style);?>" <?php echo do_shortcode($inline_css); ?> 
		 style="<?php echo isset($padding) ? 'padding: ' . esc_attr($padding): '';?>; 
		 <?php echo isset($letter_spacing) ? 'letter-spacing: ' . esc_attr($letter_spacing): '';?>; 
		 <?php echo isset($radius) ? 'border-radius: ' . esc_attr($radius): '';?>; ">
			<?php echo do_shortcode($button_html); ?></button><?php
endif; ?></div><?php echo do_shortcode($this->endBlockComment( 'vc_btn3' )) . "\n";
