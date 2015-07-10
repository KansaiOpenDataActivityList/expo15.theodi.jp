=== OGP Generator ===
Contributors: ShinichiN
Tags: Facebook,ogp,open graph tag
Requires at least: 4.0
Tested up to: 4.2.1
Stable tag: 0.5.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

When shared on Facebook, this plugin shows a nice Thumbnail of your posts, pages and site.

== Description ==

When shared on Facebook, this plugin shows a nice Thumbnail of your posts, pages and site.

### Example of Open Graph Protocol tags


	<meta property="fb:app_id"      content="you can specify in admin" />
	<meta property="og:title"       content="Post Title" />
	<meta property="og:type"        content="article" />
	<meta property="og:url"         content="Post URL" />
	<meta property="og:image"       content="Post thumbnail, attached image, the first image or default image which you upload" />
	<meta property="og:site_name"   content="Site Title" />
	<meta property="og:locale"      content="Your Locale" />
	<meta property="og:description" content="Post excerpt or text generated from your content" />


### Rules of the og:image

#### When a post permalink is shared (is_singular).

1. If your post has a post-thumbnail, that will show up.
2. If not, this plugin shows the images attatched to the post.
3. If not, this plugin shows the images which is in the content.
4. If not, this plugin shows the default image, which you upload in Settings > Reading > OGP Settings.
5. If not, this plugin doesn't show anything. (Other ogp tags such as og:title, og:url and so on will be served.)

#### When the link posted on facebook was not a post link (!is_singular).

When home page, archive pages, search result page or what ever else pages are shared on facebook, og:image will be the image you specify in Settings > Reading > OGP Settings.

== Installation ==

1. Upload `nskw-ogp-generator` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Settings > Reading > OGP Settings to set image and ID.


== Screenshots ==

1. You can set default image of the og:image, and put your app_id or fb:admins id.

== Changelog ==

= 0.1 =
* First release.

== Upgrade Notice ==

= 0.2 =
* Assets done.

= 0.5 =
* Filter added to the description.
