<?php session_start(); 
include("conn.php");
     if($lmbs==true){
        $sid=$_POST[sid];
        $query=mysql_query("update matches set id='$id',day='$day',time='$time',typename='$typename',hometeam='$hometeam',points='$points',guestteam='$guestteam',halfpoints='$halfpoints',remarks='$remarks' where id='$lmbs'");
        if($query==true){ echo "<script>alert('�����곡�������ϸ��³ɹ�!!');window.location.href='http://localhost/dataprocessing4/update/';</script>";
        }else{echo "����ʧ��!!";}
}
?>