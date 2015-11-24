<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();
$upin = array($product->id);
$upsells = array_merge($upin,$upsells);
if ( sizeof( $upsells ) == 0 ) {
	return;
}

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',  
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;
$count_compare = count($upsells); 

if ( $products->have_posts() ) : ?>

	<div class="product-compare table-responsive">
        <table class="zo-product-compare-list">
         <tbody>
	    	
            <?php 
            $j==0;
          
            ?>  
           
                   <tr class="zo-product-compare-row first-row">
                    <?php woocommerce_product_loop_start(); ?>
                       <?php while ( $products->have_posts()) : $products->the_post(); ?>
                        <?php if($j ==0) { ?>
                         <td class="product-compare-column"></td>
                        <?php } ?>
                        <td class="product-compare-column">
                             <div class="product-img">
                                <?php  do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
                             </div>
                             <h5 class="product-name"><?php  the_title(); ?></h5>
                             <div class="product-link-btn-box">
                               <a href="<?php the_permalink(); ?>" title="<?php _e('Buy Now', 'fptcity'); ?>"><?php _e('Buy Now', 'fptcity'); ?></a>
                             </div>
                      
                          </td>  
                         
                      <?php
                       $j++;
                       endwhile; ?>
                       <?php woocommerce_product_loop_end(); ?> 
                   </tr>
                    <tr class="zo-product-compare-row zo-row-even">
                    <?php woocommerce_product_loop_start(); ?>
                       <?php $j=0;   while ( $products->have_posts()) : $products->the_post(); ?>
                       <?php if($j ==0) { ?>
                         <td class="product-compare-column"><?php _e('Price', 'fptcity'); ?></td>
                        <?php } ?>
                         <td class="product-compare-column"><?php echo $product->get_price_html();?></td>
                       <?php $j++; endwhile; ?>
                        <?php woocommerce_product_loop_end(); ?> 
                    </tr>
                      <tr class="zo-product-compare-row zo-row-odd">
                       <?php $j=0;   while ( $products->have_posts()) : $products->the_post(); ?>
                       <?php if($j ==0) { ?>
                         <td class="product-compare-column"><?php _e('Main Feature', 'fptcity'); ?></td>
                        <?php } ?>
                         <td class="product-compare-column"><?php  echo get_post_meta( get_the_ID(),'_product_attributes',true)['main-feature']['value'];?></td>
                       <?php $j++; endwhile; ?>
                    </tr> 
                    <tr class="zo-product-compare-row zo-row-even">
                       <?php $j=0;   while ( $products->have_posts()) : $products->the_post(); ?>
                       <?php if($j ==0) {  ?>
                         <td class="product-compare-column"><?php _e('Technology', 'fptcity'); ?></td>
                        <?php } ?>
                         <td class="product-compare-column"><?php echo get_post_meta( get_the_ID(),'_product_attributes',true)['technology']['value'] ;?></td>
                       <?php $j++; endwhile; ?>
                    </tr>
                    <tr class="zo-product-compare-row zo-row-odd">
                       <?php $j=0;   while ( $products->have_posts()) : $products->the_post(); ?>
                       <?php if($j ==0) { ?>
                         <td class="product-compare-column"><?php _e('Compatibility', 'fptcity'); ?></td>
                        <?php } ?>
                         <td class="product-compare-column"><?php echo get_post_meta( get_the_ID(),'_product_attributes',true)['compatibility']['value'];?></td>
                       <?php $j++; endwhile; ?>
                    </tr>    
                     <tr class="zo-product-compare-row zo-row-even">
                       <?php $j=0;   while ( $products->have_posts()) : $products->the_post(); ?>
                       <?php if($j ==0) {  ?>
                         <td class="product-compare-column"><?php _e('RCA Stereo Outputs', 'fptcity'); ?></td>
                        <?php } ?>
                         <td class="product-compare-column"><?php  if(get_post_meta( get_the_ID(),'_product_attributes',true)['rca-stereo-outputs']['value']  == 1) { ?> <span class="rtp-blue-dot"></span> <?php } ;?></td>
                       <?php $j++; endwhile; ?>
                    </tr>  
                    <tr class="zo-product-compare-row zo-row-odd">
                       <?php $j=0;   while ( $products->have_posts()) : $products->the_post(); ?>
                       <?php if($j ==0) { ?>
                         <td class="product-compare-column"><?php _e('RCA Stereo Inputs', 'fptcity'); ?></td>
                        <?php } ?>
                         <td class="product-compare-column"><?php echo get_post_meta( get_the_ID(),'_product_attributes',true)['rca-stereo-inputs']['value'];?></td>
                       <?php $j++; endwhile; ?>
                    </tr>        
                 
		
         </tbody>
       </table>
	</div>

<?php endif;

wp_reset_postdata();
