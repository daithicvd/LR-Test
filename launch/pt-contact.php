<?php /* Template Name: Contact us*/ ?>
<?php get_header(); ?>

	<?php
		if ( have_posts() ):
			while ( have_posts() ): the_post();
		?>
        <article <?php post_class(); ?>>
            <?php if($id = get_field('_video_id')){ ?>
				<div class="page-banner top-banner">
					<?php /*<iframe class="video-background" src="https://player.vimeo.com/video/<?php echo $id; ?>?background=1&amp;autoplay=1&amp;loop=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;api=1&amp" width="1920" height="1281" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>*/?>
					<?php // $poster = get_field('_banner_image')  ?>
					<video loop id="video" muted plays-inline>
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
                   <?php /* <span id="grey-overlay"></span>*/ ?>
				</div>
            <?php } ?>
            <div class="container contact-us">
	            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                <div class="clearer-block">
                    <div class="contact-info entry-content">
                        <h2>Contact info</h2>
                        <?php the_content(); ?>
                    </div>
                    <div class="contact-content">
                        <div class="contact-form clearer-block">
                            <?php if($t = get_field('_contact_us_form')) echo $t; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($backgroundImage = get_field('_footer_banner_image')) { ?>
            <div class="section-banner text page-banner" style="background-image: url(<?php echo $backgroundImage; ?>);">
				<?php if($mobileBg = get_field('_mobileBg_footer')) { 
					echo '<div class="mobile-bg" style="background-image: url('.$mobileBg.');"></div>';
				} ?>
                <div class="banner-text <?php if($t = get_field('_text_block_position')) echo $t; ?> ">
                    <?php 
                        if($t = get_field('_footer_banner_title')) echo '<div class="banner-title">'.$t.'</div>' ; 
                        if($t = get_field('_footer_banner_text')) echo '<p>'.$t.'</p>' ; 
                        if($link = get_field('_footer_banner_button_link')) {
                        $color = get_field('_footer_banner_button_color');
                        echo '<a href="'.$link['url'].'" class="btn btn-'.$color.'">'.$link['title'].'</a>'; 
                        }
                    ?>
                </div>
            </div>
            <?php } ?>
            <?php if($backgroundImage = get_field('_additional_banner_image')) { ?>
            <div class="section-banner text page-banner" style="background-image: url(<?php echo $backgroundImage; ?>);">
				<?php if($mobileBg = get_field('_mobileBg_additional')) { 
					echo '<div class="mobile-bg" style="background-image: url('.$mobileBg.');"></div>';
				} ?>
                <div class="banner-text <?php if($t = get_field('_additional_banner_block_position')) echo $t; ?> ">
                    <?php 
                        if($t = get_field('_additional_banner_title')) echo '<div class="banner-title">'.$t.'</div>' ; 
                        if($t = get_field('_additional_banner_text')) echo '<p>'.$t.'</p>' ; 
                        if($link = get_field('_additional_banner_link')) {
                        $color = get_field('_additional_banner_color');
                        echo '<a href="'.$link['url'].'" class="btn btn-'.$color.'">'.$link['title'].'</a>'; 
                        }
                    ?>
                </div>
            </div>
            <?php } ?>
            <?php 
                $link = get_field('_footer_link');
                if( $link ): ?>
                <div class="launch table links">
                    <div class="table-cell grey-bg">
                        <div class="title title-red"><a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a></div>
                    </div>
                    <div class="table-cell light-grey-bg">
                        <?php 
                        $link = get_field('_footer_link_copy');
                        if( $link ): ?>
                            <div class="title"><a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a></h1>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
		</article>

	<?php
			endwhile;
		else:
			get_template_part( '404' );
		endif;
	?>
    
<?php get_footer(); ?>