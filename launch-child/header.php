<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head <?php do_action( 'add_head_attributes' ); ?>>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="robots" content="noodp">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="main-container">
		<header class="clearer-block">
			<div class="main-logo">
				<?php global $template; ?>
				<?php if ('pt-form.php'==basename($template)) { // _banner_image was previously saved on form template pages so we need this fix 
						$buttonColor = 'red'; 
						?>
						<a href="<?php echo home_url(); ?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-red.svg" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" id="logo"></a>
				<?php } elseif(((get_field('_banner_image') && !isset($_GET['job_id'])) || get_field('_video_id') || get_field('_main_banner_image') || is_search() || is_singular('post') || is_category() || is_post_type_archive('post') ||(is_home() && get_field('_banner_image', get_option('page_for_posts'))) || (is_post_type_archive('specialisation') && get_field('_banner_image', 'option'))) || $post->ID == 398 || $post->ID == 392 || $post->ID == 400 || $post->ID == 402 ){ 
					$buttonColor = 'white';
				?>
					<a href="<?php echo home_url(); ?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" id="logo"></a>
				<?php }  else { 
					$buttonColor = 'red';
				?>
					<a href="<?php echo home_url(); ?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-red.svg" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" id="logo"></a>
				<?php } ?>
				<button class="menu-button <?php echo $buttonColor; ?>" type="button">Menu</button>
			</div>
			<div class="header-fixed">
				<a href="<?php echo home_url(); ?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-red.svg" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" id="logo"></a>
				<button class="menu-button red" type="button">Menu</button>
			</div>
		</header>
		<div class="pusher">
			<div class="main-header">
				<div class="menu-dropdown">
					<div class="nav">
						<div class="top-row clearer-block">
							<?php if($text = get_field('_site_phone' , 'option')) {
								$link = get_field('_site_phone_link', 'option');
								echo '<a href="tel:'.$link.'" class="phone">'.$text.'</a>'; 
								}
								?>
							<a href="<?php if($t = get_field('_timesheet_link' , 'option')) echo $t; ?>" target="_blank" class="timesheet">Timesheet</a>
						</div>
						<?php
							wp_nav_menu(array(
								'container' => false,
								'menu_id' => 'nav',
								'menu_class' => '',
								'theme_location' => 'primary'
							));
						?>
						<div class="search">
							<a class="btn btn-red" target="_blank" href="<?php echo the_field('_search_jobs_link', 'option'); ?>">Search jobs</a> 
						</div>
					</div>
				</div>
			</div>
		


