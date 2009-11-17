jQuery(document).ready(function($) {
	$('.column-subtitle').hide();
	$('td.subtitle').each(function() {
		$('td.post-title :first', $(this).parents('tr'))
			.after($(this).html());
	});
});