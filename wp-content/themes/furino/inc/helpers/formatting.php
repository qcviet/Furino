<?php

/**
 * Formatter
 *
 * @package furino
 * @author qcviet
 * @since 0.0.1
 */

function furino_format_css_variables($css)
{
	// Remove unused css
	$css = preg_replace('/@custom-media --(.*)\;/i', '', $css);

	// Remove empty whitespace
	$css = preg_replace('/\s+/', '', $css);

	return $css;
}
