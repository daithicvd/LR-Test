	<?php if ( is_active_sidebar( 'Sidebar' ) ) : ?>
        <aside id="sidebar" class="sidebar">        
            <form class="search" role="search" method="GET" id="searchform" action="<?php echo get_option('siteurl')?>">
                <input type="text" placeholder="Search Blog" name="s" value="<?php the_search_query(); ?>" id="search"/>
                <input type="hidden" name="post_type" value="post" />
                <button type="submit"></button>
            </form>
            <?php dynamic_sidebar( 'Sidebar' ); ?>
        </aside>
	<?php endif; ?>