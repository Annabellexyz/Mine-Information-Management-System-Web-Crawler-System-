<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160 Olympic奥运输出数据</title>
</head>
<body>

<?
	//连接数据库
	$host='localhost';
	$username='admin';
	$password='xxzx160168';
	$db_name='phpcms';
	$tb_name='olympic_match_detail';
		
	$link=@mysql_connect($host,$username,$password);
	mysql_query('set names gbk');
	mysql_select_db($db_name, $link);
	
	$ConditionsNumber=5; //共有5个条件。
	$condition1 = isset($_POST['condition1']) ? trim($_POST['condition1']) : '';
	$condition2 = isset($_POST['condition2']) ? trim($_POST['condition2']) : '';
	$condition3 = isset($_POST['condition3']) ? trim($_POST['condition3']) : '';
	$condition4 = isset($_POST['condition4']) ? trim($_POST['condition4']) : '';
	$condition5 = isset($_POST['condition5']) ? trim($_POST['condition5']) : '';
	
	
	$ConditionsArray=array("$condition1","$condition2","$condition3","$condition4","$condition5");
	//把各个条件排入一个数组中，方便下面循环。（数组很容易扩充）
	//$SearchSQLArray=array(" where province='$condition1'"," where city like '%$condition2%'"," where xian='$condition3'"," where id='$condition4'"," where special like '%$condition5%'");
	$SearchSQLArray=array(" where olympic_year='$condition1'"," where olympic_match_big like '%$condition2%'"," where olympic_match_small='$condition3'"," where heldday like '%$condition4%'",
	" where (gym like '%$condition5%' or matchname like '%$condition5%' or goldpoint like '%$condition5%' or final like '%$condition5%')");
	//预写好一些SQL语句，下面再根据情况处理。（数组很容易扩充）

for($i=0;$i<$ConditionsNumber;$i++)
{
	if($ConditionsArray[$i]=="")
	$SearchSQLArray[$i]="";
	//第一步处理：如果条件值为空，相应的SQL语句为空。
	$haveWhere=false; //设“存在where”检查标志的初值为false。
	for($j=0;$j<$i;$j++)
	//从开始到目前循环的i，处理有哪些where
	//需要变为and。
	{
		$wherePosition=strpos($SearchSQLArray[$j],"where");
		//检查i前面是否有where出现。
		if(($wherePosition=="1")&&($haveWhere==false))
		{
			$SearchSQLArray[$i]=ereg_replace("where","and",$SearchSQLArray[$i]);
			//where的位置为1，且前面已有where。
			//则where换成and。
			$haveWhere=true; //"存在where”检查标志设为true。
		}
	}
};

	for($i=0;$i<$ConditionsNumber;$i++)
	$sql=$sql.$SearchSQLArray[$i];
	//$sql="select * from myself_matches".$sql.";"; 
	$sql="select * from olympic_match_detail".$sql."";
	//组成SQL语句
	echo $sql;
	
	
	$result=mysql_query($sql);
	echo mysql_error(); 
	$num_results = mysql_num_rows($result);
	echo '<p>一共找到'.$num_results.'条记录</p>';
	  
	echo "<h4 align='CENTER'>2008奥运赛事搜索结果</h4>";//画标题和表头
	echo "<table width='100%' border='1' FRAME='box' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"; 
	echo "<tr>";
	echo "<th width=8%>比赛大项</th>";
	echo "<th width=11%>比赛小项</th>";
	echo "<th width=18%>举行日期</th>";
	echo "<th width=12%>举行时间</th>";
	echo "<th width=25%>赛事名</th>";
	echo "<th width=14%>场馆</th>";
	echo "<th width=5%>决赛</th>";
	echo "<th width=7%>夺金点</th>";
	echo "</tr>";


for ($i=0; $i<$num_results;$i++)
{
	 $row = mysql_fetch_assoc($result) ;
	 //$id = ($i+1);
	 //$id = htmlspecialchars(stripslashes($row['id']));
	 $olympic_match_big = stripslashes($row['olympic_match_big']);
	 $olympic_match_small = stripslashes($row['olympic_match_small']);
	 $heldday = stripslashes($row['heldday']);
	 $heldtime = stripslashes($row['heldtime']);
	 $matchname = stripslashes($row['matchname']);
	 $gym = stripslashes($row['gym']);
	 $final = stripslashes($row['final']);
	 $goldpoint = stripslashes($row['goldpoint']);
     
	  //画输出记录(带链接)
	  echo "<tr>";
	  //echo "<td>$id</td>";
	  echo "<td><a href='http://172.179.1.33/mine/searchball.php?datetime=$datetime'>$olympic_match_big</a></td>";
	  echo "<td><a href='http://172.179.1.33/mine/searchball.php?datetime=$datetime'>$olympic_match_small</a></td>";
	  echo "<td><a href='http://172.179.1.33/mine/searchball.php?name=$name&match=$name'>$heldday</a></td>";
	  echo "<td>$heldtime</td>";
	  echo "<td>$matchname</td>";
	  echo "<td>$gym</td>";
	  echo "<td>$final</td>";
	  echo "<td>$goldpoint</td>";
	  echo "</tr>";
}
echo "</table>";

?>
</body>
</html>
