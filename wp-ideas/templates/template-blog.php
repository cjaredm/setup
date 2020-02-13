<?php

/**
 * Template Name: Blog
 *
 * @package Custom
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();
?>
<?php
if (have_posts()) :
	while (have_posts()) :
		the_post();
?>
		<div id="page-<?php the_ID(); ?>" <?php post_class('wysiwyg-content'); ?>>
			<?php the_content(); ?>
		</div>
<?php
	endwhile;
endif;
?>

<div id="blog" class="g-row content-sidebar" style="margin-top: 20px;">
	<div>
		<?php
		$custom_paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

		$args = [
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => '10',
			'orderby'        => 'date',
			'paged'          => $custom_paged,
		];

		$custom_query = new WP_Query($args);

		if ($custom_query->have_posts()) :
			while ($custom_query->have_posts()) :
				$custom_query->the_post();
				get_template_part('components/post-item');

			endwhile;

			custom_pagination($custom_query);

			wp_reset_postdata();
		endif;
		?>
	</div>

	<div class="wysiwyg-content blog__sidebar">
		<?php dynamic_sidebar('Sidebar'); ?>
	</div>
</div>

<?php get_footer(); ?>