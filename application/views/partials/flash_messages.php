<div style="" class="cart_notificationbg success hide">
     <a class="notifi_close" onclick="$(this).parent().hide();" href="javascript:void(0);">
          <i class="icon-remove-circle"></i>
     </a>
     <span id="msg">
          <i class="icon-thumbs-up"></i>
          <span class="sus_msg"></span>
     </span>
</div>

<?php if ($alert = $this->session->flashdata('app_alert')): ?>
       <div style="" class="cart_notificationbg msgBox">
            <a class="notifi_close" onclick="$(this).parent().hide();" href="javascript:void(0);">
                 <i class="icon-remove-circle"></i>
            </a>
            <span id="msg">
                 <i class="icon-warning-sign"></i>
                 <?php echo $alert ?>
            </span>
       </div>
  <?php endif ?>

<?php if ($error = $this->session->flashdata('app_error')): ?>
       <div style="" class="cart_notificationbg msgBox">
            <a class="notifi_close" onclick="$(this).parent().hide();" href="javascript:void(0);">
                 <i class="icon-remove-circle"></i>
            </a>
            <span id="msg">
                 <i class="icon-thumbs-down"></i>
                 <?php echo $error ?>
            </span>
       </div>
  <?php endif ?>

<?php if ($success = $this->session->flashdata('app_success')): ?>
       <div style="" class="cart_notificationbg msgBox">
            <a class="notifi_close" onclick="$(this).parent().hide();" href="javascript:void(0);">
                 <i class="icon-remove-circle"></i>
            </a>
            <span id="msg">
                 <i class="icon-thumbs-up"></i>
                 <?php echo $success ?>
            </span>
       </div>
  <?php endif ?>

<?php if ($info = $this->session->flashdata('app_info')): ?>
       <div style="" class="cart_notificationbg msgBox">
            <a class="notifi_close" onclick="$(this).parent().hide();" href="javascript:void(0);">
                 <i class="icon-remove-circle"></i>
            </a>
            <span id="msg">
                 <i class="icon-bullhorn"></i>
                 <?php echo $info ?>
            </span>
       </div>
       <?php
   endif ?>