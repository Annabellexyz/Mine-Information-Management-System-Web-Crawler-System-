<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>深圳160:足球球队资料搜索 </title>
</head>
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

//连接数据库
$host='172.20.1.21';
$username='admin';
$password='xxzx160168';
$db_name='phpcms';
$tb_name='myself_teams';

// 每页显示的链接数
$linksize = 20;
// 每页显示数据数量
$pagesize = 25;
	
$link=@mysql_connect($host,$username,$password);
@mysql_query("SET NAMES GBK");//编码

mysql_select_db($db_name, $link);

// print_r($_POST);

$content = '';  // 内容
$pageation = ''; // 分页

//////////////////////////////////////////////////////////////////////////////////////
///
/// myself_teams 表的记录
///
//////////////////////////////////////////////////////////////////////////////////////

$searchMethod = isset($_REQUEST['searchtype']) ? trim($_REQUEST['searchtype']) : '';

$searchterm = isset($_REQUEST['searchterm']) ? trim($_REQUEST['searchterm']) : '';//搜索关键词

$limit = isset($_GET['limit']) ? trim($_GET['limit']) : ''; // 条件限制

$limitArray = array();
if (!empty($limit))
	{	
	if(strpos($limit,','))
	   $limitArray=explode(',',$limit);
	elseif(strpos($limit,'，'))
	   $limitArray=explode('，',$limit);  
	elseif(strpos($limit,'　'))      
	   $limitArray=explode('　',$limit);
	else
	   $limitArray=explode(' ',$limit); 
	}

// 存储球队资料字段
$fieldArray = array(
  'tid',
	'teamname', 
	'teamname_big', 
	'ename', 
	'tintro',
	'url', 
);

// 分开关键字存于数据库
if(strpos($searchterm,','))
   $teamArray=explode(',',$searchterm);
elseif(strpos($searchterm,'，'))
   $teamArray=explode('，',$searchterm);  
elseif(strpos($searchterm,'　'))      
   $teamArray=explode('　',$searchterm);
else
   $teamArray=explode(' ',$searchterm); 

// 循环过滤空格
foreach ($teamArray as $key => $value)
	$teamArray[$key] = trim($value);

// 初始化SqlWhere
$sqlWhere = '';
switch ($searchMethod)
{
	case "Union":
		// 用来存储SQL语句数组
		$queryWhereArray = array();
		// 遍历去空格
		foreach ($teamArray as $key => $value)   // 关键字
		{
			$fieldFrameArray = array();  // 清空临时存储的数据片段
			foreach ($fieldArray as $fieldValue)  // 字段
			{
				if (count($limitArray) > 0) {
					if (in_array($fieldValue, $limitArray))
						array_push($fieldFrameArray, "`{$fieldValue}` LIKE '%{$value}%'");
				}
				else
					array_push($fieldFrameArray, "`{$fieldValue}` LIKE '%{$value}%'");
			}
			// 合并小的SqlWhere
			$smallSentence = '(' . implode(' OR ', $fieldFrameArray) . ')';
			// 组织SQL语句
			array_push($queryWhereArray, $smallSentence);
		}
		$sqlWhere = 'WHERE ' . implode(' AND ', $queryWhereArray);
		break;
	case "all":
		// 用来存储SQL语句数组
		$queryWhereArray = array();
		// 遍历去空格
		foreach ($fieldArray as $fieldValue)
		{
			foreach ($teamArray as $value)
			{
				array_push($queryWhereArray, "`{$fieldValue}` LIKE '%{$value}%'");
			}
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;
			// 下面语句处理单类型
		case "teamname":
		case "tintro":
		$onlyField = $searchMethod;
		// 用来存储SQL语句数组
		$queryWhereArray = array();
		// 遍历去空格
		foreach ($teamArray as $value)
		{
			array_push($queryWhereArray, "`{$onlyField}` LIKE '%{$value}%'");
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;

	// 默认查找全部
	default:
		$sqlWhere = '';
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `myself_teams` {$sqlWhere}";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// 分页字符串
$pageationmyself_teams = "共{$row['PageNum']}条数据 " . index_page($row['PageNum'], $linksize, $pagesize, 'pageball', array('searchterm', 'searchtype'));

//取当前页数据
$pageball = intval($_GET['pageball']);
$offset = $pagesize*($pageball - 1);

$query ="SELECT * FROM `myself_teams` {$sqlWhere} ORDER BY tid ASC LIMIT $offset,$pagesize";

$result = mysql_query($query);

$contentmyself_teams = '';
// 表格头
	$contentmyself_teams .= 	"<h4 align='CENTER'>足球赛事球队资料搜索结果</h4>"
					."<table width='75%' border='1' FRAME='box' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"
					."<tr>"
					."<th width=5%>编号</th>"
					."<th width=30%>普通话</th>"
					."<th width=30%>粤语音</th>"
					."<th width=35%>英文</th>"
					. "</tr>"
					. "<tr>"
					. "<td colspan=4>&nbsp;</td>"
					. "</tr>";

while ($row = mysql_fetch_assoc($result))
{
	 $tid = htmlspecialchars(stripslashes($row['tid']));
	 $teamname = stripslashes($row['teamname']);
	 $teamname_big = stripslashes($row['teamname_big']);
	 $ename = stripslashes($row['ename']);
	 $tintro = stripslashes($row['tintro']);
	 $url = stripslashes($row['url']);

     
	$contentmyself_teams .= "<tr>"
	."<td>"
	."</td>"
	. "<td align=center>球队赛果赛程：</td>"
	. "<td colspan=2 align=center>$url</td>"
	. "</tr>"
	. "<tr>"
	. "<td align=center>$tid</td>"
	. "<td>$teamname</td>"
	. "<td>$teamname_big</td>"
	. "<td>$ename</td>"
	. "</tr>"
	. "<tr>"
	. "<th align=center>球<br>队<br>资<br>料</th>"
	. "<td colspan=3>$tintro</td>"
	. "</tr>"
	. "<tr>"
	. "<td colspan=4>&nbsp;</td>"
	. "</tr>";

} 
$contentmyself_teams .= "</table>";

?>

<body>
<form method="get"> 	
<table align="center">
<tr align="center">
  <td >
	  <select align="center" name="searchtype"> 
	  <option value="Union">联合</option>
	  <option value="all">不限</option>
	  <option value="teamname">球队</option>
	  <option value="tintro">资料</option>
    </select></td>
  <td >关键词:</td>
  <td> <input name="searchterm" type="text"></td>
  <td> <input name="sousuo" type="submit" value="搜索"></td>
    
</tr>
<tr><td colspan=4>&nbsp;</td><tr>
<tr align="center">
  <td colspan=2>
  <A href="http://172.20.1.21/mine/searchteams2.php" target=_blank> <U><FONT color=#0000ff>点击此处搜索球队资料</FONT></U></A>
  </td>
  <td colspan=2>
  <A href="http://172.20.1.21/mine/searchball2.php" target=_blank> <U><FONT color=#0000ff>点击回完场赛事搜索首页</FONT></U></A>
  </td>
</tr>

</table>
</form>

<!-- myself_teams表的记录及分页 -->
<table id="results" width="100%">
<tr><td align="left">
<?php echo $contentmyself_teams ?>
<td><tr>
</table>

<table width="100%">
<tr><td align="right">
<?php echo $pageationmyself_teams ?>
<td><tr>
</table>
<!-- myself_teams表的记录及分页 -->
</body>
</html>

