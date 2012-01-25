<?php
/*
Plugin Name: Open Graph Meta
Plugin URI: http://www.icprojects.net/open-graph-meta.html
Description: The plugin add Open Graph meta data to blog posts and pages.
Version: 1.28
Author: Ivan Churakov
Author URI: http://www.freelancer.com/affiliates/ichurakov/
*/
class ogmeta_class {
	function __construct() {
		if (is_admin()) {
		} else {
			add_action("wp_head", array(&$this, "front_header"));
		}
	}
	
	function front_header() {
		global $post;
		if (is_singular()) {
			the_post();
			echo '
	<meta property="og:title" content="'.esc_attr(trim(wp_title('',false))).'" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="'.get_permalink().'" />
	'.(has_post_thumbnail() ? '<meta property="og:image" content="'.wp_get_attachment_url(get_post_thumbnail_id($post->ID)).'" />' : '').'
	<meta property="og:site_name" content="'.esc_attr(get_bloginfo('name')).'" />
	<meta property="og:description" content="'.esc_attr(strip_tags(get_the_excerpt())).'" />';
			rewind_posts();
		}
	}
}
$ogmeta = new ogmeta_class();
?>