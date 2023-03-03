<?php 
    get_header(); 
    global $wp_query;
    $cats = get_terms(array(
		'taxonomy' => 'job_cat',
        'orderby' => 'term_id',
		'hierarchical' => false,
		'hide_empty' => false
	));
    $works = get_terms(array(
		'taxonomy' => 'job_type',
        'orderby' => 'term_id',
		'hierarchical' => false,
		'hide_empty' => false
	));
    $locations = get_terms(array(
		'taxonomy' => 'job_location',
        'orderby' => 'term_id',
		'hierarchical' => false,
		'hide_empty' => false
	));
    ?>
    <?php if($pageBanner = get_field('_banner_image_jobs', 'option')){ ?>
    <div class="page-banner" style="background-image: url(<?php echo $pageBanner ; ?>);">
        <div class="banner-text">
            <h1>Job search</h1>
            <?php if($t = get_field('_banner_text_jobs', 'option')) echo '<p>'.$t.'</p>' ; ?>
        </div>
        <div class="search-filter clearer-block">
            <span class="close">X</span>
            <form method="get" action="<?php echo get_option('siteurl')?>/job" class="job-filter">
                <div class="header mobile">Apply Filter</div>
                <input type="text" name="keywords" value="<?php echo $_GET['keywords']; ?>" class="search-input" placeholder="Search By Keywords "/>
                <button type="submit" class="btn btn-red">Filter</button>
                <button type="submit" class="mobile done">Done</button>
                <div class="select-group">
                    <div class="select">
                        <h4 class="mobile">Categories</h4>
                        <select multiple="multiple" class="category" data-placeholder="Any Category" name="category[]">
                            <?php 
                                foreach($cats as $cat):
                                    $selected = '';
                                    if($_GET['category'] && in_array($cat->slug, $_GET['category'])) {
                                            $selected = ' selected="selected"';
                                    };
                                    echo '<option value="'.$cat->slug.'" '.$selected.'>'.$cat->name.'</option>';
                                endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="select">
                        <h4 class="mobile">Work Type</h4>
                        <select multiple="multiple" class="work_type" data-placeholder="Any Work Type" name="work_type[]">
                            <?php 
                                foreach($works as $work):
                                    $selected = '';
                                    if($_GET['work_type'] && in_array($work->slug, $_GET['work_type'])) {
                                            $selected = ' selected="selected"';
                                    };
                                    echo '<option value="'.$work->slug.'" '.$selected.'>'.$work->name.'</option>';
                                endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="select">
                        <h4 class="mobile">Location</h4>
                        <select multiple="multiple" class="location" data-placeholder="Any Location" name="location[]">
                            <?php 
                                foreach($locations as $location):
                                    $selected = '';
                                    if($_GET['location'] && in_array($location->slug, $_GET['location']) || $_GET['location'] && in_array($location->name, $_GET['location'])) {
                                            $selected = ' selected="selected"';
                                    };
                                    echo '<option value="'.$location->slug.'" '.$selected.'>'.$location->name.'</option>';
                                endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mobile deselect">
                    <button class="mobile" type="button">Deselect all</button>
                </div>
            </form>
        </div>
    </div>
    <?php } ?>
    <?php
        global $paged;
        if(!$paged) $paged = 1;
        if($_GET['category']){
            $catsGet = $_GET['category'];
            $c_q = array(
                'taxonomy' => 'job_cat',
                'field'    => 'slug',
                'terms'    => $catsGet
            );
        }
        if($_GET['work_type']){
            $workGet = $_GET['work_type'];
            $w_q = array(
                'taxonomy' => 'job_type',
                'field'    => 'slug',
                'terms'    => $workGet
            );
        }
        if($_GET['location']){
            $locGet = $_GET['location'];
            $l_q = array(
                'taxonomy' => 'job_location',
                'field'    => 'slug',
                'terms'    => $locGet
            );
        }
        $t_q = array(
            'post_type' => 'job',
            'paged' => $paged,
            'posts_per_page' => 2, 
            'tax_query' => array (
                'relation' => 'AND',
                $c_q,
                $w_q,
                $l_q,
            ),
        );
        if($_GET['keywords']){
            $keywords = $_GET['keywords'];
            $t_q['s'] = $keywords;
        }
        $list = new WP_Query($t_q);
        
    ?>
    <div class="container mobile filter grey-bg">
        <button type="button" class="btn btn-red filter-btn">Apply filter</button>
    </div>
    <div class="grey-section">
        <div class="jobs-content">
        <?php if ($list->have_posts()) : ?>
            <span class="count"><strong><?php echo $list->found_posts; ?></strong> Jobs found</span>
			<?php while ($list->have_posts()) : $list->the_post(); ?>
				<?php get_template_part('loop-job'); ?>
			<?php endwhile; ?>
            <?php my_pagination($list); ?>
        <?php else : ?>
            <span class="count"><strong>0</strong> Jobs found</span>
        <?php endif; ?>
        </div>
    </div> 
<?php get_footer(); ?>