<?php 
$link=mysql_connect("localhost","admin","xxzx160168") or die('连接失败:' . mysql_error());

mysql_query("set names gbk");
if(mysql_select_db("phpcms",$link))
  echo "数据库连接成功"."<br>";
  //echo "<br>";
  else
  echo ('数据库选择失败:' . mysql_error());
?>