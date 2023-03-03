<?php
/**
 * Job listing in the loop.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @since       1.0.0
 * @version     1.34.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;
?>
<li <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr( $post->geolocation_long ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_lat ); ?>">
	


	<div class="job-details">
		<div class="job-title">
			<a href="<?php the_job_permalink(); ?>"><?php wpjm_the_job_title(); ?></a>
		</div>
		<ul class="job-info clearfix">
			<li class="results-job-location"><?php the_job_location( false ); ?></li>
			<li class="results-posted-at">
				<?php the_job_publish_date(); ?>
			</li>
		</ul>
		<div class="job-description">
		<?php the_excerpt() ?>
</div>
<div class="extra-job-links">
<?php if ( $apply = get_the_job_application_method() ){ ?>
<span class="job-apply-now-link"><a href="<?php echo esc_url( $apply->url ); ?>" target="_blank" class="btn btn-sm btn-red-outline" style="margin-right:10px;">Apply Now</a></span>
<?php } ?>
<span class="job-read-more-link">
<a href="<?php the_job_permalink(); ?>" class="btn btn-sm btn-grey-outline">View Details</a>
</span>
</div>
</div>
</li>
