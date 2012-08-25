<?php
/*
Plugin Name: SubHeading
Plugin URI: http://wordpress.org/extend/plugins/subheading/
Description: Adds the ability to show a subheading for posts and pages using a custom field. To display subheadings place <code>&lt;?php the_subheading(); ?&gt;</code> in your template file. 
Version: 0.3.3
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
	$subHeading = wp_filter_kses($_POST['wpsh_value']);
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
	if ($value = wpsh_value($id)) {
		$subheading = $before.$value.$after;
		if ($display) {
			echo $subheading;
		} else {
			return $subheading;
		}
	}
	return null;
}
function get_the_subheading($id=false, $before='', $after='', $display=true)
{
	return the_subheading($before, $after, false, $id);
}
function wpsh_rss($title) {
	if ((!defined('WPSH_RSS') || WPSH_RSS === true) && $subHeading = wpsh_value()) {
		return $title.' - '.esc_html(strip_tags($subHeading));
	}
	return $title;
}
function wpsh_columnHeading($columns)
{
	$columns['subtitle'] = "SubHeading";
	return $columns;
}
function wpsh_columnValue($column_name, $post_id)
{
	echo get_the_subheading($post_id);
}
function wpsh_enqueue_js($hook)
{
	if ($hook == 'edit.php' || $hook == 'edit-pages.php') {
		wp_enqueue_script('wp_subheading', WP_PLUGIN_URL.'/subheading/admin.js');
		add_filter('manage_posts_columns', 'wpsh_columnHeading');
		add_filter('manage_posts_custom_column', 'wpsh_columnValue', 10, 2);
		add_filter('manage_pages_columns', 'wpsh_columnHeading');
		add_filter('manage_pages_custom_column', 'wpsh_columnValue', 10, 2);
	}
}
add_action('admin_enqueue_scripts','wpsh_enqueue_js', 10, 1);
add_action('admin_menu', 'wpsh_panels');
add_action('save_post', 'wpsh_save');
add_filter('the_title_rss', 'wpsh_rss');
