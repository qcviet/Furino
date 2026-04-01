<?php

/**
 * Theme Init Class
 *
 * @package furino
 * @author qcviet
 * @since 0.0.1
 */

namespace Furino;

include_once get_theme_file_path('inc/helpers/env.php');
include_once get_theme_file_path('inc/helpers/cdn.php');
include_once get_theme_file_path('inc/helpers/queries.php');
include_once get_theme_file_path('inc/helpers/formatting.php');
include_once get_theme_file_path('inc/helpers/template-tags.php');
include_once get_theme_file_path('inc/helpers/debug.php');
$sidebar_functions_path = get_theme_file_path('inc/helpers/sidebar-functions.php');
if (is_readable($sidebar_functions_path)) {
	include_once $sidebar_functions_path;
}
// include_once get_theme_file_path('inc/class-sidebar.php');

class Theme_Init
{
	var $theme_version;
	var $theme_env;

	public function __construct()
	{
		$this->theme_version = WP_DEBUG ? time() : wp_get_theme()->Get('Version');
		$this->theme_env = ! furino_is_localhost() ? '.min' : '';

		add_filter('gform_disable_css', '__return_true');

		add_action('wp_head', [$this, 'preconnect_google_fonts'], 1);

		add_action('wp_enqueue_scripts', [$this, 'critical_frontend_assets'], 1);
		add_action('wp_enqueue_scripts', [$this, 'register_frontend_assets'], 60);

		$this->register_layout_hooks();

		add_action('after_setup_theme', [$this, 'theme_supports']);
	}

	function preconnect_google_fonts()
	{
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php
	}

	/**
	 * Register critical frontend assets
	 */
	function critical_frontend_assets()
	{
		$variables_css_context = file_get_contents(get_theme_file_path('variables.css'));

		if (!empty($variables_css_context)) {
			wp_register_style('-variables', false);
			wp_enqueue_style('furino-variables', false);
			wp_add_inline_style('furino-variables', furino_format_css_variables($variables_css_context));
		}
	}

	function register_frontend_assets()
	{
		if (!furino_is_localhost()) {
			wp_enqueue_style('furino-bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', [], $this->theme_version);
			wp_enqueue_style('furino-frontend', get_stylesheet_directory_uri() . '/assets/css/frontend.min.css', [], $this->theme_version);
		}

		wp_enqueue_script('furino-bootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap' . $this->theme_env . '.js', [], $this->theme_version);
		wp_enqueue_script('furino-frontend', get_stylesheet_directory_uri() . '/assets/js/frontend' . $this->theme_env . '.js', [], $this->theme_version);

		wp_enqueue_style('furino-fonts', get_stylesheet_directory_uri() . '/static-assets/fonts/font.css', [], $this->theme_version);
		wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', [], '5.15.4');

		wp_enqueue_style('furino-custom-theme', get_stylesheet_uri(), [], $this->theme_version);
	}

	function register_layout_hooks()
	{
		require_once get_theme_file_path('inc/layouts/container.php');
		require_once get_theme_file_path('inc/layouts/archive.php');
		require_once get_theme_file_path('inc/layouts/singular.php');
		require_once get_theme_file_path('inc/layouts/global.php');
	}

	function theme_supports()
	{
		load_theme_textdomain('furino', get_theme_file_path('languages'));
	}
}

new Theme_Init();
