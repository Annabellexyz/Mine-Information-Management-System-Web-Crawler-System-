<?php session_start(); include("conn.php");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>单条数据删除</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.STYLE1 {font-size: 13px}
.STYLE2 {font-size: 12px}
-->
</style></head>

<body>
<table width="474" height="293" border="0" cellpadding="0" cellspacing="0" background="images/bg.jpg">
  <tr>
    <td width="65" height="120">&nbsp;</td>
    <td width="344">&nbsp;</td>
    <td width="65">&nbsp;</td>
  </tr>
  <tr>
    <td height="120">&nbsp;</td>
    <td align="center" valign="top">
	<table width="342" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td width="60" height="25" align="center"><span class="STYLE1">姓名</span></td>
        <td width="60" align="center"><span class="STYLE1">编号</span></td>
        <td width="76" align="center"><span class="STYLE1">电话</span></td>
        <td width="80" align="center"><span class="STYLE1">地址</span></td>
        <td width="66" align="center"><span class="STYLE1">&nbsp;</span></td>
      </tr>
	  <?php $query=mysql_query("select * from tb_insert where id limit 3");
	  if($query==true){
	    while($myrow=mysql_fetch_array($query)){
	  ?>
	   <form name="form1" method="post" action="index_ok.php?lmbs=<?php echo $myrow[id];?>">
      <tr>
        <td height="25" align="center"><span class="STYLE2"><?php echo $myrow[name];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[number];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[tel];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[address];?></span></td>
        <td align="center"><span class="STYLE2">
          <input type="submit" name="Submit" value="删除">
        </span></td>
      </tr>
	  </form>
	  <?php }}?>
    </table>
      
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="53">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
