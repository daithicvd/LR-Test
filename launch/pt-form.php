<?php /* Template Name: Form page*/ ?>
<?php get_header(); ?>

	<?php
		if ( have_posts() ):
			while ( have_posts() ): the_post();
		?>
        <article <?php post_class(); ?>>
            <div class="grey-section page-form">
                <div class="post-container">
                    <div class="form-section white-block">
                        <?php if(is_page(395)) { ?>
                        <div class="contact-form success">
                            <h2><?php the_title(); ?></h2>
                            <?php the_content(); ?>
                            <a href="<?php echo home_url(); ?>" class="btn btn-red">Back to Home</a>
                        </div>
                        <?php } else { ?>
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