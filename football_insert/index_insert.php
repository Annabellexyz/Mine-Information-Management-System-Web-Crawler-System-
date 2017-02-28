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
if($Submit=="提交"){
//$query=mysql_query("insert into myself_matches ('id','day','time','typename','hometeam','points','guestteam','halfpoints','remarks')values('$id','$day','$time','$typename','$hometeam','$points','$guestteam','$halfpoints','$remarks')");}
//$query=mysql_query("insert into myself_matches (`id`,day,`time`,`typename`,`hometeam`,`points`,`guestteam`,`halfpoints`,`remarks`) values('$id','$day','$time','$typename','$hometeam','$points','$guestteam','$halfpoints','$remarks')"); }
//$sqlstr = "insert into myself_matches ( 'day','time','typename','hometeam','points','guestteam','halfpoints','remarks' ) values ('$day','$time','$typename','$hometeam','$points','$guestteam','$halfpoints','$remarks')";
$sqlstr = "INSERT INTO myself_matches ( 
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
     	echo "<font color=red>"."数据插入成功!!请检查数据是否正确！"."</font>"."<br>"."<br>"
     	."<a href='http://172.20.1.21/mine/football_insert'>点击此处继续插入数据</a>";
     	//."继续插入数据－后退或者在地址栏输入：http://172.20.1.21/mine/football_insert/";
     	echo "<br>";
     	}
else
    {echo "数据插入失败!!";}
/*
以下浏览器自动跳转到插入界面
$query=mysql_query("INSERT INTO myself_matches ( 
					id, day, time, typename, hometeam, points, guestteam, halfpoints, remarks
					) VALUES (
					'$id', '$day' ,'$time' ,'$typename' ,'$hometeam' ,'$points' ,'$guestteam' ,'$halfpoints' ,'$remarks'  
					)") or die(mysql_error());
        if($query==true)
        { echo "<script>alert('足球完场赛事资料插入成功!!');window.location.href='http://172.20.1.21/mine/football_insert/';</script>";
        }
        else
        {echo "数据插入失败!!";}*/


}

else
{echo "...未提交数据!!";};
mysql_close( $link );
?>