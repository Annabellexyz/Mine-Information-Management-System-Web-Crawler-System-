<?php session_start(); 
	$fpath = str_replace('\\', '/',substr(dirname(__FILE__), 0, -31));
	require_once $fpath.'/include/common.inc.php'; 
	//echo $fpath.'/include/common.inc.php';//测试路径是否正确
  //include("conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160餐饮数据纠错删除系统</title>
<script src="/member/login.php?action=abc"></script>
</head>
<body>
<?
$lmbs = isset($__GET['lmbs']) ? intval($__GET['lmbs']) : 0;
$Submit = isset($__POST['Submit']) ? trim($__POST['Submit']) : '';
$editor_new = isset($_POST['editor']) ? trim($_POST['editor']) : '';

$result=mysql_query("SELECT editor from telecom_rework_restaurant where changeid='$lmbs'");

while ($row = mysql_fetch_assoc($result)){
	$editor_old = stripslashes($row['editor']);

if($editor_new == $editor_old)
{
	if($Submit=="删除"){
	      $query=mysql_query("delete from telecom_rework_restaurant where changeid='$lmbs'");
	      echo $query;
		  if($query==true){ 
		  echo "<script>alert('删除成功!!'); window.location.href='/mine/telecom_restaurant_update/index_quality.php';</script>";
		  }else{
		  echo "<script>alert('删除失败!!'); window.location.href='/mine/telecom_restaurant_update/index_quality.php';</script>"; }
	}
	else 
	echo "<br>"."提交删除失败！" ;
}
else
{echo "<br><font color=red>这条记录不是你编辑的，你没有权利删除！</font><br><a href='/mine/telecom_restaurant_update/index_quality.php'>点击此处继续查看纠错数据</a>";}
}
?>
</body>
</html>