<?php

include('./function.php');

$required_fields = ['post_id','comment'];

//form validation
$error = formvalidation($required_fields,$_REQUEST);

if(count($error) ==0 ){

    $post_id = $_REQUEST['post_id'];
    $author_id = $_SESSION['id'];
    $comment = $_REQUEST['comment'];
    $table = 'comments';
    $data = [
        'post_id' => "'".$post_id."'",
        'author_id' => "'".$author_id."'",
        'comment' => "'".$comment."'",
    ];

    //insert query
    $result = insert($data,$table);

    if($result){

        $_SESSION['success'] = 'Comment Added Successfully';
    }
}
if(count($error) > 0){

    $_SESSION['error'] = $error;
}
header('Location:http://localhost/20-04-2024/project_x/single_post.php?id='.$post_id);
exit;
?>