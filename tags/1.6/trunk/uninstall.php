<?php 

	// Ensure uninstall source is WordPress...
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}
	// Define the key used for storing options...
$tag = 'subheading';
	// Lookup all posts that have subheadings...
$posts = get_posts( array(
	'numberposts' => -1,
	'post_type' => 'any',
	'meta_key' => '_'.$tag
) );
	// Remove all the subheading values...
foreach ( $posts as $post ) {
	delete_post_meta( $post->ID, $this->meta_key );
}
	// Finally, remove the subheading options...
delete_option( $tag, null );
