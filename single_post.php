<?php

include('./function.php');

$post_id = $_REQUEST['id'];
$views = updatePostViews($post_id);
$postdetail = getpostdetail($post_id);

$post_tags = [];
if(isset($postdetail['post_tags'])){
    $post_tags = unserialize($postdetail['post_tags']);
}

$posts = 'posts';
$latestposts = getlatestposts($posts);

$success = false;
$error = false;

if(isset($_SESSION['success'])){
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}
if(isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

$getcomments = getcomments($post_id);
$categories = 'categories';
$allcategories = getCategory($categories);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog Post - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="./assets/css/single_post.css" rel="stylesheet" />
        <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#!">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?php echo $postdetail['post_title'];?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2"><?php echo date('d-m-Y',strtotime($postdetail['created_date']));?> by <?php echo $postdetail['fname'].' '.$postdetail['lname'];?></div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!"><?php echo $postdetail['category_title'];?></a>
                        <?php foreach($post_tags as $key => $value){?>
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!"><?php echo $value;?></a>
                            <?php }?>
                            <i class="fa fa-eye" aria-hidden="true"></i><?php echo $postdetail['views'];?>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="http://localhost/20-04-2024/project_x/assets/images/<?php echo $postdetail['post_image'];?>" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <p class="fs-5 mb-4">Science is an enterprise that should be cherished as an activity of the free human mind. Because it transforms who we are, how we live, and it gives us an understanding of our place in the universe.</p>
                            <p class="fs-5 mb-4">The universe is large and old, and the ingredients for life as we know it are everywhere, so there's no reason to think that Earth would be unique in that regard. Whether of not the life became intelligent is a different question, and we'll see if we find that.</p>
                            <p class="fs-5 mb-4">If you get asteroids about a kilometer in size, those are large enough and carry enough energy into our system to disrupt transportation, communication, the food chains, and that can be a really bad day on Earth.</p>
                            <h2 class="fw-bolder mb-4 mt-5">I have odd cosmic thoughts every day</h2>
                            <p class="fs-5 mb-4">For me, the most fascinating interface is Twitter. I have odd cosmic thoughts every day and I realized I could hold them to myself or share them with people who might be interested.</p>
                            <p class="fs-5 mb-4">Venus has a runaway greenhouse effect. I kind of want to know what happened there because we're twirling knobs here on Earth without knowing the consequences of it. Mars once had running water. It's bone dry today. Something bad happened there as well.</p>
                        </section>
                       
                    </article>
                    <!-- Comments section-->
                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <!-- Comment form-->
                                <form class="mb-4" action='./server_comment.php' method='POST'>
                                    <textarea class="form-control" rows="3" name='comment' placeholder="Join the discussion and leave a comment!"></textarea>
                                    <?php if(isset($error['comment']) && !empty($error['comment'])){?>
                                        <div class='alert alert-danger'>
                                            <p><?php echo $error['comment'];?></p>
                                        </div>
                                        <?php }?>
                                    <input type='hidden' value='<?php echo $post_id?>' name='post_id'>
                                    <button type="submit" class="btn btn-primary">Comment</button>
                                    <?php if($success){?>
                                        <div class='alert alert-success'>
                                            <p><?php echo $success;?><p>
                                        </div>
                                        <?php }?>
                                </form>
                                <!-- Comment with nested comments--> 
                                <?php foreach($getcomments as $key => $value){?>
                                <div class="d-flex mb-4">
                                    <!-- Parent comment-->
                                    <div class="flex-shrink-0"><img width='45px' height='45px' class="rounded-circle" src="http://localhost/20-04-2024/project_x/assets/images/<?php echo $value['photo'];?>" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold"><?php echo $value['fname'].' '.$value['lname'];?></div>
                                        <?php echo $value['comment'];?>
                                    </div>
                                    <?php if($postdetail['author_id'] == $_SESSION['id'] || $value['author_id'] == $_SESSION['id']){ ?>
                                        <a href='http://localhost/20-04-2024/project_x/delete_comment.php?comment_id=<?php echo $value['id'];?>&post_id=<?php echo $post_id?>' class="btn btn-secondary">Delete</a>
                                    <?php }?>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                        <form action='<?php echo $base_url; ?>/post_listing.php' method='GET'>
                            <div class="input-group">
                                <input class="form-control" name='search' type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                              
                                    <ul class="list-unstyled mb-0">
                                    <?php foreach($allcategories as $key => $value){ if($key % 2 == 0) { ?>
                                        <li <?php if($postdetail['post_category'] == $value['id']){?> class='wcp-active' <?php }?> ><a href="http://localhost/20-04-2024/project_x/post_listing.php?category_id=<?php echo $value['id'];?>"><?php echo $value['category_title'];?></a></li>
                                    <?php } }?>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <?php foreach($allcategories as $key => $value){ if($key % 2 != 0) { ?>
                                        <li <?php if($postdetail['post_category'] == $value['id']){?> class='wcp-active' <?php }?> ><a href="http://localhost/20-04-2024/project_x/post_listing.php?category_id=<?php echo $value['id'];?>"><?php echo $value['category_title'];?></a></li>                                 
                                        <?php } }?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">video</div>
                        <div class="card-body">
                        <?php if(isset($postdetail['post_video']) && !empty($postdetail['post_video'])){?>
                            <video width="100%" height="170px" controls>
                                    <source src="http://localhost/20-04-2024/project_x/assets/images/<?php echo $postdetail['post_video'];?>" type="video/mp4">
                                    Your browser does not support the video tag.
                            </video>
                                <?php }else{?>
                                    <p>There's no Video.</p>
                                <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>