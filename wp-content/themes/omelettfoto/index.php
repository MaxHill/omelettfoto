


<?php get_header(); ?>
<section id="main" role="main">
    <div class="bloggroll-container">
        <div class="row">
            <div id="content" class="col-12">

                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                        <header class="postHeader">
                            <h1 class="page-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <h4> <p class="date"><?php the_date(); ?></p> <?php the_category(); ?></h4>
                        </header>
                        <?php the_content(); ?>
                    </article>
                <?php endwhile; //End the loop ?>
            
                <nav class="pagination">
                <?php previous_posts_link('Nyare') ?>
                    <?php if($previous = get_previous_posts_link() && $next = get_next_posts_link()) : ?>
                    <?php endif; ?>
                    <?php next_posts_link('Äldre') ?>
                </nav> 
            </div>
        </div>
    </div>
</section>	
<?php get_footer(); ?>