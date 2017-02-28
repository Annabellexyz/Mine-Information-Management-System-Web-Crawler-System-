<html><head>
<title>采集</title>
<meta http-equiv='content-type' content='text/html; charset=utf8_unicode_ci' />
</head>
<BODY>
<?php
error_reporting();
set_time_limit(0);
include_once("cprogbar.php");
include_once("function.php");
include_once('common.php');

//mysql_query("set names 'UTF-8'"); 
mysql_query('SET CHARACTER SET utf8');
	mysql_query('set character_set_client = utf8');
	mysql_query('set character_set_connection = GBK');
	mysql_query('set character_set_results = utf8'); 

  
$err=0;
$progbar=new CProgbar("采集任务");
print("<p><b>采集任务</b><br>".$progbar->show()."<p>");
$progbar->init();

if($par=='company')
{
$cid = 800;
$total = 1083; //总数多少？

while ($cid<=$total) 
{
$progbar->step();
$company_info='http://172.20.1.21/HK/openrice/HK2/sr1('.$cid.').htm'; //商家资料 修改
$str_all=file_get_contents($company_info);
//$str_all = str_replace('<meta http-equiv=\'content-type\' content=\'text/html; charset=UTF-8\' />', "<meta http-equiv='content-type' content='text/html; charset=big5' />", $str_all);
//echo $str_all;
if ((($pos0 = strpos($str_all,'var data ='))!= false)&&(($pos1 = strrpos($str_all,'return data'))!=false)){
$str = substr($str_all,$pos0+10,$pos1-$pos0-11);//echo $str;
 if ((($pos2 = strpos($str,'['))!= false)&&(($pos3 = strrpos($str,'}'))!=false))
 {
  $str = substr($str,$pos2+1,$pos3-$pos2-1);
 }
$str = trim($str);//截取字符串首尾的空格或其他字符 
//echo $str;
$strArray = explode('},',$str);

if(!empty($strArray[0])){

foreach ($strArray as $k => $v){
//&&(($pos5 = strrpos($str,'}'))!=false)	
 if((($pos4 = strpos($v,'id: '))!= false)&&(($pos5 = strrpos($v,',url'))!=false)&&(($pos6 = strrpos($v,'lat: '))!=false)&&
 (($pos7 = strrpos($v,',\'long'))!=false)&&(($pos8 = strrpos($v,',\'zoom'))!=false)&&(($pos9 = strrpos($v,'name: \''))!=false)&&
 (($pos10 = strrpos($v,'\',phone'))!=false)&&(($pos11 = strrpos($v,'\',categories: [\''))!=false)&&(($pos12 = strrpos($v,'\'],addr'))!=false))
 {
  $oid = substr($v,$pos4+4,$pos5-$pos4-4);
  $lat = substr($v,$pos6+5,$pos7-$pos6-5);
  //$long = substr($v,$pos7+7,$pos8-$pos7-6);
  $longs = substr($v,$pos7+9,$pos8-$pos7-9);
  $name = substr($v,$pos9+7,$pos10-$pos9-7);
  $phone = substr($v,$pos10+10,$pos11-$pos10-10);
  $phone = str_replace(" ","",$phone);
  $categories = substr($v,$pos11+16,$pos12-$pos11-16);
  $categories = str_replace("','","；",$categories);
  //$categories = addslashes($categories);
  //$name = addslashes($name);
  $addr = substr($v,$pos12+10,-1);
 }
 	
//$query=$db->query("select * from HK_openrice where (oid='$oid' and lat='$lat' and long='$long')");
//$query=$db->query("select * from HKopenrice where (oid='$oid' and name='$name')");
  $query=$db->query("select * from HKopenrice where oid='$oid'");
//$query=$db->query("select * from HKopenrice where oid='$oid' and name='$name'");
   if(!($db->num_rows($query)))
   {
     $query=$db->query("insert into HKopenrice(oid,lat,longs,name,phone,categories,addr) 
     values('$oid','$lat','$longs','$name','$phone','$categories','$addr')");
 
		if($db->affected_rows($query))
		{
			$successed=1;
		}
		else 
		{
			$successed=0;
		}
   if($successed) 
    { echo '成功采集'.$oid."编号的-".$name;echo "<br>";}
  }
  else
  {
  echo '<font color = red>'.$name.'</font>'.'已存在;'.'<br>';
  }
 }
}
 else 
 {
 	echo "找不到名称";echo "<br>";
 }
//}
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



