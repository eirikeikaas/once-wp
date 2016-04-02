<?php
// Template Name: HomePage
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
<?php if(get_post_meta($post->ID, 'progression_address_home', true)): ?>
<div id="address-hours-homepage">
	<div class="width-container">
		<div id="address-homepage-pro"><?php echo (get_post_meta($post->ID, 'progression_address_home', true)); ?></div>
		<?php if(get_post_meta($post->ID, 'progression_hours_home', true)): ?><div id="hours-homepage-pro"><?php echo (get_post_meta($post->ID, 'progression_hours_home', true)); ?></div><?php endif; ?> 
	</div>
</div>
<?php endif; ?> 

<div id="main">
	<div class="width-container">
	<!-- Homepage Child Pages Start -->
	<?php
	$args = array(
		'post_type' => 'page',
		'numberposts' => -1,
		'post' => null,
		'post_parent' => $post->ID,
	    'order' => 'ASC',
	    'orderby' => 'menu_order'
	);
	$features = get_posts($args);
	$features_count = count($features);
	if($features):
		$count = 1;
		foreach($features as $post): setup_postdata($post);
			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src($image_id, 'large');
			$col_count_progression = get_theme_mod('home_col_progression', '3');
			if($count >= 1+$col_count_progression) { $count = 1; }
	?>
		<div class="home-child-boxes grid<?php echo get_theme_mod('home_col_progression', '3'); ?>column-progression <?php if($count == get_theme_mod('home_col_progression', '3')): echo ' lastcolumn-progression'; endif; ?>">
			<div class="home-child-boxes-container">
				<?php if(get_post_meta($post->ID, 'progression_child_link', true)): ?><a href="<?php echo get_post_meta( get_the_ID(), 'progression_child_link', true ); ?>"><?php endif; ?>
				<?php if($image_url[0]): ?><div class="home-child-image-pro"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>"></div><?php endif; ?>
				
				<?php if($image_url[0]): ?><div class="floating-text-home"><?php the_content(); ?><?php endif; ?>
					<h3 class="home-child-title"><?php the_title(); ?></h3>
				<?php if($image_url[0]): ?></div><?php else : ?><?php the_content(); ?><?php endif; ?>
				<?php if(get_post_meta($post->ID, 'progression_child_link', true)): ?></a><?php endif; ?>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	<?php if($count == get_theme_mod('home_col_progression', '3')): ?><div class="clearfix"></div><?php endif; ?>
	<?php $count ++; endforeach; ?>
	<?php endif; ?>
	<div class="clearfix"></div>
	<!-- Homepage Child Pages End -->
	</div><!-- close .width-container -->
	
	<!-- this code pull in the homepage content -->
	<?php while(have_posts()): the_post(); ?>
		<?php if($post->post_content=="") : ?><?php else : ?>
		<div id="homepage-content-container">
			<div class="width-container">
			<?php the_content(); ?>
			<div class='clearfix'></div>
			</div>
		</div>
		<?php endif; ?>
	<?php endwhile; ?>
	
	<?php if ( is_active_sidebar( 'homepage-widgets' ) ) : ?>
		<?php dynamic_sidebar( 'homepage-widgets' ); ?>
	<?php endif; ?>

<?php get_footer(); ?>