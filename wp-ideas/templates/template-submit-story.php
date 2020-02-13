<?php

/**
 * Template Name: Submit Story
 *
 * @package Custom
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();
?>

<div class="g-row">
	<div class="">
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
	</div>

	<?php get_template_part('components/form-submit-story'); ?>
</div>

<?php get_footer(); ?>