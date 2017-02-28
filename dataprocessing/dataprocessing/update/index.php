<?php session_start(); include("conn/conn.php");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>单条数据更新</title>
<style type="text/css">
<!--
.STYLE1 {font-size: 12px}
-->
</style>
</head>

<body>
<table width="535" height="264" border="0" cellpadding="0" cellspacing="0" background="images/bg2.jpg">
  <tr>
    <td width="55" height="106">&nbsp;</td>
    <td width="325">&nbsp;</td>
    <td width="55">&nbsp;</td>
  </tr>
  <tr>
    <td height="125">&nbsp;</td>
    <td align="left" valign="top"><table width="425" border="1" cellpadding="0" cellspacing="0">
	  <tr>
        <td width="60" height="25" align="center" class="STYLE1">姓名</td>
        <td width="60" align="center" class="STYLE1">编号</td>
        <td width="80" align="center" class="STYLE1">电话</td>
        <td width="145" align="center"><span class="STYLE1">地址</span></td>
        <td width="80" align="center"></td>
      </tr>
	<?php $query=mysql_query("select * from tb_insert");
	       if($query==true){
		   while($myrow=mysql_fetch_array($query)){
		   $sid=$myrow[nid];
	?>
	<form name="form1" method="post" action="index_ok.php?lmbs=<?php echo $sid;?>">
      <tr>
        <td height="25" align="center" class="STYLE1"><label>
          <input name="name" type="text" id="name" value="<?php echo $myrow[name];?>" size="6">
        </label></td>
        <td align="center" class="STYLE1"><input name="number" type="text" id="number" value="<?php echo $myrow[number];?>" size="6"></td>
        <td align="center" class="STYLE1"><input name="tel" type="text" id="tel" value="<?php echo $myrow[tel];?>" size="9"></td>
        <td align="center" class="STYLE1"><input name="address" type="text" id="address" value="<?php echo $myrow[address];?>" size="18"></td>
        <td align="center"><input type="image" name="imageField" src="images/bg1.jpg"></td>
      </tr>
	   </form>
	  <?php }}?>
	  
    </table>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="33">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
