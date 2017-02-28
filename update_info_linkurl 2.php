<HTML>
<HEAD>
<TITLE>更新香港黄页信息linkurl字段数据</TITLE>
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
/*此程序跟采集信用网信息caijiSZcredit.php类似*/

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
  	//echo "成功更新ID为".$cid."的数据！<br>";
  	continue;
  }  
  else 
  {
   echo "更新失败！ID为".$cid."的数据！<br>";
  } 
  $cid++;
  //continue;
 }
}
else 
{
echo '参数不正确！';
}

?>

</BODY>
</HTML>