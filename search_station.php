<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>深圳160:公交站点搜索 </title>
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
$host='localhost';
$username='admin';
$password='xxzx160168';
$db_name='phpcms';
$tb_name='myself_station';

// 每页显示的链接数
$linksize = 20;
// 每页显示数据数量
$pagesize = 50;
	
$link=@mysql_connect($host,$username,$password);
@mysql_query("SET NAMES GBK");//编码

mysql_select_db($db_name, $link);

// print_r($_POST);

$content = '';  // 内容
$pageation = ''; // 分页

//////////////////////////////////////////////////////////////////////////////////////
///
/// myself_station 表的记录
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
  'stationid',
	'stationname', 
	'stroad', 
	'stationpic', 
	'aliases1',
	'aliases2', 
	'relation1',
	'relation2',
	'relation3',
	'updatetime',
	'editor',
	'isdelete'
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
		case "stationname":
		case "stroad":
		$onlyField = $searchMethod;
		// 用来存储SQL语句数组
		$queryWhereArray = array();
		// 遍历去空格
		foreach ($teamArray as $value)
		{
			array_push($queryWhereArray, "`{$onlyField}` like '%{$value}%'");
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;

	// 默认查找全部
	default:
		$sqlWhere = '';
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `myself_station` {$sqlWhere}";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// 分页字符串
$pageationmyself_station = "共{$row['PageNum']}条数据 " . index_page($row['PageNum'], $linksize, $pagesize, 'pageball', array('searchterm', 'searchtype'));

//取当前页数据
$pageball = intval($_GET['pageball']);
$offset = $pagesize*($pageball - 1);

$query ="SELECT * FROM `myself_station` {$sqlWhere} ORDER BY stationid ASC LIMIT $offset,$pagesize";

$result = mysql_query($query);

$contentmyself_station = '';
// 表格头
	$contentmyself_station .= 	"<h4 align='CENTER'>公交站点搜索结果</h4>"
					."<table width='100%' border='1' FRAME='box' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"
					."<tr>"
					."<th width=8%>站点编号</th>"
					."<th >站点名</th>"
					."<th ></th>"
					."<th >所在道路</th>"
					."<th>地图标注</th>"
					."<th>别名1</th>"
					."<th>别名2</th>"
					."<th>相关站点1</th>"
					."<th>相关站点2</th>"
					."<th>相关站点3</th>"
					."<th>更新时间</th>"
					."<th>更新者</th>"
					."<th>是否删除</th>"
					. "</tr>";

while ($row = mysql_fetch_assoc($result))
{
	 $stationid = htmlspecialchars(stripslashes($row['stationid']));
	 $stationname = stripslashes($row['stationname']);
	 $newstationname = stripslashes($row['newstationname']);
	 $stroad = stripslashes($row['stroad']);
	 $stationpic = stripslashes($row['stationpic']);
	 $aliases1 = stripslashes($row['aliases1']);
	 $aliases2 = stripslashes($row['aliases2']);
	 $relation1 = stripslashes($row['relation1']);
	 $relation2 = stripslashes($row['relation2']);
	 $relation3 = stripslashes($row['relation3']);
	 $updatetime = stripslashes($row['updatetime']);
	 $editor = stripslashes($row['editor']);
	 $isdelete = stripslashes($row['isdelete']);

     
	$contentmyself_station .= "<tr>"

	. "<td>$stationid</td>"
	. "<td>$stationname</td>"
	. "<td>$newstationname</td>"
	. "<td> $stroad</td>"
	. "<td> $stationpic</td>"
	. "<td> $aliases1</td>"
	. "<td> $aliases2</td>"
	. "<td> $relation1</td>"
	. "<td> $relation2</td>"
	. "<td> $relation3</td>"
	. "<td> $updatetime</td>"
	. "<td> $editor</td>"
	. "<td> $isdelete</td>"
	. "</tr>";

} 
$contentmyself_station .= "</table>";

?>

<body>
<form method="get"> 	
<table align="center">
<tr align="center">
  <td >
	  <select align="center" name="searchtype"> 
	  <option value="Union">联合</option>
	  <option value="all">不限</option>
	  <option value="stationname">站点名</option>
	   <option value="stroad">所在道路</option>
    </select></td>
  <td >关键词:</td>
  <td> <input name="searchterm" type="text"></td>
  <td> <input name="sousuo" type="submit" value="搜索"></td>
    
</tr>
</table>
</form>
<table align="center">
  <tr >
  <td >
  <A href="/mine/search_station.php" > <U><FONT color=#0000ff>搜索站点</FONT></U></A>
  </td>
  <td >
  <A href="/mine/search_bus.php" > <U><FONT color=#0000ff>搜索线路</FONT></U></A>
  </td>
  <td >
  <A href="/mine/search_busline.php" > <U><FONT color=#0000ff>搜索busline</FONT></U></A>
  </td>
  </tr>
</table>

<!-- myself_station表的记录及分页 -->
<table id="results" width="100%">
<tr><td align="left">
<?php echo $contentmyself_station ?>
<td><tr>
</table>

<table width="100%">
<tr><td align="right">
<?php echo $pageationmyself_station ?>
<td><tr>
</table>
<!-- myself_station表的记录及分页 -->
</body>
</html>

