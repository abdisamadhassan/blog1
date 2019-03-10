<?php
   include('inc/conn.php');
      //pagination system
   
      //check for the page value
      if(isset($_POST['page'])){
         $page=$_POST['page'];
         }else{
         $page=1;
         }
         if($page=='' or $page=='1'){
         $numpages=0;
         }else{
         $numpages=($page*5)-5;
         }
         
         //next and previews buttons
         if(isset($_POST['next'])){
         $page=$page+1;
         $numpages=($page*5)-5;
         }
         if(isset($_POST['previous'])){
         $page=$page-1;
         $numpages=($page*5)-5;
         }
   //display the catogory
      if(isset($_GET['cato']) ){
         $pcato=$_GET['cato'];
         //this section checks if the catogory is all or blank and than it  displays all the catogories
            if($pcato=='all' or $pcato==''){
               $stmo="SELECT * from posts ORDER BY id DESC";
               $pages=mysqli_query($conn,$stmo);
               $pageno=mysqli_fetch_all($pages,MYSQLI_ASSOC);
               mysqli_free_result($pages);
            }else{
         // this checks if the catogory isn't equel to all or none and than displays what it is
            $stmo="SELECT * from posts WHERE catogory='$pcato'";
            $pages=mysqli_query($conn,$stmo);
            $pageno=mysqli_fetch_all($pages,MYSQLI_ASSOC);
            mysqli_free_result($pages);
         }
      }else{
// this displays 5 posts for each page only if the catogory is not 
      //grab the pages needed
      $stmo="SELECT * from posts ORDER BY id DESC limit $numpages,5";
      $pages=mysqli_query($conn,$stmo);
      $pageno=mysqli_fetch_all($pages,MYSQLI_ASSOC);
      mysqli_free_result($pages);
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
   
   //featured posts
      $sql = "SELECT * from posts WHERE featured=1";
      $featured_results=mysqli_query($conn,$sql);
      $featuredposts=mysqli_fetch_all($featured_results,MYSQLI_ASSOC);
      mysqli_free_result($featured_results);
      
      //archive of all posts
      $stmo="SELECT * from posts ORDER BY id DESC";
      $results=mysqli_query($conn,$stmo);
      $archives=mysqli_fetch_all($results,MYSQLI_ASSOC);
      mysqli_free_result($results);
      // total num of posts
      
      //this section calculates the number of pages per 5 posts in each page
      $sql="SELECT * from posts";
      $posts=mysqli_query($conn,$sql);
      $postrows=mysqli_num_rows($posts);
      $lastpage=ceil($postrows/5);
      $n=$postrows;
      mysqli_free_result($posts);
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
  // close the connection
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
      <title></title>
      <style type="text/css">
         p{
         font-size: fit-width;
         }
         h2{
         font-family: 'Charm', cursive;
         }
         p{
         word-wrap: break-word;
         }
         .scrolling{
         overflow-y:scroll;
         height:200px;
         }
      </style>
   </head>
   <body>
      <div class='container'>
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
         <a class="navbar-brand" href="#"></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="contact.php">contact <span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="about.php">About.php<span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="addpost.php">addpost</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="posts.php">posts</a>
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
      <!--<img src='cover2.jpg' style='width:100%;'>-->
      <hr>
      <div class='container'>
         <div class='row'>
            <div class='col-md-7 col-sm-12'>
               <?php foreach ($pageno as $post):?>
               
               <h2 class='text-info'><?php echo $post['title'];?> [<?php echo $post['catogory'];?>]</h2>
               <p><img src="images/<?php echo $post['image'];?>" style='width: 100%;'></p>
      <p><?php echo $post['author'];?> <small class='text-muted'><?php echo $post['date_created'];?>.</small> <?php if(!isset($_GET['cato'])):?>|<span class="disqus-comment-count text-warning" data-disqus-url="http://localhost/blog/previewpost/<?php echo preg_replace('/\s+/', '-', $post['title']);?>/"> <!-- Count will be inserted here --> </span>|<?php endif;?></p>
               <p><?php echo $post['describtion'];?></p>
               <a href="previewpost/<?php echo preg_replace('/\s+/', '-', $post['title']);?>" class="btn btn-primary" >read more</a>
               <a href="delete.php?id=<?php echo $post['id'];?>" class="btn btn-danger" >delete</a>
               <a href="editpost.php?id=<?php echo $post['id'];?>" class="btn btn-warning" >edit</a>
            
               <hr>
               <?php endforeach;?>
               <?php if(!isset($_GET['cato'])):?>
               <form action="dashboard.php" method='post'>
                  <input type="hidden" name="page" value='<?php echo $page;?>'>
                  <?php if($page!=1):?>
                  <button class="btn btn-outline-dark" type='submit' name='previous'>Previous</button>
                  <?php endif;?>
                  <?php if($page==1):?>
                  <button class="btn btn-outline-dark disabled" type='submit' name='previous'>Previous</button>
                  <?php endif;?>
                  <?php if($page!=$lastpage):?>
                  <button class="btn btn-outline-dark" type='submit' name='next'>Next</button>
                  <?php endif;?>
                  <?php if($page==$lastpage):?>
                  <button class="btn btn-outline-dark disabled" type='submit' name='next'>Next</button>
                  <?php endif;?>
               </form>
               <?php endif;?>
               <br><br>
            </div>
            <div class='col-md-4 col-sm-12'>
               <br><br>
               <h2 class='text-dark'>Self Introduction</h2>
               <hr>
               <img src="images/genos.png" alt="" style='width:100%;' class='img-thumbnail'>
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
         </div>
      </div>
      <?php include('inc/footer.php');?>