<?php /* Template Name: Services*/ ?>
<?php get_header(); ?>
	<?php
		if ( have_posts() ):
			while ( have_posts() ): the_post();
		?>
        <article <?php post_class(); ?>>
            <?php if($id = get_field('_video_id')){ ?>
				<div class="page-banner top-banner">
					<?php /*<iframe class="video-background" src="https://player.vimeo.com/video/<?php echo $id; ?>?background=1&amp;autoplay=1&amp;loop=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;api=1&amp" width="1920" height="1281" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>*/ ?>
					
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
                    <?php /*<span id="grey-overlay"></span>*/ ?>
				</div>
            <?php } ?>
            <div class="services">
                
                <?php if( have_rows('_information_blocks') ):
                    while ( have_rows('_information_blocks') ) : the_row();
                    $imageExist = get_sub_field('_block_image');
                    $noImage = '';
                    if (!$imageExist) {
                        $noImage = 'without';
                    }
                    $backgroundColor = get_sub_field('_background_color');
                    $imagePosititon = get_sub_field('_block_image_position');
                    $titleColor = get_sub_field('_block_title_color');
                ?>
                    <div class="middle-block <?php echo $backgroundColor; ?>">
                        <div class="container">
	                        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                            <?php if($imagePosititon == 'left') {?>
                                <div class="img <?php echo $noImage; ?>">
                                    <?php if($e = get_sub_field('_block_image')) echo wp_get_attachment_image($e, 'home_gallery', 0, array('title'=> '')); ?>
                                </div>
                            <?php } ?>
                            <div class="text">
                                <?php 
                                    if($e = get_sub_field('_block_title')) echo '<h2 class="'.$titleColor.'">'.$e.'</h2>';
                                    if($e = get_sub_field('_block_image')) echo '<div class="mobile">'.wp_get_attachment_image($e, 'home_gallery', 0, array('title'=> '')).'</div>';
                                    if($e = get_sub_field('_block_text')) echo $e;
                                    if($link = get_sub_field('_block_link')) {
                                        echo '<a href="'.$link['url'].'" class="btn btn-red">'.$link['title'].'</a>'; 
                                    }
                                ?>
                            </div>
                            <?php if($imagePosititon == 'right') {?>
                                <div class="img <?php echo $noImage; ?>">
                                    <?php if($e = get_sub_field('_block_image')) echo wp_get_attachment_image($e, 'home_gallery', 0, array('title'=> '')); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                <div class="section-padding grey-bg">
                    <?php if($t = get_field('_content_tabs_title')) echo '<h2>'.$t.'</h2>' ; ?>
                    <?php if($t = get_field('_under_title_text')) echo '<div class="small-content"><p>'.$t.'</p></div>' ; ?>
                    <?php if( have_rows('_tabs') ): ?>
                        <ul class="values-tabs why">
                            <?php 
                                $i = 0;
                                while ( have_rows('_tabs') ) : the_row();
                                    $i++;
                                    $active = '';
                                    if ($i == 1) {
                                        $active = 'active';
                                    }
                                ?>
                                <li>
                                    <?php if($e = get_sub_field('_tab_name')) echo '<a href="javascript:void(0);" class="tab '. $active .'" data-target="content-'.$i.'">'.$e.'</a>'; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                        <div class="values-content clearer-block">
                            <?php 
                                $i = 0;
                                while ( have_rows('_tabs') ) : the_row();
                                    $i++;
                                    $active = '';
                                    if ($i == 1) {
                                        $active = 'active';
                                    }
                                ?>
                                <div class="content <?php echo $active; ?>" id="content-<?php echo $i; ?>">
                                    <div class="text">
                                        <?php if($e = get_sub_field('_content_title')) echo '<h2 class="title-red">'.$e.'</h2>'; ?>
                                        <?php if($e = get_sub_field('_content_text')) echo $e; ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <ul class="values-tabs mobile">
                            <?php while ( have_rows('_tabs') ) : the_row(); ?>
                                <li>
                                    <?php if($e = get_sub_field('_tab_name')) echo '<a class="tab" href="javascript:void(0);">'.$e.'</a>'; ?>
                                    <div class="values-content clearer-block">
                                        <div class="content">
                                            <div class="text">
                                                <?php if($e = get_sub_field('_content_title')) echo '<h2 class="title-red">'.$e.'</h2>'; ?>
                                                <?php if($e = get_sub_field('_content_text')) echo $e; ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <?php if( have_rows('_testimonials_slider') ): ?>
                    <div class="testimonials section-padding">
                        <div class="container">
                            <?php if($e = get_field('_slider_title')) echo '<h2>'.$e.'</h2>'; ?>
                            <div class="testimonial-slider">
                             <?php while ( have_rows('_testimonials_slider') ) : the_row(); ?>
                                <div class="testimonial">
                                   <?php if($e = get_sub_field('_testimonial_slide')) echo $e; ?>
                                </div>
                            <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
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
                        <div class="title"><a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a></div>
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