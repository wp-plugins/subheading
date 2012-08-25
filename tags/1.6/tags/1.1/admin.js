jQuery(document).ready(function($) {
	$('.column-subheading').hide();
	$('td.subheading').each(function() {
		$('td.post-title :first', $(this).parents('tr'))
			.after($(this).html());
	});
});