<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160足球完场赛事单条数据录入系统</title>
<style type="text/css">
<!--
.STYLE1 {
	font-family: "华文琥珀";
	font-size: 20px;
	color: #000000;
}
.STYLE2 {font-size: 13px}
.STYLE3 {font-size: 12px}
-->
</style>
</head>

<body>
	<table  border="1" align="center">
  <tr>
    <td width="120"><a href="http://172.20.1.21/mine/football_update">足球数据修改</a></td>
    <td width="120"><a href="http://172.20.1.21/mine/football_insert">足球数据插入</a></td>
    <td width="120"><a href="http://172.20.1.21/mine/football_delete/">足球数据删除</a></td>
  </tr>
</table>
<br>
&nbsp;&nbsp;<font size=2 > 1.点击右下角的“插入”即可以插入一条新记录；</font><BR>
&nbsp; &nbsp;<font size=2 >2.编号不用插入；</font><BR>
&nbsp;  &nbsp;<font size=2 color=red >3.请谨慎操作。</font>
<table align="center" width="620" border="1">
<form name="form1" method="post" action="index_insert.php">
  <tr>
    <td height="40" colspan="3" align="center"><span class="STYLE1"><strong>160足球完场赛事单条数据录入</strong></span></td>
  </tr>
  <tr>
    <td width="40" height="25" align="center" class="STYLE2">日期:</td>
    <td><input name="day" type="text" id="day"  size="64"></td>
    <td width="100"  class="STYLE2">例：2007-01-01</td>
  </tr>
  <tr>
    <td height="25" align="center" class="STYLE2">时间:</td>
    <td><input name="time" type="text" id="time"  size="64"></td>
    <td  class="STYLE2">例：23:00</td>
  </tr>
  <tr>
    <td height="25" align="center" class="STYLE2">赛事:</td>
    <td><input name="typename" type="text" id="typename"  size="64"></td>
    <td  class="STYLE2">例：英超</td>
  </tr>
    <tr>
    <td height="25" align="center" class="STYLE2">主队:</td>
    <td><input name="hometeam" type="text" id="hometeam"  size="64"></td>
    <td  class="STYLE2">例：切尔西</td>
  </tr>
    <tr>
    <td height="25" align="center" class="STYLE2">比分:</td>
    <td><input name="points" type="text" id="points"  size="64"></td>
    <td  class="STYLE2">例：2-0</td>
  </tr>
    <tr>
    <td height="25" align="center" class="STYLE2">客队:</td>
    <td><input name="guestteam" type="text" id="guestteam"  size="64"></td>
    <td  class="STYLE2">例：英格兰</td>
  </tr>
    <tr>
    <td height="25" align="center" class="STYLE2">半场:</td>
    <td><input name="halfpoints" type="text" id="halfpoints"  size="64"></td>
    <td  class="STYLE2">例：1-0</td>
  </tr>

  <tr>
    <td height="25" align="center" class="STYLE2">备注</td>
    <td><input name="remarks" type="text" id="remarks"  size="64"></td>
    <td align="right"> <input type="submit" name="Submit" value="提交"></td>
  </tr>
  <tr>
    <td height="25" colspan="3" align="center"><span class="STYLE3">版权所有<span class="STYLE2">:</span>中通信息服务有限公司</span></td>
  </tr>
  </form>
</table>
</body>
</html>
