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
if($Submit=="提交"){
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
     	echo "<font color=red>"."数据插入成功!!请检查数据是否正确！"."</font>"."<br>"."<br>"
     	."<a href='http://172.20.1.21/mine/Olympic/Olympic_insert'>点击此处继续插入数据</a>";
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