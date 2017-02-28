<?php
	$link=mysql_connect("localhost","admin","admin") or die("数据库连接失败".mysql_error());
	mysql_select_db("db_database18",$link);
	mysql_query("set names gb2312");
?>
