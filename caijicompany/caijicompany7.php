<HTML>
<HEAD>
<TITLE>�ɼ��̼���ҳ</TITLE>


<?php
set_time_limit(0);
include_once("cprogbar.php");
//include_once("function.php");
include_once('common.php');

$err=0;
$progbar=new CProgbar("�ɼ�����");

print("<p><b>�ɼ�����</b><br>".$progbar->show()."<p>");
$progbar->init();

if($par=='company')
{
$cid=759083;
$total=759083; //����939859
//$cid=str_pad($cid,6, "0", STR_PAD_LEFT); 
//$total=str_pad($total,6, "0", STR_PAD_LEFT); 

//while ($teamid<=$total) 
while ($cid<=$total) 
{
$progbar->step();
$cid=str_pad($cid,6, "0", STR_PAD_LEFT); 
$company_info='http://'.$cid.'.ecbay.cn'; //�̼�����
$str=file_get_contents($company_info);
//echo $str;
if ((($pos1 = strpos($str, '<!--nameId-->')) !== false)&&(($pos2 = strrpos($str, '<!--nameId-->')) !== false) ) 
{
$nameid = substr($str, $pos1+13, $pos2-$pos1-13); 
}
// print $comid.' ';
if($nameid)
{
	$query=$db->query("select * from myself_companies where comid='$nameid'");
	if($db->num_rows($query))
	{
		//$comid++;
		$cid++;
		continue;
	}
	else 
	{
		if ((($pos3 = strpos($str, '<!--custname-->')) !== false)&&(($pos4 = strrpos($str, '<!--custname-->')) !== false) ) 
		{
		$category = substr($str, $pos3+15, $pos4-$pos3-15); 
		}
		
		if ((($pos5 = strpos($str, '<!--eTel-->')) !== false)&&(($pos6 = strrpos($str, '<!--eTel-->')) !== false) ) 
		{
		$telone = substr($str, $pos5+11, $pos6-$pos5-11); 
		}
		
		if ((($pos7 = strpos($str, '<!--linkMan-->')) !== false)&&(($pos8 = strrpos($str, '<!--linkMan-->')) !== false) ) 
		{
		$connector = substr($str, $pos7+14, $pos8-$pos7-14); 
		}
		
		if ((($pos9 = strpos($str, '<!--linkNbr-->')) !== false)&&(($pos10 = strrpos($str, '<!--linkNbr-->')) !== false) ) 
		{
		$teltwo = substr($str, $pos9+14, $pos10-$pos9-14); 
		}
		
		if ((($pos11 = strpos($str, '<!--faxNbr-->')) !== false)&&(($pos12 = strrpos($str, '<!--faxNbr-->')) !== false) ) 
		{
		$comfax = substr($str, $pos11+13, $pos12-$pos11-13); 
		}
		
		if ((($pos13 = strpos($str, '<!--cityCode-->')) !== false)&&(($pos14 = strrpos($str, '<!--cityCode-->')) !== false) ) 
		{
		$comcity = substr($str, $pos13+15, $pos14-$pos13-15); 
		}
		
		if ((($pos15 = strpos($str, '<!--address-->')) !== false)&&(($pos16 = strrpos($str, '<!--address-->')) !== false) ) 
		{
		$comaddr = substr($str, $pos15+14, $pos16-$pos15-14); 
		}
		
		//<!--eMail--><a href='mailto: ' target='_blank'> </a><!--eMail-->
		if ((($pos17 = strpos($str, '<!--eMail--><a href=\'mailto:')) !== false)&&(($pos18 = strrpos($str, '\' target=\'_blank\'> </a><!--eMail-->')) !== false) ) 
		{
		$comemail = substr($str, $pos17+28, $pos18-$pos17-28); 
		}

		if ((($pos19 = strpos($str, '<!--webHome--><a href=\'http://')) !== false)&&(($pos20 = strrpos($str, '\' target=\'_blank\'> </a><!--webHome-->')) !== false) ) 
		{
			$comwebsite = substr($str, $pos19+30, $pos20-$pos19-30); 
		//	echo $comwebsite;
		}
		
		if ((($pos21 = strpos($str, '<!--companyname-->')) !== false)&&(($pos22 = strrpos($str, '<!--companyname--></span>')) !== false) ) 
		{
		$comname = substr($str, $pos21+18, $pos22-$pos21-18); 
		}

		
	$query=$db->query("insert into myself_companies(comid,category,telone,connector,teltwo,comfax,comcity,comaddr,comemail,comwebsite,comname) values('$nameid','$category','$telone','$connector','$teltwo','$comfax','$comcity','$comaddr','$comemail','$comwebsite','$comname')");
	//$query=$db->query("insert into myself_country(cid, cname, cname_big) values ('$team_country_bh','$team_country','$team_fcountry')");
	//$comid ++;
	
	$cid ++;
	}
}



else 
{
$cid++;
continue;
}
//echo $successed_1.' <br>';
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



