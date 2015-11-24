<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $onclick
 * @var $custom_links
 * @var $custom_links_target
 * @var $img_size
 * @var $images
 * @var $el_class
 * @var $mode
 * @var $slides_per_view
 * @var $wrap
 * @var $autoplay
 * @var $hide_pagination_control
 * @var $hide_prev_next_buttons
 * @var $speed
 * @var $partial_view
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_images_carousel
 */
//custom VC Images Carousel
extract( shortcode_atts( array(
    'zo_carousel_lib' => '',
    'zo_page_image' => '',
    'zo_page_image_count' => 3
), $atts ) );

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$gal_images = '';
$link_start = '';
$link_end = '';
$el_start = '';
$el_end = '';
$slides_wrap_start = '';
$slides_wrap_end = '';
$pretty_rand = $onclick == 'link_image' ? ' rel="prettyPhoto[rel-' . get_the_ID() . '-' . rand() . ']"' : '';

wp_enqueue_script( 'vc_carousel_js' );
wp_enqueue_style( 'vc_carousel_css' );
if ( 'link_image' === $onclick ) {
    wp_enqueue_script( 'prettyphoto' );
    wp_enqueue_style( 'prettyphoto' );
}

$el_class = $this->getExtraClass( $el_class );

if ( '' === $images ) {
    $images = '-1,-2,-3';
}

if ( 'custom_link' === $onclick ) {
    $custom_links = explode( ',', $custom_links );
}

if( $zo_carousel_lib === 'zo' ) {
    wp_enqueue_script('zo-slick-js', get_template_directory_uri(). '/assets/js/slick.min.js', array('jquery'), '1.0');
    wp_enqueue_style('zo-slick-css', get_template_directory_uri(). '/assets/css/slick.css','','1.0','all');	
    wp_enqueue_script('zo-images-carousel', get_template_directory_uri(). '/assets/js/zo_images_carousel.js', array(), '1.0');
}

$images = explode( ',', $images );
$i = - 1;
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_images_carousel wpb_content_element' . $el_class . ' vc_clearfix', $this->settings['base'], $atts );
$carousel_id = 'vc_images-carousel-' . WPBakeryShortCode_VC_images_carousel::getCarouselIndex();
$slider_width = $this->getSliderWidth( $img_size );
?>
<div class="<?php echo esc_attr( apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->settings['base'], $atts ) ); ?>">
    <div class="wpb_wrapper">
<?php echo wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_gallery_heading' ) ) ?>

    <?php if( $zo_carousel_lib !== 'zo' ) : ?>

        <div id="<?php echo esc_attr($carousel_id) ?>" data-ride="vc_carousel"
             data-wrap="<?php echo 'yes' === $wrap ? 'true' : 'false' ?>" style="width: <?php echo esc_attr($slider_width) ?>;"
             data-interval="<?php echo 'yes' === $autoplay ? $speed : 0 ?>" data-auto-height="yes"
             data-mode="<?php echo esc_attr($mode); ?>" data-partial="<?php echo 'yes' === $partial_view ? 'true' : 'false' ?>"
             data-per-view="<?php echo esc_attr($slides_per_view); ?>"
             data-hide-on-end="<?php echo 'yes' === $autoplay ? 'false' : 'true' ?>" class="vc_slide vc_images_carousel">
            <!-- Wrapper for slides -->
            <div class="vc_carousel-inner">
                <div class="vc_carousel-slideline">
                    <div class="vc_carousel-slideline-inner">
                        <?php foreach ( $images as $attach_id ): ?>
                            <?php
                            $i ++;
                            if ( $attach_id > 0 ) {
                                $post_thumbnail = wpb_getImageBySize( array(
                                    'attach_id' => $attach_id,
                                    'thumb_size' => $img_size
                                ) );
                            } else {
                                $post_thumbnail = array();
                                $post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
                                $post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
                            }
                            $thumbnail = $post_thumbnail['thumbnail'];
                            ?>
                            <div class="vc_item">
                                <div class="vc_inner">
                                    <?php if ( 'link_image' === $onclick ): ?>
                                        <?php $p_img_large = $post_thumbnail['p_img_large']; ?>
                                        <a class="prettyphoto"
                                           href="<?php echo $p_img_large[0] ?>" <?php //echo esc_attr($pretty_rand); ?>>
                                            <?php echo do_shortcode($thumbnail) ?>
                                        </a>
                                    <?php elseif ( 'custom_link' === $onclick && isset( $custom_links[ $i ] ) && '' !== $custom_links[ $i ] ): ?>
                                        <a
                                            href="<?php echo esc_url($custom_links[ $i ]); ?>"<?php echo( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) ?>>
                                            <?php echo do_shortcode($thumbnail); ?>
                                        </a>
                                    <?php else: ?>
                                        <?php echo do_shortcode($thumbnail); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php if ( 'yes' !== $hide_pagination_control ): ?>
                <!-- Indicators -->
                <ol class="vc_carousel-indicators">
                    <?php for ( $z = 0; $z < count( $images ); $z ++ ): ?>
                        <li data-target="#<?php echo esc_attr($carousel_id) ?>" data-slide-to="<?php echo esc_attr($z); ?>"></li>
                    <?php endfor; ?>
                </ol>
            <?php endif; ?>
            <?php if ( 'yes' !== $hide_prev_next_buttons ): ?>
                <!-- Controls -->
                <a class="vc_left vc_carousel-control" href="#<?php echo esc_attr($carousel_id); ?>" data-slide="prev">
                    <span class="icon-prev"></span>
                </a>
                <a class="vc_right vc_carousel-control" href="#<?php echo esc_attr($carousel_id); ?>" data-slide="next">
                    <span class="icon-next"></span>
                </a>
            <?php endif; ?>
        </div>
        <?php else : ?>
        <div id="<?php echo esc_attr($carousel_id); ?>" class="zo_images_carousel-wrap">
            <div data-slick = '{
                "slidesToShow": <?php echo esc_attr($slides_per_view); ?>,
                "slidesToScroll": 1,
                "autoplay": <?php echo 'yes' === $autoplay ? "true" : "false"; ?>,
                "autoplaySpeed": <?php echo esc_attr($speed); ?>,
                "vertical" : <?php echo "vertical" === $mode ? "true" : "false"; ?>,
                "dots" : <?php echo "yes" !== $hide_pagination_control ? "true" : "false"; ?>,
                "arrows" : <?php echo "yes" !== $hide_prev_next_buttons ? "true" : "false"; ?>,
                "infinite" : <?php echo 'yes' === $wrap ? 'true' : 'false' ?>
                 <?php if( 'yes' === $zo_page_image ) echo ',"asNavFor": ".'.$carousel_id.'-nav"'; ?>
                 }'
                 class="zo_images_carousel zo_images_carousel_for <?php echo esc_attr($carousel_id); ?>-for">
                <?php foreach ( $images as $attach_id ): ?>
                    <?php
                    $i ++;
                    if ( $attach_id > 0 ) {
                        $post_thumbnail = wpb_getImageBySize( array(
                            'attach_id' => $attach_id,
                            'thumb_size' => $img_size
                        ) );
                    } else {
                        $post_thumbnail = array();
                        $post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
                        $post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
                    }
                    $thumbnail = $post_thumbnail['thumbnail'];
                    ?>
                    <div>
                        <div class="zo_inner">
                            <?php if ( 'link_image' === $onclick ): ?>
                                <?php $p_img_large = $post_thumbnail['p_img_large']; ?>
                                <a class="prettyphoto"
                                   href="<?php echo $p_img_large[0] ?>" <?php echo esc_attr($pretty_rand); ?>>
                                    <?php echo do_shortcode($thumbnail) ?>
                                </a>
                            <?php elseif ( 'custom_link' === $onclick && isset( $custom_links[ $i ] ) && '' !== $custom_links[ $i ] ): ?>
                                <a
                                    href="<?php echo esc_url($custom_links[ $i ]); ?>"<?php echo( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) ?>>
                                    <?php echo do_shortcode($thumbnail); ?>
                                </a>
                            <?php else: ?>
                                <?php echo do_shortcode($thumbnail); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if( $zo_page_image === 'yes' ) :?>
            <div class="zo_images_carousel zo_images_carousel_nav <?php echo esc_attr($carousel_id); ?>-nav" data-slick='{
                "asNavFor": ".<?php echo esc_attr($carousel_id); ?>-for",
                "slidesToShow": <?php echo esc_attr($zo_page_image_count); ?>,
                "slidesToScroll": 1,
                "centerMode": true,
                "focusOnSelect": true}'>
                <?php foreach ( $images as $attach_id ): ?>
                    <?php
                    $i ++;
                    if ( $attach_id > 0 ) {
                        $post_thumbnail = wpb_getImageBySize( array(
                            'attach_id' => $attach_id,
                            'thumb_size' => 'thumbnail'
                        ) );
                    } else {
                        $post_thumbnail = array();
                        $post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
                        $post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
                    }
                    $thumbnail = $post_thumbnail['thumbnail'];
                    ?>
                    <div class="zo_inner">
                        <span><?php echo do_shortcode($thumbnail); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div><?php echo $this->endBlockComment( '.wpb_wrapper' ) ?>
</div><?php echo $this->endBlockComment( $this->getShortcode() ) ?>
