<?php
if (array_key_exists('updated', $_GET)) :
?>
<div id="message" class="updated fade">
	<p><?php _e('Settings saved'); ?>.</p>
</div>
<?php endif; ?>
<div class="wrap">
	<div id="icon-plugins" class="icon32"><br /></div>
	<h2><?=$this->name?> <?php _e('Settings'); ?></h2>
	<form method="post" action="options.php">
		<?php settings_fields($this->tag.'_options'); ?>
		<table class="form-table">
			<tr valign="top">
				<td>
					<label for="subheading[rss]">
						<input name="subheading[rss]" type="checkbox" id="subheading[rss]" value="1" <?php if (array_key_exists('rss', $this->options)) { checked('1', $this->options['rss']); } ?> />
						Append to RSS feeds.
					</label>
				</td>
			</tr>
			<tr valign="top">
				<td>
					<label for="subheading[reposition]">
						<input name="subheading[reposition]" type="checkbox" id="subheading[reposition]" value="1" <?php if (array_key_exists('reposition', $this->options)) { checked('1', $this->options['reposition']); } ?> />
						Prevent reposition of input under the title when editing.
					</label>
				</td>
			</tr>
			<tr valign="top">
				<td>
					<label for="subheading[posts]">
						<input name="subheading[posts]" type="checkbox" id="subheading[posts]" value="1" <?php if (array_key_exists('posts', $this->options)) { checked('1', $this->options['posts']); } ?> />
						Enable for posts as well as pages.
					</label>
				</td>
			</tr>
			<tr valign="top">
				<td>
					<label for="subheading[lists]">
						<input name="subheading[lists]" type="checkbox" id="subheading[lists]" value="1" <?php if (array_key_exists('lists', $this->options)) { checked('1', $this->options['lists']); } ?> />
						Display on admin edit lists.
					</label>
				</td>
			</tr>
			<tr valign="top">
				<td>
					<label for="subheading[tags]">
						<input name="subheading[tags]" type="checkbox" id="subheading[tags]" value="1" <?php if (array_key_exists('tags', $this->options)) { checked('1', $this->options['tags']); } ?> />
						Apply shortcode filters.
					</label>
				</td>
			</tr>
			<tr valign="top">
				<td>
					<label for="subheading[append]">
						<input name="subheading[append]" type="checkbox" id="subheading[append]" value="1" <?php if (array_key_exists('append', $this->options)) { checked('1', $this->options['append']); } ?> />
						Automatically append before the content.
					</label>
				</td>
			</tr>
			<tr id="subheading-append" valign="top">
				<td>
					<label for="subheading[before]">
						Before:
						<input name="subheading[before]" type="text" id="subheading[before]" value="<?php if (array_key_exists('before', $this->options)) { echo esc_attr($this->options['before']); } ?>" />
					</label>
					<label for="subheading[after]">
						After:
						<input name="subheading[after]" type="text" id="subheading[after]" value="<?php if (array_key_exists('after', $this->options)) { echo esc_attr($this->options['after']); } ?>" />
					</label>
				</td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" name="Submit" class="button-primary" value="<?php _e('Save Changes'); ?>" />
		</p>
	</form>
</div>