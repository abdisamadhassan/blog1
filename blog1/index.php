<?php include('header.php');?>
<?php
include('conn.php');
$sql = "SELECT * from posts LIMIT 5";
$results=mysqli_query($conn,$sql);
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

mysqli_close($conn);
?>
<h2 class='text-danger'>posts</h2>
<hr>
<div class='row'>
  <div class='col-md-7 col-sm-12'>
        <div>
          <h2 class='text-info'>top new ten anime in 2018</h2>
           <img src='boruto.jpg' style='width:100%;'>
           bdkjbajbvjbqjvbnqbmnbvnabnbnbsnbnabnbnbanbsnbanbasnbnbbdk
           jbajbvjbqjvbnqbmnbvnabnbnbsnbnabnbnbanbsnbanbasnb
           nbbdkjbajbvjbqjvbnqbmnbvnabnbnbsnbna
           bnbnbanbsnbanbasnbnbbdkjbajbvjbqj
           vbnqbmnbvnabnbnbsnbnabnbnbanbsnbanbasnbnbbdkjbajbvjb
           qjvbnqbmnbvnabnbnbsnbnabnbnbanbsnbanbasnbnb<br>
           <button class="btn btn-primary">read more</button>
           <hr>
    </div>
    <div>
          <h2 class='text-info'">top new ten anime in 2018</h2>
           <img src='boruto2.jpg' style='width:100%;'>
           bdkjbajbvjbqjvbnqbmnbvnabnbnbsnbnabnbnbanbsnbanbasnbnbbdk
           jbajbvjbqjvbnqbmnbvnabnbnbsnbnabnbnbanbsnbanbasnb
           nbbdkjbajbvjbqjvbnqbmnbvnabnbnbsnbna
           bnbnbanbsnbanbasnbnbbdkjbajbvjbqj
           vbnqbmnbvnabnbnbsnbnabnbnbanbsnbanbasnbnbbdkjbajbvjb
           qjvbnqbmnbvnabnbnbsnbnabnbnbanbsnbanbasnbnb<br>
           <button class="btn btn-primary">read more</button>
           <hr>
    </div>
    <?php foreach ($posts as $post):?>
      <p><?php echo $post['title'];?></p>
      <p><?php echo $post['image'];?></p>
      <p><?php echo $post['author'];?><small><?php echo $post['date_created'];?></small></p>
      <p><?php echo $post['describtion'];?></p>
      <a href="post.php?id=<?php echo $post['id'];?>" class="btn btn-primary" >read more</a>
      <hr>
    <?php endforeach;?>
  </div>

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
</div>
</div>
  </div>
  <?php include('footer.php');?>