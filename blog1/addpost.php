<?php
include('inc/conn.php');

if(isset($_POST['submit'])){
  $title=mysqli_escape_string($conn,$_POST['title']);
  $author=mysqli_escape_string($conn,$_POST['author']);
  $image=mysqli_escape_string($conn,$_POST['image']);
  $describtion=mysqli_escape_string($conn,$_POST['describtion']);
  $body=mysqli_escape_string($conn,$_POST['body']);
  $catogory=mysqli_escape_string($conn,$_POST['catogory']);
  $query="insert into posts(title,author,image,describtion,body,catogory) values('$title','$author','$image','$describtion','$body','$catogory')";
  if(mysqli_query($conn,$query)){
    header('location:dashboard.php');
  }
  else{
    echo 'error'.mysqli_error($conn);
  }
}
if(isset($_POST['add'])){
  $new_catogory=mysqli_escape_string($conn,$_POST['new_catogory']);
    $query="insert into catogory(catogory) values('$new_catogory')";
  if(mysqli_query($conn,$query)){
    echo 'successfully added';
  }
  else{
    echo 'error'.mysqli_error($conn);
  }
}
// this is the recent post section
$recent="SELECT * from posts ORDER BY id DESC limit 5";
$rec=mysqli_query($conn,$recent);
$recposts=mysqli_fetch_all($rec,MYSQLI_ASSOC);
mysqli_free_result($rec);

// this is the catogogry section
$catogory="SELECT catogory from catogory";
$catogories=mysqli_query($conn,$catogory);
$cato=mysqli_fetch_all($catogories,MYSQLI_ASSOC);
mysqli_free_result($catogories);

//archive of all posts
$stmo="SELECT * from posts ORDER BY id DESC";
$results=mysqli_query($conn,$stmo);
$archives=mysqli_fetch_all($results,MYSQLI_ASSOC);
mysqli_free_result($results);

// this checks the  suggestion box and then sends an email
if(isset($_POST['suggestion_box'])){
  $msg=$_POST['suggestion'];
  $headers = "From: user@example.com" . "\r\n" .
"CC: abdisamadhassan00@gmail.com";
  if(mail("abdisamadhassan00@gmail.com",'suggestion',$msg,$headers)){
     echo'success your message has been sent';
  }
  else{
     echo 'failure your message could not be sent';
  }
}
      //this section calculates the number of pages per 5 posts in each page
      $sql="SELECT * from posts";
      $posts=mysqli_query($conn,$sql);
      $postrows=mysqli_num_rows($posts);
      $n=$postrows;
      mysqli_free_result($posts);
mysqli_close($conn);
include('inc/header.php');
?>
<h2 class='text-danger'>posts</h2>
<hr>
<div class='row'>
<div class='col-md-4 col-sm-12'>
                <br><br>
               <h2 class='text-dark'>Self Introduction</h2>
               <hr>
               <img src="https://secure.gravatar.com/avatar/497cb525c83e3ddf9da4117f1f824d43" alt="" style='width:100%;' class='img-thumbnail'>
               <a href="http://en.gravatar.com/nightghoul" class='text-danger'>NightGhoul</a><br>
               <p>Before I start losing myself in the excitement let me start off by why I decided to take on blogging. To start with I am not that of great of writer and English is my second language but I have always been inspired by my love for anime and the blogging community.</p>
               <a href="http://en.gravatar.com/nightghoul" class='text-danger'>view profile page--></a><br><br>
               <ul class='list-group list-unstyled'>
                  <li><a href='#' class="list-group-item list-group-item-success text-danger list-group-item-action">Recent Posts</a></li>
                  <?php foreach ($recposts as $recpost):?>
                  <li class="list-group-item d-flex justify-content-between align-items-center"><a href='previewpost/<?php echo preg_replace('/\s+/', '-', $recpost['title']);?>'><?php echo $recpost['title'];?></a>
                  </li>
                  <?php endforeach;?>
               </ul>
               <hr>
               <br>
               <ul class="list-group list-unstyled">
                  <li><a href='#' class="list-group-item list-group-item-success text-danger list-group-item-action">catorgories</a></li>
                  <div class="form-group">
                     <select class="form-control" name='cato' onchange="location = this.value;">
                        <option value=''>
                           <li class="list-group-item d-flex justify-content-between align-items-center">choose a catogory</li>
                        </option>
                        <?php foreach ($cato as $catogory):?>
                        <option value='dashboard.php?cato=<?php echo $catogory['catogory'];?>'>
                           <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo $catogory['catogory'];?>
                           </li>
                        </option>
                        <?php endforeach;?>
                     </select>
                  </div>
               </ul>
               <hr>
               <br>
               <ul class="list-group list-unstyled">
                  <li><a href='#' class="list-group-item list-group-item-success text-danger list-group-item-action">Archieves</a></li>
                  <div class='scrolling'>
                     <table class="table table-bordered">
                        <tr>
                           <td>#</td>
                           <td>post title</td>
                           <td>post date</td>
                        </tr>
                        <?php foreach ($archives as $post):?>
                        <tr>
                           <td>
                              <?php print($n);
                                 $n=$n-1;?>
                           </td>
                           <td>
                              <a href="previewpost/<?php echo preg_replace('/\s+/', '-', $post['title']);?>">
                              <?php echo $post["title"];?>
                              </a>
                           </td>
                           <td>
                              <?php echo $post['date_created'];?>
                           </td>
                           
                           </td>
                        </tr>
                        <?php endforeach;?>
                     </table>
                  </div>
               </ul>
               <hr>
               <br>
               <form action='dashboard.php' method='post'>
                  <div class="form-group">
                     <h2 class='text-dark'>suggestion box</h2>
                     <hr>
                     <textarea class="form-control" id="suggestion" name='suggestion'rows='10'>Enter your Suggestion</textarea>
                     <button type="submit" name='suggestion_box' class="btn btn-dark" >send!</button>
                  </div>
               </form>
               <hr>
               <br>
               <h2 class='text-dark'>fallow blog on</h2>
               <hr>
               <p>Click to follow this blog and receive notifications of new posts by email.</p>
               <input name="subscribe" id="subc_btn" class="btn btn-dark btn-lg" type="text" placeholder='enter your email'> <br>
               <button type="submit" name='suggestion_box' class="btn btn-success btn-lg button-block" >subscribe</button>
               <hr>
               <br><br>
            </div>
  <div class='col-md-7 col-sm-12'>
    <h2 class='text-danger'> add post</h2>
<hr>
    <form action='addpost.php' method='post'>
      <div class="form-group">
    <label for="title">Title:</label>
    <input type="text" class="form-control" id="title" name='title'>
  </div>
  <div class="form-group">
    <label for="author">Author:</label>
    <input type="text" class="form-control" id="author" name="author">
  </div>
  <div class="form-group">
    <label for="image">Cover Image:</label>
    <input type="text" class="form-control" id="image" name="image">
  </div>
  <div class="form-group">
    <label for="describtion">describtion</label>
    <textarea class="form-control" id="describtion" rows="3" name="describtion"></textarea>
  </div>
  <div class="form-group">
    <label for="body">Body</label>
    <textarea class="form-control" id="body" rows="3" name="body"></textarea>
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
  <button type="submit" name='submit' class="btn btn-dark">post</button>
    </form>
    <br>
    <h2 class='text-danger'> add catogory</h2>
<hr>
<form action='addpost.php' method='post'>
        <div class="form-group">
    <label for="new_catogory">Add catogory:</label>
    <input type="text" class="form-control" id="new_catogory" name='new_catogory'>
  </div>
    <button type="submit" name='add' class="btn btn-dark">add catogory</button>
  </form>
  </div>
  </div>
  <?php include('inc/footer.php');?>