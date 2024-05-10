<?php

$error = false;
$success = false;

if(isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
if(isset($_SESSION['success'])){
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

?>

<form action='./category_form_server.php' method='POST' enctype='multipart/form-data'>
  <div class="mb-3">
    <label for="text" class="form-label">Category Title</label>
    <input type="text" class="form-control" id="category_title" name='category_title'>
    <?php if(isset($error['category_title']) && !empty($error['category_title'])){?>
        <div class='alert alert-danger'>
            <p><?php echo  $error['category_title'];?></p>
        </div>
        <?php }?>
  </div>
  <div class="mb-3">
    <label for="text" class="form-label">Category Description</label>
    <textarea type="text" class="form-control" id="category_description" name='category_description'></textarea>
    <?php if(isset($error['category_description']) && !empty($error['category_description'])){?>
        <div class='alert alert-danger'>
            <p><?php echo $error['category_description'];?></p>
        </div>
        <?php }?>
  </div>
  <div class="mb-3">
    <label for="text" class="form-label">Category Image</label>
    <input type="file" class="form-control" id="category_image" name='category_image'>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <?php if($success){?>
    <div class='alert alert-success'>
        <p><?php echo $success;?></p>
    </div>
    <?php }?>
</form>