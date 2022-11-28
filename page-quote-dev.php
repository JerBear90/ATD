<?php
ini_set('display_errors','On');
error_reporting(E_ERROR);
/* Template Name: Quote Pages - DEV */

// Get site header
get_header(); ?>
	<div id="content-wrap" class="container clr <?php echo wpex_get_post_layout_class(); ?>">
		<section id="primary" class="content-area clr">
			<div id="content" class="clr site-content" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="clr">
						<div class="entry-content entry clr">
							<?php 
    							if (isset($_GET['step'])) {
                                    if ($_GET['step']=='1b') {
                                        //Show search results
                                	    the_content();
                                    } elseif ($_GET['step']=='2') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-2-dev.php');
                                    } elseif ($_GET['step']=='3') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-3-dev.php');
                                    } elseif ($_GET['step']=='4') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-4-dev.php');
                                    } elseif ($_GET['step']=='5') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-5-dev.php');
                                    } elseif ($_GET['step']=='6') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-6-dev.php');
                                    } elseif ($_GET['step']=='7') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-7-dev.php');
                                    } 
                                } else {
	                                    the_content();
                                    }
							?>
						</div><!-- .entry-content -->
					</article><!-- #post -->
				<?php endwhile; ?>
			</div><!-- #content -->
		</section><!-- #primary -->

	</div><!-- #content-wrap -->
<?php
// Get site footer
  //echo "<div align='center'><font color='red'><br><strong>DEV</strong></font></div><br>";  
get_footer(); ?>