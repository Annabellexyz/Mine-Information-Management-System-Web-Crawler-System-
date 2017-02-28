<HTML>
<HEAD>
<TITLE>采集深圳信用网大厦企业信息</TITLE>
</HEAD>
<BODY>
<?php
error_reporting();
set_time_limit(0);
include_once("cprogbar.php");
include_once("function.php");
include_once('common.php');

$err=0;
$progbar=new CProgbar("采集任务");
print("<p><b>采集任务</b><br>".$progbar->show()."<p>");
$progbar->init();
/*此程序跟采集信用网信息caijiSZcredit.php一样，只是按照大厦采集*/
if($par=='company')
{
$cid = 40;
$total = 40; //总数多少？

while ($cid<=$total) 
{
$progbar->step();
$company_info='http://172.20.1.21/HK/edifice/19/'.$cid.'.htm'; //商家资料 修改
//$company_info='http://172.20.1.21/HK/edifice/2/61.htm'; //商家资料 修改
$str_all=file_get_contents($company_info);
//echo $str_all;
if ((($pos0 = strpos($str_all,'<td>变更资料</td>'))!= false)&&(($pos1 = strrpos($str_all,'</table></td>'))!=false)){
$str = substr($str_all,$pos0+17,$pos1-$pos0-17);//echo $str;
$str = str_replace(' style="background-color:#F7F7DE;"','',$str);
$str = str_replace(' style="background-color:White;"','',$str);
$str = str_replace(' class="cpx12lan2" style="color:Red;text-decoration:underline;"','',$str);
$str = str_replace(' style="color:Blue;"','',$str);
//echo $str;

$strArray = explode('</tr><tr>',$str);
foreach ($strArray as $k => $v){
 $companyArray = explode('<td>',$v);//echo "<pre>";print_r($companyArray);echo "</pre>";
 if (!empty($companyArray[1])) 
 {
 	if (($pos2 = strpos($companyArray[5],'</tr>'))!= false)
 	{
 		$companyArray[5] = substr($companyArray[5],0,$pos2-8);
 	}
 	$name = $companyArray[1]; $name = str_replace('</td>','',$name);
 	$person = $companyArray[2]; $person = str_replace('</td>','',$person);
 	$types = $companyArray[3]; $types = str_replace('</td>','',$types);
 	$detail = $companyArray[4]; $detail = str_replace('</td>','',$detail);
 	$changes = $companyArray[5]; $changes = str_replace('</td>','',$changes); 
 	/*
 	echo $name;echo "<br>";
 	echo $person;echo "<br>";
 	echo $types;echo "<br>";
 	echo $detail;echo "<br>";
 	echo $changes;echo "<br>";echo "<br>";*/
 	
 	    $query=$db->query("select * from credit_edifice where (name='$name' and person='$person' and types='$types')");
   if(!($db->num_rows($query)))
   {
     $query=$db->query("insert into credit_edifice(area,edifice,name,person,types,detail,changes) 
     values('嘉宾路','熙龙大厦','$name','$person','$types','$detail','$changes')");
 
		if($db->affected_rows($query))
		{
			$successed=1;
		}
		else 
		{
			$successed=0;
		}
   if($successed) 
    { echo '成功采集'.$name;echo "<br>";}
  }
  else
  {
  echo '<font color = red>'.$name.'</font>'.'已存在;'.'<br>';
  }
 }
 else 
 {
 	echo "企业名称为空";echo "<br>";
 }
}
$cid ++;
}//if (($pos0 = strpos($str_all,'所有分类</a>'))!= false)
else 
{
$cid++;
continue;
}

echo $successed_1.' <br>';
}
$progbar->full();
$progbar->text("采集任务1 完成");
}

else 
{
echo '参数不正确！';
}
?>
</BODY>
</HTML>



