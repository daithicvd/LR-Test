<div class="job-block white-block">
    <div class="header">
        <h4 class="job-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h4>
        <div class="date">Posted <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></div>
        <?php echo do_shortcode('[addtoany]'); ?>
    </div>
    <div class="content">
        <?php if($t = get_field('_text_desc')) echo '<div class="short-desc"><p>'.$t.'</p></div>'; ?>
        <?php if($list = get_field('_list')): ?>
            <ul class="list">
            <?php
                foreach($list as $el):
                    if($el['list_item']) echo '<li>'.$el['list_item'].'</li>';
                endforeach;
            ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="category-list">
        <ul>
            <li>
                <?php $cats = get_the_terms($post->ID, 'job_cat');
				if($cats) echo '<a href="'.home_url().'/job/?category[]='. $cats[0]->slug .'">'. $cats[0]->name .'</a>'; ?>
            </li>
            <li>
                <?php $type = get_the_terms($post->ID, 'job_type');
				if($type) echo '<a href="'.home_url().'/job/?work_type[]='. $type[0]->slug .'">'. $type[0]->name .'</a>'; ?>
            </li>
            <li>
                <?php $location = get_the_terms($post->ID, 'job_location');
				if($location) echo '<a href="'.home_url().'/job/?location[]='. $location[0]->slug .'">'. $location[0]->name .'</a>'; ?>
            </li>
        </ul>
    </div>
</div>