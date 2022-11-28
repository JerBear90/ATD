<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package TotalTheme
 * @subpackage Templates
 * @version 5.0
 */

defined( 'ABSPATH' ) || exit;

?><!doctype html>
<html <?php language_attributes(); ?><?php wpex_schema_markup( 'html' ); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
<script>
var $ = jQuery.noConflict();
</script>
<script type="text/javascript" src="//d36b03yirdy1u9.cloudfront.net/wp-content/themes/atdv2/js/main.js?nocache=11"></script>   
<link rel="shortcut icon" href="//d36b03yirdy1u9.cloudfront.net/wp-content/uploads/2021/07/favicon.png">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-678634-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-678634-1');  
</script>


<?php
if (isset($_GET['step'])) {
  if ($_GET['step']=='3') {
    if($_COOKIE['admin']!="") {
    ?>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCEBbsv4WtlzY7UBpe57r0eP9l50wwDYNs"></script>
    <script type="text/javascript" src="/scripts/gmap/jquery.ui.map.min.js"></script>
    <?php 
    }
  }
}
?>


</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<?php wpex_hook_after_body_tag(); // Added before wp_body_open was introduced ?>

	<?php wpex_outer_wrap_before(); ?>

	<div id="outer-wrap" class="wpex-clr">

		<?php wpex_hook_wrap_before(); ?>

		<div id="wrap" class="wpex-clr">

			<?php wpex_hook_wrap_top(); ?>

			<?php wpex_hook_main_before(); ?>

			<main id="main" class="site-main wpex-clr"<?php wpex_schema_markup( 'main' ); ?><?php wpex_aria_landmark( 'main' ); ?>>

				<?php wpex_hook_main_top(); ?>