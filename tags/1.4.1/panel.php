<?php
if (!isset($this->options['reposition'])) :
?><script type="text/javascript">
	jQuery(function($) {
		var subheading = $("#<?=$this->tag?>_postbox")
			.hide()
			.find("input")
			.attr('tabindex', 1)
			.appendTo("#titlewrap");
	});
</script>
<?php endif; ?>
<style type="text/css">
	#wp_<?=$this->tag?> { width: 100%; padding: 5px; font-size: 13px; margin-top: 3px; }
</style>
<?=wp_nonce_field('wp_'.$this->tag, $this->tag.'nonce')?>
<input type="text" autocomplete="off" id="wp_<?=$this->tag?>" name="<?=$this->tag?>_value" value="<?=esc_html($this->value())?>" />