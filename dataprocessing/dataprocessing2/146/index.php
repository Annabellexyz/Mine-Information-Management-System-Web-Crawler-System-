<?php 
$data=date("Y-m-d h:i:s");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>批量数据录入</title>
<style type="text/css">
<!--
.STYLE1 {font-size: 13px}
.STYLE2 {
	font-family: "华文琥珀", "华文隶书", "华文行楷", "楷体_GB2312";
	font-size: 24px;
}
-->
</style>
</head>

<body>
<table width="480" height="262" border="1" cellpadding="0" cellspacing="0" background="images/bg.JPG">
 <form name="form1" method="post" action="index_ok.php">
  <tr>
    <td height="100" colspan="5" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="center"><span class="STYLE1">商品名称</span></td>
    <td align="center" class="STYLE1">编号</td>
    <td align="center" class="STYLE1">单价</td>
    <td align="center" class="STYLE1">数量</td>
    <td align="center"><span class="STYLE1">产地</span>
    <input name="data" type="hidden" value="<?php echo $data;?>">    </td>
  </tr>
  <tr>
    <td height="25" align="center"><input name="sp_name[]" type="text" id="sp_name" size="15"></td>
    <td align="center"><input name="sp_number[]" type="text" id="sp_number" size="10"></td>
    <td align="center"><input name="price[]" type="text" id="price" size="8"></td>
    <td align="center"><input name="counts[]" type="text" id="counts" size="8"></td>
    <td align="center"><input name="address[]" type="text" id="address" size="15"></td>
  </tr>
  <tr>
    <td height="25" align="center"><input name="sp_name[]" type="text" id="sp_name[]" size="15"></td>
    <td align="center"><input name="sp_number[]" type="text" id="sp_number" size="10"></td>
    <td align="center"><input name="price[]" type="text" id="price" size="8"></td>
    <td align="center"><input name="counts[]" type="text" id="counts" size="8"></td>
    <td align="center"><input name="address[]" type="text" id="address" size="15"></td>
  </tr>
  <tr>
    <td height="25" align="center"><input name="sp_name[]" type="text" id="sp_name" size="15"></td>
    <td align="center"><input name="sp_number[]" type="text" id="sp_number" size="10"></td>
    <td align="center"><input name="price[]" type="text" id="price" size="8"></td>
    <td align="center"><input name="counts[]" type="text" id="counts" size="8"></td>
    <td align="center"><input name="address[]" type="text" id="address" size="15"></td>
  </tr>
  <tr>
    <td height="30" colspan="3" align="right"><input type="submit" name="Submit" value="提交">&nbsp;&nbsp;</td>
    <td colspan="2">&nbsp;&nbsp;<input type="reset" name="Submit2" value="重置"></td>
  </tr>
   </form>
</table>
</body>
</html>
