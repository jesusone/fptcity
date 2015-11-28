<?php
require( get_template_directory() . '/webservice/class/webservice-class.php' );
$objService = new zo_webservice();

/*
************ 1. Get List
*/

/*
* 	Get all news
*/
function zo_get_lists_news($request) {
    global $wp_query;
	
	$public = (isset($request['userId'])) ? $request['userId'] : '1' ; 
	$role = (isset($request['roleId'])) ? $request['roleId'] : '5' ;
	$category = (isset($request['Category'])) ? $request['Category'] : '' ;
	$paged = (isset($request['paged'])) ? $request['paged'] : 1 ;
	$cat_query  = "";
	if($category) {
		$cat_array = array($category);
		$cat_query ="'category__in' => ".$cat_array;
	}
	
	
	$args = array(
		'posts_per_page' => 10,
		'orderby' => 'date',
		'paged'  => $paged,
		'order' => 'DESC',
		 'meta_query' => array(
			'relation' => 'AND',
			array(
				'key'     => '_zo_user_role',
				'value'   => $role,
				'compare' => 'LIKE',
			),
			array(
				'key'     => '_zo_public_or_private',
				'value'   => $public,
				'compare' => '=',
			),
			
		),
		$cat_query
		 
	);
	
	
	
	query_posts( $args ); 
	if ( have_posts() ) {	
		$json = array();
		$i = 1;
		while (have_posts()) :  the_post();
			
			$json[$i]['id'] = get_the_ID(); 
			$json[$i]['date'] = get_the_date('d/m/Y'); 
			$json[$i]['last_modified'] = get_the_modified_date('d/m/Y');
			$json[$i]['title'] = get_the_title();  
			$json[$i]['content'] = get_the_content(); 
			$json[$i]['excerpt'] = get_the_excerpt(); 
			$json[$i]['link'] = get_the_permalink();
			$json[$i]['link_image_full'] = wp_get_attachment_url(get_post_thumbnail_id()); 
			$json[$i]['link_image_thumbnail'] = wp_get_attachment_thumb_url(get_post_thumbnail_id()); 
			$json[$i]['sticky'] = is_sticky();
			$json[$i]['format'] = get_post_format();
			$json[$i]['author'] = get_the_author(); 
			$json[$i]['category'] = get_the_category();
			$json[$i]['user_role'] = get_post_meta( get_the_ID(), '_zo_user_role', true );
			$json[$i]['public_or_private'] = get_post_meta( get_the_ID(), '_zo_public_or_private', true );
			$json[$i]['type_of_copy'] = get_post_meta( get_the_ID(), '_zo_type_of_copy', true );
			$json[$i]['get_source'] = get_post_meta( get_the_ID(), '_zo_get_source', true );
			$json[$i]['page'] = $paged + 1;
			
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
	print_r($request); die();
	$args = array(
		'posts_per_page' => 10,
		'cat' => $request['id']
	);
	query_posts( $args );
	if ( have_posts() ) {	
		$json = array();
		$i = 1;
		while (have_posts()) :  the_post();
			
			$json[$i]['id'] = get_the_ID(); 
			$json[$i]['date'] = get_the_date('d/m/Y'); 
			$json[$i]['last_modified'] = get_the_modified_date('d/m/Y');
			$json[$i]['title'] = get_the_title();  
			$json[$i]['content'] = get_the_content(); 
			$json[$i]['excerpt'] = get_the_excerpt(); 
			$json[$i]['link'] = get_the_permalink();
			$json[$i]['link_image_full'] = wp_get_attachment_url(get_post_thumbnail_id()); 
			$json[$i]['link_image_thumbnail'] = wp_get_attachment_thumb_url(get_post_thumbnail_id()); 
			$json[$i]['sticky'] = is_sticky();
			$json[$i]['format'] = get_post_format();
			$json[$i]['author'] = get_the_author(); 
			$json[$i]['category'] = get_the_category();
			$json[$i]['user_role'] = get_post_meta( get_the_ID(), '_zo_user_role', true );
			$json[$i]['public_or_private'] = get_post_meta( get_the_ID(), '_zo_public_or_private', true );
			$json[$i]['type_of_copy'] = get_post_meta( get_the_ID(), '_zo_type_of_copy', true );
			$json[$i]['get_source'] = get_post_meta( get_the_ID(), '_zo_get_source', true );
			$json[$i]['request'] = $get_request;
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
		$json = array();
		$i = 1;
		while (have_posts()) :  the_post();
			
			$json[$i]['id'] = get_the_ID(); 
			$json[$i]['date'] = get_the_date('d/m/Y'); 
			$json[$i]['last_modified'] = get_the_modified_date('d/m/Y');
			$json[$i]['title'] = get_the_title();  
			$json[$i]['content'] = get_the_content(); 
			$json[$i]['excerpt'] = get_the_excerpt(); 
			$json[$i]['link'] = get_the_permalink();
			$json[$i]['link_image_full'] = wp_get_attachment_url(get_post_thumbnail_id()); 
			$json[$i]['link_image_thumbnail'] = wp_get_attachment_thumb_url(get_post_thumbnail_id()); 
			$json[$i]['sticky'] = is_sticky();
			$json[$i]['format'] = get_post_format();
			$json[$i]['author'] = get_the_author(); 
			$json[$i]['category'] = get_the_category();
			$json[$i]['user_role'] = get_post_meta( get_the_ID(), '_zo_user_role', true );
			$json[$i]['public_or_private'] = get_post_meta( get_the_ID(), '_zo_public_or_private', true );
			$json[$i]['type_of_copy'] = get_post_meta( get_the_ID(), '_zo_type_of_copy', true );
			$json[$i]['get_source'] = get_post_meta( get_the_ID(), '_zo_get_source', true );
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
		$json = array();
		while (have_posts()) :  the_post();
			
			$json['id'] = get_the_ID(); 
			$json['date'] = get_the_date('d/m/Y'); 
			$json['last_modified'] = get_the_modified_date('d/m/Y');
			$json['title'] = get_the_title();  
			$json['content'] = get_the_content(); 
			$json['excerpt'] = get_the_excerpt(); 
			$json['link'] = get_the_permalink();
			$json['link_image_full'] = wp_get_attachment_url(get_post_thumbnail_id()); 
			$json['link_image_thumbnail'] = wp_get_attachment_thumb_url(get_post_thumbnail_id()); 
			$json['sticky'] = is_sticky();
			$json['format'] = get_post_format();
			$json['author'] = get_the_author(); 
			$json['category'] = get_the_category();
			$json[$i]['user_role'] = get_post_meta( get_the_ID(), '_zo_user_role', true );
			$json[$i]['public_or_private'] = get_post_meta( get_the_ID(), '_zo_public_or_private', true );
			$json[$i]['type_of_copy'] = get_post_meta( get_the_ID(), '_zo_type_of_copy', true );
			$json[$i]['get_source'] = get_post_meta( get_the_ID(), '_zo_get_source', true );
			$json['comment_count'] = get_comment_count();
			$json['comment_approved_list'] = get_approved_comments(get_the_ID());
			
		endwhile;

		return $json;
	}
}

?>