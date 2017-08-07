</div> <! /#main -->
<footer id="footer">

</footer>
<div id="offcanvas-nav-primary" uk-offcanvas="overlay: true">
  <div class="uk-offcanvas-bar uk-flex uk-flex-column">
    <?php wp_nav_menu([
      'menu' => 'main',
      'walker' => new Walker_UIKIT_Mobile(),
      'container' => false,
      'menu_class' => '',
      'items_wrap' => '<ul id="%1$s" class="uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical %2$s">%3$s</ul>'
    ]); ?>
  </div>
</div>
<?php wp_footer(); ?>
</body>
</html>
