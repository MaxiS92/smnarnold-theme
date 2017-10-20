<!-- Desktop nav -->
<header class="main-header">
  <div class="container">
      <a class="sr-only brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
      
      <nav class="nav-primary">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
        endif;
        ?>
      </nav>
      
      <?php
        $current_user = wp_get_current_user();
        if (user_can( $current_user, 'administrator' )) {
      ?>
        <a href="#" class="only-admin js-add-color">Save Colors</a>
      <?php } ?>
  </div>
</header>