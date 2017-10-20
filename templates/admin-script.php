<?php 
  $current_user = wp_get_current_user();
  if (user_can( $current_user, 'administrator' )) {
    global $colors;
?>
  <script type="text/javascript">
    document.querySelector(".js-add-color").addEventListener("click", function( event ) {
      var data = 'c1=' + <?php echo '"' . $colors[0] . '"' ?> + '&c2=' + <?php echo '"' . $colors[1] . '"' ?>;
      console.log(data);
      var request = new XMLHttpRequest();
      request.open('POST', "<?php echo get_template_directory_uri() . '/dist/colors.php'; ?>", true);
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
      request.send(data);
    }, false);
  </script>
<?php } ?>