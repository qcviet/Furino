<?php
/**
 * Archive Template
 *
 * @package furino
 * @author qcviet
 * @since 0.0.1
 */

get_header();
?>

<main id="main" class="site-main w-100 archive">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<?php
				/**
				 * generate_before_main_content hook.
				 *
				 * @since 0.1
				 */
				do_action('generate_before_main_content');

				if (have_posts()) :
					?>
					<!-- <header class="page-header">
						<?php
						the_archive_title('<h1 class="page-title">', '</h1>');
						the_archive_description('<div class="archive-description">', '</div>');
						?>
					</header> -->

					<?php
					while (have_posts()) :
						the_post();

						get_template_part('templates/blocks/post-card', null, [
							'class' => '',
							'title' => get_the_title(),
							'date' => get_the_modified_date(),
							'comment' => get_comments_number(),
							'eyes' => get_post_meta(get_the_ID(), 'post_views', true) ?: 0,
							'excerpt' => get_the_excerpt(),
							'thumbnail_id' => get_post_thumbnail_id(),
						]);

					endwhile;

					generate_content_nav('nav-below');

				else :

					get_template_part('templates/blocks/no-results', 'archive');

				endif;

				/**
				 * generate_after_main_content hook.
				 *
				 * @since 0.1
				 */
				do_action('generate_after_main_content');
				?>
			</div>
			<div class="col-lg-4">
				<?php get_template_part('templates/blocks/sidebar'); ?>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
