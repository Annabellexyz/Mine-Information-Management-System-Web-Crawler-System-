<?php 
$data=date("Y-m-d h:i:s");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160足球完场赛事批量数据录入</title>
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
<table border="1" FRAME="box" cellspacing="0" cellpadding="0" align="center" valign="middle">
 <form name="form1" method="post" action="index_ok.php">

  <tr>
    <td  height="25" align="center" width=6%><span class="STYLE1">编号</span></td>
    <td  align="center" class="STYLE1" width=11%>日期</td>
    <td  align="center" class="STYLE1" width=6%>时间</td>
    <td  align="center" class="STYLE1" width=10%>赛事</td>
    <td  align="center" class="STYLE1" width=20% >主队</td>
    <td  align="center" class="STYLE1" width=5%>比分</td>
    <td  align="center" class="STYLE1" width=20%>客队</td>
    <td  align="center" class="STYLE1" width=5%>半场</td>
    <td  align="center" width=17%><span class="STYLE1">备注</span>	
    <input name="data" type="hidden" value="<?php echo $data;?>">    </td>
  </tr>
  
  <tr>
    <td height="25" align="center" class="STYLE1"><input name="match_id[]" type="text" id="match_id"></td>
    <td align="center" class="STYLE1"><input name="match_day[]" type="text" id="match_day"></td>
    <td align="center" class="STYLE1"><input name="match_time[]" type="text" id="match_time"></td>
    <td align="center" class="STYLE1"><input name="match_typename[]" type="text" id="match_typename"></td>
    <td align="center" class="STYLE1"><input name="match_hometeam[]" type="text" id="match_hometeam"></td>
    <td align="center" class="STYLE1"><input name="match_points[]" type="text" id="match_points"></td>
    <td align="center" class="STYLE1"><input name="match_guestteam[]" type="text" id="match_guestteam"></td>
    <td align="center" class="STYLE1"><input name="match_halfpoints[]" type="text" id="match_halfpoints"></td>
    <td align="center" class="STYLE1"><input name="match_remarks[]" type="text" id="match_remarks"></td>
  </tr>
  
 <tr>
    <td height="25" align="center" class="STYLE1"><input name="match_id[]" type="text" id="match_id"></td>
    <td align="center" class="STYLE1"><input name="match_day[]" type="text" id="match_day"></td>
    <td align="center" class="STYLE1"><input name="match_time[]" type="text" id="match_time"></td>
    <td align="center" class="STYLE1"><input name="match_typename[]" type="text" id="match_typename"></td>
    <td align="center" class="STYLE1"><input name="match_hometeam[]" type="text" id="match_hometeam"></td>
    <td align="center" class="STYLE1"><input name="match_points[]" type="text" id="match_points"></td>
    <td align="center" class="STYLE1"><input name="match_guestteam[]" type="text" id="match_guestteam"></td>
    <td align="center" class="STYLE1"><input name="match_halfpoints[]" type="text" id="match_halfpoints"></td>
    <td align="center" class="STYLE1"><input name="match_remarks[]" type="text" id="match_remarks"></td>
  </tr>
  
  <tr>
    <td height="25" align="center" class="STYLE1"><input name="match_id[]" type="text" id="match_id"></td>
    <td align="center" class="STYLE1"><input name="match_day[]" type="text" id="match_day"></td>
    <td align="center" class="STYLE1"><input name="match_time[]" type="text" id="match_time"></td>
    <td align="center" class="STYLE1"><input name="match_typename[]" type="text" id="match_typename"></td>
    <td align="center" class="STYLE1"><input name="match_hometeam[]" type="text" id="match_hometeam"></td>
    <td align="center" class="STYLE1"><input name="match_points[]" type="text" id="match_points"></td>
    <td align="center" class="STYLE1"><input name="match_guestteam[]" type="text" id="match_guestteam"></td>
    <td align="center" class="STYLE1"><input name="match_halfpoints[]" type="text" id="match_halfpoints"></td>
    <td align="center" class="STYLE1"><input name="match_remarks[]" type="text" id="match_remarks"></td>
  </tr>

  <tr>
    <td height="28" colspan="6" align="right"><input type="submit" name="Submit" value="提交">&nbsp;&nbsp;</td>
    <td colspan="3">&nbsp;&nbsp;<input type="reset" name="Submit2" value="重置"></td>
  </tr>
   </form>
</table>
</body>
</html>
