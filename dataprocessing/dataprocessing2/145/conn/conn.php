<?php 
$id=mysql_connect("localhost","admin","admin") or die('����ʧ��:' . mysql_error());
if(mysql_select_db("db_database06",$id))
  echo "���ݿ����ӳɹ�������";
  else
  echo ('���ݿ�ѡ��ʧ�ܡ�����:' . mysql_error());
mysql_query("set names gbk");
?>