<?php get_header(); ?>
<?php global $wp_query; ?>
    <?php if($pageBanner = get_field('_banner_image', get_option('page_for_posts'))){ ?>
        <div class="page-banner top-banner" style="background-image: url(<?php echo $pageBanner ; ?>);">
            <div class="banner-text">
                <h1>Blog</h1>
                <?php if($t = get_field('_banner_text', get_option('page_for_posts'))) echo '<p>'.$t.'</p>' ; ?>
            </div>
        </div>
    <?php } ?>
    <div class="container mobile filter">
        <button type="button" class="btn btn-red filter-btn">Apply filter</button>
    </div>
    <div class="container clearer-block">
	    <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        <div class="blog-content">
            <?php if (have_posts()) : ?>
                <h1 class="title-red">"<?php echo esc_html($s); ?>"<span class="results">( <?php echo $wp_query->found_posts; ?> results )</span></h1>
                <?php while (have_posts()) : the_post(); ?>
                    <?php  get_template_part('loop'); ?>
                <?php endwhile; ?>
            <?php my_pagination(); ?>
            <?php else : ?>
                <h1 class="title-red">"<?php echo esc_html($s); ?>"</h1>
                <p>
                    Sorry, but your search term <strong><?php echo esc_html($s); ?></strong> returned <strong>0</strong> results.
                </p>
            <?php endif; ?>
         </div>
        <?php get_sidebar(); ?>
    </div>

<?php get_footer(); ?>