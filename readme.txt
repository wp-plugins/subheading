=== SubHeading ===
Contributors: stvwhtly
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=MTEDNQFNQVYLS
Tags: sub, heading, title, admin, template, page, post, byline, rss, custom, h2, headline, intro, text
Requires at least: 3.1
Tested up to: 3.1.4
Stable tag: 1.6.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds the ability to easily add and display a sub title/heading on any public post type.

== Description ==

This plugin uses a custom field to allow sub titles/headings to be added to any post type, including pages, posts and any public custom post type.

The custom subheading field is re-positioned so it is directly below the main title when editing.

Updates to your theme templates may be required in order for you to output the subheading values, please refer to the Installation instructions.

By default subheadings are also appended to RSS feeds and the admin edit post/page lists, these options and more can be modified via the settings page.

== Installation ==

Here we go:

1. Upload the `subheading` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Place `<?php if (function_exists('the_subheading')) { the_subheading('<p>', '</p>'); } ?>` in your template files where you want it to appear, or enable the `Automatically display SubHeadings before post content` option on the settings page.
4. Add the subheading content using the standard WordPress edit page.

The settings for this plugin are found by navigating to the `Plugins` menu and selecting `SubHeading`.

If you are not within `the_loop`, you can use `get_the_subheading($postID);` to fetch the value for a particular page or post.

== Frequently Asked Questions ==

= How do I enable subheadings on posts and custom post types? =

By default subheadings are only enabled for pages, you can enable them for posts or any public custom post type via the `Settings > Reading` page.

Just check the box that says `Enable on Posts.` or the required post type.

= What custom field name does it use? =

The field name used is `_subheading`, the underscore prefix prevents it from being displayed in the list of custom fields.

= How can I append the subheading to my RSS feed? =

Check the RSS option on the settings page `Plugins > SubHeading > Append to RSS feeds`.

= What if I want to include shortcodes in my subheading? =

Check the apply shortcode filters option on the settings page `Plugins > SubHeading > Apply shortcode filters`.

This will apply any existing shortcode filters to the subheading value you have set.

= How can I prevent the subheading input moving to the top of the edit page? =

Some plugins will hide the element containing the post title, which is this element that the subheading input is appended to.

You can prevent the repositioning of the input via the options page.

= What are the `Before` and `After` inputs used for? =

If you are using the option to automatically wrap the SubHeading content, you can include custom content before and after the subheading is displayed.

For example, setting Before to `<h3>` and after to `</h3>` will wrap the subheading in a h3 tag.

= How can I stop SubHeadings appearing in places I don't want them to? =

Using the "Automatically display SubHeadings before post content." setting will prepend any SubHeading value before outputting any post content.

The output can be customised slightly using the "Before" and "After" fields, however if you prefer more customisation and control it is probably best to disable this setting and edit the output within your theme templates.

To display SubHeadings, place `<?php if (function_exists('the_subheading')) { the_subheading('<p>', '</p>'); } ?>` in your template files where you want the SubHeading to appear.

= Why do tags such as <br /> and <p> disappear from my SubHeadings?

By default the plugin uses the default list of allowed tags, which can result in certain tags being removed.

This can be resolved by adding valid tags to the allowed list using the `subheading_tags` filter.

If for example you would like to enable the <br /> tag in SubHeadings, add the following function to your theme functions.php file.

`add_filter( 'subheading_tags', function( $tags ) {
	$tags['br'] = array();
	return $tags;
} );`

Note here that the key ('br') is the tag name and the array should be a list of valid attributes for that tag, for example `array('class', 'id')`.

== Upgrade Notice ==

Version 1.6 introduces the ability to enable subheadings on any public post type, including custom post types via the settings page, which has been merged into the `Settings > Reading` admin page instead of the plugin specific settings page.

Please ensure that subheadings are enabled for the required post types by checking the settings page in this new location.

== Screenshots ==

1. The SubHeading option is displayed directly below the main title.
2. Settings are managed via the Settings > Reading page.

== Changelog ==

= 1.6.3 =
* Added is_main_query() check to `the_content` filter to ensure subheadings are only appended when cycling through the primary loop.
* Added valid tags filter to allow additional tags to be used in SubHeadings. See "Why do tags such as <br /> and <p> disappear from my SubHeadings?" FAQ for more information.
= 1.6.2 =
* Renamed the "Wrap the SubHeading content." setting to "Automatically display SubHeadings before post content.".
* Modified activate function.
* Renamed some plugin class methods.
* Added FAQ regarding customisation of the SubHeading output.
= 1.6.1 =
* Corrected location of assets directory.
= 1.6 =
* Created uninstall.php to fix incorrectly referenced uninstall hook.
* Moved plugin settings to the `Settings > Reading` section.
* Added ability to enable SubHeadings on all public post types, including custom post types.
* Modified donate link.
* Updated screenshots and added plugin directory banner.
* Minor code reformatting.
= 1.5 =
* Added ability to allow subheading to be searched.
* Bug fixed where multiple subheadings could be stored for a single post.
= 1.4.2 =
* Replaced all remaining PHP short tags.
= 1.4.1 =
* Fixed issue where subheading was appended to multiple columns on admin edit pages.
= 1.4 =
* Added auto inclusion option of the subheading.
* Removed tidy option, all data is now removed during the uninstall process.
= 1.3.1 =
* Missed error reporting on nonce check.
= 1.3 =
* Fixed errors when error reporting is set to all.
* Fixed admin post/pages list display conflicting with other custom columns.
* Tested the plugin in WordPress 2.9.
= 1.2.2 =
* Enabled subheadings on posts by default.
= 1.2.1 =
* Fixed plugin settings link on plugins page.
= 1.2 =
* Added auto shortcode parsing option.
* Appended link to settings on plugins overview page.
* Modified tidy setting so that options are not reset when updating the plugin.
= 1.1 =
* Added option to allow headings to be completely removed when deactivating the plugin.
* Inclusion of Donate link ;)
= 1.0 =
* Converted plugin to a class based structure.
* Added new plugin settings pages with default actions.
= 0.3.3 =
* Added ability to prevent repositioning of the subheading input on edit page.
* SubHeadings are now displayed on admin edit posts / pages lists.
= 0.3.2 =
* Fixed `get_the_subheading` function to return correctly.
= 0.3.1 =
* Fixed character encoding issue.
= 0.3 =
* Appended subheading to RSS feed post title.
= 0.2.4 =
* Double encoding bug fix.
= 0.2.3 =
* Fixed / added escaping to admin output (via achellios) and ability to use HTML tags.
= 0.2.2 =
* Bug fix nonce checking.
= 0.2.1 =
* Bug fix to prevent output of before and after text with no subheading value.
= 0.2 =
* Tested up to 2.8.5 and began optimisation of the included files.
= 0.1 =
* This is the very first version.