<html>
<head><title>����160:��������������� </title></head>
<body>
<h4 align="center">����160:��������������� </h4>

<form method="post"> 	
<table align="center">
<tr align="center">
 <td >
  <select align="center" name="searchtype"> 
  <option value="all">����</option>
  <option value="datetime">����</option>
  <option value="time">ʱ��</option>
  <option value="name">����</option>
  <option value="hometeam">����</option>
  <option value="guestteam">�Ͷ�</option>
</select></td>
<td >�ؼ���:</td>
<td> <input name="searchterm" type="text"></td>
<td> <input name="sousuo" type="submit" value="����"></td></tr>
<tr><td><input align="center" type="hidden" value="1" name="aaa"></td></tr>
</table>
</form>

<?php
  $searchtype=$_POST['searchtype'];
  // print_r($_POST); 
 //  echo $searchtype;
  $searchterm=$_POST['searchterm'];
  $searchterm= trim($searchterm);
 
$host='172.179.1.33';
$username='admin';
$password='xxzx160168';
$db_name='qiudui';
$tb_name='schedule';
$link=@mysql_connect($host,$username,$password);
@mysql_query("SET NAMES GBK");

mysql_select_db($db_name, $link);

if($_POST["aaa"])
{	
	
if($searchtype=='all')
{        
	if(strpos($searchterm,','))
	$keywords=explode(',',$searchterm);  
	elseif (strpos($searchterm,'��'))
  $keywords=explode('��',$searchterm);
  elseif (strpos($searchterm,'��'))
  $keywords=explode('��',$searchterm);
	else
	$keywords=explode(' ',$searchterm);

 {
  for($i=0;$i<count($keywords);$i++)           
   {
    if($i==0)                               
   $query = "select * from schedule where datetime like '%".$keywords[$i]."%' or time like '%".$keywords[$i]."%' or name like '%".$keywords[$i]."%' or hometeam like '%".$keywords[$i]."%' or guestteam like '%".$keywords[$i]."%'"; 
    else                                      
    $query = $query."UNION select * from schedule where datetime like '%".$keywords[$i]."%' or time like '%".$keywords[$i]."%' or name like '%".$keywords[$i]."%' or hometeam like '%".$keywords[$i]."%' or guestteam like '%".$keywords[$i]."%'"; 
   }
   $query.= "ORDER BY datetime DESC,time DESC";
  } 
}  

else
{
	if(strpos($searchterm,','))
	$keywords=explode(',',$searchterm);  
	elseif (strpos($searchterm,'��'))
  $keywords=explode('��',$searchterm);
  elseif (strpos($searchterm,'��'))
  $keywords=explode('��',$searchterm);
	else
	$keywords=explode(' ',$searchterm);
	
 {  
 	 for($i=0;$i<count($keywords);$i++)      
	 {
	 	if($i==0)
	  $query = "select * from schedule where $searchtype like '%".$keywords[$i]."%'";
	  else 
	  $query = $query."UNION select * from schedule where $searchtype like '%".$keywords[$i]."%'";
	 }
	  $query.= "ORDER BY datetime DESC,time DESC";
	}
}


	$result=mysql_query($query);
	echo mysql_error(); 
  $num_results = mysql_num_rows($result);
  echo '<p>һ���ҵ�'.$num_results.'����¼</p>';
  
echo "<h4 align='CENTER'>��������������</h4>";
echo "<table width='70%' border='1' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"; 
echo "<tr>";
echo "<th>���</th>";
echo "<th>����</th>";
echo "<th>ʱ��</th>";
echo "<th>����</th>";
echo "<th>����</th>";
echo "<th>�Ͷ�</th>";

echo "</tr>";

for ($i=0; $i<$num_results;$i++)
  {
     $row = mysql_fetch_assoc($result) ;
     $id = ($i+1);
     $datetime = htmlspecialchars(stripslashes($row['datetime']));
     $time = stripslashes($row['time']);
     $name = stripslashes($row['name']);
     $hometeam = stripslashes($row['hometeam']);
     $guestteam = stripslashes($row['guestteam']); 
  
  echo "<tr>";
  echo "<td>$id</td>";
  echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?datetime=$datetime'>$datetime</a></td>";
  echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?time=$time'>$time</a></td>";
  echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?name=$name'>$name</a></td>";
  echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?hometeam=$hometeam'>$hometeam</a></td>";
  echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?guestteam=$guestteam'>$guestteam</a></td>";
  echo "</tr>";
  }
echo "</table>";
}

elseif ($_GET['datetime']||$_GET['time']||$_GET['name']||$_GET['hometeam']||$_GET['guestteam'])
{
	$datetimee=$_GET['datetime'];$timee=$_GET['time'];$namee=$_GET['name'];$teame=$_GET['hometeam'] or $teame=$_GET['guestteam'];
	
	if($datetimee)
 {
	$query = "select * from schedule where datetime like '%".$datetimee."%'"; 
	$query.= "ORDER BY datetime DESC,time DESC";
	$result=mysql_query($query);
	echo mysql_error(); 
  $num_results = mysql_num_rows($result);
  echo '<p>һ���ҵ�'.$num_results.'����¼</p>';
  
	echo "<h4 align='CENTER'>��������������</h4>";
  echo "<table width='70%' border='1' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"; 
  echo "<tr>";
  echo "<th>���</th>";
  echo "<th>����</th>";
  echo "<th>ʱ��</th>";
  echo "<th>����</th>";
  echo "<th>����</th>";
  echo "<th>�Ͷ�</th>";
  echo "</tr>";
  
  for ($i=0; $i<$num_results;$i++)
     {
  	 $row = mysql_fetch_assoc($result) ;
     $id = ($i+1);
     $datetime = htmlspecialchars(stripslashes($row['datetime']));
     $time = stripslashes($row['time']);
     $name = stripslashes($row['name']);
     $hometeam = stripslashes($row['hometeam']);
     
     $guestteam = stripslashes($row['guestteam']);
     
      
  	
    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?datetime=$datetime'>$datetime</a></td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?time=$time'>$time</a></td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?name=$name'>$name</a></td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?hometeam=$hometeam'>$hometeam</a></td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?guestteam=$guestteam'>$guestteam</a></td>";
    echo "</tr>";
  	}
	}
	
	elseif($timee)
 {
	$query = "select * from schedule where time like '%".$timee."%'"; 
	$query.= "ORDER BY datetime DESC,time DESC";
	$result=mysql_query($query);
	echo mysql_error(); 
  $num_results = mysql_num_rows($result);
  echo '<p>һ���ҵ�'.$num_results.'����¼</p>';
  
	echo "<h4 align='CENTER'>��������������</h4>";
  echo "<table width='70%' border='1' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"; 
  echo "<tr>";
  echo "<th>���</th>";
  echo "<th>����</th>";
  echo "<th>ʱ��</th>";
  echo "<th>����</th>";
  echo "<th>����</th>";
  echo "<th>�Ͷ�</th>";
  echo "</tr>";
  
  for ($i=0; $i<$num_results;$i++)
     {
  	 $row = mysql_fetch_assoc($result) ;
     $id = ($i+1);
     $datetime = htmlspecialchars(stripslashes($row['datetime']));
     $time = stripslashes($row['time']);
     $name = stripslashes($row['name']);
     $hometeam = stripslashes($row['hometeam']);
     $guestteam = stripslashes($row['guestteam']);
      
  	
    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?datetime=$datetime'>$datetime</a></td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?time=$time'>$time</a></td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?name=$name'>$name</a></td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?hometeam=$hometeam'>$hometeam</a></td>";  
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?guestteam=$guestteam'>$guestteam</a></td>";
    echo "</tr>";
  	}
	}

	elseif($namee)
	{
	$query = "select * from schedule where name like '%".$namee."%'"; 
	$query.= "ORDER BY datetime DESC,time DESC";
	$result=mysql_query($query);
	echo mysql_error(); 
  $num_results = mysql_num_rows($result);
  echo '<p>һ���ҵ�'.$num_results.'����¼</p>';
  
	echo "<h4 align='CENTER'>��������������</h4>";
  echo "<table width='70%' border='1' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"; 
  echo "<tr>";
  echo "<th>���</th>";
  echo "<th>����</th>";
  echo "<th>ʱ��</th>";
  echo "<th>����</th>";
  echo "<th>����</th>";
  echo "<th>�Ͷ�</th>";
  echo "</tr>";
  
  for ($i=0; $i<$num_results;$i++)
     {
  	 $row = mysql_fetch_assoc($result) ;
     $id = ($i+1);
     $datetime = htmlspecialchars(stripslashes($row['datetime']));
     $time = stripslashes($row['time']);
     $name = stripslashes($row['name']);
     $hometeam = stripslashes($row['hometeam']);
     $guestteam = stripslashes($row['guestteam']);
     
      
  	
    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?datetime=$datetime'>$datetime</a></td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?time=$time'>$time</a></td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?name=$name'>$name</a></td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?hometeam=$hometeam'>$hometeam</a></td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?guestteam=$guestteam'>$guestteam</a></td>";
    echo "</tr>";
  	}
	}
	
  elseif($teame)
	{
	$query = "select * from schedule where guestteam like '%".$teame."%' or hometeam like '%".$teame."%'"; 
	$query.= "ORDER BY datetime DESC,time DESC";
	$result=mysql_query($query);
	echo mysql_error(); 
  $num_results = mysql_num_rows($result);
  echo '<p>һ���ҵ�'.$num_results.'����¼</p>';
  
	echo "<h4 align='CENTER'>��������������</h4>";
  echo "<table width='70%' border='1' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"; 
  echo "<tr>";
  echo "<th>���</th>";
  echo "<th>����</th>";
  echo "<th>ʱ��</th>";
  echo "<th>����</th>";
  echo "<th>����</th>";
  echo "<th>�Ͷ�</th>";
  echo "</tr>";
  
  for ($i=0; $i<$num_results;$i++)
     {
  	 $row = mysql_fetch_assoc($result) ;
     $id = ($i+1);
     $datetime = htmlspecialchars(stripslashes($row['datetime']));
     $time = stripslashes($row['time']);
     $name = stripslashes($row['name']);
     $hometeam = stripslashes($row['hometeam']);
     $guestteam = stripslashes($row['guestteam']);
     
      
  	
    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?datetime=$datetime'>$datetime</a></td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?time=$time'>$time</a></td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?name=$name'>$name</a></td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?hometeam=$hometeam'>$hometeam</a></td>";
    echo "<td><a href='http://172.179.1.33/mine/searchschedule.php?guestteam=$guestteam'>$guestteam</a></td>";
    echo "</tr>";
  	}
	}
	
}
else
echo "δ���������ؼ���!!!";
//echo " ";

?>
</body>
</html> 