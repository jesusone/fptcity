<?php
/**
 * The default template for displaying content
 *
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-teaser'); ?>>
    <div class="zo-blog-image zo-blog-gallery">
        <?php echo zo_archive_gallery( 'full' ); ?>
    </div>

    <div class="zo-blog-detail">
        <h2 class="zo-blog-title"><?php the_title(); ?></h2>
        <div class="zo-blog-meta"><?php zo_archive_detail(); ?></div>
        <div class="zo-blog-content">
            <?php
            if(zo_archive_gallery()){
                echo apply_filters('the_content', preg_replace('/\[gallery.*ids=.(.*).\]/', '', get_the_content()));
            } else {
                the_content();
            }
            wp_link_pages( array(
                'before'      => '<p class="page-links"><span class="page-links-title">' . __( 'Pages:', 'fptcity' ) . '</span>',
                'after'       => '</p>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'fptcity' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            ) );
            ?>
        </div>
    </div>
</article>
