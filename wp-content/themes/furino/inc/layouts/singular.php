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
		add_filter('the_content', [$this, 'render_flexible_content'], 20);
	}

	public function render_flexible_content($content)
	{
		if (!is_singular() || !in_the_loop() || !is_main_query()) {
			return $content;
		}

		if (!function_exists('have_rows') || !have_rows('sections')) {
			return $content;
		}

		ob_start();
		get_template_part('templates/content/flexible');
		$flexible_content = trim((string) ob_get_clean());

		if (empty($flexible_content)) {
			return $content;
		}

		return $flexible_content;
	}
}

new Singular_Layout();
