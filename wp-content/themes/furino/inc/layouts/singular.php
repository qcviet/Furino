<?php
/**
 * GeneratePres Archive Layout Hooks
 *
 * @package furino
 * @author qcviet
 * @since 0.0.1
 */

namespace Furino;

class Singular_Layout
{
	public function __construct()
	{
		add_action('wp', function () {
			if (is_single()) {
				$this->remove_default_hooks();

				// add_action('generate_before_footer', [$this, 'render_related_posts_section']);
			}
			if (is_singular('post')) {
				add_filter('comments_open', '__return_false');
				add_filter('generate_show_right_sidebar', '__return_false');
				add_filter('generate_has_default_loop', '__return_false');
				add_action('generate_after_main_content', [$this, 'render_content_post'], 10);
				add_filter('generate_sidebar_layout', function () {
					return 'no-sidebar';
				});
			}

		}, 100);
	}

	function render_content_post()
	{
		// get_template_part('templates/blocks/single-content');
		get_template_part('templates/blocks/single-content', null, [
			'class' => '',
			'title' => get_the_title(),
			'date' => get_the_modified_date(),
			'comment' => get_comments_number(),
			'eyes' => get_post_meta(get_the_ID(), 'post_views', true) ?: 0,
			'social_links' => get_field('social_links') ?: [],
			'content' => get_the_content(),
		]);
	}
	function remove_default_hooks()
	{
		// Remove featured image
		remove_action('generate_before_content', 'generate_featured_page_header_inside_single', 10);

		add_filter('generate_show_title', '__return_false');
		remove_action('generate_after_entry_title', 'generate_post_meta', 10);
		remove_action('generate_after_entry_content', 'generate_footer_meta', 10);
	}

}

new Singular_Layout();
