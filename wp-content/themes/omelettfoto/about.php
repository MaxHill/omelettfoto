<?php
/*
Template Name: About
*/

 get_header(); ?>

<section id="main" role="main">
	<div class="container about">
        <div class="row">
        <div id="content" class="col-4 medium-col-12 profile-picture">

                <?php while (have_posts()) : the_post(); ?>
                	 <?php the_post_thumbnail(); ?> 
                    </article>
                <?php endwhile; //End the loop ?>

            </div>
            <div id="content" class="col-8 medium-col-12">

                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                        <header>
                        <?php if (get_field('innehalls_rubrik')): ?>
                        	 <h1 class="page-title"><?php the_field('innehalls_rubrik'); ?></h1>
                        <?php else: ?>
                            <h1 class="page-title"><?php the_title(); ?></h1>
                        <?php endif; ?>
                        </header>
                        <?php the_content(); ?>

                        <ul class="contactInfo">
	                        <?php if (get_field('namn')): ?>
	                        	<li><strong><?php the_field('namn'); ?></strong></li> <br>
	                        <?php endif; ?>

							<?php if (get_field('foretag')): ?>
	                        	<li><?php the_field('foretag'); ?></li>
	                        <?php endif; ?>

	                        <?php if (get_field('adress')): ?>
	                        	<li><?php the_field('adress'); ?></li>
	                        <?php endif; ?>

	                        <?php if (get_field('post_nummer')): ?>
	                        	<li><?php the_field('post_nummer'); ?></li>
	                        <?php endif; ?>

	                        <?php if (get_field('post_nummer')): ?>
	                        	<li><strong>Tele:</strong><?php the_field('post_nummer'); ?></li>
	                        <?php endif; ?>

	                        <?php if (get_field('mail')): ?>
	                        	<li><strong>Mail:</strong><a href="mailto:<?php the_field('mail'); ?>"><?php the_field('mail'); ?></a></li>
	                        <?php endif; ?>
                        </ul>
                    </article>
                <?php endwhile; //End the loop ?>

            </div>
        </div>
</section>	

 <?php get_footer(); ?>