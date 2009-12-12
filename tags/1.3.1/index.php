<?php
/*
Plugin Name: SubHeading
Plugin URI: http://wordpress.org/extend/plugins/subheading/
Description: Adds the ability to show a subheading for posts and pages using a custom field. To display subheadings place <code>&lt;?php the_subheading(); ?&gt;</code> in your template file. 
Version: 1.3.1
Author: 36Flavours
Author URI: http://36flavours.com
*/
if (!class_exists('SubHeading')) {
	class SubHeading
	{
		var $name = 'SubHeading';
		var $tag = 'subheading';
		var $meta_key;
		var $options = array();
		function SubHeading()
		{
			if ($options = get_option($this->tag)) {
				$this->options = $options;
			}	
			$this->meta_key = '_'.$this->tag;
			if (is_admin()) {
				add_action('admin_menu', array(&$this, 'meta'));
				add_action('save_post', array(&$this, 'save'));
				add_action('admin_menu', array(&$this, 'menu'));
				add_action('admin_init', array(&$this, 'settings_init'));
				if (isset($this->options['lists'])) {
					add_action('admin_enqueue_scripts', array(&$this, 'admin'), 10, 1);
				}
				add_filter('plugin_row_meta', array(&$this, 'settings_meta'), 10, 2);
			}
			add_filter('the_title_rss', array(&$this, 'rss'));
			add_filter('the_subheading', array(&$this, 'build'), 1);
		}
		function activate()
		{
			if (!$this->options) {
				update_option($this->tag, array(
					'posts' => 1,
					'rss' => 1,
					'lists' => 1
				));
			}
		}
		function deactivate()
		{
			if (isset($this->options['tidy'])) {
				$posts = get_posts('numberposts=-1&post_type=any&meta_key=_subheading');
				foreach ($posts as $post) {
					delete_post_meta($post->ID, '_subheading');
				}
				update_option($this->tag, null);
			}
		}
		function build($args)
		{
			extract($args);
			if ($value = $this->value($id)) {
				if (isset($this->options['tags'])) {
					$value = do_shortcode($value);
				}
				$subheading = $before.$value.$after;
				if ($display == true) {
					echo $subheading;
				} else {
					return $subheading;
				}
			}
			return null;
		}
		function meta()
		{
			add_meta_box($this->tag.'_postbox', $this->name, array(&$this, 'panel'), 'page', 'normal', 'high');
			if (isset($this->options['posts'])) {
				add_meta_box($this->tag.'_postbox', $this->name, array(&$this, 'panel'), 'post', 'normal', 'high');
			}
		}
		function panel()
		{
			include_once('panel.php');
		}
		function save($post_id)
		{
			if (!isset($_POST[$this->tag.'nonce']) || !wp_verify_nonce($_POST[$this->tag.'nonce'], 'wp_'.$this->tag)) {
				return $post_id;
			}
			if (!current_user_can('edit_'.($_POST['post_type'] == 'page' ? 'page' : 'post'), $post_id)) {
				return $post_id;
			}
			$subHeading = wp_filter_kses($_POST[$this->tag.'_value']);
			if (empty($subHeading)) {
				delete_post_meta($post_id, $this->meta_key, $subHeading);
			} else if (!update_post_meta($post_id, $this->meta_key, $subHeading)){
				add_post_meta($post_id, $this->meta_key, $subHeading);
			}
		}
		function value($id=false)
		{
			global $post;
			return get_post_meta(($id !== false ? $id : $post->ID), $this->meta_key, true);
		}
		function rss($title)
		{
			if (isset($this->options['rss']) && $subHeading = $this->value()) {
				return $title.' - '.esc_html(strip_tags($subHeading));
			}
			return $title;
		}
		function column_heading($columns)
		{
			$columns[$this->tag] = $this->name;
			return $columns;
		}
		function column_value($column_name, $post_id)
		{
			$this->build(array('id'=>$post_id,'before'=>'','after'=>'','display'=>true));
		}
		function admin($hook)
		{
			if ($hook == 'edit.php' || $hook == 'edit-pages.php') {
				wp_enqueue_script($this->name, WP_PLUGIN_URL.'/'.$this->tag.'/admin.js');
				add_filter('manage_pages_columns', array(&$this, 'column_heading'));
				add_filter('manage_pages_custom_column', array(&$this, 'column_value'), 10, 2);
				if (isset($this->options['posts'])) {
					add_filter('manage_posts_columns', array(&$this, 'column_heading'));
					add_filter('manage_posts_custom_column', array(&$this, 'column_value'), 10, 2);
				}
			}
		}
		function menu()
		{
			add_submenu_page(
				'plugins.php',
				'Manage '.$this->name,
				$this->name,
				'administrator',
				$this->tag,
				array(&$this, 'settings_page')
			);
		}
		function settings_init()
		{
			register_setting($this->tag.'_options', $this->tag, array(&$this, 'settings_validate'));
		}
		function settings_validate($inputs)
		{
			if (is_array($inputs)) {
				foreach ($inputs AS $key => $input) {
					$inputs[$key] = ($inputs[$key] == 1 ? 1 : 0);
				}
				return $inputs;
			}
		}
		function settings_page()
		{
			include_once('settings.php');
		}
		function settings_meta($links, $file)
		{
			$plugin = plugin_basename(__FILE__);
			if ($file == $plugin) {
				return array_merge(
					$links,
					array(sprintf(
						'<a href="'.$_SERVER['PHP_SELF'].'?page=%s">%s</a>',
						$this->tag, __('Settings')
					))
				);
			}
			return $links;
		}
	}
	$subHeading = new SubHeading();
	if (isset($subHeading)) {
		register_activation_hook(__FILE__, array(&$subHeading, 'activate'));
		register_deactivation_hook(__FILE__, array(&$subHeading, 'deactivate'));
		function the_subheading($b='',$a='',$d=true,$i=false){
			return apply_filters('the_subheading', array('before'=>$b,'after'=>$a,'display'=>$d,'id'=>$i));
		}
		function get_the_subheading($i=false,$b='',$a='')
		{
			return apply_filters('the_subheading', array('before'=>$b,'after'=>$a,'id'=>$i));
		}
	}
}