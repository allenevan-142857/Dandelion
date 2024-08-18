<?php get_header(); ?>

<div class="single-post">
    <div class="post-header">
        <div class="post-image">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail('medium'); ?>
            <?php endif; ?>
        </div>
        <div class="post-title">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>

    <div class="post-content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>
    </div>

    <div class="post-comments">
        <div class="comments">
            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
