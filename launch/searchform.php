<form class="search" method="get" id="searchform" action="<?php echo home_url(); ?>/">
    <input type="text" value="<?php the_search_query(); ?>" name="s" id="s"/>
    <button type="submit" id="searchsubmit"></button>
</form>
