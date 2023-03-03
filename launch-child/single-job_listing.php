<?php


$apply = get_the_job_application_method();
$apply_url = $apply->url;


if(isset($_SERVER['HTTP_REFERER']) && stripos($_SERVER['HTTP_REFERER'], REFERER_LINKEDIN)>0){
    //If they have come from linked in, store it in the session
	//$_SESSION['job_referrer'] = $_SERVER['HTTP_REFERER'];
    $apply_url = str_replace("txavja6wusmenpm2tfd4hnexpu", "wnkfib7ru4xedeqjchx3crmbe4", $apply->url);
} 

//if(isset($_SESSION['job_referrer'])){
    //If they have a referrer set, hijack the referer and change the apply URL. This gets picked up in functions.php
	//$apply_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?redirect_to_application=true";
 //   $apply_url = "http://$_SERVER[HTTP_HOST]/redirectToJobApplication.php?job_application=". urlencode($apply->url);
//}



?>
<?php get_header(); ?>

	<?php if (have_posts()) : ?>
		

  
            <div class="container clearer-block">
		<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                <?php while (have_posts()) : the_post(); ?>
                <div class="blog-content post-content job-content">
                    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                        <div class="entry-content">
                            <div class="header">
                                <!-- <a class="category-link" href="<?php $cat = get_the_category(); echo $cat[0]->cat_link; ?>"><?php $cat = get_the_category(); echo $cat[0]->cat_name; ?></a>
                                <span class="meta"><?php echo get_the_date(); ?></span>
								<span class="author">by&nbsp;"<?php echo get_the_author_meta('display_name'); ?>"</span> -->
                                <h1><?php the_title(); ?></h1>
                            </div>
                            <div class="top-image">
                                <?php the_post_thumbnail('full'); ?>
                            </div>
                            
                            <?php the_content(); ?>
                        </div>
                        <!--
                        <?php //trackback_rdf(); ?>
                        -->
                        <div class="share-mobile">
                            <h4>Share this job</h4>
                            <?php echo do_shortcode('[addtoany]'); ?>
                        </div>
                        <?php if( have_rows('_post_external_links') ): ?>
                        <ul class="link">
                            <?php 
                                $i = 0;
                                while ( have_rows('_post_external_links') ) : the_row();
                                    $i++;
                                ?>
                                <li>
                                    <?php if($e = get_sub_field('_post_external_link')) echo '<a href="'.$e.'" target="_blank">[ '.$i.' ]&nbsp;&nbsp;'.$e.'</a>'; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php endif; ?>
                    </article>
                    
                </div>
                <?php //get_sidebar(); ?>

                <aside id="sidebar" class="sidebar" style="margin-top:83px;">        
                <?php if ( candidates_can_apply() && $apply = get_the_job_application_method()  ) { 

                    if($apply->type == "url"){
                        //Handle the URL button ourselves
                        ?>

                        <a href="<?php echo esc_url($apply_url ); ?>" rel="nofollow" class="big-apply-btn" target="_blank">Apply now <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        <?php
                    }else{
                     get_job_manager_template( 'job-application.php' ); 
                    }
                
                } 
                ?>
<!-- Session: <?php    echo $_SESSION['job_referrer'] ; ?><br/>
Type: <?php                echo $apply->type ; ?><br/>
Referrer: <?php                 echo $_SERVER['HTTP_REFERER']; ?><br/> -->

                      
<div class="share-block">
                            <h4>Share this job</h4>
                            <?php echo do_shortcode('[addtoany]'); ?>
                        </div>

               </aside>

            </div>
	<?php endwhile; else: ?>

		<?php get_template_part('404'); ?>

	<?php endif; ?>

<?php get_footer(); ?>


<style>
.addtoany_content {
    display:none;
}
    </style>