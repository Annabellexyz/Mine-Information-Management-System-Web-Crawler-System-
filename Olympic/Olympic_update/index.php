<?php session_start(); include("conn.php");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160 2008奥运数据编辑系统</title>
<style type="text/css">
<!--
.STYLE1 {font-size: 12px}
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
	<h3 align=center><font color=blue>奥运赛事编辑系统</font></h3>
&nbsp;&nbsp;<font size=2 > 1.点击右边的“更新”即可以给该记录作编辑修改，每次只能更新一条记录（一行）；</font><BR>
&nbsp; &nbsp;<font size=2 >2.若单元格限制数据显示不全，移动光标即可看到其余文字；</font><BR>
&nbsp; &nbsp;<font size=2 >3.此系统的数据和奥运搜索系统的数据是一一对应的，主键为编号；</font><BR>
&nbsp;  &nbsp;<font size=2 >4.请谨慎操作。</font>


<table width=100%  border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="125">&nbsp;</td>
    <td align="left" valign="top"><table border="1" cellpadding="0" cellspacing="0">
	  <tr>
	  	  <td  height="25" align="center" class="STYLE1">编号</td>
        <td  align="center" class="STYLE1">比赛大项</td>
      
        <td  align="center" class="STYLE1">举行日期</td>
        <td  align="center" class="STYLE1">举行时间</td>
        <td  align="center" class="STYLE1">赛事名</td>
        <td  align="center" class="STYLE1">决赛</td>
        <td  align="center"><span class="STYLE1">夺金点</span></td>      
        <td  align="center"><span class="STYLE1">运动员</span></td>  
        <td  align="center"></td>
       <!-- <td width=5% height="25" align="center" class="STYLE1">编号</td>
        <td width=10% align="center" class="STYLE1">比赛大项</td>
      
        <td width=13% align="center" class="STYLE1">举行日期</td>
        <td width=12% align="center" class="STYLE1">举行时间</td>
        <td width=10% align="center" class="STYLE1">赛事名</td>
        <td width=10% align="center"><span class="STYLE1">夺金点</span></td>        
        <td width=10% align="center"></td>-->
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
$pagesize = 500;

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `olympic_match_detail` ";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// 分页字符串
$pageationolympic_match_detail = "共{$row['PageNum']}条数据 " . index_page($row['PageNum'], $linksize, $pagesize);

//取当前页数据
$pageball = intval($_GET['page']);
$offset = $pagesize*($pageball - 1);

$query1 ="SELECT * FROM `olympic_match_detail` ORDER BY id ASC LIMIT $offset,$pagesize";

$result = mysql_query($query1);

	//$query=mysql_query("select * from olympic_match_detail ");
	       if($result){
		   while($myrow=mysql_fetch_array($result)){
		   $sid=$myrow[id];
	
	?>
	<form name="form1" method="post" action="index_update.php?lmbs=<?php echo $sid;?>">
      <tr>
        <td height="25" align="center" class="STYLE1"><label>
          <input name="id" type="text" id="id" value="<?php echo $myrow[id];?>" size="4">
        </label></td>
        <td align="center" class="STYLE1"><input name="bigmatch" type="text" id="bigmatch" value="<?php echo $myrow[bigmatch];?>" size="8"></td>
        
        <td align="center" class="STYLE1"><input name="heldday" type="text" id="heldday" value="<?php echo $myrow[heldday];?>" size="23"></td>
        <td align="center" class="STYLE1"><input name="heldtime" type="text" id="heldtime" value="<?php echo $myrow[heldtime];?>" size="10"></td>
        <td align="center" class="STYLE1"><input name="matchname" type="text" id="matchname" value="<?php echo $myrow[matchname];?>" size="56"></td>
        <td align="center" class="STYLE1"><input name="finals" type="text" id="finals" value="<?php echo $myrow[finals];?>" size="4"></td>
        <td align="center" class="STYLE1"><input name="goldpoint" type="text" id="goldpoint" value="<?php echo $myrow[goldpoint];?>" size="28"></td>      
        <td align="center" class="STYLE1"><input name="athlete" type="text" id="athlete" value="<?php echo $myrow[athlete];?>" size="20"></td>
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
<?php echo $pageationolympic_match_detail ?>
<td><tr>
</table>

</body>
</html>
