<?php
/**
 * Component Register
 *
 * @package Custom
 */

	$page_register = get_field( 'page_register' );
	while (have_rows('mission_statement')) :
		the_row();

		// Get sub fields.
		$title   		 = get_sub_field('title');
		$description = get_sub_field('description');
?>

	<div class="c-register <?php echo $page_register ? 'c-register--page-footer' : ''; ?>">
		<div class="g-row h-text-center">
			<h2 class="c-register__heading"><?php esc_html_e( $title, 'custom' ); ?></h2>
			<p class="c-register__text <?php echo $page_register ? 'c-register__text--page-footer' : ''; ?>">
				<?php esc_html_e( $description, 'custom' ); ?>
			</p>

			<ul class="c-register__options">
				<li class="c-register__item">
					<a href="https://health.mo.gov/living/organdonor/pdf/enrollment_application.pdf" class="c-register__link button button--secondary" target="_blank" rel="noopener">
						<h3 class="c-register__title"><?php esc_html_e( 'REGISTER', 'custom' ); ?> <i class="fas fa-arrow-alt-circle-right"></i></h3>
						<p class="c-register__description"><?php esc_html_e( 'to become a donor', 'custom' ); ?></p>
					</a>
				</li>

				<li class="c-register__item">
					<a href="https://dor.mo.gov/offloc/" class="c-register__link button" target="_blank" rel="noopener">
						<h3 class="c-register__title"><?php esc_html_e( 'EDIT', 'custom' ); ?> <i class="fas fa-arrow-alt-circle-right"></i></h3>
						<p class="c-register__description"><?php esc_html_e( 'my donor profile', 'custom' ); ?></p>
					</a>
				</li>

				<li class="c-register__item">
					<a href="https://health.mo.gov/living/organdonor/publications.php#forms" class="c-register__link button button--tertiary" target="_blank" rel="noopener">
						<h3 class="c-register__title"><?php esc_html_e( 'GIVE', 'custom' ); ?> <i class="fas fa-arrow-alt-circle-right"></i></h3>
						<p class="c-register__description"><?php esc_html_e( 'financially', 'custom' ); ?></p>
					</a>
				</li>
			</ul>
		</div>
	</div>
<?php endwhile; ?>
