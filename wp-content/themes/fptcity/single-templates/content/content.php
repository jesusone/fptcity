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
    <div class="date-block">
        <div class="zo-blog-date">
            <span class="day"><?php echo get_the_date("d"); ?></span>
            <span class="month"><?php echo get_the_date("M"); ?></span>
        </div>
    </div>
        <div class="entry-infos-holder">
            <?php if (has_post_thumbnail()) : ?>
                <h2 class="zo-blog-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></h2>
                <div class="zo-blog-detail">
                    <div class="zo-blog-meta"><?php zo_archive_detail(); ?></div>
                </div>
                <div class="zo-blog-image">
                    <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_post_thumbnail($zo_image_size); ?></a>
                </div>
            <?php endif ?>
            <div class="zo-blog-detail">
                <div class="zo-blog-content">
                    <?php
                    if (get_post_type(get_the_ID()) != 'page'):
                        the_excerpt();
                    endif;
                    wp_link_pages(array(
                        'before' => '<p class="page-links"><span class="page-links-title">' . __('Pages:', 'fptcity') . '</span>',
                        'after' => '</p>',
                        'link_before' => '<span>',
                        'link_after' => '</span>',
                        'pagelink' => '<span class="screen-reader-text">' . __('Page', 'fptcity') . ' </span>%',
                        'separator' => '<span class="screen-reader-text">, </span>',
                    ));
                    ?>
                </div>
                <a class="btn-readmore" title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php _e('Read More ', 'fptcity') ?></a>
            </div>
        </div>
</article>
