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
<table  border="0" cellpadding="1" cellspacing="1" >
  <tr>
    <td height="30">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="120">&nbsp;</td>
    <td align="center" valign="top">
	<table border="1" cellpadding="1" cellspacing="1">
      <tr>
        <td width="60" height="25" align="center" class="STYLE1">编号</td>
        <td width="100" align="center" class="STYLE1">日期</td>
        <td width="60" align="center" class="STYLE1">时间</td>
        <td width="60" align="center" class="STYLE1">赛事</td>
        <td width="100" align="center" class="STYLE1">主队</td>
        <td width="40" align="center" class="STYLE1">比分</td>
        <td width="100" align="center" class="STYLE1">客队</td>
        <td width="40" align="center" class="STYLE1">半场</td>
        <td width="100" align="center" class="STYLE1">备注</td>
        <td width="100" align="center" class="STYLE1">主队繁体</td>
        <td width="100" align="center"><span class="STYLE1">客队繁体</span></td>      
        <td width="66" align="center"><span class="STYLE1">&nbsp;</span></td>
      </tr>
	  <?php $query=mysql_query("select * from myself_matches where id limit 6");
	  if($query==true){
	    while($myrow=mysql_fetch_array($query)){
	  ?>
	   <form name="form1" method="post" action="index_ok.php?lmbs=<?php echo $myrow[id];?>">
      <tr>
      	<td align="center"><span class="STYLE2"><?php echo $myrow[id];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[day];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[time];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[typename];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[hometeam];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[points];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[guestteam];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[halfpoints];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[remarks];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[hometeam_big];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[guestteam_big];?></span></td>  
        
        <td align="center"><span class="STYLE2">
          <input type="submit" name="Submit" onclick="javascript:if (confirm('您确定要删除吗？注意：此操作不可恢复，请谨慎操作！')){return true;} return false;" value="删除">
        </span></td>
      </tr>
	  </form>
	  <?php }}?>
    </table>
      
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="10">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
