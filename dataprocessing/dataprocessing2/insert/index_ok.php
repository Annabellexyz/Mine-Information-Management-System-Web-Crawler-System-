<?php session_start(); include("conn.php");


if($Submit=="提交"){
//$query=mysql_query("insert into myself_matches ('id','day','time','typename','hometeam','points','guestteam','halfpoints','remarks')values('$id','$day','$time','$typename','$hometeam','$points','$guestteam','$halfpoints','$remarks')");}
//$query=mysql_query("insert into myself_matches (`id`,day,`time`,`typename`,`hometeam`,`points`,`guestteam`,`halfpoints`,`remarks`) values('$id','$day','$time','$typename','$hometeam','$points','$guestteam','$halfpoints','$remarks')"); }
$query=mysql_query("insert into myself_matches (id) values($id),$link"); 
}
if($query==true){
echo "...数据添加成功!!";
}else{echo "...数据插入失败!!";};
	mysql_close( $link );
?>