<?php

$error = false;

if(isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

?>

<fieldset>
    <h2 class="fs-title">Personal Details</h2>
    <h3 class="fs-subtitle">We will never sell it</h3>
    <input type="text" name="fname" placeholder="First Name" />
    <?php if(isset($error['fname']) && !empty($error['fname'])){?>
        <div class='alert alert-danger'>
            <p><?php echo $error['fname'];?></p>
        </div>
        <?php }?>
    <input type="text" name="lname" placeholder="Last Name" />
    <?php if(isset($error['lname']) && !empty($error['lname'])){?>
        <div class='alert alert-danger'>
            <p><?php echo $error['lname'];?></p>
        </div>
        <?php }?>
    <input type="text" name="phone" placeholder="Phone" />
    <?php if(isset($error['phone']) && !empty($error['phone'])){?>
        <div class='alert alert-danger'>
            <p><?php echo $error['phone'];?></p>
        </div>
        <?php }?>
    <input type="text" name="address" placeholder="Address" />
    <?php if(isset($error['address']) && !empty($error['address'])){?>
        <div class='alert alert-danger'>
            <p><?php echo $error['address'];?></p>
        </div>
        <?php }?>
    <input type="file" name="photo" placeholder="photo" />
    <a type='button' name='previous' class='previous action-button' href='http://localhost/20-04-2024/project_x/register.php?step=2'>Previous</a>
    <input type="submit" name="next" class="submit action-button" value="Submit" />
    <input type='hidden' name='step' value='3'>
</fieldset>