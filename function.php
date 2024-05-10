<?php

include('./connection.php');

function formvalidation($required_fields,$request){

    $error = [];

    foreach($required_fields as $key => $value){

        if(!isset($request[$value]) || empty($request[$value])){
    
            $error[$value] = $value.' is required';
        }
    } 
    
    return $error;
}

function file_upload($photo){

    if(isset($_FILES[$photo]['tmp_name']) && !empty($_FILES[$photo]['tmp_name'])){

        $category_image_name = $_FILES[$photo]['name'];
        $category_tmp_name = $_FILES[$photo]['tmp_name'];
    
        $pathinfo = pathinfo($category_image_name);
    
        $extension = $pathinfo['extension'];
        $unique_name = time().'.'.$extension;
        $upload_direct = './assets/images/'.$unique_name;
    
        $is_upload = move_uploaded_file($category_tmp_name,$upload_direct);

        if($is_upload){

            return $unique_name;
        }
        return false;
    }
}

function insert($data = false,$table  = false){

    global $connection;

    if($data && $table){

        $columns = [];
        $values = [];

        foreach($data as $key => $value){

            $columns[] = '`'.$key.'`';
            $values[] = $value;
        }

        if((count($columns) > 0) && (count($values) > 0)){

            $table_columns = implode(',',$columns);
            $table_values = implode(',',$values);

            $query = "INSERT INTO $table (".$table_columns.") VALUES ( ".$table_values.")";
            
           if(mysqli_query($connection,$query)){

                return true;
           }
           return false;
        }
    }
}

function getCategory($categories){

    global $connection;
    $query = "SELECT * FROM $categories";
    $result = mysqli_query($connection,$query);
    $output = [];

    while($rows = mysqli_fetch_assoc($result)){

        $output[] = $rows;
    }
    return $output;
}

function getPost($posts,$categories,$search = false,$limit = 3,$offset = 0,$category_id = false){

    global $connection;
    $author_id = $_SESSION['id'];
    $where = '';
    if($search){

        $where = ' WHERE posts.post_title LIKE "%'.$search.'%" OR posts.post_category LIKE "%'.$search.'%" OR posts.post_description LIKE "%'.$search.'%"';
    }elseif($category_id){

        $where = ' WHERE posts.post_category ='.$category_id;
    }
    $query = "SELECT posts.id,posts.post_title,posts.post_description,posts.post_category,posts.post_image,posts.views,categories.category_title,categories.category_image FROM $posts INNER JOIN $categories ON $posts.post_category = $categories.id".$where." ORDER BY posts.views DESC LIMIT ".$limit." OFFSET ".$offset;
    $result = mysqli_query($connection,$query);
    $output = [];

    while($rows = mysqli_fetch_assoc($result)){

        $output[] = $rows;
    }
    return $output;
}

function isuserloggedin(){

    if(isset($_SESSION['id'])){

        return true;

    }else{

        return false;
    }
}
function username(){

    global $connection;
    $table = 'user';
    $author_id = $_SESSION['id'];
    $query = "SELECT * FROM $table WHERE id=".$author_id;
    $result = mysqli_query($connection,$query);
    $output[] = mysqli_fetch_assoc($result);

    return $output;
}

function getpostdetail($post_id){

    global $connection;
    $query = "SELECT posts.author_id,posts.post_title,posts.post_description,posts.post_image,posts.post_video,posts.post_category,posts.post_tags,posts.views, posts.created_date, categories.category_title,user.fname,user.lname,user.photo FROM posts INNER JOIN categories ON posts.post_category = categories.id INNER JOIN user ON posts.author_id = user.id WHERE posts.id = ".$post_id;
    $result = mysqli_query($connection,$query);
    $output= mysqli_fetch_assoc($result);

    return $output;
}

function getlatestposts($posts){

    global $connection;
    $query = "SELECT posts.post_title,posts.post_description,posts.post_image,posts.created_date,categories.category_title,user.fname,user.lname,user.photo FROM posts INNER JOIN categories ON posts.post_category = categories.id INNER JOIN user ON posts.author_id = user.id ORDER BY created_date DESC LIMIT 3";
    $result = mysqli_query($connection,$query);
    $total_rows = mysqli_num_rows($result);
    $output = [];

    if($total_rows > 0){
        while($rows = mysqli_fetch_assoc($result)){
            $output[] = $rows;
        }
    }
    return $output;
}
function getcomments($post_id){

    global $connection;
    $query = "SELECT comments.id,comments.post_id,comments.author_id,comments.comment,comments.created_date,user.fname,user.lname,user.photo FROM comments INNER JOIN user ON comments.author_id = user.id WHERE comments.post_id=".$post_id;
    $result = mysqli_query($connection,$query);
    $total_rows = mysqli_num_rows($result);
    $output = [];

    if($total_rows > 0){
        while($rows = mysqli_fetch_assoc($result)){
            $output [] = $rows;
        }
    }
    return $output;
}

function totalPosts($posts){

    global $connection;
    $query = "SELECT * FROM $posts";
    $result = mysqli_query($connection,$query);
    $totalposts = mysqli_num_rows($result);

    return $totalposts;
}

function updatePostViews($post_id){

    global $connection;
    $query = "SELECT views,author_id FROM posts WHERE id=".$post_id;
    $result = mysqli_query($connection,$query);
    $query_result = mysqli_fetch_assoc($result);

    if($query_result['author_id'] != $_SESSION['id']){

        $views_count = 0;
        if($query_result){
            $views_count = $query_result['views'] + 1;
        }
    
        $update_query = "UPDATE posts SET views = '$views_count' WHERE id=".$post_id;
        $update_result = mysqli_query($connection,$update_query);
        
        if($update_result){
            return true;
        }
        return false;
        }
}
?>