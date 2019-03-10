<?php
include('inc/conn.php');
$cato_id=$_GET['id'];
$stm = "delete from catogory where id=".$cato_id;
if(mysqli_query($conn,$stm)){
    header("location:catogory.php");
  }
  else{
    echo 'error'.mysqli_error($conn);
  }
mysqli_free_result($res);
mysqli_close($conn);
?>