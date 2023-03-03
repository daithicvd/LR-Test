<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="prev-img">
            <div class="image" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>
        </div>
		<div class="prev-img mobile">
			<?php the_post_thumbnail('full'); ?>
		</div>
        <div class="content">
            <div class="header">
                <a class="category-link" href="<?php $cat = get_the_category(); echo $cat[0]->cat_link; ?>"><?php $cat = get_the_category(); echo $cat[0]->cat_name; ?></a>
                <span class="meta"><?php echo get_the_date(); ?></span>
                <h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            </div>
			<p><?php echo apply_filters('the_content', wp_trim_words(strip_tags($post->post_content), 30)); ?></p>

        </div>
</article>