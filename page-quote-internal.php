<?php
/* Template Name: Internal Quote */

// Get site header
get_header(); 

setcookie("intquote", '1', 0, "/");
$_SESSION["intquote"]=1;

?>
<style>
    .homeform {
        background: #eee !important;
        width: 50%;
        min-height: inherit !important;
        padding: 20px;
    }
    
    .quoteform {
        width: 100% !important;
        top: 0;
        margin: 0;
        padding: 0;
    }
</style>
	<div id="content-wrap" class="container clr <?php echo wpex_get_post_layout_class(); ?>">
		<section id="primary" class="content-area clr">
			<div id="content" class="clr site-content" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="clr">
						<div class="entry-content entry clr">
							<?php 
    							if($_COOKIE['admin']!="") {
        							echo "<br><h1 style='color:red'>INTERNAL QUOTE</h1>";
                                    include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/atdv2/quote-1.php');                                    
                                } else {
                                    echo "<br><br>No Access";
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