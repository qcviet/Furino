<?php

/**
 * CDN Support
 *
 * @package furino
 * @author qcviet
 * @since 0.0.1
 */

namespace Furino;

if (!defined('CDN_DOMAIN')) return;


/**
 * Retrieve the CDN domain
 *
 * @return string|null
 */
function qcviet_get_cdn_domain()
{
	return defined('CDN_DOMAIN') ? CDN_DOMAIN : null;
}

function qcviet_get_domain_from_url()
{
	$url = \get_site_url(null, '', null);

	$url_path = parse_url($url);
	return $url_path['host'];
}

function qcviet_cdn_attachments_urls($url, $post_id)
{
	$cdn_domain = qcviet_get_cdn_domain();

	if (empty($cdn_domain)) return $url;

	return str_replace(qcviet_get_domain_from_url() . '/wp-content/uploads', $cdn_domain . '/wp-content/uploads', $url);
}

function qcviet_cdn_attachment_srcset_filter($attr)
{
	$cdn_domain = qcviet_get_cdn_domain();
	$site_domain = qcviet_get_domain_from_url();

	if (empty($cdn_domain)) return $attr;

	if (!empty($attr['srcset'])) {
		$attr_srcset = $attr['srcset'];
		$attr['srcset'] = str_replace($site_domain . '/wp-content/uploads', $cdn_domain . '/wp-content/uploads', $attr_srcset);
	}

	return $attr;
}

function qcviet_calculate_image_srcset($sources)
{
	$cdn_domain = qcviet_get_cdn_domain();
	$site_domain = qcviet_get_domain_from_url();

	if (empty($cdn_domain)) return $sources;

	foreach ($sources as &$source) {
		$source['url'] = str_replace($site_domain . '/wp-content/uploads', $cdn_domain . '/wp-content/uploads', $source['url']);
	}

	return $sources;
}

function qcviet_acf_format_cdn_url_value($value, $post_id, $field)
{
	$cdn_domain = qcviet_get_cdn_domain();
	$site_domain = qcviet_get_domain_from_url();

	if (empty($cdn_domain)) return $value;

	if (is_array($value)) {
		$value['url'] = str_replace($site_domain . '/wp-content/uploads', $cdn_domain . '/wp-content/uploads', $value['url']);
		if (isset($value['sizes']) && !empty($value['sizes'])) {
			foreach ($value['sizes'] as $key => $size) {
				$value['sizes'][$key] = str_replace($site_domain . '/wp-content/uploads', $cdn_domain . '/wp-content/uploads', $size);
			}
		}
	} else {
		$value = str_replace($site_domain . '/wp-content/uploads', $cdn_domain . '/wp-content/uploads', $value);
	}

	return $value;
}

if (\function_exists('get_field')) {
	\add_filter('acf/format_value/type=image', __NAMESPACE__ . '\\qcviet_acf_format_cdn_url_value', 10, 3);
	\add_filter('acf/format_value/type=file', __NAMESPACE__ . '\\qcviet_acf_format_cdn_url_value', 10, 3);
}

\add_filter('wp_get_attachment_url', __NAMESPACE__ . '\\qcviet_cdn_attachments_urls', 10, 2);
\add_filter('wp_calculate_image_srcset', __NAMESPACE__ . '\\qcviet_calculate_image_srcset');
\add_filter('wp_get_attachment_image_srcset', __NAMESPACE__ . '\\qcviet_cdn_attachment_srcset_filter');
