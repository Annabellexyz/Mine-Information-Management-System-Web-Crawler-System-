<?php session_start(); include("conn.php");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160足球完场赛事数据编辑系统</title>
<style type="text/css">
<!--
.STYLE1 {font-size: 12px}
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
	<h3 align=center><font color=blue>足球完场赛事编辑系统</font></h3>
&nbsp;&nbsp;<font size=2 > 1.点击右边的“更新”即可以给该记录作编辑修改，每次只能更新一条记录（一行）；</font><BR>
&nbsp; &nbsp;<font size=2 >2.若单元格限制数据显示不全，移动光标即可看到其余文字；</font><BR>
&nbsp; &nbsp;<font size=2 >3.此系统的数据和足球比赛搜索系统的数据是一一对应的，主键为编号；</font><BR>
&nbsp;  &nbsp;<font size=2 >4.请谨慎操作。</font>


<table height="264" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="100" height="2">&nbsp;</td>
    <td width="500">&nbsp;</td>
    <td width="100">&nbsp;</td>
  </tr>
  <tr>
    <td height="125">&nbsp;</td>
    <td align="left" valign="top"><table border="1" cellpadding="0" cellspacing="0">
	  <tr>
        <td width="60" height="25" align="center" class="STYLE1">编号</td>
        <td width="150" align="center" class="STYLE1">日期</td>
        <td width="60" align="center" class="STYLE1">时间</td>
        <td width="60" align="center" class="STYLE1">赛事</td>
        <td width="100" align="center" class="STYLE1">主队</td>
        <td width="40" align="center" class="STYLE1">比分</td>
        <td width="100" align="center" class="STYLE1">客队</td>
        <td width="40" align="center" class="STYLE1">半场</td>
        <td width="100" align="center" class="STYLE1">备注</td>
        <td width="100" align="center" class="STYLE1">主队繁体</td>
        <td width="100" align="center"><span class="STYLE1">客队繁体</span></td>        
        <td width="80" align="center"></td>
      </tr>
	<?php 
	
	// 处理分页
function index_page($totalNum, $page_num = null, $showNum = null, $page = 'page', $matchArray = null) 
{
	if ( is_null($page_num) ) $page_num = 10;  // 分页中每显示多少页码
	if ( is_null($showNum) ) $showNum  = 10;  // 每页显示的记录
	$curPage   = isset($_GET[$page]) && intval($_GET[$page]) > 0 ? intval($_GET[$page]) : 1;
	unset($_GET[$page],$_POST[$page]);
	$URL = '?';
	foreach ($_GET as $key => $value) {
		if ($matchArray != null) {
			if (in_array($key, $matchArray))
				$URL .= $key . '=' . $value . '&';
			continue;
		}
		$URL .= $key . '=' . $value . '&';
	}
	foreach ($_POST as $key => $value) {
		if ($matchArray != null) {
			if (in_array($key, $matchArray))
				$URL .= $key . '=' . $value . '&';
			continue;
		}
		$URL .= $key . '=' . $value . '&';
	}
	$URL .= "{$page}=";
	$totalPage = ceil($totalNum/$showNum);
	($curPage <= $totalPage || !$totalPage) or $curPage = $totalPage;
	$_GET[$page] = $curPage;
	if (!$totalPage)
		return '';
	$halfNum      = intval($page_num/2);
	$startNum     = (($curPage - $halfNum) < 1) ? 1 : $curPage - $halfNum + ($page_num+1)%2;
	$endNum       = (($curPage + $halfNum) > $totalPage) ? $totalPage : $curPage + $halfNum;
	$pageString   = "<div>";
	$PreviousPage = $curPage-1;

	$pageString   .= ($curPage != 1) ? "<a href=\"{$URL}1\">首页</a>" : "<a>首页</a>";
	$pageString   .= ($PreviousPage > 0) ? "<a href=\"{$URL}{$PreviousPage}\">上一页</a>" : "";
	for ($i = $startNum; $i <= $endNum; $i++ ) {
		if ($i == $curPage) {
			$pageString .= "<a style=\"margin:auto 3px;\"><b>$i</b></a>";
			continue;
		}
		$pageString .= "<a style=\"margin:auto 3px;\" href=\"{$URL}{$i}\">{$i}</a>";
	}
	$NextPage = $curPage+1;
	//$pageString .= ($NextPage > $endNum) ? "" : "<a href=\"{$URL}{$NextPage}\">下一页</a></div>";
	$pageString .= ($NextPage > $endNum) ? "" : "<a href=\"{$URL}{$NextPage}\">下一页</a>";
	$pageString .= ($curPage == $totalPage) ? "尾页" : "<a href=\"{$URL}{$totalPage}\">尾页</a></div>";
	return $pageString;

}

// 每页显示的链接数
$linksize = 20;
// 每页显示数据数量
$pagesize = 50;

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `myself_matches` ";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// 分页字符串
$pageationmyself_matches = "共{$row['PageNum']}条数据 " . index_page($row['PageNum'], $linksize, $pagesize);

//取当前页数据
$pageball = intval($_GET['page']);
$offset = $pagesize*($pageball - 1);

$query1 ="SELECT * FROM `myself_matches` ORDER BY day DESC,time DESC LIMIT $offset,$pagesize";

$result = mysql_query($query1);

	//$query=mysql_query("select * from myself_matches ");
	       if($result){
		   while($myrow=mysql_fetch_array($result)){
		   $sid=$myrow[id];
	
	?>
	<form name="form1" method="post" action="index_update.php?lmbs=<?php echo $sid;?>">
      <tr>
        <td height="25" align="center" class="STYLE1"><label>
          <input name="id" type="text" id="id" value="<?php echo $myrow[id];?>" size="6">
        </label></td>
        <td align="center" class="STYLE1"><input name="day" type="text" id="day" value="<?php echo $myrow[day];?>" size="10"></td>
        <td align="center" class="STYLE1"><input name="time" type="text" id="time" value="<?php echo $myrow[time];?>" size="6"></td>
        <td align="center" class="STYLE1"><input name="typename" type="text" id="typename" value="<?php echo $myrow[typename];?>" size="10"></td>
        <td align="center" class="STYLE1"><input name="hometeam" type="text" id="hometeam" value="<?php echo $myrow[hometeam];?>" size="16"></td>
        <td align="center" class="STYLE1"><input name="points" type="text" id="points" value="<?php echo $myrow[points];?>" size="4"></td>
        <td align="center" class="STYLE1"><input name="guestteam" type="text" id="guestteam" value="<?php echo $myrow[guestteam];?>" size="16"></td>
        <td align="center" class="STYLE1"><input name="halfpoints" type="text" id="halfpoints" value="<?php echo $myrow[halfpoints];?>" size="4"></td>
        <td align="center" class="STYLE1"><input name="remarks" type="text" id="remarks" value="<?php echo $myrow[remarks];?>" size="12"></td>
        <td align="center" class="STYLE1"><input name="hometeam_big" type="text" id="hometeam_big" value="<?php echo $myrow[hometeam_big];?>" size="12"></td>
        <td align="center" class="STYLE1"><input name="guestteam_big" type="text" id="guestteam_big" value="<?php echo $myrow[guestteam_big];?>" size="12"></td>        

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

<table width="100%">
<tr><td align="right">
<?php echo $pageationmyself_matches ?>
<td><tr>
</table>

</body>
</html>
