<?php get_header(); ?>

	<?php
		if ( have_posts() ):
			while ( have_posts() ): the_post();
		?>
        <article <?php post_class(); ?>>
            <?php if($id = get_field('_video_id')){ ?>
				<div class="page-banner top-banner" style="background-image: url(<?php if ($poster = get_field('_banner_image')) echo $poster; ?>);">
					<?php /* <iframe class="video-background" src="https://player.vimeo.com/video/<?php echo $id; ?>?background=1&amp;autoplay=1&amp;loop=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;api=1&amp" width="1920" height="1281" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe> */ ?>
					<video loop id="video" <?php /* poster="<?php if ($poster = get_field('_banner_image')) echo $poster; ?>" */ ?> muted plays-inline>
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
						<h1><?php the_title(); ?></h1>
						<?php if($t = get_field('_banner_text')) echo '<p>'.$t.'</p>' ; ?>
					</div>
					<span id="grey-overlay"></span>
				</div>
            <?php } else {
				echo '<div  class="spacer" style="padding: 40px;"></div>';
			}?>
					
            <div class="container">
	            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                <div class="page-content entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
		</article>

	<?php
			endwhile;
		else:
			get_template_part( '404' );
		endif;
	?>
    
<?php get_footer(); ?>