<?php

include('./function.php');

$error = false;
$success = false;
$user_not_found = false;
$email = false;
$pass = false;
$remember_me = false;

if(isset($_SESSION['error'])){
  $error = $_SESSION['error'];
  unset($_SESSION['error']);
}
if(isset($_SESSION['success'])){
  $success = $_SESSION['success'];
  unset($_SESSION['success']);
}
if(isset($_SESSION['USER_NOT_FOUND'])){
  $user_not_found = $_SESSION['USER_NOT_FOUND'];
  unset($_SESSION['USER_NOT_FOUND']);
}
if(isset($_COOKIE['email'])){
  $email = $_COOKIE['email'];
}
if(isset($_COOKIE['pass'])){
  $pass = $_COOKIE['pass'];
}
if(isset($_COOKIE['remember_me'])){
  $remember_me = $_COOKIE['remember_me'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('./partial/login_signup_head.php');?>
</head>
<body>

<form id="msform" action='./server/login_server.php' method='POST'>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">LOG-IN</h2>
    <h3 class="fs-subtitle">Enter Email & Pass</h3>
    <input type="text" name="email" placeholder="Email" value='<?php echo $email;?>'/>
    <?php if(isset($error['email']) && !empty($error['email'])){?>
      <div class='alert alert-danger'>
        <p><?php echo $error['email'];?></p>
      </div>
      <?php }?>
    <input type="password" name="pass" placeholder="Password" value='<?php echo $pass;?>'/>
    <?php if(isset($error['pass']) && !empty($error['pass'])){?>
      <div class='alert alert-danger'>
        <p><?php echo $error['pass'];?></p>
      </div>
      <?php }?>
    <div class="checkbox">
    <label><input <?php if($remember_me){?> checked <?php }?> type="checkbox" name='remember_me'>Remember me</label>
    </div>
    <input type="submit" name="next" class="next action-button" value="LOG-IN" />
    <?php if(!$success){?>
      <div class='alert alert-danger'>
          <p><?php echo $user_not_found;?></p>
        </div>
        <?php }?>
  </fieldset>
</form>

</body>
</html>