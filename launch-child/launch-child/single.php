<?php get_header(); ?>

	<?php if (have_posts()) : ?>
		<?php if($id = get_field('_video_id')){ ?>
			<div class="page-banner top-banner" style="background-image: url(<?php if ($poster = get_field('_banner_image')) echo $poster; ?>);">
				<?php /*<iframe class="video-background" src="https://player.vimeo.com/video/<?php echo $id; ?>?background=1&amp;autoplay=1&amp;loop=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;api=1&amp" width="1920" height="1281" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>*/ ?>
				
				<video loop id="video" <?php /*poster="<?php if ($poster = get_field('_banner_image')) echo $poster; ?>"*/ ?>muted plays-inline>
						<source src="<?php echo $id; ?>" type="video/mp4">
                        <?php if ($poster = get_field('_banner_image')) { echo '<img src="'.$poster.'" title="banner image">';} ?>
				</video>
		<?php } else if ($pageBanner = get_field('_banner_image')) { ?>
			<div class="page-banner top-banner" style="background-image: url(<?php echo $pageBanner ; ?>);">
        <?php } else { ?>
            <div class="page-banner top-banner" style="background-image: url(<?php echo the_field('_banner_image', 194); ?>);">
        <?php } ?>
				<?php if($mobileBg = get_field('_mobileBg')) { 
					echo '<div class="mobile-bg" style="background-image: url('.$mobileBg.');"></div>';
				} ?>
                <div class="banner-text">
                    <p style="font-size: 50px;margin-bottom:20px">Blog</p>
                    <?php if($t = get_field('_banner_text')) { 
                        echo '<p>'.$t.'</p>' ; 
                    } else {
                        echo '<p>'.the_field('_banner_text', 194).'</p>';
                    } ?>
                </div>
            </div>
            
            <div class="container mobile filter">
                <button type="button" class="btn btn-red filter-btn">Apply filter</button>
            </div>
            <div class="container clearer-block">
                <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                    <?php if(function_exists('bcn_display'))
                    {
                        bcn_display();
                    }?>
                </div>
                <?php while (have_posts()) : the_post(); ?>
                <div class="blog-content post-content">
                    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                        <div class="entry-content">
                            <div class="header">
                                <a class="category-link" href="<?php $cat = get_the_category(); echo $cat[0]->cat_link; ?>"><?php $cat = get_the_category(); echo $cat[0]->cat_name; ?></a>
                                <span class="meta"><?php echo get_the_date(); ?></span>
								<span class="author">by&nbsp;"<?php echo get_the_author_meta('display_name'); ?>"</span>
                                <h1><?php the_title(); ?></h1>
                            </div>
                            <div class="top-image">
                                <?php the_post_thumbnail('full'); ?>
                            </div>
                            <?php the_content(); ?>
                        </div>
                        <!--
                        <?php trackback_rdf(); ?>
                        -->
                        <div class="share">
                            <h4>Share</h4>
                            <?php echo do_shortcode('[addtoany]'); ?>
                        </div>
                        <?php if( have_rows('_post_external_links') ): ?>
                        <ul class="link">
                            <?php 
                                $i = 0;
                                while ( have_rows('_post_external_links') ) : the_row();
                                    $i++;
                                ?>
                                <li>
                                    <?php if($e = get_sub_field('_post_external_link')) echo '<a href="'.$e.'" target="_blank">[ '.$i.' ]&nbsp;&nbsp;'.$e.'</a>'; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php endif; ?>
                    </article>
                    <?php
                 /*       $orig_post = $post;
                        global $post;
                        $tags = wp_get_post_tags($post->ID);
                        
                        if ($tags) {
                        $tag_ids = array();
                        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                        $args=array(
                        'tag__in' => $tag_ids,
                        'post__not_in' => array($post->ID),
                        'posts_per_page'=>2,
                        'caller_get_posts'=>1
                        );
                        
                        $my_query = new wp_query( $args ); 
                    ?>
                        <div class="helpfull-posts">
                            <h3><span>Other Helpful Reads</span></h3>
                            <div class="table">
                                <?php 
                                    while( $my_query->have_posts() ) {
                                        $my_query->the_post(); 
                                ?>
                                <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                    <?php the_post_thumbnail('helpfull'); ?>
                                    <div class="header">
                                        <a class="category-link" href="<?php $cat = get_the_category(); echo $cat[0]->cat_link; ?>"><?php $cat = get_the_category(); echo $cat[0]->cat_name; ?></a>
                                        <span class="meta"><?php echo get_the_date(); ?></span>
                                        <h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                    </div>
                                </article>
                                <? } ?>
                            </div>
                        </div>
                    <?php
                        }
                        $post = $orig_post;
                        wp_reset_query();*/
                    ?>
                </div>
                <?php get_sidebar(); ?>
            </div>
	<?php endwhile; else: ?>

		<?php get_template_part('404'); ?>

	<?php endif; ?>

<?php get_footer(); ?>