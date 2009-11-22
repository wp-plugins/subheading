<?php
if (array_key_exists('updated', $_GET)) :
?>
<div id="message" class="updated fade">
	<p>Settings saved.</p>
</div>
<?php endif; ?>
<div class="wrap">
	<div id="icon-plugins" class="icon32"><br /></div>
	<h2><?=$this->name?> Settings</h2>
	<form method="post" action="options.php">
		<?php settings_fields($this->tag.'_options'); ?>
		<table class="form-table">
			<tr valign="top">
				<td>
					<label for="subheading[rss]">
						<input name="subheading[rss]" type="checkbox" id="subheading[rss]" value="1" <?php checked('1', $this->options['rss']); ?> />
						Append to RSS feeds.
					</label>
				</td>
			</tr>
			<tr valign="top">
				<td>
					<label for="subheading[reposition]">
						<input name="subheading[reposition]" type="checkbox" id="subheading[reposition]" value="1" <?php checked('1', $this->options['reposition']); ?> />
						Prevent reposition of input under the title.
					</label>
				</td>
			</tr>
			<tr valign="top">
				<td>
					<label for="subheading[posts]">
						<input name="subheading[posts]" type="checkbox" id="subheading[posts]" value="1" <?php checked('1', $this->options['posts']); ?> />
						Enable for posts as well as pages.
					</label>
				</td>
			</tr>
			<tr valign="top">
				<td>
					<label for="subheading[lists]">
						<input name="subheading[lists]" type="checkbox" id="subheading[lists]" value="1" <?php checked('1', $this->options['lists']); ?> />
						Display on admin edit lists.
					</label>
				</td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" name="Submit" class="button-primary" value="<?php _e('Save Changes'); ?>" />
		</p>
	</form>
</div>