<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>2008奥运单条数据录入系统</title>
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
    <td width="150"><a href="http://172.20.1.21/mine/Olympic/Olympic_update">2008奥运数据修改</a></td>
    <td width="150"><a href="http://172.20.1.21/mine/Olympic/Olympic_insert">2008奥运数据插入</a></td>
    <td width="150"><a href="http://172.20.1.21/mine/Olympic/Olympic_delete">2008奥运数据删除</a></td>
  </tr>
</table>
<br>
&nbsp;&nbsp;<font size=2 > 1.点击右下角的“插入”即可以插入一条新记录；</font><BR>
&nbsp; &nbsp;<font size=2 >2.编号不用插入；</font><BR>
&nbsp;  &nbsp;<font size=2 color=red >3.请谨慎操作。</font>
<table align="center" width="620" border="1">
<form name="form1" method="post" action="index_insert.php">
  <tr>
    <td height="40" colspan="3" align="center"><span class="STYLE1"><strong>160 2008奥运单条数据录入</strong></span></td>
  </tr>
  <tr>
  	
    <td width="40" height="25" align="center" class="STYLE2">编号:</td>
    <td><input name="day" type="text" id="day"  size="64"></td>
    <td width="100"  class="STYLE2">例：788</td>
  </tr>
  <tr>
    <td height="25" align="center" class="STYLE2">年份:</td>
    <td><input name="time" type="text" id="time"  size="64"></td>
    <td  class="STYLE2">例：2008奥运</td>
  </tr>
  <tr>
    <td height="25" align="center" class="STYLE2">大项:</td>
    <td><input name="typename" type="text" id="typename"  size="64"></td>
    <td  class="STYLE2">例：沙滩排球</td>
  </tr>
    <tr>
    <td height="25" align="center" class="STYLE2">小项:</td>
    <td><input name="hometeam" type="text" id="hometeam"  size="64"></td>
    <td  class="STYLE2">例：女子沙滩排球</td>
  </tr>
    <tr>
    <td height="25" align="center" class="STYLE2">举行日期:</td>
    <td><input name="points" type="text" id="points"  size="64"></td>
    <td  class="STYLE2">例：20080819星期二（第11天）</td>
  </tr>
    <tr>
    <td height="25" align="center" class="STYLE2">举行时间:</td>
    <td><input name="guestteam" type="text" id="guestteam"  size="64"></td>
    <td  class="STYLE2">例：14:30-16:15</td>
  </tr>
    <tr>
    <td height="25" align="center" class="STYLE2">赛事名:</td>
    <td><input name="halfpoints" type="text" id="halfpoints"  size="64"></td>
    <td  class="STYLE2">例：女子1/4决赛第61场B2-A3</td>
  </tr>
      <tr>
    <td height="25" align="center" class="STYLE2">场馆:</td>
    <td><input name="halfpoints" type="text" id="halfpoints"  size="64"></td>
    <td  class="STYLE2">例：北京奥林匹克篮球馆</td>
  </tr>
      <tr>
    <td height="25" align="center" class="STYLE2">决赛:</td>
    <td><input name="halfpoints" type="text" id="halfpoints"  size="64"></td>
    <td  class="STYLE2">例：决赛</td>
  </tr>

  <tr>
    <td height="25" align="center" class="STYLE2">夺金点</td>
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
