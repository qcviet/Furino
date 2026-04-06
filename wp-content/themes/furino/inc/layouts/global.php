<?php
/**
 * Global Layout (Header + Footer)
 *
 * @package Furino
 * @author qcviet
 * @since 0.0.1
 */

namespace Furino;

class Global_Layout
{
	public function __construct()
	{
		add_action('wp', [$this, 'register_hooks'], 50);
	}

	public function register_hooks()
	{
		remove_action('generate_inside_mobile_menu_control_wrapper', 'generate_do_menu_bar_item_container');
		remove_action('generate_before_navigation', 'generate_do_header_mobile_menu_toggle');
		remove_action('generate_after_header_content', 'generate_do_header_widget');

		add_action('generate_after_navigation', 'generate_do_header_widget', 19);

		if (method_exists($this, 'display_mobile_header_logo')) {
			add_action('generate_before_navigation', [$this, 'display_mobile_header_logo']);
		}
		if (method_exists($this, 'mobile_header_logo_class')) {
			add_filter('generate_header_class', [$this, 'mobile_header_logo_class']);
		}
		if (method_exists($this, 'display_slideout_menu_open_button')) {
			add_action('generate_after_navigation', [$this, 'display_slideout_menu_open_button']);
		}

		$slideout_menu_template = locate_template('templates/blocks/slideout-menu.php', false, false);
		if (!empty($slideout_menu_template)) {
			add_action('wp_footer', [$this, 'render_slideout_menu']);
		}

		$header_template = locate_template('templates/blocks/header.php', false, false);
		if (!empty($header_template)) {
			remove_action('generate_header', 'generate_construct_header');
			add_action('generate_header', [$this, 'render_header'], 10);
		}

		$footer_template = locate_template('templates/blocks/footer.php', false, false);
		if (!empty($footer_template)) {
			remove_action('generate_footer', 'generate_construct_footer_widgets', 5);
			remove_action('generate_footer', 'generate_construct_footer', 10);
			add_action('generate_footer', [$this, 'render_footer'], 10);
		}
	}

	public function render_header()
	{
		get_template_part('templates/blocks/header');
	}


	public function render_header_wpml_flags()
	{

	}

	public function render_slideout_menu()
	{
		get_template_part('templates/blocks/slideout-menu');
	}

	public function render_footer()
	{
		get_template_part('templates/blocks/footer');
	}
}

new Global_Layout();
