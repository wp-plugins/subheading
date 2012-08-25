jQuery(document).ready(function($) {
	$('.column-subheading').hide();
	$('td.subheading').each(function() {
		$('td.post-title:first', $(this).parents('tr'))
			.children(':first')
			.after($(this).html());
	});
	$('input[name="subheading[append]"]').click(function(e) {
		if (e.setup) {
			e.preventDefault();
		}
		$('#subheading-append').css(
			'display',
			($(this).is(':checked') ? '' : 'none')
		);
	}).trigger({
		type: 'click',
		setup: true 
	});
});