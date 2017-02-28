<?php 
session_start(); 
//include("dateprocessing/conn.php");

$host='172.20.1.21';
$username='admin';
$password='xxzx160168';
$db_name='phpcms';
$tb_name='chinatelecom_page';
$link=mysql_connect($host,$username,$password);
if(mysql_select_db("phpcms",$link))
echo "连接数据库成功";
else
echo ('连接数据库失败:' . mysql_error());
@mysql_query("set names gbk");

// if ($Submit==true)
echo $Submit;
$hometeam = isset($_POST['hometeam']) ? trim($_POST['hometeam']) : '';
print_r($_POST['hometeam']);
echo $path1;
echo $path2;
echo $path3;
echo $path4;
echo $path5;
echo $path6;
echo $path7;
if($Submit=="提交")
 {
    for($i=0;$i<count($match_id);$i++)
  {
		$path=$_POST["id"][$i];
		$path1=$_POST["day"][$i];
		$path2=$_POST["time"][$i];
		$path3=$_POST["typename"][$i];
		$path4=$_POST["hometeam"][$i];
		$path5=$_POST["points"][$i];
		$path6=$_POST["guestteam"][$i];
		$path7=$_POST["halfpoints"][$i];
		$path8=$_POST["remarks"][$i];
		//$query=mysql_query("insert into chinatelecom_page (day,time,typename,hometeam,points,guestteam,halfpoints,remarks,data)values('$path','$path1','$path2','$path3','$path4','$path5','$path6','$path7','$path8')");
		$query=mysql_query("insert into chinatelecom_page (id,day,time,typename,hometeam,points,guestteam,halfpoints,remarks,data)values('$path','$path1','$path2','$path3','$path4','$path5','$path6','$path7','$path8','$data')");
	}
	if($query==true)
	{
		echo "成功!!";
	}
		else
	{
		echo "失败!!";
	}
}
else
echo "未提交数据";
?>