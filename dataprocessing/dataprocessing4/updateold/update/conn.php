<?php 
$link=mysql_connect("localhost","admin","admin")or die('���ݿ�����ʧ��:'. mysql_error());
if(mysql_select_db("phpcms",$link))
echo "���ӳɹ�";
else
echo ('����ʧ��:'. mysql_error());
mysql_query("set names gbk");





?>