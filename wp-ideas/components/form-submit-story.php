<?php
/**
 * Form Submit Story
 *
 * @package Custom
 */

if ( isset( $_POST['submit'] ) && ! wp_verify_nonce( 'custom_form_submit_story', 'custom_form_submit_story_action' ) ) :
	// If trap value is set redirect to home page.
	if ( '' !== sanitize_text_field( wp_unslash( $_POST['main_address'] ) ) ) {
		echo '<html><head><meta http-equiv="refresh" content="0; url=/"></head><body></body></html>';
		exit;
	}

	// Define emails, website, and domain.
	$form_email    = get_field( 'global_form_email', 'options' );
	$email_address = $form_email ? $form_email : get_bloginfo( 'admin_email' );

	define( 'EMAIL', $email_address );
	define( 'WEBSITE', get_bloginfo( 'name' ) );
	define( 'DOMAIN', str_replace( 'www.', '', $_SERVER['HTTP_HOST'] ) );

	// Fields.
	$full_name   = wp_unslash( $_POST['full_name'] );
	$description = $_POST['description'];
	$email       = $_POST['email'];
	$image       = $_FILES['story_image'];
	$captcha     = custom_get_recaptcha( $_POST['g-recaptcha-response'] );

	// Required for media_handle_upload().
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';

	$image_attachment_id = media_handle_upload( 'story_image', 0 );

	// Set required fields.
	$required_fields = [
		'full_name',
		'description',
		'email',
	];

	// Check if required fields are blank.
	$field_errors = false;

	foreach ( $required_fields as $field ) {
		if ( '' === $_POST[ $field ] ) {
			$field_errors = true;
		}
	}

	// Sanitize Information.
	if ( '' !== $full_name ) {
		$full_name = filter_var( $full_name, FILTER_SANITIZE_STRING );
	}

	if ( '' !== $description ) {
		$description = filter_var( $description, FILTER_SANITIZE_STRING );
	}

	$to       = EMAIL;
	$subject  = WEBSITE . ' Contact Form' . "\r\n";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$headers .= 'From: contact@' . DOMAIN . "\r\nReply-To: noreply@" . DOMAIN . "\r\n";
	$message  = '<html><body>';
	$message .= '<p>A new story has been submitted for the following person: ' . wp_strip_all_tags( $full_name ) . '</p>';
	$message .= '<p>Submitter email: ' . wp_strip_all_tags( $email ) . '</p>';
	$message .= '<p>Review the new post in the WordPress admin.</p>';
	$message .= '</body></html>';

	// PHP Rule: Message lines should not exceed 70 characters, so wrap it.
	$message = wordwrap( $message, 70 );

	// If no errors - send. Else - alert.
	if ( ! $field_errors && $captcha->success ) :
		wp_mail( $to, $subject, $message, $headers );

		// Create story post draft.
		$category_story_id = get_cat_ID( 'story' );
		$story_post        = [
			'post_title'    => wp_strip_all_tags( $full_name ),
			'post_content'  => $description,
			'post_category' => [ $category_story_id ],
			'post_status'   => 'draft',
			'post_type'     => 'post',
		];

		$draft_post = wp_insert_post( $story_post );

		// Add custom fields.
		add_post_meta( $draft_post, 'story_name', $full_name );
		add_post_meta( $draft_post, 'story_email', $email );

		// If image upload succeeded, attached image to post.
		if ( ! is_wp_error( $image_attachment_id ) ) {
			set_post_thumbnail( $draft_post, $image_attachment_id );
		}
		?>
		<p class="c-notification-box c-notification-box--success">
			<?php esc_html_e( 'Thank you for submitting a story. We will review before posting it.', 'custom' ); ?>
		</p>
		<?php
	else :
		?>
		<p class="c-notification-box c-notification-box--error"><?php esc_html_e( 'Please fill out all the required fields.', 'custom' ); ?></p>
		<?php
	endif;
else :
	?>
	<form method="POST" class="form form--contact" enctype="multipart/form-data">
		<?php wp_nonce_field( 'custom_form_submit_story_action', 'custom_form_submit_story' ); ?>
		<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">

		<div class="form__section form__group">
			<label for="form-full-name"><?php esc_html_e( 'Full Name *', 'custom' ); ?></label>
			<input type="text" name="full_name" id="form-full-name" class="form__input" placeholder="<?php esc_attr_e( 'Full Name', 'custom' ); ?>" required>
		</div>

		<div class="form__section form__group">
			<label for="form-description"><?php esc_html_e( 'Description *', 'custom' ); ?></label>
			<textarea name="description" id="form-description" class="form__input" placeholder="<?php esc_attr_e( 'The Story...', 'custom' ); ?>" required></textarea>
		</div>

		<div class="form__section form__group">
			<label for="form-email"><?php esc_html_e( 'Email *', 'custom' ); ?></label>
			<input type="email" name="email" id="form-email" class="form__input" placeholder="<?php esc_attr_e( 'Your Email', 'custom' ); ?>" required>
		</div>

		<div class="form__section form__group">
			<label for="form-image"><?php esc_html_e( 'Image', 'custom' ); ?></label>
			<input type="file" name="story_image" id="form-image" class="form__input" accept="image/*">
		</div>

		<div class="form__section form__group">
			<input type="text" name="main_address" value="" class="h-hidden">
			<input type="submit" name="submit" value="Submit" class="button">
		</div>
	</form>
	<?php
endif;
