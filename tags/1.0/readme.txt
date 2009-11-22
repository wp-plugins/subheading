=== SubHeading ===
Contributors: 36Flavours
Tags: sub, heading, title, admin, template, page, post, byline, rss
Requires at least: 2.8.2
Tested up to: 2.8.6
Stable tag: 1.0

Adds the ability to easily add and display a sub title/heading on both posts and pages.

== Description ==

This plugin uses a custom field to allow sub titles/headings to be added to both posts and pages.

The custom subheading field is re-positioned so it is directly below the main title when editing.

By default subheadings are also appended to RSS feeds and the admin edit post/page lists.

== Installation ==

Here we go:

1. Upload the `subheading` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Place `<?php if (function_exists('the_subheading')) { the_subheading('<p>', '</p>'); } ?>` in your template files where you want it to appear.
4. Add the subheading content using the standard WordPress edit page.

The settings for this plugin are found by navigating to the `Plugins` menu and selecting `SubHeading`.

If you are not within `the_loop`, you can use `get_the_subheading($postID);` to fetch the value for a particular page or post.

== Frequently Asked Questions ==

= How do I enable subheadings on posts? =

By default subheadings are disabled for posts, you can enable them on the settings page `Plugins > SubHeading > Enable for posts as well as pages`.

= What custom field name does it use? =

The field name used is `_subheading`, the underscore prefix prevents it from being displayed in the list of custom fields.

= How can I append the subheading to my RSS feed? =

Check the RSS option on the settings page`Plugins > SubHeading > Append to RSS feeds`.

= What if I want to include shortcodes in my subheading? =

I suggest replacing the existing method of including the subheading with something like:

`<?php if (function_exists('the_subheading')) { echo do_shortcode(the_subheading('<p>', '</p>', false)); } ?>`

This will apply any existing shortcode filters to the subheading value you have set.

= How can I prevent the subheading input moving to the top of the edit page? =

Some plugins will hide the element containing the post title, which is this element that the subheading input is appended to.

You can prevent the repositioning of the input via the options page.

== Screenshots ==

1. The SubHeading option is displayed directly below the main title.
2. Settings are managed using a plugin options page.

== Changelog ==

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