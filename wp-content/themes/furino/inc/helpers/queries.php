<?php

/**
 * Queries Helper Functions
 *
 * @package furino
 * @author qcviet
 * @since 0.0.1
 */


/**
 * Wrapper function for WP_Query
 *
 * @param array $post_args
 * @return WP_Query
 */
function furino_get_posts_query($post_args)
{
	$default_post_args = [
		'post_type' => 'post',
		'post_status' => 'publish',
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false
	];

	$final_post_args = wp_parse_args($default_post_args, $post_args);

	return new WP_Query($final_post_args);
}
function furino_get_product_query($post_args)
{
	$default_post_args = [
		'post_type' => 'product',
		'post_status' => 'publish',
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false
	];

	$final_post_args = wp_parse_args($default_post_args, $post_args);

	return new WP_Query($final_post_args);
}

function furino_get_post_card_data($post_id)
{
	$post_object = get_post($post_id);

	if (empty($post_object)) return [];

	$categories = get_the_category($post_id);

	$output = [
		'title' => $post_object->post_title,
		'url'   => get_permalink($post_object),
		'date' => get_the_date('d/m/Y', $post_object),
		'thumbnail_id' => get_post_thumbnail_id($post_object)
	];

	if (!empty($categories)) {
		$output['category'] = [
			'name' => $categories[0]->name,
			'url' => get_category_link($categories[0]->term_id)
		];
	}

	return $output;
}

function furino_get_profile_card_data($post_id)
{
	$post_object = get_post($post_id);

	if (empty($post_object)) return [];

	$output = [
		'title' => $post_object->post_title,
		'description' => $post_object->post_content,
		'thumbnail_id' => get_post_thumbnail_id($post_object)
	];

	return $output;
}

function furino_get_global_sidebar_data()
{
	$sidebar_settings = get_field('sidebar_settings', 'option');

	return array(
		'title' => $sidebar_settings['title'] ?? '',
		'title_link' => $sidebar_settings['title_link'] ?? '',
		'image_id' => $sidebar_settings['image_id'] ?? '',
		'image_size' => 'medium_large',
		'items' => array_map(function ($post_id) {
			return array(
				'title' => get_the_title($post_id),
				'title_link' => get_permalink($post_id)
			);
		}, $sidebar_settings['items'] ?? []),
		'extra_section' => [
			'title' => $sidebar_settings['extra_section']['title'] ?? '',
			'title_link' => $sidebar_settings['extra_section']['title_link'] ?? '',
			'second_image_id' => $sidebar_settings['extra_section']['hight_light_image_id'] ?? ''
		]
	);
}
