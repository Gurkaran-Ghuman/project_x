<?php

include('./function.php');
$userlogin = isuserloggedin();

if($userlogin){

    $comment_id = $_REQUEST['comment_id'];
    $post_id = $_REQUEST['post_id'];

    $postdetail = getpostdetail($post_id);

    $comments = 'comments';

    if($postdetail['author_id'] == $_SESSION['id']){

        $query = "DELETE FROM $comments WHERE id=".$comment_id;
        $result = mysqli_query($connection,$query);

        header('Location:http://localhost/20-04-2024/project_x/single_post.php?id='.$post_id);
        exit;
    }
}else{

    header('Location:http://localhost/20-04-2024/project_x/login.php');
    exit;
}
?>