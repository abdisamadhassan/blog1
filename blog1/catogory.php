<?php 
include('inc/conn.php');
$catogory="SELECT * from catogory";
$catogories=mysqli_query($conn,$catogory);
$cato=mysqli_fetch_all($catogories,MYSQLI_ASSOC);
mysqli_free_result($catogories);
mysqli_close($conn);
include('inc/header.php');
?>
<div class='col-md-10 col-sm-12'>
      <ul class="list-group list-unstyled">
       <li><a href='#' class="list-group-item list-group-item-success text-danger">catorgories</a></li>
          <?php foreach ($cato as $catogory):?>
      <li class="list-group-item d-flex justify-content-between align-items-center"><a href='dashboard.php?cato=<?php echo $catogory['catogory'];?>'><?php echo $catogory['catogory'];?>
        </a><br>
              <a href="deletecatogory.php?id=<?php echo $catogory['id'];?>" class="btn btn-danger" >delete</a><br>
      <a href="editcatogory.php?id=<?php echo $catogory['id'];?>" class="btn btn-warning" >edit</a>
  </li>
    <?php endforeach;?>
 </ul>
</div><br>
 <?php include('inc/footer.php');?>