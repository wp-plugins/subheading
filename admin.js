jQuery( document ).ready( function( $ ) {
	$( '.column-subheading' ).hide();
	$( 'td.subheading' ).each( function() {
		$( 'td.post-title:first', $( this ).parents( 'tr' ) )
			.children(':first')
			.after($(this).html());
	} );
	$( '#subheading_append' ).on( 'click', function( e ) {
		
		console.log('append');
		
		$( '#subheading_before, #subheading_after' ).parent().css(
			'display',
			( $( this ).is( ':checked' ) ? '' : 'none' )
		);
	} ).triggerHandler( 'click' );
} );