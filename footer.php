<?php
/**
 * The template for displaying the footer.
 *
 * @package TotalTheme
 * @subpackage Templates
 * @version 5.0
 */

defined( 'ABSPATH' ) || exit;

?>

			<?php wpex_hook_main_bottom(); ?>

		</main>

		<?php wpex_hook_main_after(); ?>

		<?php wpex_hook_wrap_bottom(); ?>

	</div>

	<?php wpex_hook_wrap_after(); ?>

</div>

<?php wpex_outer_wrap_after(); ?>


<!--<script type="text/javascript">
jQuery('.quota_btn').click(function(){
alert("usman");
	jQuery(window).scrollTop(0);
	//alert();
  
});
</script>-->


<?php wp_footer(); ?>
<?php //if ($_COOKIE['admin']==1) { echo '<div style="text-align:center;font-size:12px;">Logged in Rep: ' . $_COOKIE['rep'] . '</div><br><br><br>'; } ?>
<link rel="stylesheet" type="text/css"  href="//d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/smartforms/css/smart-forms.css?nocache=11">
<link rel="stylesheet" type="text/css"  href="//d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/smartforms/css/smart-themes/blue.css?nocache=11">


<script type="text/javascript" src="//d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/smartforms/js/jquery-ui.min.js?nocache=11"></script>
<script type="text/javascript" src="//d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/smartforms/js/jquery.maskedinput.js?nocache=11"></script>
<script type="text/javascript" src="//d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/smartforms/js/jquery.validate.min.js?nocache=11"></script>
<script type="text/javascript" src="//d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/smartforms/js/additional-methods.min.js?nocache=11"></script>




<?php
if (isset($_GET['step'])) {
    if ($_GET['step']=='3') {
?>
<script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyCEBbsv4WtlzY7UBpe57r0eP9l50wwDYNs"></script>
<?php
    }
} ?>

</body>
</html>