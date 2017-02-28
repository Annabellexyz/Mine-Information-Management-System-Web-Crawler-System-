<?php 
$link=mysql_connect("172.16.1.61","admin","admin") or die('连接失败:' . mysql_error());

mysql_query("set names gbk");
if(mysql_select_db("db_database06",$link))
  echo "数据库连接成功";
  else
  echo ('数据库选择失败:' . mysql_error());
?>