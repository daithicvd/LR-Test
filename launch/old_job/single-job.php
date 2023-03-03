<?php get_header(); ?>

	<?php 
        if (have_posts()) : while (have_posts()) : the_post();
        $cats = get_the_terms( $post->ID , 'job_cat' ); 
        $types = get_the_terms( $post->ID , 'job_type' ); 
        $locations = get_the_terms( $post->ID , 'job_location' );
    ?>
    <div class="grey-section">
        <div class="post-container">
            <div class="job-block white-block">
                <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <div class="header">
                            <h4 class="job-title"><?php the_title(); ?></h4>
                            <span class="date">Posted <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></span>
                            <?php if($t = get_field('_job_id')) echo '<span class="job_id">Job #'.$t.'</span>'; ?>
                            <?php echo do_shortcode('[addtoany]'); ?>
                        </div>
                        <div class="category-list">
                            <ul>
                                <li>
                                    <?php foreach ( $cats as $cat ) { echo '<a href="'.home_url().'/job/?category[]='. $cat->slug .'">'. $cat->name .'</a>'; } ?>
                                </li>
                                <li>
                                    <?php foreach ( $types as $type ) { echo '<a href="'.home_url().'/job/?work_type[]='. $type->slug .'">'. $type->name .'</a>'; } ?>
                                </li>
                                <li>
                                    <?php foreach ( $locations as $location ) { echo '<a href="'.home_url().'/job/?location[]='. $location->slug .'">'. $location->name .'</a>'; } ?>
                                </li>
                            </ul>
                        </div>
                        <div class="content">
                            <?php if($list = get_field('_list')): ?>
                                    <ul>
                                    <?php
                                        foreach($list as $el):
                                            if($el['list_item']) echo '<li>'.$el['list_item'].'</li>';
                                        endforeach;
                                    ?>
                                    </ul>
                            <?php endif; ?>
                            <?php the_content(); ?>
                        </div>
                        <div class="contact-form">
                            <?php echo do_shortcode('[gravityform id="9" title="false" description="false" ajax="true"]'); ?>
                        </div>
                    </div>
                    <!--
                    <?php trackback_rdf(); ?>
                    -->
                </article>
            </div>
        </div>
    </div>
	<?php endwhile; else: ?>

		<?php get_template_part('404'); ?>

	<?php endif; ?>

<?php get_footer(); ?>