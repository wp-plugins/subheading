<?php
if (!defined('WPSH_STATIC') || WPSH_STATIC !== true) :
?><script type="text/javascript">
	jQuery(function() {
		jQuery("#wpsh_panel")
			.hide()
			.find("input")
			.appendTo("#titlewrap");
	});
</script>
<?php endif; ?>
<style type="text/css">
	#wp_subheading { width: 100%; padding: 5px; font-size: 13px; margin-top: 3px; }
</style>
<?=wp_nonce_field('wp_subheading', '_subheadingnonce')?>
<input type="text" autocomplete="off" id="wp_subheading" name="wpsh_value" value="<?=esc_html(wpsh_value())?>" />