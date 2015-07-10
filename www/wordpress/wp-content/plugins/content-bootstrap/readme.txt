=== Content Bootstrap ===
Contributors: miyauchi
Tags: widget
Requires at least: 3.8
Tested up to: 4.2
Stable tag: 1.0.2

Apply twitter bootstrap css under the content area only.

== Description ==

Apply twitter bootstrap css under the content area only.

[This plugin is maintained on GitHub.](https://github.com/miya0001/content-bootstrap)

= Some features =

* Applies twitter bootstrap css to the content.
* Add style button to Visual Editor.
* Allows you to use bootstrap css with almost all themes.
* You can select bootstrap2 or bootstrap3.

= How to use Bootstrap3 =

`
define( 'content_bootstrap_enable_version_3', true );
`

or

`
add_filter( 'content_bootstrap_enable_version_3', '__return_true' );
`

= Translators =

* Japanese(ja) - [Takayuki Miyauchi](http://firegoby.jp/)

= Contributors =

* [Takayuki Miyauchi](http://firegoby.jp/)

== Installation ==

* A plugin installation screen is displayed on the WordPress admin panel.
* It installs it in `wp-content/plugins`.
* The plugin is made effective.

== Screenshots ==

1. Styles selector on the visual editor
2. Alerts
3. Well Box
4. Fluid grid system
5. Labels and Badges

== Changelog ==

= 1.0.2 =

* Tested at WordPress 4.2.

= 0.8.0 =

* Fix couldn't attach editor-style.css.

= 0.5.0 =
* wp-more and wp-nextpage class args renamed.

= 0.4.0 =
* Twitter Bootstrap updated to 2.3.2

= 0.3.0 =
* Icons added.
* responsive design supported

= 0.1.0 =
* The first release.
