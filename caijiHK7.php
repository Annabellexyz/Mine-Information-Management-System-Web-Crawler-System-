<HTML>
<HEAD>
<TITLE>�ɼ���ۻ�ҳ</TITLE>
</HEAD>
<BODY>
<?php
error_reporting();
set_time_limit(0);
include_once("cprogbar.php");
include_once("function.php");
include_once('common.php');

$err=0;
$progbar=new CProgbar("�ɼ�����");
print("<p><b>�ɼ�����</b><br>".$progbar->show()."<p>");
$progbar->init();

if($par=='company')
{
$cid = 1;
$total = 2; //�������٣�

while ($cid<=$total) 
{
$progbar->step();
$company_info='http://172.20.1.21/HK/1/'.$cid.'.htm'; //�̼����� �޸�
$str_all=file_get_contents($company_info);
//echo $str_all;
if ((($pos0 = strpos($str_all,'���з���</a>'))!= false)&&(($posb = strrpos($str_all,'������ҳ'))!=false)){
$str = substr($str_all,$pos0,$posb-$pos0-8);//echo $str;

$pos = strpos($str,'</td>');
//$str1 = substr($str,$pos0,$pos);
$str1 = substr($str,0,$pos);//echo $str1;

$str2 = strip_tags($str1);//echo $str2;echo "<br>";
$posa = strpos($str2,'���з���');
$str3 = substr($str2,$posa+47);//echo $str3;

$categoryArray=explode("&nbsp;&gt;&nbsp;",$str3);//print_r($categoryArray);
$category1 = $categoryArray[0];$category1=trim($category1);//echo $category1;
$category2 = $categoryArray[1];$category2=trim($category2);//echo $category2;
$category3 = $categoryArray[2];$category3=trim($category3);//echo $category3;

$strArray = explode('<td width=425 class="black12" valign=top>',$str);

foreach ($strArray as $k => $v){
 if (($pos1 = strpos($v,'<font class="e06_result_cname">')) != false){	 	
 if (($pos2 = strpos($v,'</td>')) != false) {		
   $value = substr($v,0,$pos2);
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /*if (($pos5 = strpos($v,'geo_refno=')) != false){
  	 $geo_refno = substr($v,$pos5+10,10);
  }echo $geo_refno;echo "<br>";��λ�òɼ���Ż�ѿպŵ�Ҳ��ǰһ����ֵ�ĸ�ֵ*/
  if (($pos6 = strpos($v,'showHours(this,"')) != false){
  	 $str4 = substr($v,$pos6+16);//echo $str4;
  	 $pos7 = strpos($str4,'")');
  	 $businesstime = substr($str4,0,$pos7);//echo $businesstime;echo "<br>";
  }
  else{
  	 $businesstime = "0";
  }
  
   if (($pos5 = strpos($v,'geo_refno=')) != false){
	 $geo_refno = substr($v,$pos5+10,10);//echo $geo_refno;echo "<br>";
 }
 else{
  	 $geo_refno='0';//echo $geo_refno;echo "<br>";
  }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
	//$value = str_replace("<img src=\"http://iypsearch.yp.com.hk/iypbusiness_e08/sc/images/spacer.gif\" width=\"1\" height=\"5\">","",$value);
	$value = str_replace('<img src="http://iypsearch.yp.com.hk/iypbusiness_e08/sc/images/spacer.gif" width="1" height="5">','',$value);
	$value = str_replace('<img src="http://iypsearch.yp.com.hk/iypbusiness_e08/sc/images/spacer.gif" width="30" height="1">','',$value);
	$value = str_replace('&nbsp','',$value);
	$value = str_replace(';','',$value);
	///// $result = strip_tags($value);	
	//echo $value;echo "<br>";
   if ((($pos9 = strpos($value,'</font>'))&&($pos1 = strpos($value,'<font class="e06_result_cname">'))) != false) {
   //	$name = substr($value,$pos1+31,$pos9-$pos1-7);
   $name = substr($value,$pos1+31,$pos9-$pos1-31);
   	}
  //echo $name;echo "<br>";
   $resultArray = explode('�绰��',$value);
   $resultArray2 = array_shift($resultArray);
   //echo "<pre>";print_r($resultArray);echo "</pre>";
   foreach ($resultArray as $key => $result){
   //	echo $result;echo "<br>";echo "��������һ�����顣������";echo "<br>";
   $telephone = substr($result,0,9);$telephone=str_replace(" ","",$telephone);//echo "�绰��";echo $telephone;echo "<br>";
   	if (($pos4 = strpos($result,'���棺')) != false) { 		 	
	 	
	 	$fax = substr($result,$pos4+6,9);$fax=str_replace(" ","",$fax);//echo "���棺";echo $fax;echo "<br>";
	 	if (($pos8 = strpos($result,'�������')) != false) { 
	 	$address = substr($result,$pos4+15,$pos8-$pos4-15);//echo "��ַ��";	echo $address;echo "<br>";	 
	 }
	 else{
	 	$address = substr($result,$pos4+15);
	 }
	}
	 else{
	 	$fax='0';
 		if (($pos8 = strpos($result,'�������')) != false) { 
	  $address = substr($result,9,$pos10);//echo "��ַ��";	echo $address;echo "<br>"; 	
	 }
	  else{
	 $address = substr($result,9);
	 }
	}
   $name = addslashes($name);
$telephone = addslashes($telephone);
$category1 = addslashes($category1);
$category2 = addslashes($category2);
$category3 = addslashes($category3);
$fax = addslashes($fax);
$address = addslashes($address);
$businesstime = addslashes($businesstime);
 echo $name;echo "<br>";
echo $telephone;echo "<br>";
echo $fax;echo "<br>";
echo $category1;echo "<br>";
echo $category2;echo "<br>";
echo $category3;echo "<br>";
echo $address;echo "<br>";
echo $geo_refno;echo "<br>";
echo $businesstime;echo "<br>";echo "...........................";echo "<br>";
   
   
   }
 /*******  
 if (($pos5 = strpos($v,'geo_refno=')) != false){
	 $geo_refno = substr($v,$pos5+10,10);//echo $geo_refno;echo "<br>";
 }
 else{
  	 $geo_refno='0';//echo $geo_refno;echo "<br>";
  }
  *******/
    /*
$name = addslashes($name);
$telephone = addslashes($telephone);
$category1 = addslashes($category1);
$category2 = addslashes($category2);
$category3 = addslashes($category3);
$fax = addslashes($fax);
$address = addslashes($address);
$businesstime = addslashes($businesstime);/*
echo $name;echo "<br>";
echo $telephone;echo "<br>";
echo $fax;echo "<br>";
echo $category1;echo "<br>";
echo $address;echo "<br>";
echo $geo_refno;
echo $businesstime;echo "<br>";echo "...........................";echo "<br>";
/******************************************************************************
   $query=$db->query("select * from hongkongpage where (name='$name' and telephone='$telephone' and address='$address' and category1='$category1' and category2='$category2' and category3='$category3')");
  if(!($db->num_rows($query)))
  {
     $query=$db->query("insert into hongkongpage(name,telephone,fax,address,geo_refno,category1,category2,category3,businesstime) 
     values('$name','$telephone','$fax','$address','$geo_refno','$category1','$category2','$category3','$businesstime')");
 
		if($db->affected_rows($query))
		{
			$successed=1;
		}
		else 
		{
			$successed=0;
		}
   if($successed) echo '�ɹ��ɼ�'.$name.'������';echo "<br>";echo "<br>";
 }
 ******************************************************************************/

/******$query=$db->query("select * from hongkongpage where (name='$name' and telephone='$telephone' and 
category2='$category2' and category3='$category3')");
  if(!($db->num_rows($query)))
  {//����ظ�������
echo "select * from hongkongpage where (name='$name' and telephone='$telephone' and category2='$category2' and category3='$category3')";
exit();
    }*******/
 
}//if (($pos2 = strpos($v,'</td>')) != false)//����

}
 



//echo $name.$geo_refno.$businesstime."<br>"; 
   /*echo $geo_refno;echo "<br>";
$query=$db->query("insert into hongkongpage(name,telephone,fax,address,geo_refno,category1,category2,category3,businesstime) 
values('$name','$telephone','$fax','$address','$geo_refno','$category1','$category2','$category3','$businesstime')");
echo $geo_refno;echo "<br>";*/
}
//echo $name.$geo_refno.$businesstime."<br>"; 
$cid ++;
}//if (($pos0 = strpos($str_all,'���з���</a>'))!= false)
else 
{
$cid++;
continue;
}

echo $successed_1.' <br>';
}
$progbar->full();
$progbar->text("�ɼ�����1 ���");
}

else 
{
echo '��������ȷ��';
}
?>
</BODY>
</HTML>



