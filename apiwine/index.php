<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>API Rest Wine</title>
    </head>
    <?php wp_head(); ?>
    <body>
        <?php 
  $args = [
      'post_type' => 'wines'
  ];
  $loop = new WP_Query($args);
  if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
  the_content();
 
endwhile;
  wp_reset_postdata();
endif;
  ?>
        <?php wp_footer(); ?>
    </body>
</html>