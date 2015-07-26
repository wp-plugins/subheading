<?php if ( ! isset( $this->options['reposition'] ) ) : ?>
<script type="text/javascript">
	jQuery( function( $ ) {
		$( '#<?php echo esc_js(  $this->tag ); ?>_postbox' )
			.hide()
			.find( 'input' )
			.attr( 'tabindex', 1 )
			.appendTo( '#titlewrap' );
	});
</script>
<?php endif; ?>
<style type="text/css">
	#wp_<?php echo esc_attr( $this->tag ); ?> { width: 100%; padding: 5px; font-size: 13px; margin-top: 3px; }
</style>
<?php echo wp_nonce_field( 'wp_' . $this->tag, $this->tag . 'nonce' ); ?>
<input type="text"
	autocomplete="off"
	id="wp_<?php echo esc_attr( $this->tag ); ?>"
	name="<?php echo esc_attr( $this->tag . '_value' ); ?>"
	value="<?php echo esc_attr( $this->value() ); ?>" />