<?php
/**
 * The Template for displaying all single posts.
 *
 * @package     Total
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2014, Symple Workz LLC
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 * @version     2.0.0
 */

get_header(); ?>
<style>
.site-breadcrumbs {
    display:none;
}
</style>
<div id="content-wrap" class="container clr">


    <div id="primary" class="content-area clr" style="width:100%">


        <main id="content" class="site-content clr" role="main">


            <?php while ( have_posts() ) : the_post(); ?>

                <article class="single-blog-article clr">

                    <div class="vehicleblock">
            			<div class="vehiclepic">
            			    <img src="/vehicles-old/<?php the_field('original_image_1'); ?>" alt="<?php the_field('make'); ?> <?php the_field('model'); ?>" style="border: 1px solid #9e9e9e;" />
            			</div>
        
            			<div class="vehicleinfo">
            			    <div class="vehicletitle">Vehicle Make/Model Specifications:</div>
            			    <div class="vehiclerow"><strong>Make:</strong> <?php the_field('make'); ?></div>
            			    <div class="vehiclerow"><strong>Model:</strong> <?php the_field('model'); ?></div>
            			</div>
        
        
                    </div>
        
        
        			<div class="post-content" style="margin-top:30px;clear:both;">
        				<img src="/vehicles/<?php the_field('original_image_2'); ?>" alt="<?php the_field('make'); ?> <?php the_field('model'); ?>" class="alignright" style="border: 1px solid #9e9e9e;" /><?php the_content(); ?>
        				
        				<a href='/vehicle-make-models-calculator/'><b><< Back to Vehicle Index</b></a>
        			</div>

                </article><!-- .entry -->

            <?php endwhile; ?>


        </main><!-- #content -->


    </div><!-- #primary -->


</div><!-- .container -->




<?php get_footer(); ?>