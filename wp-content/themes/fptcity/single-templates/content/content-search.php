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
        <div class="entry-infos-holder">
            <?php if (has_post_thumbnail()) : ?>
                <h2 class="zo-blog-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></h2>
                <div class="zo-blog-detail">
                    <div class="zo-blog-meta"><?php zo_archive_detail(); ?></div>
                </div>
                
            <?php endif ?>
          
        </div>
</article>
