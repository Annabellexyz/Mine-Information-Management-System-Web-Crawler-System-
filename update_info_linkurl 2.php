<HTML>
<HEAD>
<TITLE>������ۻ�ҳ��Ϣlinkurl�ֶ�����</TITLE>
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
/*�˳�����ɼ���������ϢcaijiSZcredit.php����*/

if($par=='url')
{
 $cid = 1;
 $total = 157461;
 while($cid <= $total)
 {
  $progbar->step();
  $query=$db->query("UPDATE phpcms_info_27 SET linkurl='HK/2009/0413/info_".$cid.".html' WHERE infoid = $cid");
  if($db->affected_rows($query))
  {
  	//echo "�ɹ�����IDΪ".$cid."�����ݣ�<br>";
  	continue;
  }  
  else 
  {
   echo "����ʧ�ܣ�IDΪ".$cid."�����ݣ�<br>";
  } 
  $cid++;
  //continue;
 }
}
else 
{
echo '��������ȷ��';
}

?>

</BODY>
</HTML>