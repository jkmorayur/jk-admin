<!DOCTYPE html>
<html lang="en">
     <head>
          <meta charset="utf-8">
          <title><?php echo $template['title'] ?></title>
          <base href="<?php echo base_url('assets/'); ?>/"/>
          <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/images/favicon.png'); ?>" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <script>var site_url = "<?php echo site_url(); ?>";</script>
          <?php echo $template['metadata'] ?>
     </head>
     <body class="fixed-top">
          <?php echo ($this->router->fetch_method() != 'login') ? $template['partials']['header'] : ''; ?>
          <?php echo $template['partials']['flash_messages'] ?>
          <?php echo $template['body'] ?>
          <?php echo ($this->router->fetch_method() != 'login') ? $template['partials']['footer'] : ''; ?>
     </body>
</html>