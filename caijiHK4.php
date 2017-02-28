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
$total=2; //总数多少？

while ($cid<=$total) 
{
$progbar->step();
$company_info='http://172.20.1.21/HK/99/'.$cid.'.htm'; //商家资料 修改
$str_all=file_get_contents($company_info);
//echo $str_all;
if ((($pos0 = strpos($str_all,'所有分类</a>'))!= false)&&(($posb = strrpos($str_all,'返回上页'))!=false)){
$str = substr($str_all,$pos0,$posb-$pos0-8);//echo $str;

$pos = strpos($str,'</TD>');
//$str1 = substr($str,$pos0,$pos);
$str1 = substr($str,0,$pos);//echo $str1;

$str2 = strip_tags($str1);//echo $str2;echo "<br>";
$posa = strpos($str2,'所有分类');
$str3 = substr($str2,$posa+47);//echo $str3;

$categoryArray=explode("&nbsp;&gt;&nbsp;",$str3);//print_r($categoryArray);
$category1 = $categoryArray[0];$category1=trim($category1);//echo $category1;
$category2 = $categoryArray[1];$category2=trim($category2);
$category3 = $categoryArray[2];$category3=trim($category3);//echo $str;

$strArray = explode('<td width=425 class="black12" valign=top>',$str);

foreach ($strArray as $k => $v){
 if (($pos1 = strpos($v,'<font class="e06_result_cname">')) != false){	 	
 if (($pos2 = strpos($v,'</td>')) != false) {		
   $value = substr($v,0,$pos2);
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /*if (($pos5 = strpos($v,'geo_refno=')) != false){
  	 $geo_refno = substr($v,$pos5+10,10);
  }echo $geo_refno;echo "<br>";此位置采集编号会把空号的也用前一个有值的赋值*/
  if (($pos6 = strpos($v,'showHours(this,"')) != false){
  	 $str4 = substr($v,$pos6+16);//echo $str4;
  	 $pos7 = strpos($str4,'")');
  	 $businesstime = substr($str4,0,$pos7);//echo $businesstime;echo "<br>";
  }
  else{
  	 $businesstime = " ";
  }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
	 $result = strip_tags($value);	//echo $result;echo "<br>";
/*	 
	 $pos3 = strpos($result,'电话：&nbsp;');
	 $name = substr($result,0,$pos3);//echo $name;echo "<br>";
	 $telephone = substr($result,$pos3+12,9);$telephone=str_replace(" ","",$telephone);//echo $telephone;echo "<br>";
*/
	 if (($pos3 = strpos($result,'电话：&nbsp;')) != false) { 		 	
	 	$name = substr($result,0,$pos3);//echo $name;echo "<br>";
	 $telephone = substr($result,$pos3+12,9);$telephone=str_replace(" ","",$telephone);//echo $telephone;echo "<br>";
	 	}
	 if (($pos4 = strpos($result,'传真：')) != false) { 		 	
	 	$fax = substr($result,$pos4+6,9);$fax=str_replace(" ","",$fax);//echo $fax;echo "<br>";
	 	$address = substr($result,$pos4+15);	
	 	$address=str_replace("&nbsp;&nbsp;&nbsp","",$address); //	echo $address;echo "<br>";
	 	}
	 else{
	 	$fax='0';
	 	$address = substr($result,$pos3+21); //	echo $address;echo "<br>";
	 	$address=str_replace("&nbsp;&nbsp;&nbsp","",$address);
	 	}
 // }	
 if (($pos5 = strpos($v,'geo_refno=')) != false){
	 $geo_refno = substr($v,$pos5+10,10);//echo $geo_refno;echo "<br>";
 }
 else{
  	 $geo_refno='0';//echo $geo_refno;echo "<br>";
  }
 /*
echo $geo_refno;echo "<br>";
$query=$db->query("insert into hkpages(name,telephone,fax,address,geo_refno,category1,category2,category3,businesstime) 
values('$name','$telephone','$fax','$address','$geo_refno','$category1','$category2','$category3','$businesstime')");
echo $geo_refno;echo "<br>";*/
 
   $query=$db->query("select * from hkpages where (name='$name' and telephone='$telephone' and category2='$category2' and category3='$category3')");
  if(!($db->num_rows($query)))
  {
     $query=$db->query("insert into hkpages(name,telephone,fax,address,geo_refno,category1,category2,category3,businesstime) 
     values('$name','$telephone','$fax','$address','$geo_refno','$category1','$category2','$category3','$businesstime')");
 
		if($db->affected_rows($query))
		{
			$successed=1;
		}
		else 
		{
			$successed=0;
		}
   if($successed) echo '成功采集'.$name.'的数据';echo "<br>";
 } 
 
}//if (($pos2 = strpos($v,'</td>')) != false)//后来

}
 



//echo $name.$geo_refno.$businesstime."<br>"; 
   /*echo $geo_refno;echo "<br>";
$query=$db->query("insert into hkpages(name,telephone,fax,address,geo_refno,category1,category2,category3,businesstime) 
values('$name','$telephone','$fax','$address','$geo_refno','$category1','$category2','$category3','$businesstime')");
echo $geo_refno;echo "<br>";*/
}
//echo $name.$geo_refno.$businesstime."<br>"; 
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



