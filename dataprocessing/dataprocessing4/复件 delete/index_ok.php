<?php session_start(); include("conn.php");
if($Submit==true){
      $query=mysql_query("delete from tb_insert where id='$lmbs'");
	  if($query==true){ 
	  echo "<script>alert('É¾³ý³É¹¦!!'); window.location.href='index.php';</script>";
	  }else{
	  echo "<script>alert('É¾³ýÊ§°Ü!!'); window.location.href='index.php';</script>"; }
}
?>