<HTML>
<HEAD>
<TITLE>采集香港黄页</TITLE>
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

if($par=='company')
{
$cid = 1;
$total=99; //总数多少？

while ($cid<=$total) 
{
$progbar->step();
$company_info='http://172.20.1.21/HK/'.$cid.'.htm'; //商家资料 修改
$str_all=file_get_contents($company_info);
echo $str_all;
if (($pos0 = strpos($str_all,'所有分类</a>'))!== false)
{
$str = substr($str_all,$pos0);
$pos = strpos($str,'</td>');
$str1 = substr($str,$pos0,$pos);
$str2 = strip_tags($str1);
$posa = strpos($str2,'所有分类  >  ');
$str3 = substr($str2,$posa+13);
 if ((($posb = strpos($str3,'  >  '))!== false)&&(($posc = strrpos($str3,'  >  '))!==false)){
  $category1 = substr($str3,0,$posb); 
  $category2 = substr($str3,$posb+5,$posc-$posb-5); 
  $category3 = substr($str3,$posc+5);
 }

$strArray=explode('<td width=425 class=\"black12\" valign=top>',$str);
foreach ($strArray as $k => $v)
{
 if (($pos1 = strpos($v,'<font class=\"e06_result_cname\">')) !== false)   {	

	if (($pos2 = strpos($v,'</td>')) !== false) {		
	 $value = substr($v,0,$pos2);
	 $result = strip_tags($value);	
	 $pos3 = strpos($result,'电话： ');
	 $name = substr($result,0,$pos3);
	 $telephone = substr($result,$pos3+7,9);
	 if (($pos4 = strpos($result,'传真：')) !== false) { 		 	
	 	$fax = substr($result,$pos4+6,9);
	 	$address = substr($result,$pos4+15);	 	
	 	}
	 else{
	 	$fax = " ";
	 	$address = substr($result,$pos3+16); 
	 	}
  }	
  if (($pos5 = strpos($v,'geo_refno=')) !== false){
  	 $geo_refno = substr($v,$pos5+10,10);
  }
  if (($pos6 = strpos($v,'showHours(this,"')) !== false){
  	 $str4 = substr($v,$pos6+16);
  	 $pos7 = strpos($str4,'")');
  	 $businesstime = substr($str4,0,$pos7-2);
  }
 //} 
}
$query=$db->query("select * from hkpages where name='$name' and category2='$category2'");
if($db->num_rows($query))
{	
 $query=$db->query("insert into hkpages(name,telephone,fax,address,geo_refno,category1,category2,category3,businesstime) 
 values('$name','$telephone','$fax','$address','$geo_refno','$category1','$category2','$category3','$businesstime')");
 }
}
$cid ++;
}
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



