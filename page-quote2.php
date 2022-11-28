<?php
/* Template Name: PWS Quote Pages */

// Get site header
get_header(); ?>

<style type="text/css">
    
    .page-template-page-quote2 .smart-forms 
    {
        padding: 0px !important;
    }
</style>
	
	<div id="content-wrap" class="custom_wrapper clr <?php echo wpex_get_post_layout_class(); ?>">
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
                                    } elseif ($_GET['step']=='1c') {
                                        //Show detail page
                                        //
//                                              echo "<pre>";
// 	print_r($_POST);
// 	echo "</pre>";
// 	exit();
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-2.php');
                                    } 
                                    elseif ($_GET['step']=='1') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/pws-quote-3.php');
                                    } elseif ($_GET['step']=='2') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/pws-quote-4.php');
                                    } elseif ($_GET['step']=='3') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/pws-quote-5.php');
                                    } elseif ($_GET['step']=='4') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/pws-quote-6.php');
                                    } elseif ($_GET['step']=='7') {
                                        //Show detail page
                                        include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/pws-quote-7.php');
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