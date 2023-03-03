<?php
/**
 * Single view job meta box.
 *
 * Hooked into single_job_listing_start priority 20
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-single-job_listing-meta.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @since       1.14.0
 * @version     1.28.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

do_action( 'single_job_listing_meta_before' ); ?>

<ul class="job-listing-meta meta plainList">
	<?php do_action( 'single_job_listing_meta_start' ); ?>

	<?php if ( get_option( 'job_manager_enable_types' ) ) { ?>
		<?php $types = wpjm_get_the_job_types(); ?>
		<?php if ( ! empty( $types ) ) : foreach ( $types as $type ) : ?>

			<li class="job-type <?php echo esc_attr( sanitize_title( $type->slug ) ); ?>"><?php echo esc_html( $type->name ); ?></li>

		<?php endforeach; endif; ?>
	<?php } ?>

	<li class="location"><?php the_job_location(); ?></li>

	<li class="date-posted"><?php the_job_publish_date(); ?></li>

	<?php if ( is_position_filled() ) : ?>
		<li class="position-filled"><?php _e( 'This position has been filled', 'wp-job-manager' ); ?></li>
	<?php elseif ( ! candidates_can_apply() && 'preview' !== $post->post_status ) : ?>
		<li class="listing-expired"><?php _e( 'Applications have closed', 'wp-job-manager' ); ?></li>
	<?php endif; ?>

	<?php do_action( 'single_job_listing_meta_end' ); ?>
</ul>



<?php 
	$reference_no = get_post_meta($post->ID, "_reference_no", true);
	$salary_description = get_post_meta($post->ID, "_salary_description", true);
	$contact_name = get_post_meta($post->ID, "_contact_name", true);
	$contact_email = get_post_meta($post->ID, "_contact_email", true);
	$contact_phone = get_post_meta($post->ID, "_contact_phone", true);
/*	
	$salaryMin = get_post_meta($post->ID, "_salary_min_value", true);
	$salaryMax = get_post_meta($post->ID, "_salary_max_value", true);
	$salaryRange = null;
	if(!empty($salaryMin)&& !empty($salaryMax)){
		$salaryMin = $salaryMin / 1000;
		$salaryMax = $salaryMax / 1000;
		$salaryRange = '$' . $salaryMin . " - $" .$salaryMax . "k";

	}*/



?>

<?php if(!empty($reference_no) || !empty($salary_description) || !empty($contact_name) || !empty($contact_email) || !empty($contact_phone) || !empty($salaryRange) ){ ?>
<table class="details-table">
		<tbody>
			<!-- <tr>
				<td colspan=2>
					
				</td>
	</tr> -->
		<?php if(!empty($reference_no)){ ?>
				<tr>
					<td>Reference:</td>
					<td><?php echo $reference_no ?></td>
				</tr>
			
		<?php 
			}
		
			if(!empty($salary_description)){ ?>
				<tr>
					<td>Salary / Rate:</td>
					
					<td><?php echo $salary_description ?></td>
				</tr>
			
				<?php 
			}

			/*if(!empty($salaryRange)){ ?>
				<tr>
					<td>Range:</td>
					
					<td><?php echo $salaryRange ?></td>
				</tr>
			
				<?php 
			}*/


		
		if(!empty($contact_name)){ ?>
			<tr>
				<td>Contact:</td>
				
				<td><?php echo $contact_name ?></td>
			</tr>
		
			<?php 
		}

		if(!empty($contact_email)){ ?>
			<tr>
				<td>Email:</td>
				
				<td style="overflow-wrap: break-word;word-wrap: break-word;word-break: break-all;"><a href="mailto:<?php echo $contact_email ?>"><?php echo $contact_email ?></a></td>
			</tr>
		
			<?php 
		}

		if(!empty($contact_phone)){ ?>
			<tr>
				<td>Phone:</td>
				
				<td><a href="tel:<?php echo $contact_phone ?>"><?php echo $contact_phone ?></a></td>
			</tr>
		
			<?php 
		}

			?>

		</tbody>
</table>

<?php 
			}
			?>

<?php do_action( 'single_job_listing_meta_after' ); ?>