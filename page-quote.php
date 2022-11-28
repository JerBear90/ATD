<?php
/* Template Name: Quote Pages */

// Get site header
get_header(); 

$step = $_GET['step'];

if($step == '7')
{
?>
	<div id="content-wrap" class="clr <?php echo wpex_get_post_layout_class(); ?>">

<?php } else{?>	    

	    <div id="content-wrap" class="container clr <?php echo wpex_get_post_layout_class(); ?>">
<?php } ?>

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
                                   
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-2.php');
                                    } elseif ($_GET['step']=='3') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-3.php');
                                    } elseif ($_GET['step']=='4') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-4.php');
                                    } elseif ($_GET['step']=='5') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-5.php');
                                    } elseif ($_GET['step']=='6') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-6.php');
                                    } elseif ($_GET['step']=='7') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-7.php');
                                    } 

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
get_footer(); ?>