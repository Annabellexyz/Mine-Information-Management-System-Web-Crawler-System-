<?php session_start(); include("conn.php");

if($Submit=="�ύ"){
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
echo "...������ӳɹ���!!";
}else{echo "...���ݲ���ʧ����!!";};
mysql_close( $link );
?>