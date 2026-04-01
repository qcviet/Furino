<?php

/**
 * Template Tags
 *
 * @package furino
 * @author qcviet
 * @since 0.0.1
 */

function furino_get_svg_icon($name)
{
	$value = '';

	switch ($name):
		case 'chevron-left':
			$value = '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>';
			break;

		case 'chevron-right':
			$value = '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>';
			break;
	endswitch;
	return $value;
}

/**
 * @param WP_Post $post
 * @param string  $type
 * @return string
 */
function furino_get_flexible_content_data($array)
{
	$items = [];

	foreach ($array as $key => $field_key) {
		$items[$key] = get_sub_field($field_key);
	}

	return $items;
}

/**
 * Get term meta
 *
 * @param WP_Term $term_object
 * @return array
 */
function furino_get_term_meta($term_object)
{
	return [
		'url' => get_term_link($term_object),
		'name' => $term_object->name
	];
}

if (!function_exists('get_furino_sidebar')) {
	function get_furino_sidebar()
	{
		get_template_part('templates/blocks/sidebar');
	}
}
