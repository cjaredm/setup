<?php

/**
 * Slider
 *
 * @package Custom
 */

?>

<?php if (have_rows('slides')) : ?>
  <div class="slick-slider custom-slider">
    <?php
    while (have_rows('slides')) :
      the_row();

      // Get sub fields.
      $image              = get_sub_field('image');
      $heading            = get_sub_field('heading');
      $heading_color      = get_sub_field('heading_color');
      $sub_heading        = get_sub_field('sub_heading');
      $sub_heading_color  = get_sub_field('sub_heading_color');
      $button_link        = get_sub_field('link');
      $button_color       = get_sub_field('button_color');
      $slide_url          = isset($button_link['url']) ? $button_link['url'] : '';
      $slide_title        = isset($button_link['title']) && !empty($button_link['title']) ? $button_link['title'] : __('Learn More', 'custom');
      $slide_target       = isset($button_link['target']) && !empty($button_link['target']) ? $button_link['target'] : '_self';
    ?>
      <div class="slick-slider__slide" style="background-image: url(<?php echo esc_url($image['sizes']['slider-large']); ?>);">
        <?php if ($heading) : ?>
          <p class="slick-slider__heading h-color-<?= esc_html($heading_color) ?>"><?php echo esc_html($heading); ?></p>
        <?php endif; ?>

        <?php if ($sub_heading) : ?>
          <p class="slick-slider__sub-heading h-color-<?= esc_html($sub_heading_color) ?>"><?php echo wp_kses_post($sub_heading); ?></p>
        <?php endif; ?>

        <?php if ($button_link) : ?>
          <a href="<?php echo esc_url($slide_url); ?>" class="button button--full-width slick-slider__link button--<?= esc_html($button_color) ?>" target="<?php echo esc_attr($slide_target); ?>" <?php echo '_self' !== $slide_target ? 'rel="noopener"' : ''; ?>>
            <?php echo esc_html($slide_title); ?>
          </a>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </div>
<?php
  elseif(tribe_is_event_query()):
    $img = get_field( 'global_events_image', 'options' );
?>
  <div class="slick-slider custom-slider">
    <div class="slick-slider__slide" style="background-image: url(<?php echo esc_url($img['sizes']['slider-large']); ?>);">
      <p class="slick-slider__heading h-color-white">Events</p>
    </div>
  </div>
<?php endif; ?>
