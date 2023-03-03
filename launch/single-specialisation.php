<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php if($id = get_field('_video_id')){ ?>
		<div class="page-banner top-banner">
			<?php /*<iframe class="video-background" src="https://player.vimeo.com/video/<?php echo $id; ?>?background=1&amp;autoplay=1&amp;loop=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;api=1&amp" width="1920" height="1281" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>*/ ?>
			<video loop id="video" <?php /*poster="<?php if ($poster = get_field('_banner_image')) echo $poster; ?>"*/ ?>muted plays-inline>
						<source src="<?php echo $id; ?>" type="video/mp4">
						<?php if ($poster = get_field('_banner_image')) { echo '<img src="'.$poster.'" title="banner image">';} ?>
				</video>
	<?php } else if ($pageBanner = get_field('_banner_image')) { ?>
		<div class="page-banner top-banner" style="background-image: url(<?php echo $pageBanner ; ?>);">
	<?php } ?>
	<?php if($pageBanner = get_field('_banner_image') || $id = get_field('_video_id')){ ?>
			<?php if($mobileBg = get_field('_mobileBg')) { 
				echo '<div class="mobile-bg" style="background-image: url('.$mobileBg.');"></div>';
			} ?>
			<div class="banner-text">
				<div class="banner-title"><?php the_title(); ?></div>
				<?php if($t = get_field('_banner_text')) echo '<p>'.$t.'</p>' ; ?>
			</div>
		</div>
	<?php } ?>
    <div class="container">
	    <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <div class="post-container specialisations">
                <div class="entry-content">
                    <h1 class="title-red"><?php the_title(); ?> <!--span class="red-star"></span--></h1>
                    <?php the_content(); ?>
                </div>
            </div>
			<!--
			<?php trackback_rdf(); ?>
			-->
		</article>
    </div>
	<?php endwhile; else: ?>

		<?php get_template_part('404'); ?>

	<?php endif; ?>

<?php get_footer(); ?>