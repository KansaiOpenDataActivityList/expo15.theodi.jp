<?php

add_action( 'wp_head', 'nskw_ogp_output' );
function nskw_ogp_output() {

	$installed = get_option( 'nskw_ogp_id_select' );
	if ( ! $installed ) {
		return;
	}

	// remove ogp tags by jetpack plugin
	add_filter( 'jetpack_enable_opengraph', '__return_false', 11 );

	$og_title = $og_type = $og_url = $og_img = $og_sitename = $og_locale = $og_description = '';
	
	// og:site_name
	$sitename = get_bloginfo( 'name' );
	$og_sitename = $sitename;
	
	// og:title
	if ( is_front_page() || is_home() ) {
		$og_title = $sitename;
	} elseif ( is_singular() ) {
		$og_title = get_the_title() . ' - ' . $sitename;
	} elseif ( is_search() ) {
		$og_title = wp_title( '-', false, 'right' );
	}
	else {
		$og_title = __( 'Archive of: ', 'nskw-ogp-generator' ) . wp_title( '-', false, 'right' );
	}

	// og:type
	if ( is_home() ) {
		$og_type = 'blog';
	} elseif ( is_front_page() ) {
		$og_type = 'website';		
	} else {
		$og_type = 'article';
	}
	
	// og:url
	if ( is_single() ) {
		$og_url = get_permalink();
	} elseif ( is_front_page() ) {
		$og_url = home_url();
	} elseif ( is_home() ) {
		if ( $blog_page = get_option( 'page_for_posts' ) ) {
			$og_url = get_permalink( $blog_page );
		} else {
			$og_url = home_url();
		}
	}
	
	// og:img
	$user_set_image = get_option( 'nskw_ogp_img' );
	if ( is_singular() && !is_front_page() && !is_home() ) {
		
		if ( has_post_thumbnail() ) {
			$ogimage_id  = get_post_thumbnail_id();
			$ogimage_url = wp_get_attachment_image_src( $ogimage_id,'full', true ); 
			$og_img = $ogimage_url[0]; 
		} else {
			$id = get_the_ID();
			$attachments = get_children( array( 
				'post_parent'    => $id , 
				'post_type'      => 'attachment' , 
				'post_mime_type' => 'image' , 
				'orderby'        => 'menu_order' , 
				) );
			foreach ( $attachments as $attachment ) {
				$image_src = wp_get_attachment_image_src( $attachment->ID, 'full', true );
				$og_img     = ( isset($image_src[0]) ? $image_src[0] : '' );
				break;
			}
			
			if ( '' == $og_img ) {
				global $post;
				if ( preg_match_all('/<img .*src=[\'"]([^\'"]+)[\'"]/', $post->post_content, $matches, PREG_SET_ORDER) ) {
					$og_img = $matches[0][1];
				}
				
			}
		}
	}
	if ( '' == $og_img ) {
		$og_img = $user_set_image;
	}
	
	// og:locale
	$og_locale = get_locale();
	if ( 'ja' == $og_locale ) {
		$og_locale = 'ja_JP';
	} elseif ( 'th' == $og_locale ) {
		$og_locale = 'th_TH';
	}
	
	// og:description
	if ( is_singular() && !is_front_page() && !is_home() ) {

		global $post;

		if ( $post->post_excerpt ) {
			$description = $post->post_excerpt;
		} else {
			$description = $post->post_content;
		}

		$description    = wp_strip_all_tags( $description );
		$description    = strip_shortcodes( $description );
		$og_description = wp_trim_words( $description, 100, '' );

	} else {

		$og_description = get_bloginfo( 'description' );

	}
	$og_description = apply_filters( 'nskw_og_description', $og_description );

	// about ids
	$property = get_option( 'nskw_ogp_id_select' );
	$content  = esc_attr(get_option( 'nskw_ogp_app_id' ));
	if ( '' != $content && in_array( $property, get_nskw_white_list() ) ) {
		?><meta property="<?php echo esc_attr($property); ?>" content="<?php echo $content; ?>" /><?php
		echo "\n";
	}
	
	// let's out put the meta tags.
	$ogp_tags = array(
		'og:title'       => $og_title,
		'og:type'        => $og_type,
		'og:url'         => $og_url,
		'og:image'       => $og_img,
		'og:site_name'   => $og_sitename,
		'og:locale'      => $og_locale,
		'og:description' => $og_description,
	);
	
	foreach ( $ogp_tags as $property => $content ) {
		if ( '' != $content ) {
			?>
<meta property="<?php echo $property; ?>" content="<?php echo esc_attr( $content ); ?>" />
<?php
		}
	}
	
}
