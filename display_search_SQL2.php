<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160 Olympic�����������</title>
</head>
<body>

<?
	//�������ݿ�
	$host='localhost';
	$username='admin';
	$password='xxzx160168';
	$db_name='phpcms';
	$tb_name='olympic_match_detail';
		
	$link=@mysql_connect($host,$username,$password);
	mysql_query('set names gbk');
	mysql_select_db($db_name, $link);
	
	$ConditionsNumber=5; //����5��������
	$condition1 = isset($_POST['condition1']) ? trim($_POST['condition1']) : '';
	$condition2 = isset($_POST['condition2']) ? trim($_POST['condition2']) : '';
	$condition3 = isset($_POST['condition3']) ? trim($_POST['condition3']) : '';
	$condition4 = isset($_POST['condition4']) ? trim($_POST['condition4']) : '';
	$condition5 = isset($_POST['condition5']) ? trim($_POST['condition5']) : '';
	
	
	$ConditionsArray=array("$condition1","$condition2","$condition3","$condition4","$condition5");
	//�Ѹ�����������һ�������У���������ѭ������������������䣩
	//$SearchSQLArray=array(" where province='$condition1'"," where city like '%$condition2%'"," where xian='$condition3'"," where id='$condition4'"," where special like '%$condition5%'");
	$SearchSQLArray=array(" where olympic_year='$condition1'"," where olympic_match_big like '%$condition2%'"," where olympic_match_small='$condition3'"," where heldday like '%$condition4%'",
	" where (gym like '%$condition5%' or matchname like '%$condition5%' or goldpoint like '%$condition5%' or final like '%$condition5%')");
	//Ԥд��һЩSQL��䣬�����ٸ������������������������䣩

for($i=0;$i<$ConditionsNumber;$i++)
{
	if($ConditionsArray[$i]=="")
	$SearchSQLArray[$i]="";
	//��һ�������������ֵΪ�գ���Ӧ��SQL���Ϊ�ա�
	$haveWhere=false; //�衰����where������־�ĳ�ֵΪfalse��
	for($j=0;$j<$i;$j++)
	//�ӿ�ʼ��Ŀǰѭ����i����������Щwhere
	//��Ҫ��Ϊand��
	{
		$wherePosition=strpos($SearchSQLArray[$j],"where");
		//���iǰ���Ƿ���where���֡�
		if(($wherePosition=="1")&&($haveWhere==false))
		{
			$SearchSQLArray[$i]=ereg_replace("where","and",$SearchSQLArray[$i]);
			//where��λ��Ϊ1����ǰ������where��
			//��where����and��
			$haveWhere=true; //"����where������־��Ϊtrue��
		}
	}
};

	for($i=0;$i<$ConditionsNumber;$i++)
	$sql=$sql.$SearchSQLArray[$i];
	//$sql="select * from myself_matches".$sql.";"; 
	$sql="select * from olympic_match_detail".$sql."";
	//���SQL���
	echo $sql;
	
	
	$result=mysql_query($sql);
	echo mysql_error(); 
	$num_results = mysql_num_rows($result);
	echo '<p>һ���ҵ�'.$num_results.'����¼</p>';
	  
	echo "<h4 align='CENTER'>2008���������������</h4>";//������ͱ�ͷ
	echo "<table width='100%' border='1' FRAME='box' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"; 
	echo "<tr>";
	echo "<th width=8%>��������</th>";
	echo "<th width=11%>����С��</th>";
	echo "<th width=18%>��������</th>";
	echo "<th width=12%>����ʱ��</th>";
	echo "<th width=25%>������</th>";
	echo "<th width=14%>����</th>";
	echo "<th width=5%>����</th>";
	echo "<th width=7%>����</th>";
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
     
	  //�������¼(������)
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
