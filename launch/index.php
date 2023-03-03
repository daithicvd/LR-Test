<?php get_header(); ?>

	<?php if (have_posts()) : ?>
		<?php if($id = get_field('_video_id', get_option('page_for_posts'))){ ?>
			<div class="page-banner top-banner" style="background-image: url(<?php if ($poster = get_field('_banner_image', get_option('page_for_posts'))) echo $poster; ?>);">
				<?php /* <iframe class="video-background" src="https://player.vimeo.com/video/<?php echo $id; ?>?background=1&amp;autoplay=1&amp;loop=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;api=1&amp" width="1920" height="1281" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe> */ ?>
				<video loop id="video" <?php /* poster="<?php if ($poster = get_field('_banner_image')) echo $poster; ?>" */ ?> muted plays-inline>
					<source src="<?php echo $id; ?>" type="video/mp4">
                    <?php if ($poster = get_field('_banner_image', get_option('page_for_posts'))) { echo '<img src="'.$poster.'" title="banner image">';} ?>
				</video>
		<?php } else if ($pageBanner = get_field('_banner_image', get_option('page_for_posts'))) { ?>
			<div class="page-banner top-banner" style="background-image: url(<?php echo $pageBanner ; ?>);">
		<?php } ?>
		<?php if($pageBanner = get_field('_banner_image', get_option('page_for_posts')) || $id = get_field('_video_id', get_option('page_for_posts'))){ ?>
				<?php if($mobileBg = get_field('_mobileBg')) { 
					echo '<div class="mobile-bg" style="background-image: url('.$mobileBg.');"></div>';
				} ?>
				<div class="banner-text">
					<h1>Blog</h1>
					<?php if($t = get_field('_banner_text', get_option('page_for_posts'))) echo '<p>'.$t.'</p>' ; ?>
				</div>
                <span id="grey-overlay"></span>
			</div>
		<?php } ?>
        
        <div class="container mobile filter">
            <button type="button" class="btn btn-red filter-btn">Apply filter</button>
        </div>
        <div class="container clearer-block">
	        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
            <div class="blog-content">
                <div class="h1-title title-red">All Categories</div>
                <?php while (have_posts()) : the_post(); ?>
                    <?php  get_template_part('loop'); ?>
                <?php endwhile; ?>

                
                <?php my_pagination(); ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
	<?php 
		else : 
			get_template_part('404');
		endif;
	?>

<?php get_footer(); ?>