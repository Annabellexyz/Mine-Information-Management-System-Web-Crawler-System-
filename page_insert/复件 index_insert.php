<?php session_start(); 
include("conn.php");

$Submit = isset($_POST['Submit']) ? trim($_POST['Submit']) : '';
$day = isset($_POST['day']) ? trim($_POST['day']) : '';
$time = isset($_POST['time']) ? trim($_POST['time']) : '';
$typename = isset($_POST['typename']) ? trim($_POST['typename']) : '';
$hometeam = isset($_POST['hometeam']) ? trim($_POST['hometeam']) : '';
$points = isset($_POST['points']) ? trim($_POST['points']) : '';
$guestteam = isset($_POST['guestteam']) ? trim($_POST['guestteam']) : '';
$halfpoints = isset($_POST['halfpoints']) ? trim($_POST['halfpoints']) : '';
$remarks = isset($_POST['remarks']) ? trim($_POST['remarks']) : '';

//print_r($_POST);
if($Submit=="�ύ"){
//$query=mysql_query("insert into chinatelecom_page ('id','day','time','typename','hometeam','points','guestteam','halfpoints','remarks')values('$id','$day','$time','$typename','$hometeam','$points','$guestteam','$halfpoints','$remarks')");}
//$query=mysql_query("insert into chinatelecom_page (`id`,day,`time`,`typename`,`hometeam`,`points`,`guestteam`,`halfpoints`,`remarks`) values('$id','$day','$time','$typename','$hometeam','$points','$guestteam','$halfpoints','$remarks')"); }
//$sqlstr = "insert into chinatelecom_page ( 'day','time','typename','hometeam','points','guestteam','halfpoints','remarks' ) values ('$day','$time','$typename','$hometeam','$points','$guestteam','$halfpoints','$remarks')";
$sqlstr = "INSERT INTO chinatelecom_page ( 
					 day, time, typename, hometeam, points, guestteam, halfpoints, remarks
					) VALUES (
					'$day' ,'$time', '$typename' ,'$hometeam' ,'$points' ,'$guestteam' ,'$halfpoints' ,'$remarks'  
					)";
//echo "<br>";
echo $sqlstr;
$query=mysql_query( $sqlstr, $link ) or die(mysql_error());
if($query==true)
     {
     	echo "<br>";echo "<br>";
     	echo "<font color=red>"."���ݲ���ɹ�!!���������Ƿ���ȷ��"."</font>"."<br>"."<br>"
     	."<a href='/mine/page_insert'>����˴�������������</a>";
     	//."�����������ݣ����˻����ڵ�ַ�����룺http://172.20.1.21/mine/football_insert/";
     	echo "<br>";
     	}
else
    {echo "���ݲ���ʧ��!!";}
/*
����������Զ���ת���������
$query=mysql_query("INSERT INTO chinatelecom_page ( 
					id, day, time, typename, hometeam, points, guestteam, halfpoints, remarks
					) VALUES (
					'$id', '$day' ,'$time' ,'$typename' ,'$hometeam' ,'$points' ,'$guestteam' ,'$halfpoints' ,'$remarks'  
					)") or die(mysql_error());
        if($query==true)
        { echo "<script>alert('�����곡�������ϲ���ɹ�!!');window.location.href='http://172.20.1.21/mine/football_insert/';</script>";
        }
        else
        {echo "���ݲ���ʧ��!!";}*/


}

else
{echo "...δ�ύ����!!";};
mysql_close( $link );
?>