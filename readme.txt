=== SubHeading ===
Contributors: 36Flavours
Tags: sub, heading, title, admin, template, page, post, byline
Requires at least: 2.8.2
Tested up to: 2.8.6
Stable tag: 0.3.2

Adds the ability to show a subtitle for posts and pages using a custom field.

== Description ==

This plugin uses a custom field to allow sub headings to ba added to both posts and pages.

The custom sub heading field is re-positioned so it is directly below the main title.

== Installation ==

Here we go:

1. Upload the `subheading` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place `<?php if (function_exists('the_subheading')) { the_subheading('<p>', '</p>'); } ?>` in your template files

If you are not within `the_loop`, you can use `get_the_subheading($postID);` to fetch the value for a particular post.

Sub headings can be disabled for posts by defining WPSH_POSTS in your functions file and setting the value to false `define('WPSH_POSTS', false);`.

== Frequently Asked Questions ==

= What custom field name does it use? =

The field name used is `_subheading`, the underscore prefix prevents it from being displayed in the list of custom fields.

= How can I prevent the subheading appearing in my RSS feed? =

Define WPSH_RSS in your functions file and set the value to false `define('WPSH_RSS', false);`.

== Screenshots ==

1. The Sub Heading option is displayed directly below the main title.

== Changelog ==

= 0.3.2 =
* Fixed get_the_subheading function to return correctly.
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