<?php get_header(); ?>
<section id="main" role="main">
    <div class="container">
        <div class="row">
            <div id="content" class="col-8">

                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                        <header>
                            <h1 class="page-title"><?php the_title(); ?></h1>
                        </header>
                        <?php the_content(); ?>
                    </article>
                <?php endwhile; //End the loop ?>

            </div>
            <div class="col-4">
            <?php get_sidebar(); ?>
            </div>
    </div>
</section>	
<?php get_footer(); ?>