=== WP Add Mime Types ===
Contributors: Kimiya Kitani
Tags: mime,file extention
Requires at least: 3.0
Tested up to: 4.9
Stable tag: 2.2.1

The plugin additionally allows the mime types and file extensions to WordPress.
 
== Description ==

The plugin additionally allows the mime types and file extensions to WordPress. In other words, your WordPress site can upload various file extensions. 

== Installation ==

Please install this plugin and activate it.
If you use a language except English, please update the translation data in the updates of Dashboard.

If the multisite is enabled, please check the setting menu in the network administrator. 

= Usage =

 First of all, please check the "Media Type Settings" in the "Settings".
You can see the list of allowed mime types and file extensions by WordPress.

 When you add the mime type or file extension, the data will be added to last item in this list at the red color.

 About the mime type list, please see the list of mime types in the information of the Internet.
  Ex. http://www.freeformatter.com/mime-types-list.html

 The user who have the [manage_options](http://codex.wordpress.org/Roles_and_Capabilities#manage_options) permission can only add the setting.

 If you would like to translate it to your language, please visit the GlotPress from https://wordpress.org/plugins/wp-add-mime-types/ .

 If the multisite is enabled, the multisite network administrator can add/change/delete the mime type value in the multisite network setting menu. And the multisite network administrator or the site administrator can only see the past value (cannot change) before the site was migrated to the multisite.
 
== Frequently Asked Questions ==

* Can I comment out in the setting value?
Yes. You can comment out above version 2.3.0.

* (Above 4.7.1) In case of custom extension in this plugins' setting, the WordPress 4.7.1 file contents check system using finfo_info function is always true.

= Cannot work =
If the added mime type does not work, please deactivate other mime type plugins or the setting of other mime type plugins.

For example, if you install Media Library Assistant plugin, please turn off "Enable Upload MIME Type Support" in the Upload tag in this plugin setting.

= How do the plugin behave when it is installed and activated on the multisite network administration dashboard? =
The setting in the multisite network administration dashboard is taken precedence. The setting in each site administration dashboard is displayed, but the values aren't applied.

= How do the plugin behave when it is deactivated/uninstalled on the multisite network administration dashboard? =

The setting values in each site administration dashboard in case of activating the plugin in each site is applied. 

= Don't the setting values in the multisite network administration dashboard  and the setting values in each site administration dashboard influence each other? =

Yes, each setting values are saved as the other setting items.

== Screenshots ==
1. Setting Menu
2. Setting Menu in case of the multisite
3. Ignore to the right of '#' on a line


== Changelog ==

= 2.2.1 = 
* Tested up to WordPress 4.9.

= 2.2.0 = 
* Fixed foreach function warning if a setting value is empty.
* Added to escape HTML tags in a setting value using wp_strip_all_tags function.
* Added to ignore to the right of '#' on a line.

= 2.1.3 = 
* Tested up to WordPress 4.8 and PHP 7.1

= 2.1.2 = 
* Fixed the warning issue regarding explode function. 
* Tested up to WordPress 4.7.2

= 2.1.1 = 
* Fixed the issue that the safe files in WordPress, such as jpg, png, pdf cannot be uploaded. 

= 2.1.0 = 
* Tested up to WordPress 4.7.1
* Fixed finfo_file issue. See FAQ section.

= 2.0.6 = 
* Tested up to WordPress 4.7

= 2.0.5 = 
* Tested up to WordPress 4.6

= 2.0.4 = 
* Fixed the help message in the administration menu.

= 2.0.3 = 
* Fixed the help message in the administration menu.
* If the added mime type does not work, please turn off the mime type setting or deactivate other mime type plugins.

= 2.0.2 = 
* Fixed the compatibility with Media Library Assistant plugin.

= 2.0.1 = 
* Fixed the message in the setting menu

= 2.0.0 = 
* Supported Multisite.
* Tested up to WordPress 4.5.1

= 1.3.13 = 
* Tested up to WordPress 4.5.

= 1.3.12 = 
* Migrated the translation function to GlotPress. If you translate it to your language, please visit the GlotPress from https://wordpress.org/plugins/wp-add-mime-types/ .

= 1.3.11 = 
* Preparation of migrating the translation function to GlotPress.

= 1.3.10 = 
* Tested up to WordPress 4.4.2

= 1.3.9 = 
* Tested up to WordPress 4.4.1

= 1.3.8 = 
* Tested up to WordPress 4.4
* Fixed language translation setting.

= 1.3.7 = 
* Tested up to WordPress 4.3

= 1.3.6 = 
* Fixed load_plugin_textdomain setting.

= 1.3.5 = 
* Fixed load_plugin_textdomain setting.

= 1.3.4 = 
* Tested up to WordPress 4.2.2

= 1.3.3 = 
* Tested up to WordPress 4.1.1

= 1.3.2 = 
* Tested up to WordPress 4.0

= 1.3.1 =
* Tested up to WordPress 3.9.1

= 1.3.0 =
* Tested up to WordPress 3.9

= 1.2.1 =
* Fixed Language support

= 1.2.0 =
* Tested up to WordPress 3.8

= 1.1.0 =
* Tested up to WordPress 3.7.1

= 1.0.1 =
* Fixed the display error if the setting value is empty for the first time. 

= 1.0.0 =
* First Released.
* Language: English, Japanese


== Upgrade Notice ==

