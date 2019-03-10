<?php
include('inc/conn.php');
$curr_id=$_GET['id'];
$stm = "delete from posts where id=".$curr_id;
//$res=mysqli_query($conn,$stm);
if(mysqli_query($conn,$stm)){
    header('location:dashboard.php');
  }
  else{
    echo 'error'.mysqli_error($conn);
  }
mysqli_free_result($res);
mysqli_close($conn);
?>