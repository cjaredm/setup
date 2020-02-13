<?php
/**
 * Stories
 * @todo This is copied from MO, after revising, remove this todo.
 * @package Custom
 */

$global_post_image   = get_field( 'global_post_image', 'options' );
$stories_heading     = get_field( 'stories_heading' );
$stories_sub_heading = get_field( 'stories_sub_heading' );
$stories_cite        = get_field( 'stories_cite' );
$stories_stories     = get_field( 'stories_stories' );
?>

<div class="c-stories">
	<div class="g-row h-text-center">
		<h2 class="c-stories__heading"><?php echo esc_html( $stories_heading ); ?></h2>
		<p class="c-stories__description"><?php echo esc_html( $stories_sub_heading ); ?></p>
		<p class="c-stories__cite"><?php echo esc_html( $stories_cite ); ?></p>
	</div>

	<div class="g-row g-row--large c-stories__row h-text-center">
		<?php if ( $stories_stories ) : ?>
			<ul class="c-stories__stories stories-slider">
				<?php
				foreach ( $stories_stories as $post ) : // @codingStandardsIgnoreLine
					setup_postdata( $post );
					// If we have a featured image use it, otherwise fallback to global.
					$image_id = get_post_thumbnail_id() ? get_post_thumbnail_id() : $global_post_image;
					?>
					<li class="c-stories__story">
						<a href="<?php the_permalink(); ?>" class="c-stories__link">
							<?php custom_display_image_acf( $image_id, 'stories-large', [ 'c-stories__image' ] ); ?>

							<div class="c-stories__content h-cover-absolute">
								<h2 class="c-stories__content-heading"><?php the_title(); ?></h2>
								<p class="c-stories__content-text"><?php esc_html_e( 'Read Story', 'custom' ); ?> <span class="fas fa-angle-right"></span></p>
							</div>
						</a>
					</li>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			</ul>
		<?php endif; ?>
	</div>

	<div class="g-row h-text-center">
		<ul class="c-stories__actions">
			<li class="c-stories__action">
				<a href="<?php echo esc_url( home_url( 'stories' ) ); ?>" class="button button--full-width"><?php esc_html_e( 'View All Stories', 'custom' ); ?></a>
			</li>

			<li class="c-stories__action">
				<a href="<?php echo esc_url( home_url( 'stories/submit-a-story' ) ); ?>" class="button button--full-width"><?php esc_html_e( 'Share a Story', 'custom' ); ?></a>
			</li>
		</ul>
	</div>
</div>
