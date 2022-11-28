<?php
$home_message_text = get_field( "home_message_text" );  
$home_message_image = get_field('home_message_image');
?>

<div class="homepromoimage"><img src="<?php echo $home_message_image['url']; ?>" style="min-height: 195px;" /></div>
<div class="promo-text" style="min-height: 69px;"><?php echo $home_message_text ?></div>