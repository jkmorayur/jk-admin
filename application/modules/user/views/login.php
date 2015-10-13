<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
     <!-- BEGIN HEAD -->

     <!-- Mirrored from thevectorlab.net/metrolab/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Sep 2015 07:27:27 GMT -->
     <head>
          <meta charset="utf-8" />
          <title>Login</title>
          <meta content="width=device-width, initial-scale=1.0" name="viewport" />
          <meta content="" name="description" />
          <meta content="" name="author" />
          <link href="styles/bootstrap.min.css" rel="stylesheet" />
          <link href="styles/bootstrap-responsive.min.css" rel="stylesheet" />
          <link href="styles/font-awesome.css" rel="stylesheet" />
          <link href="styles/style.css" rel="stylesheet" />
          <link href="styles/style-responsive.css" rel="stylesheet" />
          <link href="styles/style-default.css" rel="stylesheet" id="style_color" />
     </head>
     <!-- END HEAD -->
     <!-- BEGIN BODY -->
     <body class="lock">
          <div class="lock-header">
               <!-- BEGIN LOGO -->
               <a class="center" id="logo" href="index-2.html">
                    <img class="center" alt="logo" src="images/logo.png">
               </a>
               <!-- END LOGO -->
          </div>
          <?php echo form_open('user/login', array('class' => 'form-signin')) ?>
          <div class="login-wrap">
               <div class="metro single-size red">
                    <div class="locked">
                         <i class="icon-lock"></i>
                         <span>Login</span>
                    </div>
               </div>
               <div class="metro double-size green">

                    <div class="input-append lock-input">
<!--                         <input type="text" class="" placeholder="Username">-->
                         <?php echo form_input($identity) ?>
                    </div>
               </div>
               <div class="metro double-size yellow">
                    <div class="input-append lock-input">
<!--                         <input type="password" class="" placeholder="Password">-->
                         <?php echo form_input($password) ?>
                    </div>
               </div>
               <div class="metro single-size terques login">
                    <button type="submit" class="btn login-btn">
                         Login
                         <i class=" icon-long-arrow-right"></i>
                    </button>
               </div>
               <div class="login-footer">
                    <div class="remember-hint pull-left">
                         <input type="checkbox" id=""> Remember Me
                    </div>
               </div>
          </div>
          <?php echo form_close() ?>
     </body>
</html>