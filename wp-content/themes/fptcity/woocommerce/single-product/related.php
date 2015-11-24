<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     9.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$posts_per_page = 5;

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

ob_start();
$date = time() . '_' . uniqid(true);


wp_register_script('owl-carousel', ZO_JS . 'owl.carousel.js', 'jquery', '1.0', TRUE);
wp_register_script('owl-carousel-zo', ZO_JS . 'owl.carousel.zo.js', 'owl-carousel', '1.0', TRUE);
wp_enqueue_style('owl-carousel-zo', ZO_CSS . 'owl.carousel.css');
wp_enqueue_script('owl-carousel');
$zo_carousel['related-product-carousel'] = array(
    'loop' => false,
    'margin' => 30,
    'mouseDrag' => true,
    'nav' => true,
    'dots' => false,
    'autoplay' => true,
    'autoplayTimeout' => 2000,
    'autoplayHoverPause' => false,
    'navText' => array(''),
    'responsive' => array(
        0 => array(
            "items" => 1,
        ),
        768 => array(
            "items" => 2,
        ),
        992 => array(
            "items" => 3,
        ),
        1200 => array(
            "items" => 4,
        )
    )
);
wp_localize_script('owl-carousel-zo', "zocarousel", $zo_carousel);
wp_enqueue_script('owl-carousel-zo');

$products = new WP_Query($args);

if ($products->have_posts()) :
    ?>
    <div id="zo_carousel_product<?php echo esc_attr($date); ?>" class="clear zo-related-products">
        <div class="zo-header zo-custom-heading vc_custom_heading zo-title-line-bottom">
            <h2 class="zo-custom-heading-title"><?php _e('Related Products', 'fptcity'); ?></h2>
            <div class="zo-line-style-1 center"><span></span></div>
            <div class="zo-custom-heading-subtitle">
                <span><?php _e('The standard chunk of Lorem Ipsum used since the 1500s is reproduced below ', 'fptcity'); ?></span>
            </div>
        </div>
        <div class="zo-content-related-items">
            <div class="zo-carousel-list">
                <div id="related-product-carousel" class="zo-carousel owl-carousel">

                <?php while ($products->have_posts()) : $products->the_post(); ?>
                        <?php
                        global $product, $woocommerce_loop;

                        // Store loop count we're currently on
                        if (empty($woocommerce_loop['loop']))
                            $woocommerce_loop['loop'] = 0;

                        // Store column count for displaying the grid
                        $woocommerce_loop['columns'] = $columns;

                        // Ensure visibility
                        if (!$product || !$product->is_visible())
                            return;
                        ?>
                        <div <?php post_class('item'); ?>>
                            <div class="zo-product-teaser">
                                <div class="zo-product-header">
                                    <div class="zo-product-image">
                                        <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
                                        <a href="<?php the_permalink(); ?>" title="<?php _e('View detail', 'fptcity'); ?>">
                                            <?php
                                            /**
                                             * woocommerce_before_shop_loop_item_title hook
                                             *
                                             * @hooked woocommerce_show_product_loop_sale_flash - 10
                                             * @hooked woocommerce_template_loop_product_thumbnail - 10
                                             */
                                            do_action( 'woocommerce_before_shop_loop_item_title' );
                                            ?>
                                        </a>
                                    </div>
                                    <div class="zo-product-overlay">
                                        <?php
                                        
                                        ?>
                                    </div>
                                </div>
                                <div class="zo-product-meta">
                                    <h3 class="zo-product-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                    <?php
                                    /**
                                     * woocommerce_after_shop_loop_item_title hook
                                     *
                                     * @hooked woocommerce_template_loop_rating - 5
                                     * @hooked woocommerce_template_loop_price - 10
                                     */
                                    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
                                    do_action( 'woocommerce_after_shop_loop_item_title' );  
                                    /**
                                         * woocommerce_after_shop_loop_item hook
                                         *
                                         * @hooked woocommerce_template_loop_add_to_cart - 10
                                         */
                                        do_action( 'woocommerce_after_shop_loop_item' );
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; // end of the loop.   ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php
wp_reset_postdata();
