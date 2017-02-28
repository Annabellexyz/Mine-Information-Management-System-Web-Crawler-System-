<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>PHPCMS系统质检数据输入结果（质检须登录） </title>
<script src="/member/login.php?action=abc"></script>
</head>
<body>
<?php 
  include("conn.php");
	$Submit = isset($_POST['Submit']) ? trim($_POST['Submit']) : '';
	$grade = isset($_POST['grade']) ? trim($_POST['grade']) : '';
	$remark = isset($_POST['remark']) ? trim($_POST['remark']) : '';
	$channelid = isset($_POST['channelid']) ? trim($_POST['channelid']) : '';
	$id = isset($_POST['id']) ? trim($_POST['id']) : '';
  $qualityuser = isset($_POST['qualityuser']) ? trim($_POST['qualityuser']) : '';
  //echo $channelid;
	
if(phpversion()>='5.1.0')
{ 
    //echo date_default_timezone_get();////获取php当前使用时区
    date_default_timezone_set('Asia/Shanghai'); //设置时区
}
$qualitytime = date("Y-m-d H:i:s");
echo "<pre>";print_r($_POST); echo "</pre>";
if($Submit=="提交"){
	if($channelid == "7")
	{	
	   if (!empty($qualityuser)){
				$query = "SELECT * FROM `phpcms_member` WHERE username = '$qualityuser'"; 
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result) OR die(mysql_error());
			  if($row[qualityvalue] == "1"){
			     $sqlstr = "UPDATE phpcms_article_7_new SET
							       grade = '$grade',remark = '$remark',qualitytime = '$qualitytime',qualityuser = '$qualityuser'
							       WHERE id = '$id' LIMIT 1";	
			  }
			  else {
			      echo "你没有质检权限！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
			  }
		 }
		 else {
	    	   echo "你没有登录系统！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
	   }	
	}
	elseif($channelid == "8")
	{	
	   if (!empty($qualityuser)){
				$query = "SELECT * FROM `phpcms_member` WHERE username = '$qualityuser'"; 
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result) OR die(mysql_error());
			  if($row[qualityvalue] == "1"){
			     $sqlstr = "UPDATE phpcms_article_8_new SET
							       grade = '$grade',remark = '$remark',qualitytime = '$qualitytime',qualityuser = '$qualityuser'
							       WHERE id = '$id' LIMIT 1";	
			  }
			  else {
			      echo "你没有质检权限！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
			  }
		 }
		 else {
	    	   echo "你没有登录系统！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
	   }	
	}
	elseif($channelid == "9")
	{	
	   if (!empty($qualityuser)){
				$query = "SELECT * FROM `phpcms_member` WHERE username = '$qualityuser'"; 
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result) OR die(mysql_error());
			  if($row[qualityvalue] == "1"){
			     $sqlstr = "UPDATE phpcms_article_9_new SET
							       grade = '$grade',remark = '$remark',qualitytime = '$qualitytime',qualityuser = '$qualityuser'
							       WHERE id = '$id' LIMIT 1";	
			  }
			  else {
			      echo "你没有质检权限！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
			  }
		 }
		 else {
	    	   echo "你没有登录系统！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
	   }	
	}
	elseif($channelid == "10")
	{	
	   if (!empty($qualityuser)){
				$query = "SELECT * FROM `phpcms_member` WHERE username = '$qualityuser'"; 
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result) OR die(mysql_error());
			  if($row[qualityvalue] == "1"){
			     $sqlstr = "UPDATE phpcms_article_10_new SET
							       grade = '$grade',remark = '$remark',qualitytime = '$qualitytime',qualityuser = '$qualityuser'
							       WHERE id = '$id' LIMIT 1";	
			  }
			  else {
			      echo "你没有质检权限！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
			  }
		 }
		 else {
	    	   echo "你没有登录系统！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
	   }	
	}
	elseif($channelid == "11")
	{	
	   if (!empty($qualityuser)){
				$query = "SELECT * FROM `phpcms_member` WHERE username = '$qualityuser'"; 
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result) OR die(mysql_error());
			  if($row[qualityvalue] == "1"){
			     $sqlstr = "UPDATE phpcms_article_11_new SET
							       grade = '$grade',remark = '$remark',qualitytime = '$qualitytime',qualityuser = '$qualityuser'
							       WHERE id = '$id' LIMIT 1";	
			  }
			  else {
			      echo "你没有质检权限！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
			  }
		 }
		 else {
	    	   echo "你没有登录系统！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
	   }	
	}
	elseif($channelid == "12")
	{	
	   if (!empty($qualityuser)){
				$query = "SELECT * FROM `phpcms_member` WHERE username = '$qualityuser'"; 
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result) OR die(mysql_error());
			  if($row[qualityvalue] == "1"){
			     $sqlstr = "UPDATE phpcms_article_12_new SET
							       grade = '$grade',remark = '$remark',qualitytime = '$qualitytime',qualityuser = '$qualityuser'
							       WHERE id = '$id' LIMIT 1";	
			  }
			  else {
			      echo "你没有质检权限！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
			  }
		 }
		 else {
	    	   echo "你没有登录系统！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
	   }	
	}
	elseif($channelid == "13")
	{	
	   if (!empty($qualityuser)){
				$query = "SELECT * FROM `phpcms_member` WHERE username = '$qualityuser'"; 
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result) OR die(mysql_error());
			  if($row[qualityvalue] == "1"){
			     $sqlstr = "UPDATE phpcms_article_13_new SET
							       grade = '$grade',remark = '$remark',qualitytime = '$qualitytime',qualityuser = '$qualityuser'
							       WHERE id = '$id' LIMIT 1";	
			  }
			  else {
			      echo "你没有质检权限！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
			  }
		 }
		 else {
	    	   echo "你没有登录系统！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
	   }	
	}
	elseif($channelid == "14")
	{	
	   if (!empty($qualityuser)){
				$query = "SELECT * FROM `phpcms_member` WHERE username = '$qualityuser'"; 
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result) OR die(mysql_error());
			  if($row[qualityvalue] == "1"){
			     $sqlstr = "UPDATE phpcms_article_14_new SET
							       grade = '$grade',remark = '$remark',qualitytime = '$qualitytime',qualityuser = '$qualityuser'
							       WHERE id = '$id' LIMIT 1";	
			  }
			  else {
			      echo "你没有质检权限！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
			  }
		 }
		 else {
	    	   echo "你没有登录系统！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
	   }	
	}
	elseif($channelid == "15")
	{	
	   if (!empty($qualityuser)){
				$query = "SELECT * FROM `phpcms_member` WHERE username = '$qualityuser'"; 
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result) OR die(mysql_error());
			  if($row[qualityvalue] == "1"){
			     $sqlstr = "UPDATE phpcms_article_15_new SET
							       grade = '$grade',remark = '$remark',qualitytime = '$qualitytime',qualityuser = '$qualityuser'
							       WHERE id = '$id' LIMIT 1";	
			  }
			  else {
			      echo "你没有质检权限！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
			  }
		 }
		 else {
	    	   echo "你没有登录系统！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
	   }	
	}
	elseif($channelid == "16")
	{	
	   if (!empty($qualityuser)){
				$query = "SELECT * FROM `phpcms_member` WHERE username = '$qualityuser'"; 
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result) OR die(mysql_error());
			  if($row[qualityvalue] == "1"){
			     $sqlstr = "UPDATE phpcms_article_16_new SET
							       grade = '$grade',remark = '$remark',qualitytime = '$qualitytime',qualityuser = '$qualityuser'
							       WHERE id = '$id' LIMIT 1";	
			  }
			  else {
			      echo "你没有质检权限！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
			  }
		 }
		 else {
	    	   echo "你没有登录系统！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
	   }	
	}
	else
	{	
	   if (!empty($qualityuser)){
				$query = "SELECT * FROM `phpcms_member` WHERE username = '$qualityuser'"; 
				$result = mysql_query($query);
				$row = mysql_fetch_assoc($result) OR die(mysql_error());
			  if($row[qualityvalue] == "1"){
			     $sqlstr = "UPDATE phpcms_article_18_new SET
							       grade = '$grade',remark = '$remark',qualitytime = '$qualitytime',qualityuser = '$qualityuser'
							       WHERE id = '$id' LIMIT 1";	
			  }
			  else {
			      echo "你没有质检权限！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
			  }
		 }
		 else {
	    	   echo "你没有登录系统！<a href='/mine/articles'>点击此处继续进行查询或质检！</a>";
	   }	
	}

echo $sqlstr;
$query=mysql_query( $sqlstr, $link ) or die(mysql_error());
//echo $query;
if($query==true){
     	echo "<br>";echo "<br>";
     	echo "<font color=red>"."质检数据插入成功!!请检查数据是否正确！"."</font>"."<br>"."<br>"
     	."<a href='/mine/articles'>点击此处继续进行质检！</a>";
 
     	echo "<br>";
  }
  else{
	    echo "数据插入失败!!";
	}
}

else
{echo "...未提交数据!!";};
mysql_close( $link );
?>
</body>
</html>