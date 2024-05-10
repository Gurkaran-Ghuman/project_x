<?php

$error = false;
$email = false;
$pass = false;
$cpass = false;
$success = false;

if(isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
if(isset($_SESSION['step-1-value']['email'])){
    $email = $_SESSION['step-1-value']['email'];
}
if(isset($_SESSION['step-1-value']['pass'])){
    $pass = $_SESSION['step-1-value']['pass'];
}
if(isset($_SESSION['step-1-value']['cpass'])){
    $cpass = $_SESSION['step-1-value']['cpass'];
}
if(isset($_SESSION['success'])){
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

?>

<fieldset>
    <h2 class="fs-title">Create your account</h2>
    <h3 class="fs-subtitle">Choose Email & Pass</h3>
    <input type="text" name="email" placeholder="Email" value='<?php echo $email;?>'>
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
    <input type="password" name="cpass" placeholder="Confirm Password" value='<?php echo $cpass;?>'/>
    <?php if(isset($error['cpass']) && !empty($error['cpass'])){?>
        <div class='alert alert-danger'>
            <p><?php echo $error['cpass'];?></p>
        </div>
        <?php }?>
    <input type="submit" name="next" class="next action-button" value="Next" />
    <?php if($success){?>
        <div class='alert alert-success'>
            <p><?php echo $success;?></p>
        </div>
        <?php }?>
    <input type='hidden' name='step' value='1'>
</fieldset>