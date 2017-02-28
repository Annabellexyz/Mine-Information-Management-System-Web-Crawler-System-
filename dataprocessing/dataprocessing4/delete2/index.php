<?php session_start(); include("conn.php");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>清空指定数据表中的指定数据</title>
<style type="text/css">
<!--
.STYLE1 {font-size: 13px}
.STYLE2 {font-size: 12px}
-->
</style>
</head>
<script language="javascript" type="text/javascript">
function deletes(){
  if (window.confirm('确定要删除该记录??')==true){
  return true;
  }else{ return false;}

}
</script>
<body>
<table width="408" height="42" border="0" cellpadding="0" cellspacing="0" background="images/bg1.jpg">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="408" height="20" border="0" cellpadding="0" cellspacing="0" background="images/bg2.jpg">
  <tr>
    <td width="85" height="25" align="center"><span class="STYLE1">姓名</span></td>
    <td width="70" align="center"><span class="STYLE1">编号</span></td>
    <td width="81" align="center" class="STYLE1">电话</td>
    <td width="91" align="center"><span class="STYLE1">地址</span></td>
    <td width="81" align="center">&nbsp;</td>
  </tr>
  <?php $query=mysql_query("select * from tb_insert");
     if($query==true){
	 while($myrow=mysql_fetch_array($query)){	 
?>
<form name="form1" method="post" action="index_ok.php?lmbs=<?php echo $myrow[nid];?>" onSubmit="return deletes();">
  <tr>
    <td height="25" align="center"><span class="STYLE2"><?php echo $myrow[name];?></span></td>
    <td height="25" align="center"><span class="STYLE2"><?php echo $myrow[number];?></span></td>
    <td height="25" align="center"><span class="STYLE2"><?php echo $myrow[tel];?></span></td>
    <td height="25" align="center"><span class="STYLE2"><?php echo $myrow[address];?></span></td>
    <td><input name="Submit" type="submit" value="删除"></td>
  </tr>
  </form>
  <?php }}?>
</table>
<table width="408" height="30" border="0" cellpadding="0" cellspacing="0" background="images/bg3.jpg">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
