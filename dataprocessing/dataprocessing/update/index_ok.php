<?php session_start(); 
include("conn/conn.php");
     if($lmbs==true){
        $sid=$_POST[sid];
        $query=mysql_query("update tb_insert set name='$name',number='$number',tel='$tel',address='$address' where nid='$lmbs'");
        if($query==true){ echo "<script>alert('Ա�����ϸ��³ɹ�!!');window.location.href='http://localhost/dataprocessing/update/';</script>";
        }else{echo "����ʧ��!!";}
}
?>