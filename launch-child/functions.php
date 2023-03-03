<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if (!session_id()) {
  session_start();
}



/*
function redirect_to_jobApplication() {
//Check to see if the querystring exists and then redirects to the job al=pplication URL with the original referrer.

//See single-job_listing and content-single-job-listing where these variables get set

  if(isset($_GET["redirect_to_application"]) && $_GET["redirect_to_application"] == "true"){
    global $post;
    $post = get_post(url_to_postid($_SERVER['REQUEST_URI'])) ;
    $apply = get_the_job_application_method();
    //  echo $_SESSION['job_referrer'];
    header_remove("Referer");
    header("Referer: ". $_SESSION['job_referrer']);
    header("Location:  $apply->url"); 
    exit();
    
  }
}*/

//add_action( 'send_headers', 'redirect_to_jobApplication' );



// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'chld_thm_cfg_parent' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css' );

// add_action( 'wp_footer','add_code_footer' );
	function add_code_footer(){
		?>
			<div id="fb-root"></div>

			<script>(function(d, s, id) {

			var js, fjs = d.getElementsByTagName(s)[0];

			if (d.getElementById(id)) return;

			js = d.createElement(s); js.id = id;

			js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&autoLogAppEvents=1';

			fjs.parentNode.insertBefore(js, fjs);

			}(document, 'script', 'facebook-jssdk'));</script>
		<?php
	}


	function add_css() {
    wp_enqueue_script( 'add_js', get_stylesheet_directory_uri() . '/assets/js/custom.js');
    wp_enqueue_style( 'colorbox-css', trailingslashit( get_stylesheet_directory_uri() ) . '/assets/css/colorbox.css', array());
  wp_enqueue_script( 'color-box', trailingslashit( get_stylesheet_directory_uri() ) . '/assets/js/jquery.colorbox-min.js', array());
}
add_action( 'wp_enqueue_scripts', 'add_css' );

// END ENQUEUE PARENT ACTION


add_filter('use_block_editor_for_post', '__return_false');

/*script added from header and footer script plugin -- start --- */
// add_action('wp_head', 'header_google_script');
function header_google_script(){
?>
<!-- Google Tag Manager -->
<!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WJS2H2');</script> -->
<!-- End Google Tag Manager -->

<script type="application/ld+json">
{ "@context" : "http://schema.org",
  "@type" : "employmentagency",
  "name" : "Launch Recruitment Agency",
  "url" : "https://www.launchrecruitment.com.au",
  "image" : "https://gallery.launchrecruitment.com.au/wp-content/uploads/2019/03/launch-app-icon.png",
  "address" : "23/9 Castlereagh St Sydney 2000 NSW AU",
  "priceRange" : "$$$$",
  "telephone" : "+61 -1300452986",
  "sameAs" : [ "https://www.facebook.com/launchrecruitment",
    "https://twitter.com/launchjobs",
    "https://www.youtube.com/user/LaunchRecruitment",
    "https://www.linkedin.com/company/launch-recruitment",
    "https://www.instagram.com/launchrecruitment/"] 
}
</script>
<meta name="google-site-verification" content="eFo4RHxc1U258-fXo9KJuV1KaNHEbXmESqO4H2DCQag" />
<?php
};

//Remove Yoast HTML Comments
add_filter( 'wpseo_json_ld_output', '__return_false' );

add_action('wp_head', 'fc_opengraph');
function fc_opengraph() {

  if( is_single() || is_page() ) {

    $post_id = get_queried_object_id();

    $url = get_permalink($post_id);

    
    $title = get_post_meta($post_id, '_aioseop_title', true);
    if(!$title){
     $title = get_the_title($post_id);
    }
    $site_name = get_bloginfo('name');

    $description = get_post_meta($post_id, '_aioseop_description', true);

    $image = get_the_post_thumbnail_url($post_id);
    if( !empty( get_post_meta($post_id, 'og_image', true) ) ) $image = get_post_meta($post_id, 'og_image', true);

    $locale = get_locale();

   
    echo '<meta property="og:type" content="article" />';
    echo '<meta property="og:title" content="' . esc_attr($title) . ' | ' . esc_attr($site_name) . '" />';
    echo '<meta property="og:description" content="' . esc_attr($description) . '" />';
    echo '<meta property="og:url" content="' . esc_url($url) . '" />';
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '" />';

    if($image) {
        echo '<meta property="og:image" content="' . esc_url($image) . '" />';
    }else{
        echo '<meta property="og:image" content="https://www.launchrecruitment.com.au/wp-content/themes/launch-child/assets/img/popup-image.png" />';
    }

    // Twitter Card
    echo '<meta name="twitter:card" content="summary_large_image" />';
    echo '<meta name="twitter:site" content="@launchjobs" />';
    echo '<meta name="twitter:creator" content="@launchjobs" />';

  }

}

function launch_theme_support() {

	/**
	 * Hide admin bar on public site for everyone except admins
	 */
	remove_admin_bar();

	/**
	 * Register theme support for Rank Math breadcrumbs
	 */
	add_theme_support( 'rank-math-breadcrumbs' );

}
add_action( 'after_setup_theme', 'launch_theme_support' );

// Hide admin bar function
function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
      show_admin_bar(false);
    }
}


apply_filters( "acf/settings/enqueue_select2", "disableSelect2" );

function disableSelect2(){
  return false;
}

// function mis_cursos_register_session(){
//      if( !session_id() ) // DEBUG && !headers_sent()
//         session_start();		
// }

// // session
// function mis_cursos_destroy_session() {
//      // if( !session_id()) DEBUG
//         // session_start();
//     session_destroy ();
// }


// add_action('init','mis_cursos_register_session');

// if ( !is_admin() ){
//     // Avoid session locks with REST_API 
//     add_action('init','mis_cursos_register_session'); 
//     add_action('wp_logout', 'mis_cursos_destroy_session');
//     add_action('wp_login', 'mis_cursos_destroy_session');
// }

add_filter( 'rank_math/sitemap/enable_caching', '__return_false');

add_filter('http_request_args', 'bal_http_request_args', 100, 1);
function bal_http_request_args($r) //called on line 237
{
	$r['timeout'] = 5;
	return $r;
}
 
add_action('http_api_curl', 'bal_http_api_curl', 100, 1);
function bal_http_api_curl($handle) //called on line 1315
{
	curl_setopt( $handle, CURLOPT_CONNECTTIMEOUT, 5 );
	curl_setopt( $handle, CURLOPT_TIMEOUT, 5 );
}

/* Restrict REST API calls to authenticated API users only */
add_filter( 'rest_authentication_errors', function( $result ) {
    // If a previous authentication check was applied,
    // pass that result along without modification.
    if ( true === $result || is_wp_error( $result ) ) {
        return $result;
    }

    // No authentication has been performed yet.
    // Return an error if user is not logged in.
    /*if ( ! is_user_logged_in() ) {
        return new WP_Error(
            'rest_not_logged_in',
            __( 'You are not currently logged in.' ),
            array( 'status' => 401 )
        );
    }*/

    // Our custom authentication check should have no effect
    // on logged-in requests
    return $result;
});