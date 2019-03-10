<?php
include('inc/conn.php');
$sql = "SELECT * from posts";
$results=$conn->query($sql);
$posts=mysqli_fetch_all($results,MYSQLI_ASSOC);
mysqli_free_result($results);

$recent="SELECT * from posts ORDER BY DESC limit 5";
$rec=mysqli_query($conn,$sql);
$recposts=mysqli_fetch_all($rec,MYSQLI_ASSOC);
mysqli_free_result($rec);

$catogory="SELECT catogory from catogory";
$catogories=mysqli_query($conn,$catogory);
$cato=mysqli_fetch_all($catogories,MYSQLI_ASSOC);
mysqli_free_result($catogories);


$curr_id=$_GET['id'];
$sql = "SELECT * from posts where id=".$curr_id;
$reso=mysqli_query($conn,$sql);
$post=mysqli_fetch_assoc($reso);
mysqli_free_result($reso);


if(isset($_POST['edit'])){
 $post_id=mysqli_escape_string($conn,$_POST['post_id']);
  $title=mysqli_escape_string($conn,$_POST['title']);
  $author=mysqli_escape_string($conn,$_POST['author']);
  $image=mysqli_escape_string($conn,$_POST['image']);
  $describtion=mysqli_escape_string($conn,$_POST['describtion']);
  $body=mysqli_escape_string($conn,$_POST['body']);
  $catogory=mysqli_escape_string($conn,$_POST['catogory']);
$current_post="update posts SET 
title='$title',author='$author',image='$image',describtion='$describtion',body='$body',catogory='$catogory' where id=".$post_id;
if(mysqli_query($conn,$current_post)){
    header('location:dashboard.php');
  }
  else{
    echo 'error'.mysqli_error($conn);
  }
}


mysqli_close($conn);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

   <link href="https://fonts.googleapis.com/css?family=Charm" rel="stylesheet">

   <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

    <title>Shout4Anime</title>
    <style type="text/css">
      h2{
        font-family: 'Charm', cursive;
      }
    </style>
  </head>
  <body>
    <div class='container'>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href="#">Shout4Anime</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addpost.php">addpost</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="catogory.php">catogory</a>
      </li>
              <li class="nav-item">
        <a class="nav-link" href="logout.php">logout</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<br>
<h2 class='text-danger'>posts</h2>
<hr>
<div class='row'>
        <div class='col-md-4 col-sm-12'>
          <br><br>
          <ul class='list-group list-unstyled'>
          <li><a href='#' class="list-group-item list-group-item-success text-danger list-group-item-action">Recent Posts</a></li>
                    <?php foreach ($recposts as $recpost):?>
      <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo $recpost['title'];?>
  </li>
    <?php endforeach;?>
      </ul><hr><br>
      <ul class="list-group list-unstyled">
       <li><a href='#' class="list-group-item list-group-item-success text-danger">catorgories</a></li>
          <?php foreach ($cato as $catogory):?>
      <li class="list-group-item d-flex justify-content-between align-items-center"><a href='dashboard.php?cato=<?php echo $catogory['catogory'];?>'><?php echo $catogory['catogory'];?>
          <span class="badge badge-primary badge-pill">14</span>
        </a>
  </li>
    <?php endforeach;?>
</ul><hr><br>
  <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="boruto2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="boruto.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="boruto2.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
</div><br>
</div>
  <div class='col-md-7 col-sm-12'>
    <h2 class='text-danger'> add post</h2>
<hr>
    <form action='editpost.php' method='post'>
  <div class="form-group">
    <input type="hidden" class="form-control" name='post_id' value='<?php echo $_GET['id'];?>'>
  </div>
      <div class="form-group">
    <label for="title">Title:</label>
    <input type="text" class="form-control" id="title" name='title' value='<?php echo $post['title'];?>'>
  </div>
  <div class="form-group">
    <label for="author">Author:</label>
    <input type="text" class="form-control" id="author" name="author" value='<?php echo $post['author'];?>'>
  </div>
  <div class="form-group">
    <label for="image">Cover Image:</label>
   <textarea class="form-control" id="image" rows="3" name="image"><?php echo $post['image'];?></textarea>
  </div>
  <div class="form-group">
    <label for="describtion">describtion</label>
    <textarea class="form-control" id="describtion" rows="3" name="describtion"><?php echo $post['describtion'];?></textarea>
  </div>
  <div class="form-group">
    <label for="body">Body</label>
    <textarea class="form-control" id="body" rows="3" name="body" ><?php echo $post['body'];?></textarea>
  </div>
  <div class="form-group">
  <select name='catogory'>
  <?php foreach ($cato as $catogory):?>
                        <option value='<?php echo $catogory['catogory'];?>'>
                           <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo $catogory['catogory'];?>
                           </li>
                        </option>
                        <?php endforeach;?>
                        </select>
                        </div>
  <button type="submit" name='edit' class="btn btn-dark">post</button>
    </form>
    <br>
  </div>
  </div>
  <?php include('inc/footer.php');?>