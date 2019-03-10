<?php include('inc/header.php');?>
<?php
include('inc/conn.php');
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
?>

<div class='row'>
  <div class='col-md-7 col-sm-12'>
    <h2 class='text-danger'> About page</h2>
    <hr>
    <img src='images/cover2.jpg' style='width:100%;'>
    <hr>
    Before I start losing myself in the excitement let me start off by why I decided to take on blogging. To start with I am not that of great of writer and English is my second language but I have always been inspired by my love for anime and the blogging community. Lately I started to think of blogging seriously but this is not to say this is the first time this idea came to me in fact It came to me a year ago but I dropped it until I would be able to create my own blogging site from scratch. This still remained until now when I created this site.
    <img src='images/about1.jpg' style='width:100%;'><br>
<h3><u>What to expect from this blog</u></h3>
I made this site to share my thoughts with you all and yet also deepen my anime knowledge to some extent. The site will be completely dedicated to anime reviews, recommendations and any other aspects that sort of relate to anime. In terms of posting I am not that strict but I will most likely be posting frequently and if I can't I will try posting once a week at the very least.As for now this is a little info about me.
<img src='images/about2.png' style='width:100%;'>
<br>Name: Night Ghoul

<br>Age:18

<br>Favorite color:black

<br>Main Motive for blogging:boredom<br><br>
  </div>

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
                              <a href="post.php?id=<?php echo $post['id'];?>">
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
  <?php include('inc/footer.php');?>