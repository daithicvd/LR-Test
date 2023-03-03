			<?php //if(!is_page(181)) { ?>
			<?php 
				$questionBg = '';
				if (get_field('_background_image_from_page')) {
					$questionBg = get_field('_background_image_from_page');
				} else {
					$questionBg = get_field('_contact_background_image' , 'option');
				}
			
			?>
			<div class="contact-section" style="background-image: url(<?php echo $questionBg; ?>);">
				<div class="banner-text">
					<?php 
						if($t = get_field('_contact_block_title' , 'option')) echo '<div class="banner-title">'.$t.'</div>'; 
						if($t = get_field('_contact_block_text' , 'option')) echo '<p>'.$t.'</p>'; 
						if($link = get_field('_contact_block_link', 'option')) {
							echo '<a href="'.$link['url'].'" class="btn btn-red">'.$link['title'].'</a>'; 
						} 
					?>
				</div>
			</div>
			<?php //} ?>
			<div class="footer-subscribe">
				<?php echo do_shortcode('[gravityform id="10" title="false" description="true" ajax="true"]'); ?>
			</div>
			<footer>
				<div class="container clearer-block">
					<div class="mobile footer-social">
						<a href="<?php echo home_url(); ?>" class="footer-logo">
						   <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" />
						</a>
						<ul>
							<?php if($t = get_field('_facebook_link' , 'option')) echo '<li><a href="'.$t.'" class="facebook">Facebook</a></li>'; ?>
							<?php if($t = get_field('_twitter_link' , 'option')) echo '<li><a href="'.$t.'" class="twitter">twitter</a></li>'; ?>
							<?php if($t = get_field('_blogger_link' , 'option')) echo '<li><a href="'.$t.'" class="blogger">blogger</a></li>'; ?>
							<?php if($t = get_field('_youtube_link' , 'option')) echo '<li><a href="'.$t.'" class="youtube">youtube</a></li>'; ?>
							<?php if($t = get_field('_linkedin_link' , 'option')) echo '<li><a href="'.$t.'" class="linkedin">linkedin</a></li>'; ?>
							<?php if($t = get_field('_instagram_link' , 'option')) echo '<li><a href="'.$t.'" class="instagram">instagram</a></li>'; ?>
						</ul>
					</div>
					<div class="footer-logo">
						<a href="<?php echo home_url(); ?>">
						   <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" />
						</a>
						<ul>
							<?php if($t = get_field('_facebook_link' , 'option')) echo '<li><a target="_blank" href="'.$t.'" class="facebook">Facebook</a></li>'; ?>
							<?php if($t = get_field('_twitter_link' , 'option')) echo '<li><a target="_blank" href="'.$t.'" class="twitter">twitter</a></li>'; ?>
							<?php if($t = get_field('_blogger_link' , 'option')) echo '<li><a target="_blank" href="'.$t.'" class="blogger">blogger</a></li>'; ?>
							<?php if($t = get_field('_youtube_link' , 'option')) echo '<li><a target="_blank" href="'.$t.'" class="youtube">youtube</a></li>'; ?>
							<?php if($t = get_field('_linkedin_link' , 'option')) echo '<li><a target="_blank" href="'.$t.'" class="linkedin">linkedin</a></li>'; ?>
							<?php if($t = get_field('_instagram_link' , 'option')) echo '<li><a target="_blank" href="'.$t.'" class="instagram">instagram</a></li>'; ?>

						</ul>
					</div>
					<div class="footer-menu">
						<div class="col">
							<div class="col-title">QUICK LINKS</div>
							<ul class="second-menu">
								<?php site_menu('Quick links'); ?>
							</ul>
						</div>
						<div class="col">
							<div class="col-title">RESOURCES</div>
							<ul class="second-menu">
								<?php site_menu('Resources'); ?>
							</ul>
						</div>
						<div class="col">
							<div class="col-title">ABOUT</div>
							<ul class="second-menu">
								<?php site_menu('About'); ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="copyright">
					<p><?php bloginfo( 'name' ); ?>  ©  - <?php echo date('Y'); ?></p>
				</div>
			</footer>
		</div>
		<div class="search-filter mobile clearer-block">
            <span class="close">X</span>
            <div class="header mobile">Apply Filter</div>
            <button type="button" class="mobile done">Done</button>
            <div class="sidebar">        
                <form class="search blog" role="search" method="GET" id="searchform" action="<?php echo get_option('siteurl')?>">
                    <ul class="second-menu">
                        <?php site_menu('Categories'); ?>
                    </ul>
                    <input type="text" placeholder="Search Blog" name="s" value="<?php the_search_query(); ?>" id="search"/>
                    <input type="hidden" name="post_type" value="post" />
                    <button type="submit"></button>
                </form>
            </div>
        </div>
		<!-- end of border-content -->
		<a href="javascript:void(0);" class="button-top"></a>
	</div>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/multiple-select.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.slick.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<?php wp_footer(); ?>
</body>
</html>