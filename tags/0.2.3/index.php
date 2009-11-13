<?php
/*
Plugin Name: SubHeading
Plugin URI: http://wordpress.org/extend/plugins/subheading/
Description: Adds the ability to show a subheading for posts and pages using a custom field. To display subheadings place <code>&lt;?php the_subheading(); ?&gt;</code> in your template file. 
Version: 0.2.3
Author: 36Flavours
Author URI: http://36flavours.com
*/

function wpsh_panels()
{
	add_meta_box('wpsh_panel', 'Subtitle', 'wpsh_render', 'page', 'normal', 'high');
	if (!defined('WPSH_POSTS') || WPSH_POSTS === true) {
		add_meta_box('wpsh_panel', 'Subtitle', 'wpsh_render', 'post', 'normal', 'high');
	}
}
function wpsh_render()
{
	include_once('panel.php');
}
function wpsh_save($post_id)
{
	if (!wp_verify_nonce($_POST['_subheadingnonce'], 'wp_subheading')) {
		return $post_id;
	}
	if (!current_user_can('edit_'.($_POST['post_type'] == 'page' ? 'page' : 'post'), $post_id)) {
		return $post_id;
	}
	$subHeading = wp_filter_kses(htmlentities($_POST['wpsh_value']));
	if (empty($subHeading)) {
		delete_post_meta($post_id, '_subheading', $subHeading);
	} else if (!update_post_meta($post_id, '_subheading', $subHeading)){
		add_post_meta($post_id, '_subheading', $subHeading);
	}
}
function wpsh_value($id=false)
{
	global $post;
	return get_post_meta(($id !== false ? $id : $post->ID), '_subheading', true);
}
function the_subheading($before='', $after='', $display=true, $id=false)
{
	global $post;
	if ($value = wpsh_value()) {
		$subheading = $before.$value.$after;
		if ($display) {
			echo $subheading;
		} else {
			return $subheading;
		}
	}
	return null;
}
function get_the_subheading($id, $before='', $after='', $display=true)
{
	the_subheading($before, $after, $display, $id);
}
add_action('admin_menu', 'wpsh_panels');
add_action('save_post', 'wpsh_save');
