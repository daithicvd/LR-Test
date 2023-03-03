<?php

// Image Sizes
//set_post_thumbnail_size( 150, 150, true );
add_image_size( 'spec', 380, 304, true);
add_image_size( 'post', 369, 268, true);
add_image_size( 'helpfull', 408, 195, true);

// Content Width
if ( ! isset( $content_width) ) $content_width = 500;

// Menus
register_nav_menus( array(
	'primary' => 'Main Menu'
) );

// Widgets
add_action( 'widgets_init', 'mr_widgets_init' );
function mr_widgets_init() {
  register_sidebar(array(
	'id' => 'sidebar',
	'name' => 'Sidebar',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ) );
}

// Core Enqueues
function mr_core_scripts_styles() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'jquery-core' );
	wp_enqueue_script( 'jquery.main.js', get_template_directory_uri().'/assets/js/jquery.main.js', array( 'jquery-core' ), time() );

	wp_enqueue_style( 'mr-style', get_stylesheet_uri(), array(), time() );
}
add_action( 'wp_enqueue_scripts','mr_core_scripts_styles' );

// Custom WP Head
function mr_head() {
?>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="application-name" content="<?php bloginfo( 'name' ); ?>" />
	<meta name="msapplication-TileColor" content="#ffffff" />
     <link href="<?php echo get_template_directory_uri(); ?>/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/mobile-style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/assets/imgicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/assets/imgicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/imgicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/assets/imgicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/assets/imgicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/assets/imgicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/assets/imgicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/imgicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/imgicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/assets/imgicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/imgicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/assets/imgicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/imgicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/imgicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/imgicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<?php
}
add_action( 'wp_head', 'mr_head' );

// Advanced Custom Fields Options Panels
if ( function_exists( 'acf_add_options_page' ) ) {
	// acf_add_options_page();
	// acf_add_options_sub_page( 'General Options' );
}

// Advanced Custom Fields Google Map Key
add_filter('acf/settings/google_api_key', function () {
    return '';
});

// Remove All Yoast HTML Comments
if ( defined( 'WPSEO_VERSION' ) ){
	add_action( 'get_header', function() {
		ob_start(
			function ( $o ) {
				return preg_replace( '/\n?<.*?yoast.*?>/mi', '', $o );
			}
		);
	});
	add_action( 'wp_head', function() {
		ob_end_flush();
	}, 999 );
}

// No, bad emojis! (and how much code is required to remove them)
function disable_wp_emojicons() {
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
/*Custom Post type*/

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'specialisation',
    array(
      'labels' => array(
        'name' => __( 'Specialisations' ),
        'singular_name' => __( 'Specialisation' )
		
      ),
	  'supports' => array( 'title', 'editor',  'thumbnail' ),
      'public' => true,
      'has_archive' => true,
	  'taxonomies'  => array( 'spec_cat' ),
    )
  );
  /*register_post_type( 'job',
    array(
      'labels' => array(
        'name' => __( 'Jobs' ),
        'singular_name' => __( 'Job' )
		
      ),
	  'supports' => array( 'title', 'editor',  'thumbnail' ),
      'public' => true,
      'has_archive' => true,
	  'taxonomies'  => array( 'job_cat' ),
    )
  );
   register_taxonomy('job_cat', array('job'), array(
	 'hierarchical' => true,
	 'labels' => array(
	  'name' => _x('Categories', 'taxonomy general name'),
	  'add_new_item' => __('Add New Category')
	 ),
	 'show_ui' => true,
	 'query_var' => true,
	 'rewrite' => array( 'slug' => 'job_cat' )
	));
	register_taxonomy_for_object_type('job_cat', 'job');
   register_taxonomy('job_type', array('job'), array(
	 'hierarchical' => true,
	 'labels' => array(
	  'name' => _x('Work Type', 'taxonomy general name'),
	  'add_new_item' => __('Add New Work Type')
	 ),
	 'show_ui' => true,
	 'query_var' => true,
	 'rewrite' => array( 'slug' => 'job_type' )
	));
	register_taxonomy_for_object_type('job_type', 'job');
   register_taxonomy('job_location', array('job'), array(
	 'hierarchical' => true,
	 'labels' => array(
	  'name' => _x('Location', 'taxonomy general name'),
	  'add_new_item' => __('Add Location')
	 ),
	 'show_ui' => true,
	 'query_var' => true,
	 'rewrite' => array( 'slug' => 'job_location' )
	));
	register_taxonomy_for_object_type('job_location', 'job');*/
}

/*--- pagination fn ---*/
function my_pagination($query = false, $p_count = false){
	if(!$query){
		global $wp_query;
		$query = $wp_query;
	}
	$page = $query->query_vars['paged'];
	if(!$page) $page = 1;
	if(!$p_count) $p_count = ceil($query->found_posts/$query->query_vars['posts_per_page']);
	if($p_count > 1){
		echo '<ul class="paging">';
			
			if($page != 1) echo '<li class="first"><a href="'.get_pagenum_link(1).'">first</a></li>';
			else echo '<li class="first"><span>first</span></li>';
			
			if($page != 1) echo '<li class="prev"><a href="'.get_pagenum_link($page-1).'">prev</a></li>';
			else echo '<li class="prev"><span>prev</span></li>';
			if($p_count < 6){
				for($i = 1; $i <= $p_count; $i++){
					if($page == $i) echo '<li class="active"><span>'.($i).'</span></li>';
					else echo '<li><a href="'.get_pagenum_link($i).'">'.($i).'</a></li>';
				}
			}
			else{
				if($page + 2 >= $p_count) $k = $p_count - 4;
				elseif($page < 3) $k = 1;
				else $k = $page - 1;
				for($i = $k; $i < $k+5; $i++){
					if($page == $i) echo '<li class="active"><span>'.($i).'</span></li>';
					elseif($k + 2 == $i && $k < $p_count-4) echo '<li><span>...</span></li>';
					elseif($k <= $p_count-5 && $i >= $k+3 ) echo '<li><a href="'.get_pagenum_link($i+1).'">'.($i+1).'</a></li>';
					elseif($k <= $p_count-5 && $i >= $k+2 ) echo '<li><a href="'.get_pagenum_link($i+2).'">'.($i+2).'</a></li>';
					else echo '<li class="'.$k.'"><a href="'.get_pagenum_link($i).'">'.($i).'</a></li>';
				}
			}
			if($page != $p_count) echo '<li class="next"><a href="'.get_pagenum_link($page+1).'">next</a></li>';
			else echo '<li class="next"><span>next</span></li>';
			
			if($page != $p_count) echo '<li class="last"><a href="'.get_pagenum_link($p_count).'">last</a></li>';
			else echo '<li class="last"><span>last</span></li>';
			
		echo '</ul>';
	}
}

function the_excerpt_max_charlength( $charlength ){
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		echo $excerpt;
	}
}

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
    
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Specialisation archive options',
		'menu_title'	=> 'Specialisation archive',
		'parent_slug'	=> 'theme-settings',
	));
    /*acf_add_options_sub_page(array(
		'page_title' 	=> 'Search banner',
		'menu_title'	=> 'Search banner',
		'parent_slug'	=> 'theme-settings',
	));
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Jobs search',
		'menu_title'	=> 'Jobs search',
		'parent_slug'	=> 'theme-settings',
	));*/
	
}
add_filter( 'gform_confirmation_anchor_7', '__return_false' );
add_filter( 'gform_confirmation_anchor_10', '__return_false' );
add_filter( 'gform_confirmation_anchor_2', '__return_false' );

/**
 * [list_searcheable_acf list all the custom fields we want to include in our search query]
 * @return [array] [list of custom fields]
 */
 /*
function list_searcheable_acf(){
  $list_searcheable_acf = array("title", "_job_id", "_list", "list_item", "_text_desc");
  return $list_searcheable_acf;
}
*/
/**
 * [advanced_custom_search search that encompasses ACF/advanced custom fields and taxonomies and split expression before request]
 * @param  [query-part/string]      $where    [the initial "where" part of the search query]
 * @param  [object]                 $wp_query []
 * @return [query-part/string]      $where    [the "where" part of the search query as we customized]
 * see https://vzurczak.wordpress.com/2013/06/15/extend-the-default-wordpress-search/
 * credits to Vincent Zurczak for the base query structure/spliting tags section
 */
 /*
function advanced_custom_search( $where, &$wp_query ) {

    global $wpdb;
 
    if ( empty( $where ))
        return $where;
 
    // get search expression
    $terms = $wp_query->query_vars[ 's' ];
    
    // explode search expression to get search terms
    $exploded = explode( ' ', $terms );
    if( $exploded === FALSE || count( $exploded ) == 0 )
        $exploded = array( 0 => $terms );
         
    // reset search in order to rebuilt it as we whish
    $where = '';
    
    // get searcheable_acf, a list of advanced custom fields you want to search content in
    $list_searcheable_acf = list_searcheable_acf();

    foreach( $exploded as $tag ) :
        $where .= " 
          AND (
            (wp_posts.post_title LIKE '%$tag%')
            OR (wp_posts.post_content LIKE '%$tag%')
            OR EXISTS (
              SELECT * FROM wp_postmeta
	              WHERE post_id = wp_posts.ID
	                AND (";

        foreach ($list_searcheable_acf as $searcheable_acf) :
          if ($searcheable_acf == $list_searcheable_acf[0]):
            $where .= " (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
          else :
            $where .= " OR (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
          endif;
        endforeach;

	        $where .= ")
            )
            OR EXISTS (
              SELECT * FROM wp_comments
              WHERE comment_post_ID = wp_posts.ID
                AND comment_content LIKE '%$tag%'
            )
            OR EXISTS (
              SELECT * FROM wp_terms
              INNER JOIN wp_term_taxonomy
                ON wp_term_taxonomy.term_id = wp_terms.term_id
              INNER JOIN wp_term_relationships
                ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
              WHERE (
          		taxonomy = 'post_tag'
            		OR taxonomy = 'category'          		
            		OR taxonomy = 'myCustomTax'
          		)
              	AND object_id = wp_posts.ID
              	AND wp_terms.name LIKE '%$tag%'
            )
        )";
    endforeach;
    return $where;
}
 
add_filter( 'posts_search', 'advanced_custom_search', 500, 2 ); */
 

add_filter( 'gform_tabindex', 'gform_tabindexer', 10, 2 );
function gform_tabindexer( $tab_index, $form = false ) {
    $starting_index = 1000; // if you need a higher tabindex, update this number
    if( $form )
        add_filter( 'gform_tabindex_' . $form['id'], 'gform_tabindexer' );
    return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}


