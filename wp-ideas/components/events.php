<?php
/**
 * Events
 *
 * @package Custom
 */

$events_paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$events_args  = [
	'post_type'      => 'tribe_events',
	'post_status'    => 'publish',
	'posts_per_page' => '9',
	'orderby'        => 'date',
	'paged'          => $events_paged,
];
$events_query = new WP_Query( $events_args );

if ( $events_query->have_posts() ) :
	?>
	<div class="events">
		<div class="g-row g-row--large events__row">
			<h2 class="events__heading"><?php esc_html_e( 'Upcoming Events', 'custom' ); ?></h2>

			<ul class="events__events events-slider">
				<?php
				while ( $events_query->have_posts() ) :
					$events_query->the_post();
					?>
					<li id="post-<?php the_ID(); ?>" <?php post_class( 'events__event' ); ?>>
						<div class="events__container">
							<a href="<?php the_permalink() ?>" class="events__image">
								<?php get_template_part( 'components/post-thumbnail' ); ?>
							</a>

							<div class="events__content">
								<a href="<?php the_permalink() ?>">
									<h2 class="events__event-title">
										<?php the_title(); ?>
										<span class="events__event-date"><?php echo esc_html( tribe_get_start_date( $events_query->ID, 'F d' ) ); ?></span>
									</h2>
								</a>

								<?php
								if ( has_excerpt() ) {
									the_excerpt();
								}
								?>
							</div>
						</div>
					</li>
					<?php
				endwhile;

				custom_pagination( $events_query );

				wp_reset_postdata();
				?>
			</ul>
		</div>
	</div>
	<?php
endif;
?>
