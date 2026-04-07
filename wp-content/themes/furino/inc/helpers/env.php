<?php

/**
 * Setup environments
 *
 * @package furino
 * @author qcviet
 * @since 0.0.1
 */

namespace Furino;

function furino_is_localhost()
{
	// Support both legacy and new header names.
	$env =
		($_SERVER['HTTP_X_FURINO_THEME_ENV'] ?? null) ??
		($_SERVER['HTTP_X_FURINO_THEME_ENV'] ?? null);

	return !empty($env) && $env === 'development';
}
