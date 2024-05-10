<?php

include('./function.php');

$required_fields = ['post_title','post_description','post_category'];

//form_validation
$error = formvalidation($required_fields,$_REQUEST);

//file_upload_image
$unique_name = file_upload($photo = 'post_image');

//file_upload_video
$video_unique_name = file_upload($video = 'post_video');

//continue
if(count($error) == 0){

    $post_title = $_REQUEST['post_title'];
    $post_description = $_REQUEST['post_description'];
    $post_category = $_REQUEST['post_category'];
    $author_id = $_SESSION['id'];

    $tags = [];

    if(isset($_POST['tags'])){
        $tags = $_POST['tags'];
    }

    $table = 'posts';

    $data = [
        'post_title' => "'".$post_title."'",
        'post_description' => "'".$post_description."'",
        'post_category' => $post_category,
        'post_image' => "'".$unique_name."'",
        'post_video' => "'".$video_unique_name."'",
        'post_tags' => "'".serialize($tags)."'",
        'author_id' => $author_id,
    ];
    
    //insert_query
    $result = insert($data,$table);

    if($result){

        $_SESSION['success'] = 'Post Added Successfully';
    }
}

if(count($error) > 0){

    $_SESSION['error'] = $error;
}
header('Location:http://localhost/20-04-2024/project_x/post_form.php');
exit;

?>