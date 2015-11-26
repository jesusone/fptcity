<?php
require( get_template_directory() . '/webservice/class/webservice-class.php' );
$objService = new zo_webservice();

/*
************ 1. Get List
*/

/*
* 	Get all news
*/
function zo_get_lists_news() {
    global $wp_query;
	$args = array(
		'posts_per_page' => 10,
		'orderby' => 'date',
		'order' => 'DESC'
	);
	query_posts( $args ); 
	if ( have_posts() ) {	
		$json = array('zo_news'=>array());
		$i = 1;
		while (have_posts()) :  the_post();
			
			$json['zo_news'][$i]['id'] = get_the_ID(); 
			$json['zo_news'][$i]['date'] = get_the_date('d/m/Y'); 
			$json['zo_news'][$i]['last_modified'] = get_the_modified_date('d/m/Y');
			$json['zo_news'][$i]['title'] = get_the_title();  
			$json['zo_news'][$i]['content'] = get_the_content(); 
			$json['zo_news'][$i]['excerpt'] = get_the_excerpt(); 
			$json['zo_news'][$i]['link'] = get_the_permalink();
			$json['zo_news'][$i]['link_image_full'] = wp_get_attachment_url(get_post_thumbnail_id()); 
			$json['zo_news'][$i]['link_image_thumbnail'] = wp_get_attachment_thumb_url(get_post_thumbnail_id()); 
			$json['zo_news'][$i]['sticky'] = is_sticky();
			$json['zo_news'][$i]['format'] = get_post_format();
			$json['zo_news'][$i]['author'] = get_the_author(); 
			$json['zo_news'][$i]['category'] = get_the_category();
			$json['zo_news'][$i]['zo_meta_data'] = zo_post_meta_data();
			$i++;			
		endwhile;

		return $json;
	}
}

/*
* 	Get Categories
*/
function zo_get_list_categories($request) {
    global $wp_query;
	$args = array(
		'posts_per_page' => 10,
		'cat' => $request['id']
	);
	query_posts( $args );
	if ( have_posts() ) {	
		$json = array('zo_news'=>array());
		$i = 1;
		while (have_posts()) :  the_post();
			
			$json['zo_news'][$i]['id'] = get_the_ID(); 
			$json['zo_news'][$i]['date'] = get_the_date('d/m/Y'); 
			$json['zo_news'][$i]['last_modified'] = get_the_modified_date('d/m/Y');
			$json['zo_news'][$i]['title'] = get_the_title();  
			$json['zo_news'][$i]['content'] = get_the_content(); 
			$json['zo_news'][$i]['excerpt'] = get_the_excerpt(); 
			$json['zo_news'][$i]['link'] = get_the_permalink();
			$json['zo_news'][$i]['link_image_full'] = wp_get_attachment_url(get_post_thumbnail_id()); 
			$json['zo_news'][$i]['link_image_thumbnail'] = wp_get_attachment_thumb_url(get_post_thumbnail_id()); 
			$json['zo_news'][$i]['sticky'] = is_sticky();
			$json['zo_news'][$i]['format'] = get_post_format();
			$json['zo_news'][$i]['author'] = get_the_author(); 
			$json['zo_news'][$i]['category'] = get_the_category();
			$json['zo_news'][$i]['zo_meta_data'] = zo_post_meta_data();
			$i++;			
		endwhile;

		return $json;
	}
}

/*
* 	Pagination
*/
function zo_get_list_pagination($request) {
    global $wp_query;
	$args = array(
		'posts_per_page' => 2,
		'paged' => $request['id']
	);
	query_posts( $args );
	if ( have_posts() ) {	
		$json = array('zo_news'=>array());
		$i = 1;
		while (have_posts()) :  the_post();
			
			$json['zo_news'][$i]['id'] = get_the_ID(); 
			$json['zo_news'][$i]['date'] = get_the_date('d/m/Y'); 
			$json['zo_news'][$i]['last_modified'] = get_the_modified_date('d/m/Y');
			$json['zo_news'][$i]['title'] = get_the_title();  
			$json['zo_news'][$i]['content'] = get_the_content(); 
			$json['zo_news'][$i]['excerpt'] = get_the_excerpt(); 
			$json['zo_news'][$i]['link'] = get_the_permalink();
			$json['zo_news'][$i]['link_image_full'] = wp_get_attachment_url(get_post_thumbnail_id()); 
			$json['zo_news'][$i]['link_image_thumbnail'] = wp_get_attachment_thumb_url(get_post_thumbnail_id()); 
			$json['zo_news'][$i]['sticky'] = is_sticky();
			$json['zo_news'][$i]['format'] = get_post_format();
			$json['zo_news'][$i]['author'] = get_the_author(); 
			$json['zo_news'][$i]['category'] = get_the_category();
			$json['zo_news'][$i]['zo_meta_data'] = zo_post_meta_data();
			$i++;			
		endwhile;

		return $json;
	}
}

/*
************ End 1. Get List
*		2. Start Get single
*/

/*
*	Single post
*/
function zo_get_new_detail($request) {
	global $wp_query;
	$args = array(
		'p' => $request['id']
	);
	query_posts( $args );
	if ( have_posts() ) {	
		$json = array('zo_news'=>array());
		while (have_posts()) :  the_post();
			
			$json['zo_news']['id'] = get_the_ID(); 
			$json['zo_news']['date'] = get_the_date('d/m/Y'); 
			$json['zo_news']['last_modified'] = get_the_modified_date('d/m/Y');
			$json['zo_news']['title'] = get_the_title();  
			$json['zo_news']['content'] = get_the_content(); 
			$json['zo_news']['excerpt'] = get_the_excerpt(); 
			$json['zo_news']['link'] = get_the_permalink();
			$json['zo_news']['link_image_full'] = wp_get_attachment_url(get_post_thumbnail_id()); 
			$json['zo_news']['link_image_thumbnail'] = wp_get_attachment_thumb_url(get_post_thumbnail_id()); 
			$json['zo_news']['sticky'] = is_sticky();
			$json['zo_news']['format'] = get_post_format();
			$json['zo_news']['author'] = get_the_author(); 
			$json['zo_news']['category'] = get_the_category();
			$json['zo_news']['comment_count'] = get_comment_count();
			$json['zo_news']['zo_meta_data'] = zo_post_meta_data();
			$json['zo_news']['wp_query'] = $wp_query;
			
		endwhile;

		return $json;
	}
}

?>