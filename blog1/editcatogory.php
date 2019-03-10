 <?php
 include('inc/conn.php');
 if(isset($_POST['editcato'])){
 if(isset($_POST['edit_id'])){
 $edit_id=mysqli_escape_string($conn,$_POST['edit_id']);
 $catogory=mysqli_escape_string($conn,$_POST['catogory']);
$stm = " update catogory SET
catogory='$catogory'
where id=". $edit_id;
if(mysqli_query($conn,$stm)){
     header("location:catogory.php");
  }
  else{
    echo 'error'.mysqli_error($conn);
  }
}
}
$cato_id=$_GET['id'];
  $catogory="SELECT * from catogory where id=".$cato_id;
$catogories=mysqli_query($conn,$catogory);
$cato=mysqli_fetch_assoc($catogories);
mysqli_free_result($catogories);
mysqli_close($conn);
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method='post'>
	 <div class="form-group">
    <input type="hidden" class="form-control" name='edit_id' value='<?php echo $_GET['id'];?>'>
  </div>
        <div class="form-group">
    <label for="catogory">change catogory:</label>
    <input type="text" class="form-control" id="catogory" name='catogory' value="<?php echo $cato['catogory'];?>">
  </div>
    <button type="submit" name='editcato' class="btn btn-dark">catogory</button>
  </form>