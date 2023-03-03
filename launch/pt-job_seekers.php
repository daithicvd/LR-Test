<?php /* Template Name: Job Seekers*/ ?>
<?php get_header(); ?>
<?php
	$xml = simplexml_load_file('jobadder.xml');
	$fields = $xml->xpath('//Fields');
	if(isset($fields)) unset($fields[0][0]);
?>
	<?php
		if ( have_posts() ):
			while ( have_posts() ): the_post();
		?>
		<article <?php post_class(); ?>>
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
						<h1><?php the_title(); ?></h1>
						<?php if($t = get_field('_banner_text')) echo '<p>'.$t.'</p>' ; ?>
					</div>
					<?php /*<span id="grey-overlay"></span>*/ ?>
				</div>
				<div class="search-block seeker clearer-block">
					<form method="get" id="searchform" action="<?php echo get_permalink(477); ?>">
						<div class="seeker-search">
							<h5>Search Jobs</h5>
							<a class="btn btn-red" href="<?php echo the_field('_search_jobs_link', 'option'); ?>">Find Job</a> 
						</div>
						
						<div class="separator">or</div>
						<div class="seeker-apply">
							<h5>Send In Your Resume</h5>
							<?php 
								if($link = get_field('_send_in_')) {
									echo '<a href="'.$link['url'].'" class="btn btn-red">'.$link['title'].'</a>'; 
								}
							?>
						</div>
					</form>
				</div>
			<?php } ?>
					
			<div class="seeker">
				
				<div class="section-padding">
					<div class="under-search-block">
						<div class="table">
							<?php if($t = get_field('_red_title')) echo '<div class="h1-title title-red">'.$t.'</div>' ; ?>
							<div class="text">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				</div>
				<a name="downloadables"></a>
				<div id="downloadable" class="section-padding resources grey-bg">
					<div class="container">
						<?php if($t = get_field('_resources_title')) echo '<h2>'.$t.'</h2>' ; ?>
						<?php if( have_rows('_resources_items') ): ?>
						<ul class="clearer-block">
							<?php while ( have_rows('_resources_items') ) : the_row(); ?>
									<?php if (get_sub_field('_resource_item_title') || get_sub_field('_resource_item_text')) {
										echo '<li><div class="block">'; 
											if($title = get_sub_field('_resource_item_title')) echo '<h3>'.$title.'</h3>' ; 
											if($t = get_sub_field('_resource_item_text')) echo '<p>'.$t.'</p>' ; 
											if($file = get_sub_field('_resource_item_file')) {
												echo '<a href="'.$file.'" class="btn btn-white">Download</a>'; 
											} else if($link = get_sub_field('_resource_item_link')) {
												echo '<a href="'.$link['url'].'" class="btn btn-white">'.$link['title'].'</a>'; 
											}
										echo '</div></li>'; ?>
									<?php } ?>
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>
					</div>
				</div>
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
			</div>
			<?php if($backgroundImage = get_field('_footer_banner_image')) { ?>
			<div class="section-banner page-banner" style="background-image: url(<?php echo $backgroundImage; ?>);">
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
			<?php if( have_rows('_testimonials_slider') ): ?>
				<div class="testimonials section-padding grey-bg">
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
			<?php 
				$link = get_field('_footer_link');
				if( $link ): ?>
			<div class="launch table links">
				<div class="table-cell">
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