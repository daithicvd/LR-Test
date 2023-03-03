<?php get_header(); ?>
<?php
	$xml = simplexml_load_file('jobadder.xml');
	$fields = $xml->xpath('//Fields');
	if(isset($fields)) unset($fields[0][0]);
?>
	<?php if ( have_posts() ):
			while ( have_posts() ): the_post();
    ?>
		<?php if($id = get_field('_video_id')){ 
		?>
		<div class="main-banner">            
			<div class="video-container<?php if (get_field('_mobileBg_main')) echo ' withmobileimage'; ?>">
                   <?php if(is_front_page() ):  ?>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
                        
                        <div id="bounce-wrapper" class="text-center">
                            <div id="bounce" class='animated infinite pulse slow '><a href="https://www.launchrecruitment.com.au/news/2018-seek-sara-winners/">
                                <img style="border-right: 1px solid #fff" src="https://launchrecruitment.com.au/wp-content/uploads/2018/12/seek-logo-116.png">Winner 2018 Medium Recruitment Agency Of The Year</a>
                            </div>
                        </div>

                        <script>
                            
                            jQuery("#bounce").hover(function(){
                                jQuery(this).removeClass("animated");
                            });
                            jQuery("#bounce").mouseleave(function(){
                                jQuery(this).addClass("animated");
                            });          

                             jQuery(document).ready(function(){
                                if(jQuery(window).width() <= 767 ){
                                    jQuery("#bounce-wrapper").prependTo(".mobile-bg");
                                } else {
                                     jQuery("#bounce-wrapper").prependTo(".video-container");
                                }                                      
                             });   

                             jQuery(window).resize(function(){
                                if(jQuery(window).width() <= 767 ){
                                    jQuery("#bounce-wrapper").prependTo(".mobile-bg");
                                } else {
                                     jQuery("#bounce-wrapper").prependTo(".video-container");
                                }                                  
                             });                              

              

                        </script>
                       
                    <?php endif ?>                
				<video loop id="video" <?php /* poster="<?php if ($poster = get_field('_main_banner_image')) echo $poster; ?>"*/ ?> muted plays-inline>
					<source src="<?php echo $id; ?>" type="video/mp4">
                    <?php if ($poster = get_field('_main_banner_image')) { echo '<img src="'.$poster.'" title="banner image">';} ?>
			</video>

				<?php /*<iframe id="video" class="video-background" src="https://player.vimeo.com/video/<?php echo $id; ?>?background=1&amp;autoplay=1&amp;loop=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;api=1" width="1920" height="1281" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>*/ ?>
			</div>
		<?php } else if($t = get_field('_main_banner_image')) { ?>
			<div class="main-banner" style="background-image: url(<?php echo $t; ?>);">
		<?php } ?>
			<?php if($mobileBg = get_field('_mobileBg_main')) { 
				echo '<div class="mobile-bg" style="background-image: url('.$mobileBg.');"></div>';
			} ?>
			<div class="banner-text">
				<?php the_content(); ?>
				<div class="search">
					<a class="btn btn-white"  href="<?php echo the_field('_search_jobs_link', 'option'); ?>">Search jobs</a>                    
				</div>
                <?php if(!empty(get_field('scroll_img'))) : ?>
                    <div class="scroll-down">
                         <img src="<?php echo get_field('scroll_img'); ?>" alt="">
                    </div>
                <?php endif; ?>
			</div>
            <?php /*<span id="grey-overlay"></span>*/ ?>
		</div>
    <?php if( have_rows('_launch_info_blocks') ): ?>
        <div class="launch table">
            <?php while ( have_rows('_launch_info_blocks') ) : the_row(); ?>
            <?php if (get_sub_field('_block_color') == 'dark-grey-bg') { ?>
                <div class="table-cell dark-grey-bg">
                    <?php if($t = get_sub_field('_block_title')) echo '<div class="title">'.$t.'</div>' ; ?>
                    <?php if($t = get_sub_field('_block_text')) echo '<p>'.$t.'</p>' ; ?>
                    <?php if($link = get_sub_field('_block_button_link')) {
                        echo '<a href="'.$link['url'].'" class="btn btn-red">'.$link['title'].'</a>'; 
                        }
                    ?>
                </div>
            <?php } else { ?>
                <div class="table-cell">
                    <?php if($t = get_sub_field('_block_title')) echo '<div class="title title-red">'.$t.'</div>' ; ?>
                    <?php if($t = get_sub_field('_block_text')) echo '<p>'.$t.'</p>' ; ?>
                    <?php if($link = get_sub_field('_block_button_link')) {
                        echo '<a href="'.$link['url'].'" class="btn btn-red">'.$link['title'].'</a>'; 
                        }
                    ?>
                </div>
            <?php } ?>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <div class="specialisations grey-bg section-padding">
        <div class="container">
            <?php if($t = get_field('_specializations_title')) echo '<h2>'.$t.'</h2>' ; ?>
            <?php if($t = get_field('_specializations_under_title_text')) echo '<p  class="under-title">'.$t.'</p>' ; ?>
            <?php 
                $query = new WP_Query( array(
                    'posts_per_page' => -1,
                    'post_type' => 'specialisation',
                )); 
            
                if ($query->have_posts()) :
                ?>
                <ul class="specialisations-list clearer-block">
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                        <?php if ( has_post_thumbnail() ) { ?>
                        <li>
                            <article>
                                <div class="flipper">
                                    <div class="front-content">
                                        <?php  the_post_thumbnail('spec'); ?>
                                        <a href="<?php the_permalink(); ?>" rel="bookmark"><h3 class="front-title"><?php the_title(); ?></h3></a>
                                    </div>
                                    <div class="hidden-content">
                                        <div class="table">
                                            <div class="table-cell">
                                                <h3><?php the_title(); ?></h3>
                                                <p><?php echo apply_filters('the_content', wp_trim_words(strip_tags($post->post_content), 20)); ?></p>
                                                <a href="<?php the_permalink(); ?>" rel="bookmark" class="view-more">view more <i class="fa fa-angle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </li>
                        <?php } ?>
                    <?php endwhile; ?>
                </ul> 
                <?php wp_reset_postdata(); ?>
                <?php endif; ?>
        </div>
    </div>
    <div class="info-block section-padding">
        <div class="container clearer-block">
            <div class="right">
                <?php if($e = get_field('text_block_image')) echo wp_get_attachment_image($e, 'home_gallery', 0, array('title'=> '')); ?>
            </div>
            <div class="left">
                <?php if($t = get_field('_text_block_title')) echo '<h2>'.$t.'</h2>' ; ?>
                <?php if($e = get_field('text_block_image')) echo '<div class="mobile">'.wp_get_attachment_image($e, 'home_gallery', 0, array('title'=> '')).'</div>'; ?>
                <?php if($t = get_field('_text_block_content')) echo '<p>'.$t.'</p>' ; ?>
                <?php if($link = get_field('_text_block_button_link')) {
                    $text = get_field('_text_block_button_text');
                    echo '<a href="'.$link['url'].'" class="btn btn-red">'.$link['title'].'</a>'; 
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="clients section-padding">
        <div class="container">
            <?php if($t = get_field('_clients_title')) echo '<h2>'.$t.'</h2>' ; ?>
            <?php if($t = get_field('_clients_under_title_text')) echo '<p  class="under-title">'.$t.'</p>' ; ?>
            <?php if( have_rows('_clients_logo') ): ?>
                <div class="slider">
                    <ul class="clients-slider">
                    <?php while ( have_rows('_clients_logo') ) : the_row(); ?>
                        <li>
                            <a href="<?php if($link = get_sub_field('_client_link')) echo $link; ?>" target="_blank">
                                <?php if($e = get_sub_field('_client_logo')) echo wp_get_attachment_image($e, 'home_gallery', 0, array('title'=> '')); ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="col-xs-12 text-center title_blog">
                <h2>Blog</h2>
            </div>
        </div>
    </div>
    <?php
        $list = new WP_Query(array(
            'posts_per_page' => 2,
            'post_type' => 'post'
        ));
        $i = 0;
    ?>
    <?php if ($list->have_posts()) : ?>
    <div class="blog clearer-block grey-bg">
        <?php while ( $list->have_posts() ) : $list->the_post(); 
            $i++;
        ?>
        <article class="post">
            <?php if ($i == 1) { ?>
			<div class="prev-img">
				<div class="scale" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>
			</div>
            <?php } ?>
			<div class="prev-img mobile">
				<?php the_post_thumbnail('full'); ?>
			</div>
            <div class="post-description">
                <div class="content">
                    <a class="category-link" href="<?php $cat = get_the_category(); echo $cat[0]->cat_link; ?>"><span><?php $cat = get_the_category(); echo $cat[0]->cat_name; ?></span></a>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <!-- <p><?php echo wp_trim_words(get_the_excerpt(),25); ?></p> -->
                    <p>
                    	<?php 
                    		$trimexcerpt = get_the_content();
							$shortexcerpt = wp_trim_words( $trimexcerpt, $num_words = 25, $more = '...' ); 
							echo $shortexcerpt;
                    	?>
                    </p>
                </div>
                <h2><a href="<?php the_permalink(); ?>" class="btn btn-red read">Read more</a></h2>
            </div>
            <?php if ($i == 2) { ?>
			<div class="prev-img">
				<div class="scale" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>
			</div>
            <?php } ?>
        </article>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

	<?php
			endwhile;
		else:
			get_template_part( '404' );
		endif;
	?>
<?php get_footer(); ?>