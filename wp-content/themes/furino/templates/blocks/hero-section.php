<?php

/**
 * Block: Hero Section
 *
 * @package furino
 * @author qcviet
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'class' => '',
	'title' => '',
	'sub_title' => '',
	'description' => '',
	'image' => '',
	'button_text' => '',
	'button_url' => '',
]);
$_class = '';
$_class .= ' hero-section';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';

?>
<section class="<?php echo esc_attr($_class); ?> ">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1 class="hero-section__title text-center"><?php echo esc_html($data['title']); ?></h1>
				<p class="hero-section__sub-title text-center"><?php echo wp_kses_post($data['sub_title']); ?></p>
				<p class="hero-section__description text-center"><?php echo wp_kses_post($data['description']); ?></p>
				<?php
				get_template_part('templates/core-blocks/image', null, [
					'image_id' => $data['image'],
					'image_size' => 'full',
					'lazyload' => true,
					'image_class' => 'hero-section__image',
				]);
				?>
				<a href="<?php echo esc_url($data['button_url']); ?>" class="btn btn-primary hero-section__button js-scroll-to"><?php echo esc_html($data['button_text']); ?></a>
			</div>
		</div>
	</div>
</section>
