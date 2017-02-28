<?php session_start(); include("conn.php");

if($Submit=="提交"){
//$query=mysql_query("insert into myself_matches ('id','day','time','typename','hometeam','points','guestteam','halfpoints','remarks')values('$id','$day','$time','$typename','$hometeam','$points','$guestteam','$halfpoints','$remarks')");}
//$query=mysql_query("insert into myself_matches (`id`,day,`time`,`typename`,`hometeam`,`points`,`guestteam`,`halfpoints`,`remarks`) values('$id','$day','$time','$typename','$hometeam','$points','$guestteam','$halfpoints','$remarks')"); }
//$sqlstr = "insert into myself_matches ( 'day','time','typename','hometeam','points','guestteam','halfpoints','remarks' ) values ('$day','$time','$typename','$hometeam','$points','$guestteam','$halfpoints','$remarks')";
$sqlstr = "INSERT INTO myself_matches ( 
					id, day, time, typename, hometeam, points, guestteam, halfpoints, remarks
					) VALUES (
					'$id', '$day' ,'$time' ,'$typename' ,'$hometeam' ,'$points' ,'$guestteam' ,'$halfpoints' ,'$remarks'  
					)";
echo "<br>".$sqlstr;
$query=mysql_query( $sqlstr, $link );
}
if($query){
echo "...数据添加成功了!!";
}else{echo "...数据插入失败了!!";};
mysql_close( $link );
?>