# Auto_Copyright_WP
WordPress plugin to automatically change the Copyright.

=== Auto Copyright Date ===
Contributors: Dylan RADELET
Tags: copyright, date, shortcode, settings, styles
Requires at least: 4.0
Tested up to: 5.8
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
Automatically update and customize your website's copyright date with the Auto Copyright Date plugin. This plugin allows you to set your site name and customize the copyright styles easily. You can use a shortcode to display the current year and your site name in your desired format.

== Installation ==

1. Upload the 'auto-copyright-date' folder to the '/wp-content/plugins/' directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Navigate to 'Auto Copyright Date' in the admin menu to configure your settings.

== Usage ==

Once activated, the plugin provides a shortcode that you can use to display the copyright date and site name on your website.

1. In a post or page, use the shortcode: `[copyright_date]`.
2. In your theme files, you can use the following PHP code: `<?php echo do_shortcode('[copyright_date]'); ?>`.

== Settings ==

Visit the 'Auto Copyright Date Settings' page under the 'Settings' menu to customize the display:

- Enter your site name.
- Choose a CSS class for additional styling (optional).
- Pick a color for the copyright text.
- Select a font family from the provided list.
- Set the font size in pixels.

Click "Save Changes" to update your settings.

== Donation ==

If you find this plugin helpful, please consider making a donation to support further development. Your contribution is greatly appreciated!

[PayPal Donation Link](https://www.paypal.com/donate/?hosted_button_id=H3V7TDGMTKVJU)

== Screenshots ==

1. Auto Copyright Date Settings Page
2. Shortcode examples for widget and PHP

== Changelog ==

= 1.0 =
* Initial release.

