<?php 
$link=mysql_connect("172.16.1.61","admin","admin")or dir('����ʧ��:' . mysql_error());
if(mysql_select_db("myself_matches",$link))
echo "";
else
echo ('����ʧ��:' . mysql_error());
mysql_query("set names gbk");
?>