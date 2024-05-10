<?php 

include('./function.php');
include('./connection.php');

$required_fields = ['category_title','category_description'];
$error = [];

//form_validation
$error = formvalidation($required_fields,$_REQUEST);

//file_upload
$unique_name = file_upload($photo='category_image');

if(!$unique_name){
    $error[] = 'img is required!';
}

if(count($error) == 0){

    $category_title = $_REQUEST['category_title'];
    $category_description = $_REQUEST['category_description'];
    $table = 'categories';

    $data = [
            'category_title' => "'".$category_title."'",'category_description' =>"'".$category_description."'",
            'category_image' => "'".$unique_name."'" ];

    $result = insert($data,$table);

    if($result){

        $_SESSION['success'] = 'Category Added Successfully';
    }
}
if(count($error) > 0){

    $_SESSION['error'] = $error;
}
header('Location:http://localhost/20-04-2024/project_x/dashboard.php');
exit;
?>