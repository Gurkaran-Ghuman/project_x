<?php 

include('./function.php');
$posts = 'posts';
$search = false;

if(isset($_GET['search']) && !empty($_GET['search'])){
  $search = $_GET['search'];
}

$category_id = false;

if(isset($_REQUEST['category_id'])){
  $category_id = $_REQUEST['category_id'];
}

$totalposts = totalPosts($posts);
$limit = 3;
$offset = 0;
$total_page = ceil($totalposts/$limit);

$page = 1;
if(isset($_REQUEST['page'])){
  $page = $_REQUEST['page'];
  $offset = ($page - 1) * $limit;
}

$post_data = getPost($posts = 'posts',$categories = 'categories',$search,$limit,$offset,$category_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./partial/dashboard_head.php');?>
    <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css"/>
</head>
<body>
        <header>
            <?php include('./partial/header.php');?>
        </header>

        <div class="container">
          <div class="row">
            <?php foreach($post_data as $key => $value){?>
            <div class="col-md-4">
            <div class="card" style="width:90%;height:auto">
                <img class="card-img-top" src="http://localhost/20-04-2024/project_x/assets/images/<?php echo $value['post_image'];?>" alt="Card image">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $value['post_title'];?></h4>
                    <p class="card-text"><?php echo $value['post_description'];?></p>
                    <h6 class='card-text'><?php echo $value['category_title'];?></h6>
                    <p><i class="fa fa-eye" aria-hidden="true"></i><?php echo $value['views'];?></p>
                    <a href='http://localhost/20-04-2024/project_x/single_post.php?id=<?php echo $value['id'];?>' class="btn btn-primary">See Profile</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <?php for($a=1; $a<=$total_page; $a++){
      $active='';
      if($a== $page){
        $active='active';
      }
      ?>
    <li class = '<?php echo $active;?>'><a class="page-link" href="http://localhost/20-04-2024/project_x/post_listing.php?page=<?php echo $a;?>"><?php echo $a;?></a></li>
    <?php }?>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
        <footer>
            <?php include('./partial/footer.php');?>
        </footer>
</body>
</html>