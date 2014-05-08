<?php
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}
?>
<?php get_header(); ?>
<section id="main" role="main">
	<div id="image-container" class="content image-container">


		<?php 
		$current_query = $wp_query->query_vars;
		query_posts( array( $current_query['taxonomy'] => $current_query['term'], 'posts_per_page' => 12, 'paged' => $paged ) );

		while ( have_posts() ) : the_post();?>

		<a class="image-grid-item" href="<?php the_field('bilden'); ?>" rel="fancyboxgallery">
			<img src="<?php the_field('bilden'); ?>" alt="<?php the_title() ?>">

			<div class="fancybox overlay-image" >
				<div class="center">
					<p> <?php the_title() ?>  </p>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/glaszoom.png" alt="zoom">
				</div>
			</div>
		</a>
	<?php endwhile; ?>
</div>

<nav class="imagePagination">
	<?php previous_posts_link('Newer') ?>
	<?php next_posts_link('Older') ?>
	<p class='loading'><img src='<?php echo get_stylesheet_directory_uri(); ?>/assets/images/loader1.gif' alt="loading"></p>
</nav>    
</section>
<?php get_footer(); ?>