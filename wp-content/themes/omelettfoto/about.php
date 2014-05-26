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
	                        	<li><b><?php the_field('namn'); ?></b></li>
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

	                        <?php if (get_field('telefon')): ?>
	                        	<li><strong>Telefon:</strong> <?php the_field('telefon'); ?></li>
	                        <?php endif; ?>

	                        <?php if (get_field('mail')): ?>
	                        	<li><strong>E-post:</strong> <a href="mailto:<?php the_field('mail'); ?>"><?php the_field('mail'); ?></a></li>
	                        <?php endif; ?>
                        </ul>

                        <ul class="social-links contactInfo">
                            <li><strong>Följ mig på:</strong></li>
                            <li>
                                <?php if (get_field('instagram_link')): ?>
                                    <a class="instagram" target="_blank" href="<?php the_field('instagram_link'); ?>">
                                        <span class="icon insta"></span>Instagram
                                    </a>
                                <?php endif; ?>

                                <?php if (get_field('facebook_link')): ?>
                                    <a class="facebook" target="_blank" href="<?php the_field('facebook_link'); ?>">
                                        <span class="icon fb"></span>Facebook
                                    </a>
                                <?php endif; ?>
                            </li>
                        </ul>

                    </article>
                <?php endwhile; //End the loop ?>

            </div>
        </div>
</section>	

 <?php get_footer(); ?>