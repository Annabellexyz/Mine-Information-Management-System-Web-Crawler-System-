<?php 
$link=mysql_connect("localhost","admin","admin")or die('数据库连接失败:'. mysql_error());
if(mysql_select_db("phpcms",$link))
echo "连接成功";
else
echo ('连接失败:'. mysql_error());
mysql_query("set names gbk") or die("errors!")



?>