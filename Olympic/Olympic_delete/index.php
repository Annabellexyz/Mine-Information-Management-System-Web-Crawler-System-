<?php session_start(); include("conn.php");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>160奥运赛事单条数据删除</title>
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
</style>


</head>

<body>
<br>
<table  border="1" align="center">
  <tr>
    <td width="150"><a href="http://172.20.1.21/mine/Olympic/Olympic_update">2008奥运数据修改</a></td>
    <td width="150"><a href="http://172.20.1.21/mine/Olympic/Olympic_insert">2008奥运数据插入</a></td>
    <td width="150"><a href="http://172.20.1.21/mine/Olympic/Olympic_delete">2008奥运数据删除</a></td>
  </tr>
</table><br>
&nbsp;&nbsp;<font size=2 > 1.点击右边的“删除”即立刻删除了此行记录；</font><BR>
&nbsp;&nbsp;<font size=2 > 2.此页面显示的是ID编号最大的50条记录，基本上是最新的记录；</font><BR>
&nbsp;  &nbsp;<font size=2 color=red >3.请谨慎操作!!!</font>
<h3 align=center><font color=blue>奥运赛事单条数据删除</font></h3>
	
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
        <td width="100" align="center" class="STYLE1">年份</td>
        <td width="60" align="center" class="STYLE1">大项</td>
        <td width="60" align="center" class="STYLE1">小项</td>
        <td width="100" align="center" class="STYLE1">举行日期</td>
        <td width="40" align="center" class="STYLE1">举行时间</td>
        <td width="100" align="center" class="STYLE1">赛事名</td>
        <td width="40" align="center" class="STYLE1">场馆</td>
        <td width="100" align="center" class="STYLE1">决赛</td>
        <td width="100" align="center" class="STYLE1">夺金点</td>     
        <td width="66" align="center"><span class="STYLE1">&nbsp;</span></td>
      </tr>
	  <?php 
	  //$query=mysql_query("select * from myself_matches where id limit 100");
	  $query=mysql_query("select * from olympic_match_detail ORDER BY id ASC");
	  if($query==true){
	    while($myrow=mysql_fetch_array($query)){
	  ?>
	   <form name="form1" method="post" action="index_delete.php?lmbs=<?php echo $myrow[id];?>">
      <tr>
      	<td align="center"><span class="STYLE2"><?php echo $myrow[id];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[olympic_year];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[olympic_match_big];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[olympic_match_small];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[heldday];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[heldtime];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[matchname];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[gym];?></span></td>
       <td align="center"><span class="STYLE2"><?php echo $myrow[finals];?></span></td>
        <td align="center"><span class="STYLE2"><?php echo $myrow[goldpoint];?></span></td>
        
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
