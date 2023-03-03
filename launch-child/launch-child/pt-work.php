<?php /* Template Name: Work For Us*/ ?>
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
            <?php } else {
				echo '<div  class="spacer" style="padding: 40px;"></div>';
			} ?>
            <div class="services">
                <?php if( have_rows('_information_blocks') ):
                    $i = 0;
                    while ( have_rows('_information_blocks') ) : the_row();
                    $i ++;
                    $backgroundColor = get_sub_field('_background_color');
                    $imagePosititon = get_sub_field('_block_image_position');
                    $titleColor = get_sub_field('_block_title_color');
                    $imageExist = get_sub_field('_block_image');
                    $noImage = '';
                    if (!$imageExist) {
                        $noImage = 'without';
                    }
                    if ($i == 1) {
                ?>
                    <div class="middle-block <?php echo $backgroundColor; ?>">
                        <div class="container">
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
                    <?php } endwhile; ?>
                <?php endif; ?>
                <div class="benefits section-padding lighter-grey-bg">
                    <div class="container">
                        <?php if($t = get_field('_content_tabs_title')) echo '<h2>'.$t.'</h2>' ; ?>
                        <?php if($t = get_field('_under_title_text')) echo '<div class="small-content"><p>'.$t.'</p></div>' ; ?>
                        <?php if( have_rows('_benefits_checks') ): ?>
                            <ul>
                                <?php while ( have_rows('_benefits_checks') ) : the_row();
                                    if($e = get_sub_field('_content_text')) echo '<li>'.$e.'</li>';
                                    endwhile; ?>
                            </ul>
                        <?php endif; ?>
                        <?php 
                            if($link = get_field('button')) {
                                echo '<a href="'.$link['url'].'" class="btn btn-red">'.$link['title'].'</a>'; 
                            }
                        ?>
                    </div>
                </div>
                <?php if( have_rows('_testimonials_slider') ): ?>
					<?php if(get_field('choose') == 'Awards slider') { ?>
						<div class="testimonials awards">
							<div class="container clearer-block">
								<div class="left-content section-padding">
									<?php if($e = get_field('_slider_title')) echo '<h2>'.$e.'</h2>'; ?>
									<?php if($e = get_field('_slider_under_title')) echo '<p class="under-title">'.$e.'</p>'; ?>
									<div class="awards-slider">
									 <?php while ( have_rows('_testimonials_slider') ) : the_row(); ?>
										<div class="testimonial big-text">
										   <?php if($e = get_sub_field('_testimonial_slide')) echo $e; ?>
										</div>
									<?php endwhile; ?>
									</div>
								</div>
								<div class="right-content">
									<div class="awards-image-slider">
									 <?php while ( have_rows('_testimonials_slider') ) : the_row(); ?>
									 <div class="awards-image" <?php if($t = get_sub_field('_testimonial_image')) echo 'style="background: url('.wp_get_attachment_image_url($t, 'home_gallery', 0, array('title'=> '')).') no-repeat 50% 50%;background-size:cover;"'; ?>>

										   <?php if($e = get_sub_field('_testimonial_image')) echo wp_get_attachment_image($e, 'home_gallery', 0, array('title'=> '')); ?>
										</div>
									<?php endwhile; ?>
									</div>
								</div>
							</div>
						</div>
					<?php } else { ?>
						<div class="testimonials awards section-padding">
							<div class="container">
								<?php if($e = get_field('_slider_title')) echo '<h2>'.$e.'</h2>'; ?>
								<?php if($e = get_field('_slider_under_title')) echo '<p class="under-title">'.$e.'</p>'; ?>
								<div class="testimonial-slider">
								 <?php while ( have_rows('_testimonials_slider') ) : the_row(); ?>
									<div class="testimonial big-text">
									   <?php if($e = get_sub_field('_testimonial_slide')) echo $e; ?>
									</div>
								<?php endwhile; ?>
								</div>
							</div>
						</div>
					<?php } ?>
                <?php endif; ?>                 
                <?php if( have_rows('_information_blocks') ):
                    $i = 0;
                    while ( have_rows('_information_blocks') ) : the_row();
                    $i ++;
                    $backgroundColor = get_sub_field('_background_color');
                    $imagePosititon = get_sub_field('_block_image_position');
                    $titleColor = get_sub_field('_block_title_color');
                    $imageExist = get_sub_field('_block_image');
                    $noImage = '';
                    if (!$imageExist) {
                        $noImage = 'without';
                    }
                    
                    if ($i > 1) {
                ?>
                    <div class="middle-block before-form <?php echo $backgroundColor; ?>">
                        <div class="container">
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
                    <?php } endwhile; ?>
                <?php endif; ?>
                <?php /* <div class="title_feed_instagram"><h2>Instagram Feeds</h2></div> */ ?>
                <?php // echo do_shortcode('[ap_instagram_feed_pro id="2"]')?>
                <div id="work-form" class="form-work section-padding">
                    <div class="container">
                        <div class="contact-form">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
		</article>

	<?php
			endwhile;
		else:
			get_template_part( '404' );
		endif;
	?>
        

    <script type="text/javascript">
           jQuery("document").ready(function(){
                          
                    jQuery('.testimonial-inner').each(function(){
                        var jQuerydestination = jQuery(this).find('.testimonial-client ');
                        jQuery(this).find(' .in-view ').prependTo( jQuerydestination );
                    });
              //  jQuery("<i class='fa fa-star'></i> <i class='fa fa-star'></i> <i class='fa fa-star'></i> <i class='fa fa-star'></i> <i class='fa fa-star'></i> <span style='margin-right:5px'> - </span>").prependTo(".testimonial-heading")
           });





    </script>
<?php get_footer(); ?>