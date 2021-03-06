<?php
/**
 * Template Parts
 * Theme functions for templates.
 *
 * @package Custom
 */

/**
 * Hero Content
 *
 * @author Rich Edmunds
 * @param  string $title Main heading title.
 */
function custom_display_hero_content( $title = '' ) {
	// Bail early if not a string.
	if ( ! is_string( $title ) ) {
		return;
	}

	$hero_spacing = get_field( 'hero_spacing' );

	// Set the featured image or hero fallback image.
	$page_hero_image  = has_post_thumbnail() ? get_post_thumbnail_id() : get_field( 'global_hero_image', 'options' );
	$page_description = get_field( 'page_description' );

	// Is title set in the function, use it, else fallback to the post title.
	$title = $title ? $title : get_the_title();
	?>
	<div class="g-page-header <?php echo $hero_spacing ? 'g-page-header--no-margin' : ''; ?>">
		<div <?php custom_the_image_background_acf( $page_hero_image, 'hero-small', [ 'g-page-header__background' ] ); ?>>
			<div class="g-page-header__content">
				<h1><?php echo esc_html( $title ); ?></h1>
				<?php
				if ( $page_description ) {
					echo wp_kses_post( $page_description );
				}
				?>
			</div>
		</div>

		<div class="g-row">
			<?php get_template_part( 'components/breadcrumbs' ); ?>
		</div>
	</div>
	<?php
}

/**
 * Display Social Media
 *
 * @author Rich Edmunds
 * @param string $modifier Class name BEM modifier.
 */
function custom_display_social_icons( $modifier = '' ) {
	$global_facebook  = get_field( 'global_facebook', 'options' );
	$global_twitter   = get_field( 'global_twitter', 'options' );
	$global_youtube   = get_field( 'global_youtube', 'options' );
	$global_instagram = get_field( 'global_instagram', 'options' );
	$global_pinterest = get_field( 'global_pinterest', 'options' );
	$modifier         = $modifier ? "c-social-media--{$modifier}" : '';
	$social_media     = [
		[
			'link' => $global_facebook,
			'icon' => 'facebook',
			'name' => 'Facebook',
		],
		[
			'link' => $global_twitter,
			'icon' => 'twitter',
			'name' => 'Twitter',
		],
		[
			'link' => $global_youtube,
			'icon' => 'youtube',
			'name' => 'YouTube',
		],
		[
			'link' => $global_instagram,
			'icon' => 'instagram',
			'name' => 'Instagram',
		],
		[
			'link' => $global_pinterest,
			'icon' => 'pinterest',
			'name' => 'Pinterest',
		],
	];
	?>
	<ul class="c-social-media <?php echo esc_attr( $modifier ); ?>">
		<?php foreach ( $social_media as $media ) : ?>
			<?php if ( $media['link'] ) : ?>
				<li class="c-social-media__item">
					<a
						href="<?php echo esc_url( $media['link'] ); ?>"
						class="c-social-media__link"
						data-color="<?php echo esc_attr( $media['icon'] ); ?>"
						rel="noopener"
						target="_blank"
					>
						<span class="fab fa-<?php echo esc_attr( $media['icon'] ); ?>"></span>
						<span class="h-visual-hide"><?php echo esc_html( $media['name'] ); ?></span>
					</a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
	<?php
}
