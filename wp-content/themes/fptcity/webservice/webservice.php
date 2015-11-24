<?php
require( get_template_directory() . '/webservice/class/webservice-class.php' );
$objService = new zo_webservice();
//Add Routers


       

  /*Add Post*/
/*add_action( 'rest_api_init', function () {
      register_rest_route( 'services', '/get-all-post-ids/', array(
    'methods' => 'GET',
    'callback' => 'dt_get_all_post_ids',
) );
        } );*/
// Return all post IDs
function dt_get_all_post_ids() {
    if ( false === ( $all_post_ids = get_transient( 'dt_all_post_ids' ) ) ) {
        $all_post_ids = get_posts( array(
            'numberposts' => -1,
            'post_type'   => 'post',
            'fields'      => 'ids',
        ) );
       
    }

    return $all_post_ids;
}
/*Function NEWS
* Get all news
*/
function zo_get_lists_news() {
    global $wp_query;
    query_posts('posts_per_page=10' ); 
   if ( have_posts() ) {
    $json = array('zo_news'=>array());   
    while ( have_posts()) :  the_post() ;
        $json['zo_news']['title'] = get_the_title(); 
        $json['zo_news']['content'] = get_the_content(); 
        $json['zo_news']['description'] = get_the_excerpt(); 
        $json['zo_news']['image_full'] = the_post_thumbnail( 'fulf' ); 
        $json['zo_news']['image_thubnail'] = the_post_thumbnail( 'thubnail' ); 
        $json['zo_news']['author'] = get_the_author(); 
        $json['zo_news']['category'] = get_the_category();
        
        
   endwhile;
    // end while
    return $json;
} // end if
   
    
}
?>
