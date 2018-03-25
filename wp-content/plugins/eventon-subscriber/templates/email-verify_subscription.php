<?php
/**
 * Email template for subscriber verification email
 * 
 * You can edit this template by copying this file to 
 * ../wp-content/themes/yourtheme/eventon/subscriber/
 *
 * @version 0.2
 */

// styles
	$styles = array(
		'btn'=>"display: inline-block;padding: 5px 10px;border: 1px solid #B7B7B7; text-decoration:none; font-style:normal"
	);	
?>
<p><?php evo_lang_e('Thank you for subscribing to our calendar events!');?></p>
<p><?php evo_lang_e('Please click the link below to verify your email address.');?></p>
<p><a style='<?php echo $styles['btn'];?>' href='<?php echo $_link;?>'><?php evo_lang_e('Verify your email address');?></a></p>
<p><i><?php evo_lang_e('NOTE: If clicking on the link does not work, please copy the link and paste it in your browser window to verify your email address.');?></i></p>