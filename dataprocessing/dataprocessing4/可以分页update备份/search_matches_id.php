<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
	<title>����160:�������������� </title></head>
<body>
<h4 align="center">����160:��������������� </h4>
<form method="post"> 	
<table align="center">
<tr align="center">
 <td >
  <select align="center" name="searchtype"> 
  <option value="all">���</option>
</select></td>
<td >�ؼ���:</td>
<td> <input name="searchterm" type="text"></td>
<td> <input name="sousuo" type="submit" value="����"></td></tr>
<tr><td><input align="center" type="hidden" value="1" name="aaa"></td></tr>
</table>
</form>
<?php
 $searchtype=$_POST['searchtype'];//������ʽ
 //print_r($_POST); 
// echo $searchtype;
 $searchterm=$_POST['searchterm'];//�����ؼ���
 $searchterm= trim($searchterm);//Strip whitespace (or other characters) from the beginning and end of a string
 //�������ݿ�
$host='172.16.1.61';
$username='admin';
$password='admin';
$db_name='phpcms';
$tb_name='myself_matches';
$link=@mysql_connect($host,$username,$password);
@mysql_query("SET NAMES GBK");//����

mysql_select_db($db_name, $link);

//if($_POST["aaa"])
//if (!empty($_REQUEST['aaa']))//������ύ�ؼ���
//{
	 //if($searchtype=='all')//ѡ���޹ؼ��ʵ�������ʽ
   
	//�ָ��ؼ���:����,�ո��    
	if(strpos($searchterm,','))
	   $keywords=explode(',',$searchterm);  
	elseif (strpos($searchterm,'��'))
  $keywords=explode('��',$searchterm);
  elseif (strpos($searchterm,'��'))
  $keywords=explode('��',$searchterm);
	else
	$keywords=explode(' ',$searchterm);
	
	 if (!empty($searchterm)) 
{		
 
{
  for($i=0;$i<count($keywords);$i++)           
   {
    if($i==0)    //ֻ��һ���ؼ��ʵ����                           
   //$query = "select * from football where datetime like '%".$keywords[$i]."%' or time like '%".$keywords[$i]."%' or name like '%".$keywords[$i]."%' or hometeam like '%".$keywords[$i]."%' or points like '%".$keywords[$i]."%' or guestteam like '%".$keywords[$i]."%' or halfpoints like '%".$keywords[$i]."%' or remarks like '%".$keywords[$i]."%'"; 
   $query = "select * from myself_matches where id like '%".$keywords[$i]."%'"; 
    else         //����ؼ��ʵ����                             
    $query = $query."UNION select * from myself_matches where id like '%".$keywords[$i]."%'"; 
   }
   $query.= "ORDER BY tid ASC";//����
 }
 // } 
  
//��ҳ
	$result=mysql_query($query);
	echo mysql_error(); 
  $num_results = mysql_num_rows($result);
  echo '<p>һ���ҵ�'.$num_results.'����¼</p>';
  
  echo "<h4 align='CENTER'>������������������</h4>";
	echo "<table width='75%' border='1' FRAME='box' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"; 
	echo "<tr>";
	echo "<th width='5%'>���</th>";
  echo "<th width='30%'>��ͨ��</th>";
  echo "<th width='30%'>������</th>";
  echo "<th width='35%'>Ӣ��</th>";
  echo "</tr>";
  echo "<tr>";
  echo "<td colspan=4>&nbsp;</td>";
	echo "</tr>";
	for ($i=0; $i<$num_results;$i++)
	//while( $row = mysql_fetch_array($rs) )

  {
     $row = mysql_fetch_assoc($result) ;
     $id = ($i+1);
     $tid = htmlspecialchars(stripslashes($row['tid']));
     $teamname = stripslashes($row['teamname']);
     $teamname_big = stripslashes($row['teamname_big']);
     $ename = stripslashes($row['ename']);
     $tintro = stripslashes($row['tintro']);
     
	   $url = stripslashes($row['url']);
      			
			echo "<tr>";
			echo "<td>";
			echo "</td>";
			echo "<td align=center>����������̣�</td>";
			echo "<td colspan=2 align=center>$url</td>";
			echo "</tr>";
			
			echo "<tr>";
			echo "<td align=center>$tid</td>";
			echo "<td>$teamname</td>";
			echo "<td>$teamname_big</td>";
			echo "<td>$ename</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<th align=center>��<br>��<br>��<br>��</th>";
			echo "<td colspan=3>$tintro</td>";
			echo "</tr>";
			echo "<tr>";
		  echo "<td colspan=4>&nbsp;</td>";
			echo "</tr>";
			//echo "</table>";		
	 //$i++;
   }	

 echo "</table>";  
 echo "<br>";  
}

else 
echo "δ������������ؼ���!!!";
   ?>
</body>
</html> 