<?php /* Template Name: About*/ ?>
<?php get_header(); ?>

	<?php
		if ( have_posts() ):
			while ( have_posts() ): the_post();
		?>
        <article <?php post_class(); ?>>
            <?php if($id = get_field('_video_id')){ ?>
				<div class="page-banner top-banner">
					<video loop id="video" <?php /* poster="<?php if ($poster = get_field('_banner_image')) echo $poster; ?>" */ ?> muted plays-inline>
					<source src="<?php echo $id; ?>" type="video/mp4">
                    <?php if ($poster = get_field('_banner_image')) { echo '<img src="'.$poster.'" title="banner image">';} ?>
			</video>
					<?php /*<iframe class="video-background" src="https://player.vimeo.com/video/<?php echo $id; ?>?background=1&amp;autoplay=1&amp;loop=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;api=1&amp" width="1920" height="1281" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>*/ ?>
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
            <div class="about">
	            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                <div class="section-padding">
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                    <?php if( have_rows('_awards') ): ?>
                        <ul class="rewards">
                            <?php while ( have_rows('_awards') ) : the_row(); ?>
                                <li>
                                    <?php if($e = get_sub_field('_image')) echo wp_get_attachment_image($e, 'home_gallery', 0, array('title'=> '')); ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="values section-padding grey-bg">
                    <?php if($t = get_field('_content_tabs_title')) echo '<h2>'.$t.'</h2>' ; ?>
                    <?php if($t = get_field('_under_title_text')) echo '<div class="small-content"><p>'.$t.'</p></div>' ; ?>
                    <?php if( have_rows('_tabs') ): ?>
                        <ul class="values-tabs">
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
                                    <?php if($icon = get_sub_field('_tab_icon')) {
										echo '<a href="javascript:void(0);" class="icon '. $active .'" data-target="content-'.$i.'" style="background-image: url('.$icon.');"></a>'; 
									} else if($e = get_sub_field('_tab_name')){
										echo '<a href="javascript:void(0);" class="tab '. $active .'" data-target="content-'.$i.'">'.$e.'</a>'; 
									}
									?>
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
		</article>

	<?php
			endwhile;
		else:
			get_template_part( '404' );
		endif;
	?>
    
<?php get_footer(); ?>