<?php 
$link=mysql_connect("172.16.1.61","admin","admin") or die('����ʧ��:' . mysql_error());

mysql_query("set names gbk");
if(mysql_select_db("db_database06",$link))
  echo "���ݿ����ӳɹ�";
  else
  echo ('���ݿ�ѡ��ʧ��:' . mysql_error());
?>