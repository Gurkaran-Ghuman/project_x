<?php

$error = false;
$twitter = false;
$facebook = false;

if(isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
if(isset($_SESSION['step-2-value']['twitter'])){
    $twitter = $_SESSION['step-2-value']['twitter'];
}
if(isset($_SESSION['step-2-value']['facebook'])){
    $facebook = $_SESSION['step-2-value']['facebook'];
}

?>

<fieldset>
    <h2 class="fs-title">Social Profiles</h2>
    <h3 class="fs-subtitle">Your presence on the social network</h3>
    <input type="text" name="twitter" placeholder="Twitter" value='<?php echo $twitter;?>'/>
    <?php if(isset($error['twitter']) && !empty($error['twitter'])){?>
        <div class='alert alert-danger'>
            <p><?php echo $error['twitter'];?></p>
        </div>
        <?php }?>
    <input type="text" name="facebook" placeholder="Facebook" value='<?php echo $facebook;?>'/>
    <?php if(isset($error['facebook']) && !empty($error['facebook'])){?>
        <div class='alert alert-danger'>
            <p><?php echo $error['facebook'];?></p>
        </div>
        <?php }?>
    <a type='button' name='previous' class='previous action-button' href='http://localhost/20-04-2024/project_x/register.php?step=1'>Previous</a>
    <input type="submit" name="next" class="next action-button" value="Next" />
    <input type='hidden' name='step' value='2'>
</fieldset>