<?php
get_header();
?>

<?php
if ( have_posts() ): while ( have_posts() ): the_post();
?>
<div class="uk-container uk-container-large">
  <div uk-grid class="uk-grid-large uk-grid-divider">
    <div class="uk-width-2-3@s">
      <div class="uk-section">
        <article class="uk-article">
          <h1 class="uk-article-title"><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </article>
      </div>
    </div>
    <div class="uk-width-1-3@s">
      <div class="uk-section">
        <?php dynamic_sidebar('single-video-sidebar'); ?>
      </div>
    </div>
  </div>
</div>
<?php
endwhile;
endif;
?>

<?php
get_footer();
?>
