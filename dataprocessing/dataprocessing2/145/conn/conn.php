<?php 
$id=mysql_connect("localhost","admin","admin") or die('连接失败:' . mysql_error());
if(mysql_select_db("db_database06",$id))
  echo "数据库连接成功。。。";
  else
  echo ('数据库选择失败。。。:' . mysql_error());
mysql_query("set names gbk");
?>