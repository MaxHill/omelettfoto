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
        $temp = $wp_query; 
        $wp_query = null; 
        $wp_query = new WP_Query(); 
        $wp_query->query('showposts=10&post_type=image_item'.'&paged='.$paged); 

        while ($wp_query->have_posts()) : $wp_query->the_post(); 
        ?>

        <div class="image-grid-item">
            <img src="<?php the_field('bilden'); ?>" alt="<?php the_title() ?>">

            <a class="fancybox overlay-image" href="<?php the_field('bilden'); ?>">
                <div class="center">
                    <p> <?php the_title() ?>  </p>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/glaszoom.png" alt="zoom">
                </div>
            </a>                   
        </div>
    <?php endwhile; ?>




</div> 
    <nav class="pagination">
        <?php previous_posts_link('Newer') ?>
        <?php next_posts_link('Older') ?>
    </nav>    
    <?php 
        $wp_query = null; 
        $wp_query = $temp;  // Reset
    ?>
</section>  

<?php get_footer(); ?>