<?php session_start(); 
include("conn.php");

$Submit = isset($_POST['Submit']) ? trim($_POST['Submit']) : '';
$id = isset($_POST['id']) ? trim($_POST['id']) : '';
$olympic_year = isset($_POST['olympic_year']) ? trim($_POST['olympic_year']) : '';
$olympic_match_big = isset($_POST['olympic_match_big']) ? trim($_POST['olympic_match_big']) : '';
$olympic_match_small = isset($_POST['olympic_match_small']) ? trim($_POST['olympic_match_small']) : '';
$heldday = isset($_POST['heldday']) ? trim($_POST['heldday']) : '';
$heldtime = isset($_POST['heldtime']) ? trim($_POST['heldtime']) : '';
$matchname = isset($_POST['matchname']) ? trim($_POST['matchname']) : '';
$gym = isset($_POST['gym']) ? trim($_POST['gym']) : '';
$finals = isset($_POST['finals']) ? trim($_POST['finals']) : '';
$goldpoint = isset($_POST['goldpoint']) ? trim($_POST['goldpoint']) : '';

//print_r($_POST);
if($Submit=="�ύ"){
$sqlstr = "INSERT INTO olympic_match_detail ( 
					 id, olympic_year, olympic_match_big, olympic_match_small, heldday, heldtime, matchname, gym ,finals,goldpoint
					) VALUES (
					'$id' ,'$olympic_year', '$olympic_match_big' ,'$olympic_match_small' ,'$heldday' ,'$heldtime' ,'$matchname' ,'$gym' ,'$finals', '$goldpoint'
					)";
//echo "<br>";
echo $sqlstr;
$query=mysql_query( $sqlstr, $link ) or die(mysql_error());
if($query==true)
     {
     	echo "<br>";echo "<br>";
     	echo "<font color=red>"."���ݲ���ɹ�!!���������Ƿ���ȷ��"."</font>"."<br>"."<br>"
     	."<a href='http://172.20.1.21/mine/Olympic/Olympic_insert'>����˴�������������</a>";
     	//."�����������ݣ����˻����ڵ�ַ�����룺http://172.20.1.21/mine/football_insert/";
     	echo "<br>";
     	}
else
    {echo "���ݲ���ʧ��!!";}
/*
����������Զ���ת���������
$query=mysql_query("INSERT INTO myself_matches ( 
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