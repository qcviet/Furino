<?php
/**
 * Flexible Content
 *
 * @package furino
 * @author qcviet
 * @since 0.0.1
 */
if (have_rows('sections')) {
	while (have_rows('sections')):
		the_row();
		$layout = get_row_layout();

		switch ($layout):
           case 'hero_section':
			$data = furino_get_flexible_content_data([
				'title' => 'title',
				'sub_title' => 'sub_title',
				'description' => 'description',
				'image' => 'image',
				'button_text' => 'button_text',
				'button_url' => 'button_url',
			]);
            get_template_part('templates/blocks/hero-section', null, $data);
            break;
		endswitch;
	endwhile;
}
