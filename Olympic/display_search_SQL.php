<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160 2008���������������</title>
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
	
	$ConditionsNumber=6; //����6��������
	$condition1 = isset($_POST['condition1']) ? trim($_POST['condition1']) : '';
	$condition2 = isset($_POST['condition2']) ? trim($_POST['condition2']) : '';
	$condition3 = isset($_POST['condition3']) ? trim($_POST['condition3']) : '';
	$condition4 = isset($_POST['condition4']) ? trim($_POST['condition4']) : '';
	$condition5 = isset($_POST['condition5']) ? trim($_POST['condition5']) : '';
	$condition6 = isset($_POST['condition6']) ? trim($_POST['condition6']) : '';
	$ConditionsArray=array("$condition1","$condition2","$condition3","$condition4","$condition5","$condition6");
	//�Ѹ�����������һ�������У���������ѭ������������������䣩
	//$SearchSQLArray=array(" where province='$condition1'"," where city like '%$condition2%'"," where xian='$condition3'"," where id='$condition4'"," where special like '%$Condition6%'");
	$SearchSQLArray=array(" where olympic_year='$condition1'",
	" where olympic_match_big like '%$condition2%'",
	" where olympic_match_small like '%$condition3%'",
	" where heldday like '%$condition4%'",
	" where (finals like '%$condition5%' or goldpoint like '%$condition5%' or athlete like '%$condition5%')",
	" where (gym like '%$condition6%' or athlete like '%$condition6%' or heldtime like '%$condition6%'
	or athlete like '%$condition6%' or matchname like '%$condition6%')");

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
	//$sql="select * from olympic_match_detail".$sql."";
	$sql=" select * from olympic_match_detail".$sql." ORDER BY heldday ASC,heldtime ASC";
	//���SQL���
	//echo $sql;//��ӡ��ѯ���
	echo "<br>";
	
	
	$result=mysql_query($sql);
	echo mysql_error(); 
	$num_results = mysql_num_rows($result);
	echo "<a href='index.php'>����˴��ذ�����������ҳ��</a>";
	echo '<p>һ���ҵ�'.$num_results.'����¼</p>';
	  
	echo "<h4 align='CENTER'>2008�����������</h4>";//������ͱ�ͷ
	echo "<table width='100%' border='1' FRAME='box' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"; 
	echo "<tr>";
	echo "<th width=2%>���</th>";
	echo "<th width=8%>��������</th>";
	echo "<th width=10%>����С��</th>";
	echo "<th width=17%>��������</th>";
	echo "<th width=13%>����ʱ��</th>";
	echo "<th width=19%>������</th>";
	echo "<th width=14%>����</th>";
	echo "<th width=3%>����</th>";
	echo "<th width=3%>����</th>";
	echo "<th width=11%>�˶�Ա</th>";
	echo "</tr>";


for ($i=0; $i<$num_results;$i++)
{
	 $row = mysql_fetch_assoc($result) ;
	 //$id = ($i+1);
	 $id = htmlspecialchars(stripslashes($row['id']));
	 $olympic_match_big = stripslashes($row['olympic_match_big']);
	 $olympic_match_small = stripslashes($row['olympic_match_small']);
	 $heldday = stripslashes($row['heldday']);
	 $heldtime = stripslashes($row['heldtime']);
	 $matchname = stripslashes($row['matchname']);
	 $gym = stripslashes($row['gym']);
	 $finals = stripslashes($row['finals']);
	 $goldpoint = stripslashes($row['goldpoint']);
	 $athlete = stripslashes($row['athlete']);
     
	  //�������¼(������)
	  echo "<tr>";
	  echo "<td>$id</td>";
	  echo "<td>$olympic_match_big</td>";
	  echo "<td>$olympic_match_small</td>";
	  //echo "<td><a href=''>$olympic_match_big</a></td>";
	 // echo "<td><a href=''>$olympic_match_small</a></td>";
	  echo "<td>$heldday</td>";
	  echo "<td>$heldtime</td>";
	  echo "<td>$matchname</td>";
	  echo "<td>$gym</td>";
	  echo "<td>$finals</td>";
	  echo "<td>$goldpoint</td>";
	  echo "<td>$athlete</td>";
	  echo "</tr>";
}
echo "</table>";
echo "<br>";
echo "<p align=right><a href='index.php'>����˴��ذ�����������ҳ��</a></p>";
?>
</body>
</html>
