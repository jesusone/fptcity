<?php
if( !function_exists('zo_woo_share') ) {

    /**
     * WooCommerce Share Hook
     */
    function zo_woo_share() {
        global $post;
?>
        <ul class="social-list">
            <li class="box"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-facebook"></i></a></li>
            <li class="box"><a href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&url=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-twitter"></i></a></li>
            <li class="box"><a href="https://www.linkedin.com/cws/share?url=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-linkedin"></i></a></li>
            <li class="box"><a href="https://plus.google.com/share?url=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-google-plus"></i></a></li>
            <li class="box"><a href="http://pinterest.com/pin/create/button?url=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-pinterest"></i></a></li>
        </ul>
<?php
    }
}
add_action('woocommerce_share', 'zo_woo_share');


/*
** Remove tabs from product details page
*/
function zo_woo_remove_product_tabs( $tabs ) {
    // Remove the additional information tab    
    unset( $tabs['reviews'] );     
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'zo_woo_remove_product_tabs', 98 );
add_filter( 'woocommerce_product_tabs', 'zo_woo_setting_product_tabs', 97 );
function zo_woo_setting_product_tabs( $tabs) {
   global $zo_meta;
    if($zo_meta->_zo_showtab_detault){
     if(!empty($zo_meta->_zo_showtab_detault)){
        $tabs['additional_information']['title'] = __( $zo_meta->_zo_changenamedetail,'fptcity' );  
     }
     $tabs['additional_information']['callback'] = 'woo_custom_description_tab_content'; 
      return $tabs;
    } 
    else {
        unset( $tabs['additional_information'] );
       return $tabs; 
    }
}


function woo_custom_description_tab_content() {
    global $product;
    $attributes = $product->get_attributes();
    ?>
    <?php if(get_post_meta( get_the_ID(), '_weight', true) != ''):?>
    <div class="zo-new zo-row-detailt">
    <div class="lable" > <?php _e('Weight','fptcity'); ?></div>
    <div class="content" > <?php echo get_post_meta( get_the_ID(), '_weight', true);
    
     ?></div>
    </div>
    <?php endif;?>
    <?php if ( $product->has_dimensions() ) : $has_row = true; ?>
            <div  class=" zo-row-detailt <?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'zo-old'; ?>">
                <div class="lable"><?php _e( 'Dimensions', 'woocommerce' ) ?></div>
                <div class="content"><?php echo $product->get_dimensions(); ?></div>
            </div>
        <?php endif; ?>
    <?php if($attributes): ?>
     <?php foreach ( $attributes as $attribute ) :
        if ( (strpos($attribute['name'],'zo_detail') === false) || empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) ) {
            continue;
        } else {
            $has_row = true;
        }
        ?>
        <div class="zo-row-detailt <?php if ( ( $alt = $alt * -1 ) == 1 ) { echo 'zo-new'; } else { echo 'zo-old';}?>">
            <div class="lable"><?php echo wc_attribute_label( $attribute['name'] ); ?></div>
            <div class="content"><?php
                if ( $attribute['is_taxonomy'] ) {

                    $values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
                    echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

                } else {

                    // Convert pipes to commas and display values
                    $values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
                    echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

                }
            ?></div>
        </div>
    <?php endforeach; ?>
    <?php endif; ?>
    
    
 <?php    
}

/**
 * Add Cart Clear Cart Function
 */
add_action('init', 'zo_woo_clear_cart_url');
function zo_woo_clear_cart_url() {
    global $woocommerce;
    if( isset($_REQUEST['clear_cart']) ) {
        $woocommerce->cart->empty_cart();
    }
}

//add wrap for '(Free)' or '(FREE!)' label text on cart page for Shipping and Handling
function zo_custom_shipping_free_label( $label ) {
    $label =  str_replace( "(Free)", '<span class="amount">Free</span>', $label );
    $label =  str_replace( "(FREE!)", '<span class="amount">FREE!</span>', $label );
    return $label;
}
add_filter( 'woocommerce_cart_shipping_method_full_label' , 'zo_custom_shipping_free_label' );


