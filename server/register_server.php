<?php

include('../function.php');
include('../connection.php');

$required_1st_field=['email','pass','cpass'];
$required_2nd_field=['twitter','facebook'];
$required_3rd_field=['fname','lname','phone','address'];

$step = 1;
if(isset($_REQUEST['step'])){
    $step = $_REQUEST['step'];
}
$error = [];
$next_step = 0;
$_SESSION['step-'.$step.'-value'] = $_POST;
$total_steps = 3;

switch($step){

    case 1:{
        $required_fields = $required_1st_field;
    break;
    }
    case 2:{
        $required_fields = $required_2nd_field;
    break;
    }
    case 3:{
        $required_fields = $required_3rd_field;
    break;
    }
    default:{
    $required_fields = $required_1st_field;
    break;
    }
    
}

foreach($required_fields as $key => $value){

    if(!isset($_REQUEST[$value]) || empty($_REQUEST[$value])){

        $error[$value] = $value.' is required';
    }
}

if(count($error) > 0){

    $next_step = $step;
    $_SESSION['error'] = $error;

}else{

    $next_step = $step + 1;   
}

//file upload
if(isset($_FILES['photo']['tmp_name']) && !empty($_FILES['photo']['tmp_name'])){

    $photo_name = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];

    $pathinfo = pathinfo($photo_name);

    $extension = $pathinfo['extension'];
    $unique_name = time().'.'.$extension;
    $upload_direct = '../assets/images/'.$unique_name;

    $is_upload = move_uploaded_file($tmp_name,$upload_direct);
}

if($next_step > $total_steps){

    $next_step = 1;
    $email = $_SESSION['step-1-value']['email'];
    $pass = $_SESSION['step-1-value']['pass'];
    $twitter = $_SESSION['step-2-value']['twitter'];
    $facebook = $_SESSION['step-2-value']['facebook'];
    $fname = $_SESSION['step-3-value']['fname'];
    $lname = $_SESSION['step-3-value']['lname'];
    $phone = $_SESSION['step-3-value']['phone'];
    $address = $_SESSION['step-3-value']['address'];
    $table = 'user';
    $query = "INSERT INTO $table (`email`,`pass`,`twitter`,`facebook`,`fname`,`lname`,`phone`,`address`,`photo`) VALUES ('$email','$pass','$twitter','$facebook','$fname','$lname','$phone','$address','$unique_name')";
    $result = mysqli_query($connection,$query);

    if($result){

        session_destroy();
        session_start();
        $_SESSION['success'] = 'SIGN-UP Success';
    }
}

header('Location:http://localhost/20-04-2024/project_x/register.php?step='.$next_step);
exit;
?>