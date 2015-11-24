<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */
      
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;
    wp_dequeue_script('owl-carousel');
    wp_enqueue_script('zotheme-carousel-new', ZO_JS. 'owl.carousel.min.js', array('jquery'), '3.3.2');
    wp_register_script('owl-carousel-zo', ZO_JS . 'owl.carousel.zo.js', 'owl-carousel', '1.0', TRUE);
   // wp_enqueue_style('owl-carousel-zo', ZO_CSS . 'owl.carousel.css');
   
?>
<div class="images">

	<?php
		if ( has_post_thumbnail() ) {
            $attachment_ids = $product->get_gallery_attachment_ids(); 
            $image_feauter      = get_post_thumbnail_id( $post->ID );
            $image_feauter = array($image_feauter);
            $attachment_ids = array_merge($image_feauter,$attachment_ids);
            /* Add carosel productimage */
            ?>
            <div id="zo-carousel-main" class="owl-carousel zo-image-main">
            <?php
                $loop         = 0;
                $columns = 1;
                foreach ( $attachment_ids as $attachment_id ) {
                   
                    $image_link = wp_get_attachment_url( $attachment_id );
                    if ( ! $image_link )
                        continue;
                    $image_title     = esc_attr( get_the_title( $attachment_id ) );
                    $image_caption     = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) ); 
                    
                    $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), 0, $attr = array(
                        'title'    => $image_title,
                        'alt'    => $image_title
                        ) );   
                  echo $image; //apply_filters('woocommerce_single_product_image_html'); //apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );  
                  $loop++;  
                    
                }
             ?>
            </div>
            <?php 
            
            
            
            
			$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
			$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title'	=> $image_title,
				'alt'	=> $image_title
				) );

			$attachment_count = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			//echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );

		} else {

			//echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
