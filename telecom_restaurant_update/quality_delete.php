<?php session_start(); 
	$fpath = str_replace('\\', '/',substr(dirname(__FILE__), 0, -31));
	require_once $fpath.'/include/common.inc.php'; 
	//echo $fpath.'/include/common.inc.php';//����·���Ƿ���ȷ
  //include("conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160�������ݾ���ɾ��ϵͳ</title>
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
	if($Submit=="ɾ��"){
	      $query=mysql_query("delete from telecom_rework_restaurant where changeid='$lmbs'");
	      echo $query;
		  if($query==true){ 
		  echo "<script>alert('ɾ���ɹ�!!'); window.location.href='/mine/telecom_restaurant_update/index_quality.php';</script>";
		  }else{
		  echo "<script>alert('ɾ��ʧ��!!'); window.location.href='/mine/telecom_restaurant_update/index_quality.php';</script>"; }
	}
	else 
	echo "<br>"."�ύɾ��ʧ�ܣ�" ;
}
else
{echo "<br><font color=red>������¼������༭�ģ���û��Ȩ��ɾ����</font><br><a href='/mine/telecom_restaurant_update/index_quality.php'>����˴������鿴��������</a>";}
}
?>
</body>
</html>