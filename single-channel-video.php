<?php
  $video = new BGChannel_SingleVideoModule('')
?>
<?php get_header(); ?>

<div>
<?php if ( have_posts() ): while ( have_posts() ): the_post();

$video = new BGChannel_SingleVideoModule($post->ID);
?>

<article class="uk-article post-content">
  <div class="uk-container uk-container-large">
    <div uk-grid class="uk-grid-large uk-grid-divider">
      <div id="single-video" class="uk-width-2-3@s">
        <div class="uk-section">
          <?php $video->display(); ?>
          <h1 class="uk-heading-line uk-margin-small-top" id="single-video-title"><span><?php the_title(); ?></span></h1>
          <p class="uk-text-lead"><?php the_excerpt(); ?></p>
          <?php the_content(); ?>
        </div>
      </div>
      <div id="single-video-sidebar" class="uk-width-1-3@s">
        <div class="uk-section">
          <?php dynamic_sidebar('single-video-sidebar'); ?>
        </div>
      </div>
    </div>
  </div>
</article>

<?php endwhile; endif; ?>
</div>

<?php get_footer();
