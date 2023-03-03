<?php /* Template Name: Jobs Search */ ?>
<?php get_header(); ?>
<?php
	$jobs_per_page = 8;

	$xml = simplexml_load_file('jobadder.xml');
	$fields = $xml->xpath('//Fields');
	if(isset($fields)) unset($fields[0][0]);
	
	$s_keywords = $_GET['keywords']; if($s_keywords) $s_keywords = trim($s_keywords);
	$s_category = $_GET['category']; if($s_category) $s_category = array_filter($s_category);
	$s_s_cat = $_GET['s_cat']; if($s_s_cat) $s_s_cat = array_filter($s_s_cat);
	$s_location = $_GET['location']; if($s_location) $s_location = array_filter($s_location);
	$page_url = get_permalink();

?>
<?php if($_GET['job_id']): //single page ?>
	<?php
	$job = $xml->xpath('//Job[@jid="'.$_GET['job_id'].'"]');
	if($job):
		$job = $job[0];
		$el = array(
			'id' => $job->attributes()->jid,
			'title' => $job->Title,
			'timestamp' => strtotime($job->attributes()->datePosted),
			'desc' => $job->Summary,
			'list' => $job->BulletPoints->BulletPoint,
			'cat' => $job->Classifications->Classification[0],
			's_cat' => $job->Classifications->Classification[1],
			'loc' => $job->Classifications->Classification[2],
			'type' => $job->Classifications->Classification[3],
			'keywords' => $job->SearchTitle,
			'content' => $job->Description,
			'url' => $job->Apply->Url,
			'email' => $job->Apply->EmailTo
		);
		$jobBg = '';
		if($bg = get_field('_job_background', 'option')) {
			$jobBg = 'style="background-image: url('.$bg.')"';
		}
		
	?>
	

	<div class="grey-section job-page" <?php echo $jobBg; ?>>
		<div class="post-container">
			<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
			<div class="job-block white-block">
				<div class="header">
					<h4 class="job-title"><?php echo $el['title']; ?></h4>
					<span class="date">Posted <?php echo human_time_diff($el['timestamp']) . ' ago'; ?></span>
					<span class="job_id">Job #<?php echo $el['id']; ?></span>
					<?php echo do_shortcode('[addtoany url="'.$page_url.'?job_id='.$el['id'].'" title="'.$el['title'].'"]'); ?>
				</div>
				<div class="category-list">
					<ul>
						<li><span class="inf"><?php echo $el['cat']; ?></span>
						<li><span class="inf"><?php echo $el['type']; ?></span>
						<li><span class="inf"><?php echo $el['loc']; ?></span>
					</ul>
				</div>
				<div class="content">
					<?php if($inf_list = $el['list']): ?>
						<ul class="list">
							<?php foreach($inf_list as $inf_el) echo '<li>'.$inf_el.'</li>'; ?>
						</ul>
					<?php endif; ?>
					<?php echo apply_filters('the_content', $el['content']); ?>
					<?php /*
						//link can be here
						<a href="<?php echo $el['url']; ?>" target="_blank">Apply Now</a>
					*/ ?>
				</div>
				<div class="contact-form">
					<?php echo do_shortcode('[gravityform id="9" title="false" description="false" ajax="true"]'); ?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
<?php else: //search page ?>
<?php if($id = get_field('_video_id')){ ?>
		<div class="page-banner job-banner top-banner">
			<?php /*<iframe class="video-background" src="https://player.vimeo.com/video/<?php echo $id; ?>?background=1&amp;autoplay=1&amp;loop=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;api=1&amp" width="1920" height="1281" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>*/ ?>
			<video loop id="video" muted plays-inline>
					<source src="<?php echo $id; ?>" type="video/mp4">
					<?php if ($poster = get_field('_banner_image')) { echo '<img src="'.$poster.'" title="banner image">';} ?>
			</video>
	<?php } else if ($pageBanner = get_field('_banner_image')) { ?>
		<div class="page-banner job-banner top-banner" style="background-image: url(<?php echo $pageBanner ; ?>);">
	<?php } ?>
	<?php if($pageBanner = get_field('_banner_image') || $id = get_field('_video_id')): ?>
			<?php if($mobileBg = get_field('_mobileBg')) { 
				echo '<div class="mobile-bg" style="background-image: url('.$mobileBg.');"></div>';
			} ?>
			<div class="banner-text">
				<h1><?php the_title(); ?></h1>
				<?php if($t = get_field('_banner_text')) echo '<p>'.$t.'</p>' ; ?>
			</div>
			<div class="search-filter clearer-block">
				<span class="close mobile">X</span>
				<form method="get" action="<?php echo $page_url; ?>" class="job-filter">
					<div class="header mobile">Apply Filter</div>
					<input type="text" name="keywords" placeholder="Search By Keywords" class="search-input" value="<?php echo $s_keywords; ?>" id="keywords-field" />
					
					<button type="submit" class="btn btn-red">Filter</button>
					<button type="submit" class="mobile done">Done</button>
					<div class="select-group">
						<div class="select">
							<h4 class="mobile">Categories</h4>
							<select multiple="multiple" class="category" data-placeholder="Any Category" name="category[]" id="category-select">
								<?php 
									$categories = array_unique($xml->xpath('//Classification[@name="Category"]'));
									foreach($categories as $category){
										$c_value = strtolower(str_replace(' ', '', $category));
										echo '<option value="'.$c_value.'"'.($s_category && in_array($c_value, $s_category) ? ' selected="selected"' : '').'>'.$category.'</option>';
									}
								?>
							</select>
						</div>
						<div class="select">
							<h4 class="mobile">Work Type</h4>
							<select multiple="multiple" class="work_type" data-placeholder="Any Work Type" name="s_cat[]" id="type-select">
								<?php
									$t_list = [];
									foreach($xml as $job){
										$industry = strtolower(str_replace(' ', '', $job->Classifications->Classification[0]));
										$jobtype = $job->Classifications->Classification[1];
										$s_value = strtolower(str_replace(' ', '', $jobtype));
										$t_list [$industry][$s_value] = $jobtype;
									}
									foreach($t_list as $c_name=>$list){
										foreach($list as $sc_name=>$el){
											echo '<option data-cat="'.$c_name.'" value="'.$sc_name.'"'.($s_s_cat && in_array($sc_name, $s_s_cat) ? ' selected="selected"' : '').'>'.$el.'</option>';
										}
									}
								?>
							</select>
						</div>
						<div class="select">
							<h4 class="mobile">Location</h4>
							<select multiple="multiple" class="location" data-placeholder="Any Location" name="location[]" id="location-select">
								<?php
									//can be checkboxes
									$locations = array_unique($xml->xpath('//Classification[@name="Location"]'));
									foreach($locations as $location){
										$l_value = strtolower(str_replace(' ', '', $location));
										print_r($s_location);
										echo '<option value="'.$l_value.'"'.($s_location && in_array($l_value, $s_location) ? ' selected="selected"' : '').'>'.$location.'</option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="mobile deselect">
						<button class="mobile" type="button">Deselect all</button>
					</div>
				</form>
			</div>
			<span id="grey-overlay"></span>
		</div>
	<?php endif; ?>
	<?php
		$all_list = []; $list = [];
		foreach($xml as $job){
			$all_list []= array(
				'id' => $job->attributes()->jid,
				'title' => $job->Title,
				'timestamp' => strtotime($job->attributes()->datePosted),
				'desc' => $job->Summary,
				'list' => $job->BulletPoints->BulletPoint,
				'cat' => $job->Classifications->Classification[0],
				's_cat' => $job->Classifications->Classification[1],
				'loc' => $job->Classifications->Classification[2],
				'type' => $job->Classifications->Classification[3],
				'keywords' => $job->SearchTitle
			);
		}
		foreach($all_list as $el){
			$add = true;
			if($s_keywords){ if(strpos(strtolower($el['title']), strtolower($s_keywords)) === false && strpos(strtolower($el['desc']), strtolower($s_keywords)) === false && strpos(strtolower($el['keywords']), strtolower($s_keywords)) === false) $add = false;}
			if($s_category){ if(in_array(strtolower(str_replace(' ', '', $el['cat'])), $s_category) == false) $add = false;}
			if($s_s_cat){ if(in_array(strtolower(str_replace(' ', '', $el['s_cat'])), $s_s_cat) == false) $add = false;}
			if($s_location){ if(in_array(strtolower(str_replace(' ', '', $el['loc'])), $s_location) == false) $add = false;}
			
			if($add) $list []= $el;
		}
	?>
	<div class="container mobile filter grey-bg">
		<button type="button" class="btn btn-red filter-btn">Apply filter</button>
	</div>
	<div class="grey-section">
		<div class="jobs-content">
		<?php if($list): ?>
			<span class="count"><strong><?php echo count($list); ?></strong> Job<?php if(count($list) != 1) echo 's'; ?> found</span>
			<?php
				$max_pages = ceil(count($list)/$jobs_per_page);
				global $paged; if(!$paged) $paged = 1;
				$list = array_slice($list, ($paged-1)*$jobs_per_page, $jobs_per_page);
			?>
			<?php foreach($list as $el): ?>
				<div class="job-block white-block">
					<div class="header">
						<h4 class="job-title"><a href="<?php echo $page_url.'?job_id='.$el['id']; ?>" rel="bookmark"><?php echo $el['title']; ?></a></h4>
						<div class="date">Posted <?php echo human_time_diff($el['timestamp']) . ' ago'; ?></div>
						<?php echo do_shortcode('[addtoany url="'.$page_url.'?job_id='.$el['id'].'" title="'.$el['title'].'"]'); ?>
					</div>
					<div class="content">
						<div class="short-desc"><p><?php echo $el['desc']; ?></p></div>
						<?php if($inf_list = $el['list']): ?>
							<ul class="list">
								<?php foreach($inf_list as $inf_el) echo '<li>'.$inf_el.'</li>'; ?>
							</ul>
						<?php endif; ?>
					</div>
					<div class="category-list">
						<ul>
							<li><span class="inf"><?php echo $el['cat']; ?></span>
							<li><span class="inf"><?php echo $el['type']; ?></span>
							<li><span class="inf"><?php echo $el['loc']; ?></span>
						</ul>
					</div>
				</div>
			<?php endforeach; ?>
			<?php if($max_pages != 1) my_pagination(false, $max_pages); ?>
		<?php else : ?>
			<span class="count"><strong>0</strong> Jobs found</span>
		<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
<?php get_footer(); ?>