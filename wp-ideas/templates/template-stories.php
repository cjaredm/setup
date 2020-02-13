<?php

/**
 * Template Name: Stories
 *
 * @package Custom
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();
?>

<div class="g-row c-stories__managed-content">
	<?php
	if (have_posts()) :
		while (have_posts()) :
			the_post();
	?>
			<article id="page-<?php the_ID(); ?>" <?php post_class('wysiwyg-content'); ?>>
				<?php the_content(); ?>
			</article>
	<?php
		endwhile;
	endif;
	?>
</div>

<?php
$global_post_image = get_field('global_post_image', 'options');

$stories_paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
$stories_args  = [
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => '-1',
	'orderby'        => 'date',
	'paged'          => $stories_paged,
	'category_name'  => 'story',
];
$stories_query = new WP_Query($stories_args);
?>

<div class="c-stories">
	<div class="g-row g-row--large c-stories__row h-text-center">
		<?php
		if ($stories_query->have_posts()) :
		?>
			<ul class="c-stories__stories">
				<?php
				while ($stories_query->have_posts()) :
					$stories_query->the_post();

					$card_link_pdf = get_field('card_link_pdf');

					$permalink = $card_link_pdf ? $card_link_pdf['url'] : get_the_permalink();
				?>
					<li class="c-stories__story">
						<a href="<?php echo esc_url($permalink); ?>" class="c-stories__link">
							<?php if (has_post_thumbnail()) : ?>
								<?php the_post_thumbnail('stories-large', ['class' => 'c-stories__image']); ?>
							<?php else : ?>
								<?php custom_display_image_acf($global_post_image, 'stories-large', ['c-stories__image']); ?>
							<?php endif; ?>

							<div class="c-stories__content h-cover-absolute">
								<h2 class="c-stories__content-heading"><?php the_title(); ?></h2>
								<p class="c-stories__content-text"><?php esc_html_e('Read Story', 'custom'); ?> <span class="fas fa-angle-right"></span></p>
							</div>
						</a>
					</li>
				<?php
				endwhile;

				custom_pagination($stories_query);

				wp_reset_postdata();
				?>
			</ul>
		<?php
		endif;
		?>
	</div>
</div>

<?php get_footer(); ?>