<?php
/**
 * Single job listing.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-single-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @since       1.0.0
 * @version     1.28.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//Get the apply URL
$apply = get_the_job_application_method();
$apply_url = $apply->url;

if(isset($_SERVER['HTTP_REFERER']) && stripos($_SERVER['HTTP_REFERER'], REFERER_LINKEDIN)>0){
	//If they have come from linked in, store it in the session
	$_SESSION['job_referrer'] = $_SERVER['HTTP_REFERER'];
} 

if(isset($_SESSION['job_referrer'])){
	//If they have a referrer set, hijack the referer and change the apply URL. This gets picked up in functions.php
	//$apply_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?redirect_to_application=true";
	$apply_url = "http://$_SERVER[HTTP_HOST]/redirectToJobApplication.php?job_application=$apply->url";
}


global $post;

?>
<div class="single_job_listing">
	<?php if ( get_option( 'job_manager_hide_expired_content', 1 ) && 'expired' === $post->post_status ) : ?>
		<div class="job-manager-info"><?php _e( 'This listing has expired.', 'wp-job-manager' ); ?></div>
	<?php else : ?>
		<?php
			/**
			 * single_job_listing_start hook
			 *
			 * @hooked job_listing_meta_display - 20
			 * @hooked job_listing_company_display - 30
			 */
			do_action( 'single_job_listing_start' );
		?>

		<div class="job_description">
	
			<?php wpjm_the_job_description(); ?>
		</div>

		<?php /* if ( candidates_can_apply() ) : ?>
			<?php get_job_manager_template( 'job-application.php' ); ?>
		<?php endif;*/ ?>

		<?php if ( candidates_can_apply() && $apply = get_the_job_application_method()  ) { 

		if($apply->type == "url"){
			//Handle the URL button ourselves
			?>
<div class="job_application application">
			<a href="<?php echo esc_url( $apply_url ); ?>" rel="nofollow" class="application_button button" target="_blank" style="color:#FFF">Apply now <i class="fa fa-angle-right" aria-hidden="true"></i></a>
		</div>
			<?php
		}else{
		get_job_manager_template( 'job-application.php' ); 
		}
} 
?>

		<?php
			/**
			 * single_job_listing_end hook
			 */
			do_action( 'single_job_listing_end' );
		?>
	<?php endif; ?>
</div>
