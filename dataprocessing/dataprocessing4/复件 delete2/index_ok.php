<?php session_start(); include("conn.php");
if($Submit==true){
     $result=mysql_query("delete from tb_insert where nid='$lmbs'");
	 if($result==true){echo "ɾ���ɹ�!";}else{echo "ɾ��ʧ��!!";}
}
?>