<?php

include('./function.php');

$step = 1;
if(isset($_REQUEST['step'])){
  $step = $_REQUEST['step'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('./partial/login_signup_head.php');?>
</head>
<body>
<!-- multistep form -->
<form id="msform" action='./server/register_server.php' method='POST' enctype='multipart/form-data'>
  <!-- progressbar -->
  <?php include('./partial/register_progressbar.php');?>
  <!-- fieldsets -->
  <?php switch($step){
    case 1:{
      include('./partial/register_step_1.php');
    break;
    }
    case 2:{
      include('./partial/register_step_2.php');
    break;
    }
    case 3:{
      include('./partial/register_step_3.php');
    break;
    }
    default:{
      include('./partial/register_step_1.php');
    }
  }?>
</form>

</body>
</html>