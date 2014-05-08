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
        $wp_query->query('showposts=12&post_type=image_item'.'&paged='.$paged); 

        while ($wp_query->have_posts()) : $wp_query->the_post(); 
        $product_terms = wp_get_object_terms($post->ID, 'product');
        ?>

        <?php 
$args = array( 'post_type' => 'image_category' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
    the_title();
    echo '<div class="entry-content">';
    the_excerpt();
    echo '</div>';
endwhile;
 ?>

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
        <?php previous_posts_link('Nyare') ?>
        <?php next_posts_link('Äldre') ?>
        <p class='loading'><img src='<?php echo get_stylesheet_directory_uri(); ?>/assets/images/loader1.gif' alt="loading"></p>
    </nav>    
    <?php 
        $wp_query = null; 
        $wp_query = $temp;  // Reset
    ?>
</section>  


<?php get_footer(); ?>