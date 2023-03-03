<?php get_header();
$query = new WP_Query( array(
    'posts_per_page' => -1,
    'post_type' => 'specialisation',
)); ?>
	<?php if($id = get_field('_video_id', 'option')){ ?>
		<div class="page-banner top-banner" style="background-image: url(<?php if ($poster = get_field('_banner_image', 'option')) echo $poster; ?>);">
			<iframe class="video-background" src="https://player.vimeo.com/video/<?php echo $id; ?>?background=1&amp;autoplay=1&amp;loop=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;api=1&amp" width="1920" height="1281" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
	<?php } else if ($pageBanner = get_field('_banner_image', 'option')) { ?>
		<div class="page-banner top-banner" style="background-image: url(<?php echo $pageBanner ; ?>);">
	<?php } ?>
	<?php if($pageBanner = get_field('_banner_image', 'option') || $id = get_field('_video_id', 'option')){ ?>
			<?php if($mobileBg = get_field('_mobileBg')) { 
				echo '<div class="mobile-bg" style="background-image: url('.$mobileBg.');"></div>';
			} ?>
			<div class="banner-text">
				<h1>Specialisations</h1>
				<?php if($t = get_field('_banner_text', 'option')) echo '<p>'.$t.'</p>' ; ?>
			</div>
            <span id="grey-overlay"></span>
		</div>
	<?php } ?>
    <?php if ($query->have_posts()) : ?>
        
    <div class="specialisations section-padding">
        <div class="container">
	        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        <ul class="specialisations-list clearer-block">
            <?php 
                while ($query->have_posts()) : $query->the_post();
                    if ( has_post_thumbnail() ) { ?>
                        <li>
                            <article>
                                <div class="flipper">
                                    <div class="front-content">
                                        <?php  the_post_thumbnail('spec'); ?>
                                        <a href="<?php the_permalink(); ?>" rel="bookmark"><h3 class="front-title"><?php the_title(); ?></h3></a>
                                    </div>
                                    <div class="hidden-content">
                                        <div class="table">
                                            <div class="table-cell">
                                                <h3><?php the_title(); ?></h3>
                                                <p><?php echo apply_filters('the_content', wp_trim_words(strip_tags($post->post_content), 20)); ?></p>
                                                <a href="<?php the_permalink(); ?>" rel="bookmark" class="view-more">view more <i class="fa fa-angle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </li>
                        <? } 
                endwhile; 
            ?>
            </ul>
        </div>
    </div>
	<?php 
		else : 
			get_template_part('404');
		endif; 
	?>
<?php get_footer(); ?>