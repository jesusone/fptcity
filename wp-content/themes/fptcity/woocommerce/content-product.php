<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     9.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product, $woocommerce_loop;
// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;
// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;
// Increase loop count
$woocommerce_loop['loop']++;
// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<li <?php post_class( $classes ); ?>>
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
                 <?php
                  $attachment_ids = $product->get_gallery_attachment_ids();   
                  if($attachment_ids) :
                 ?> 
            <div class="zo-product-overlay">
              <?php
                   $attachment_id =$attachment_ids[0]; 
                   $image_link = wp_get_attachment_url( $attachment_id );
                    if ( ! $image_link )
                        continue;
                    $image_title     = esc_attr( get_the_title( $attachment_id ) );
                    $image_caption     = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) ); 
                    
                    $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_catalog' ), 0, $attr = array(
                        'title'    => $image_title,
                        'alt'    => $image_title
                        ) );   
                  echo $image; 
                
                ?>
            </div>
            <?php  endif;?>
            </div>
             
        </div>
        <div class="zo-product-meta">
        
            <h3 class="zo-product-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
             <div class="zo-product-category"><?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( null, null, sizeof( get_the_terms( $post->ID, 'product_cat' ) ), 'woocommerce' ) . ' ', '.</span>' ); ?></div>
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
</li>
