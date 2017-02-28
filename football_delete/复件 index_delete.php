<?php session_start(); include("conn.php");
$lmbs = isset($__GET['lmbs']) ? intval($__GET['lmbs']) : 0;
$Submit = isset($__POST['Submit']) ? trim($__POST['Submit']) : '';
/*$day = isset($_POST['day']) ? trim($_POST['day']) : '';
$time = isset($_POST['time']) ? trim($_POST['time']) : '';
$typename = isset($_POST['typename']) ? trim($_POST['typename']) : '';
$hometeam = isset($_POST['hometeam']) ? trim($_POST['hometeam']) : '';
$points = isset($_POST['points']) ? trim($_POST['points']) : '';
$guestteam = isset($_POST['guestteam']) ? trim($_POST['guestteam']) : '';
$halfpoints = isset($_POST['halfpoints']) ? trim($_POST['halfpoints']) : '';
$remarks = isset($_POST['remarks']) ? trim($_POST['remarks']) : '';
$hometeam_big = isset($_POST['hometeam_big']) ? trim($_POST['hometeam_big']) : '';
$guestteam_big = isset($_POST['guestteam_big']) ? trim($_POST['guestteam_big']) : '';*/
echo "<pre>";print_r($__POST);echo "</pre>";

if($Submit==true){
      $query=mysql_query("delete from myself_matches where id='$lmbs'");
	  if($query==true){ 
	  echo "<script>alert('É¾³ý³É¹¦!!'); window.location.href='index.php';</script>";
	  }else{
	  echo "<script>alert('É¾³ýÊ§°Ü!!'); window.location.href='index.php';</script>"; }
}
else 
echo "<br>"."Êý¾ÝÉ¾³ýÊ§°Ü£¡" ;
?>