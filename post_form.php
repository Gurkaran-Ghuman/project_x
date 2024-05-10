<?php 

include('./function.php');

$error = false;
$success = false;

$allcategories = getCategory($categories ='categories');

if(isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
if(isset($_SESSION['success'])){
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./partial/dashboard_head.php');?>

</head>
<body>
        <header>
            <?php include('./partial/header.php');?>
        </header>

<div class="container">
<form action="./post_form_server.php" method='POST' enctype='multipart/form-data'>
  <div class="form-group">
    <label for="text">Post Title</label>
    <input type="text" class="form-control" id="post_title" name='post_title'>
    <?php if(isset($error['post_title']) && !empty($_SESSION['post_title'])){?>
        <div class='alert alert-danger'>
            <p><?php echo $error['post_title'];?></p>
        </div>
        <?php }?>
  </div>
  <div class="form-group">
    <label for="text">Post Description</label>
    <textarea type="text" class="form-control" id="post_description" name='post_description'></textarea>
    <?php if(isset($error['post_description']) && !empty($_SESSION['post_description'])){?>
        <div class='alert alert-danger'>
            <p><?php echo $error['post_description'];?></p>
        </div>
        <?php }?>
  </div>
  <div class="form-group">

    <label for="text">Post Category</label>
    <select name="post_category" class="form-control" id="post_category">
        <?php foreach($allcategories as $key => $value) { ?>

            <option value="<?php echo $value['id']; ?>"><?php echo $value['category_title']; ?></option>

        <?php } ?>
    </select>
    <?php if(isset($error['post_category']) && !empty($_SESSION['post_category'])){?>
        <div class='alert alert-danger'>
            <p><?php echo $error['post_category'];?></p>
        </div>
        <?php }?>
  </div>
  <div class="form-group">
    <label for="text">Post Image</label>
    <input type="file" class="form-control" id="post_image" name='post_image'>
  </div>
  <div class="form-group">
    <label for="text">Post video</label>
    <input type="file" class="form-control" id="post_video" name='post_video'>
  </div>

  <!-- tags_html -->
  <div class="dynamic-field"></div>
  <div class="tags-input form-group"> <nr/>
        <label for="text">Enter Tags</label>
        <ul id="tags"></ul> 
        <input type="text" class="form-control" id="input-tag" 
            placeholder="Add a tag" /> 
        
    </div> 
    
  <button type="submit" class="btn btn-default">Submit</button>
  <?php if($success){?>
    <div class='alert alert-success'>
        <p><?php echo $success;?></p>
    </div>
    <?php }?>
</form>
</div>
        <footer>
            <?php include('./partial/footer.php');?>
        </footer>

</body>
</html>