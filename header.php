<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php wp_head(); ?>
</head>
<body>
<header id="header">
  <div class="uk-navbar-container">
    <div class="uk-container uk-container-large">
      <nav uk-navbar>
        <div class="uk-navbar-left">
          <a class="uk-navbar-item uk-logo" href="<?php echo get_home_url(); ?>">Logo</a>
        </div>
        <div class="uk-navbar-right">
          <?php wp_nav_menu([
            'menu' => 'main',
            'walker' => new Walker_UIKIT(),
            'container' => false,
            'menu_class' => '',
            'items_wrap' => '<ul id="%1$s" class="uk-navbar-nav %2$s">%3$s</ul>'
          ]); ?>
          <a id="mobile-menu-toggle-button" class="uk-navbar-toggle" uk-navbar-toggle-icon uk-toggle="target: #offcanvas-nav-primary"></a>
        </div>
      </nav>
    </div>
  </div>
</header>
<div id="main">
