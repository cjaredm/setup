<?php

/**
 * Component Post-Item
 *
 * @package Custom
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post__item'); ?>>
  <aside class="post__img-wrapper">
    <a href="<?php the_permalink(); ?>" class="post__img" title="<?php the_title_attribute(); ?>">
      <?php get_template_part('components/post-thumbnail'); ?>
    </a>
  </aside>
  <header class="post__details">
    <?php get_template_part('components/post-title'); ?>

    <?php get_template_part('components/post-date'); ?>

    <?php get_template_part('components/post-categories'); ?>
  </header>
  <?php get_template_part('components/post-excerpt'); ?>
  <footer>
    <?php get_template_part('components/post-tags'); ?>
  </footer>
</article>