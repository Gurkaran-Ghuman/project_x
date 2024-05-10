<?php

include('../function.php');
include('../connection.php');

$required_fields = ['email','pass'];
$error =[];
$url = 'http://localhost/20-04-2024/project_x/login.php';

foreach($required_fields as $key => $value){

    if(!isset($_REQUEST[$value]) || empty($_REQUEST[$value])){

        $error[$value] = $value.' is required';
    }
}
if(count($error)==0){

    $email = mysqli_escape_string($connection,$_REQUEST['email']);
    $pass = mysqli_escape_string($connection,$_REQUEST['pass']);
    $table = 'user';

    $remember_me = false;
    if(isset($_POST['remember_me'])){
        $remember_me = true;
    }
    if($remember_me){

        setcookie('email', $email , time() + (86400 * 30), "/");
        setcookie('pass', $pass , time() + (86400 * 30), "/");
        setcookie('remember_me', true , time() + (86400 * 30), "/");

    }else{

        setcookie('email', $email , time() - (86400 * 30), "/");
        setcookie('pass', $pass , time() - (86400 * 30), "/");
        setcookie('remember_me', false , time() - (86400 * 30), "/");
    }

    $query = "SELECT * FROM $table WHERE email= '".$email."' AND pass= '".$pass."'";
    $result = mysqli_query($connection,$query);
    $no_of_rows = mysqli_num_rows($result);

    if($no_of_rows > 0){
        
        $output = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $output['id'];
        $_SESSION['success'] = 'LOG-IN Success';
        $url = 'http://localhost/20-04-2024/project_x/dashboard.php';

    }else{

        $_SESSION['USER_NOT_FOUND'] = 'USER NOT FOUND';
    }
}

if(count($error) > 0){

    $_SESSION['error'] = $error;
}

header('Location:'.$url);
exit;
?>