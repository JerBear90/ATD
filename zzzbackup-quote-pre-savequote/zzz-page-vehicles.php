<?php
/* Template Name: Vehicle Index */
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package     Total
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2014, Symple Workz LLC
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 * @version     2.0.0
 */

// Get site header
get_header(); ?>

    <div id="content-wrap" class="container clr">

        <?php wpex_hook_primary_before(); ?>

        <div id="primary" class="content-area clr">

            <?php wpex_hook_content_before(); ?>

            <div id="content" class="clr site-content" role="main">

                <?php wpex_hook_content_top(); ?>

                <?php
                // Main page loop
                while ( have_posts() ) : the_post(); ?>

                    <article class="clr">

                        <?php
                        // Check if page should display featured image
                        if ( has_post_thumbnail() && get_theme_mod( 'page_featured_image' ) ) : ?>

                            <div id="page-featured-img" class="clr">

                                <?php
                                // Dislpay full featured image
                                wpex_post_thumbnail( array(
                                    'size'  => 'full',
                                    'alt'   => wpex_get_esc_title(),
                                ) ); ?>
                                
                            </div><!-- #page-featured-img -->

                        <?php endif; ?>

                        <div class="entry-content entry clr">

                            <?php
                            // Output page content
                            the_content(); ?>
                            <div class="clr"></div>
                            <br><hr>
                            <?php

                            $args = array(
                            	'posts_per_page' => -1, 
                                'post_type' => 'vehicles',
                                'orderby' => 'title',
                                'order'	=> 'ASC'
                            );
                            
                            $the_query = new WP_Query( $args );

                            $num = $the_query->post_count;
                            $numbercol = $num / 3;
                            $numbercol = ceil($numbercol);
            
/*
                            echo $num."<br>";
                            echo $numbercol;
*/
            
                            if( $the_query->have_posts() ):
                            
                                $counter=1;
                                echo "<ul id='vehiclelist'>";
                                while( $the_query->have_posts() ) : $the_query->the_post();
                                    setup_postdata( $vehiclepost );
                                    $make = get_field('make');
                                    $model = get_field('model');
                                    $url = get_permalink();
                                    
                                    if ($counter==1) {
                                        echo "<li>";
                                    }
                                    echo "<a href='$url'>$make $model</a><br>";  
                                    
                                    if ($counter==$numbercol) {
                                        echo "</li>";
                                        $counter=1;
                                    } else {
                                        $counter++;
                                    }
                               endwhile; 
                           endif;
                           wp_reset_query();
                           
                           echo "</ul><div style='clear:both'></div>";
                           
            
            /*
                           while ( have_posts() ) : the_post();
                                $old_url = '^vehicles' . get_field('old_url') . '/$';
                                $url = get_permalink();
                                $url = str_ireplace("http://www.autotransportdirect.com", "", $url);
                                echo "RewriteRule $old_url $url [R=301,L]<br>";
                           endwhile; 
            */
            
                           
                           
                           ?>
                           <style>
                           ul#vehiclelist {
                               list-style: none;
                               margin: 0;
                               padding: 0;
                           }
            
                           ul#vehiclelist li {
                                float: left;
                                width: 30%;
                           }
                           
                           </style>

                            <?php
                            // Output page pagination
                            wp_link_pages( array(
                                'before'        => '<div class="page-links clr">',
                                'after'         => '</div>',
                                'link_before'   => '<span>',
                                'link_after'    => '</span>',
                            ) ); ?>

                        </div><!-- .entry-content -->

                        <?php
                        // Get social sharing template part
                        get_template_part( 'partials/social', 'share' ); ?>

                    </article><!-- #post -->

                    <?php
                    // Check if comments are enabled for pages
                    if ( get_theme_mod( 'page_comments' ) ) : ?>
                    
                        <?php
                        // Display comments
                        comments_template(); ?>

                    <?php endif; ?>

                <?php
                // End main loop
                endwhile; ?>

                <?php wpex_hook_content_bottom(); ?>

            </div><!-- #content -->

            <?php wpex_hook_content_after(); ?>

        </div><!-- #primary -->

        <?php wpex_hook_primary_after(); ?>

    </div><!-- #content-wrap -->

<?php
// Get site footer
get_footer(); ?>