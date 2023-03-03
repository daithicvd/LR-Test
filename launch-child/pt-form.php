<?php /* Template Name: Form page*/ ?>
<?php get_header(); ?>
    <img style="display: none" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/popup-image.png" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>">
	<?php
		if ( have_posts() ):
			while ( have_posts() ): the_post();
		?>
        <article <?php post_class(); ?>>
            <div class="grey-section page-form">
                <div class="post-container">
                    <?php /* if(is_page(398)) {?>
                            <div class="page-banner top-banner refer-form">
                                <div class="banner-text"><h1>Refer A Friend</h1></div>
                            </div>
                       <?php }else if(is_page(392)){
                        ?>
                            <div class="page-banner top-banner feedback-form">
                                <div class="banner-text"><h1>Feedback</h1></div>
                            </div>
                        <?php }else if(is_page(400)){
                        ?>
                            <div class="page-banner top-banner client-form">
                                <div class="banner-text"><h1>Client Enquiry</h1></div>
                            </div>
                       <?php }else if(is_page(402)){
                        ?>
                            <div class="page-banner top-banner send-form">
                                <div class="banner-text"><h1>Send In Your Resume</h1></div>
                            </div>
                        <?php
                       } */ ?>
                    <div class="form-section white-block">
                        <?php if(is_page(395)) { ?>
                        <div class="contact-form success">
                            <h2><?php the_title(); ?></h2>
                            <?php the_content(); ?>
                            <a href="<?php echo home_url(); ?>" class="btn btn-red">Back to Home</a>
                        </div>
                        <?php }else {
                         ?>
                            <h2><?php the_title(); ?></h2>
                            <div class="contact-form">
                                <?php the_content(); ?>
                            </div>
                        <?php } ?>
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
    
<?php get_footer(); ?>