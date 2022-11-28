<?php
/**
 * Template Name: Blog
 *
 * @package		Total
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2014, Symple Workz LLC
 * @link		http://www.wpexplorer.com
 * @since 		Total 1.0.0
 * @version		1.0.0
 */

get_header(); ?>

	<?php if ( has_post_thumbnail() && get_theme_mod( 'page_featured_image' ) ) : ?>
		<div id="page-featured-img" class="clr">
			<?php the_post_thumbnail(); ?>
		</div><!-- #page-featured-img -->
	<?php endif; ?>

	<div id="content-wrap" class="container clr">
		<section id="primary" class="content-area clr">
			<div id="content" class="site-content clr" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="entry-content entry clr">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				<?php endwhile; ?>
				<?php
				global $post, $paged, $more;
				$more = 0;
				if ( get_query_var( 'paged' ) ) {
					$paged = get_query_var( 'paged' );
				} else if ( get_query_var( 'page' ) ) {
					$paged = get_query_var( 'page' );
				} else {
					$paged = 1;
				}
				// Query posts
				$wp_query = new WP_Query(
					array(
						'post_type'			=> 'post',
						'paged'				=> $paged,
						'category__not_in'	=> wpex_blog_exclude_categories( true ),
					)
				);
				if ( $wp_query->posts ) : ?>
					<div id="blog-entries" class="clr <?php wpex_blog_wrap_classes(); ?>">
						<?php $wpex_count = 0; ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php $wpex_count++; ?>
							<?php get_template_part( 'partials/blog/blog-entry', 'layout' ); ?>
							<?php if ( wpex_blog_entry_columns() == $wpex_count ) $wpex_count=0; ?>
						<?php endwhile; ?>
					</div><!-- #blog-entries -->
					<?php wpex_blog_pagination(); ?>
				<?php endif; ?>
				<?php wp_reset_postdata(); wp_reset_query(); ?>
			</div><!-- #content -->
		</section><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- #content-wrap -->

<?php get_footer(); ?>