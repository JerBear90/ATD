<?php
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
                            the_content(); 
                            

                    		$statename = get_post_custom_values('state');
                    		$statename = $statename[0];
		
                            
                            ?>
                            
                            <?php if(!empty($statename) && $statename!='US') { ?>
                				<h2><?php echo $statename ?> Auto Transport</h2>
                				<iframe width="100%" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/?q=<?php echo $statename ?>&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $statename ?>&amp;t=m&amp;z=6&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/?q=<?php echo $statename ?>&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $statename ?>&amp;t=m&amp;z=6&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a></small>
                            <?php } ?>

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