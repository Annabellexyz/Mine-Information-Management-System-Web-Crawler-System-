<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>深圳160:商家黄页资料搜索 </title>
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
$tb_name='myself_companies';

// 每页显示的链接数
$linksize = 20;
// 每页显示数据数量
$pagesize = 200;
	
$link=@mysql_connect($host,$username,$password);
@mysql_query("SET NAMES GBK");//编码

mysql_select_db($db_name, $link);

// print_r($_POST);

$content = '';  // 内容
$pageation = ''; // 分页

$MatchRequest = isset($_REQUEST['table']) ? trim($_REQUEST['table']) : '';

if ($MatchRequest == 'myself_matchtype')
{
	$myself_matchtype = isset($_GET['typename']) ? trim($_GET['typename']) : '';
	
	// myself_matches 字段typename=> myself_matchtype表（关联字段typename）
	$whereString = " WHERE `typename` LIKE '%{$myself_matchtype}%'";

	$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `myself_matchtype` {$whereString}";

	$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
	$row = mysql_fetch_assoc($result) OR die(mysql_error());
	
	// 分页字符串
	$pageation = "共{$row['PageNum']}条数据 " . index_page($row['PageNum'], $linksize, $pagesize);
	
	//取当前页数据
	$page = intval($_GET['page']);
	$offset = $pagesize*($page - 1);
	
	$query ="SELECT * FROM `myself_matchtype` {$whereString} LIMIT $offset,$pagesize";

	$result = mysql_query($query);
	
	// 表格头
			$content .= 	"<h4 align='CENTER'>赛事资料</h4>"
						."<table width='90%' border='1' FRAME='box' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>";
	while ($row = mysql_fetch_assoc($result))
	{
		$content .= "<tr align=center>"
		. "<td>{$row['typename']}</td>"
		. "</tr>"
		. "<tr>"
		. "<td>{$row['typeintro']}</td>"
		. "</tr>";
	}
}
else if($MatchRequest == 'myself_teams')
{	
	// myself_matches 字段hometeam=>myself_teams表（关联字段teamname）
	// myself_matches字段guestteam=>myself_teams表（关联字段teamname）
	$teamname = isset($_GET['teamname']) ? trim($_GET['teamname']) : '';  
  if (($pos = strpos($teamname, '(')) !== false)  
  {
    $teamname = substr($teamname, 0, $pos);
  }
  //echo $str; 
	// myself_matches 字段typename=> myself_matchtype表（关联字段typename）
	$whereString = " WHERE `teamname` LIKE '%{$teamname}%'";
	
	$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `myself_teams` {$whereString}";
	
	$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
	$row = mysql_fetch_assoc($result) OR die(mysql_error());
	

	// 分页字符串
	$pageation = "共{$row['PageNum']}条数据 " . index_page($row['PageNum'], $linksize, $pagesize);
	
	//取当前页数据
	$page = intval($_GET['page']);
	$offset = $pagesize*($page - 1);
	
	$query ="SELECT * FROM `myself_teams` {$whereString} LIMIT $offset,$pagesize";
	$result = mysql_query($query);
	
		// 表格头
			$content .= 	"<h4 align='CENTER'>球队资料</h4>"
						."<table width='90%' border='1' FRAME='box' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>";
	while ($row = mysql_fetch_assoc($result))
	{
		$content .= "<tr align=center>"
		. "<td width='4%'>{$row['tid']}</td>"
		. "<td width='32%'>{$row['teamname']}（普通话）</td>"
		. "<td width='32%'>{$row['teamname_big']}（粤语音）</td>"
		. "<td width='32%'>{$row['ename']}（英文）</td>"
		. "</tr>"
		. "<tr>"
		. "<td></td>"
		. "<td colspan=3>{$row['tintro']}</td>"
		. "</tr>";
	}
	
}

//////////////////////////////////////////////////////////////////////////////////////
///
/// myself_matches 表的记录
///
//////////////////////////////////////////////////////////////////////////////////////
$MatchRequest = isset($_REQUEST['matchrequest']) ? trim($_REQUEST['matchrequest']) : '';  // 获取所查信息表

$searchMethod = isset($_REQUEST['searchtype']) ? trim($_REQUEST['searchtype']) : '';

$searchterm = isset($_REQUEST['searchterm']) ? trim($_REQUEST['searchterm']) : '';//搜索关键词

$limit = isset($_GET['limit']) ? trim($_GET['limit']) : ''; // 条件限制

$limitArray = array();
if (!empty($limit))
	//$limitArray = explode(',', $limit);
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

// 存储球队字段
$fieldArray = array(
  'comid',
	'telone', 
	'connector', 
	'teltwo', 
	'comfax',
	'comcity', 
	'comaddr', 
	'comemail',
	'comwebsite', 
	'comname'
);

// 分开关键字存于数据库
//$teamArray = explode(',', $searchterm);
//分开关键字存于数据库
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
	case "comname":
	case "category":
	case "telone":
	case "comid":
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

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `myself_companies` {$sqlWhere}";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// 分页字符串
$pageationmyself_company = "共{$row['PageNum']}条数据 " . index_page($row['PageNum'], $linksize, $pagesize, 'pageball', array('searchterm', 'searchtype'));

//取当前页数据
$pageball = intval($_GET['pageball']);
$offset = $pagesize*($pageball - 1);

$query ="SELECT * FROM `myself_companies` {$sqlWhere} ORDER BY comid DESC LIMIT $offset,$pagesize";
$result = mysql_query($query);

$contentmyself_companies = '';
// 表格头
	$contentmyself_companies .= 	"<h4 align='CENTER'>商家黄页搜索结果</h4>"
					."<table width='100%' border='1' FRAME='box' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"
					."<tr>"
					."<th width=6%>企业ID</th>"
					."<th width=24%>公司名称</th>"
					."<th width=17%>行业分类</th>"
					."<th width=8%>公司电话</th>"
					."<th width=8%>传真号码</th>"
					."<th width=6%>联系人</th>"
					."<th width=31%>联系地址</th>"
					."</tr>";
while ($row = mysql_fetch_assoc($result))
{
	/*$contentmyself_companies .= "<tr>"
	. "<td>{$row['id']}</td>"
	. "<td><a href='?searchterm=".urlencode($row['comid'])."&searchtype=day'>{$row['comid']}</a></td>"
	. "<td>{$row['comname']}</td>"
	. "<td><a href='?searchterm=".urlencode($row['category'])."&searchtype=typename&pageball={$pageball}&typename={$row['typename']}&table=myself_matchtype'>{$row['typename']}</a></td>"
	. "<td><a href='?searchterm=".urlencode($row['hometeam'])."&searchtype=all&limit=hometeam,guestteam&pageball={$pageball}&teamname={$row['hometeam']}&table=myself_teams'>{$row['hometeam']}</a></td>"
	. "<td>{$row['points']}</td>"
	. "<td><a href='?searchterm=".urlencode($row['guestteam'])."&searchtype=all&limit=hometeam,guestteam&pageball={$pageball}&teamname={$row['guestteam']}&table=myself_teams'>{$row['guestteam']}</a></td>"
	. "<td>{$row['halfpoints']}</td>"
	. "<td>{$row['remarks']}</td>"
	. "</tr>";*/
	
		$contentmyself_companies .= "<tr>"
	. "<td>{$row['comid']}</td>"
	. "<td>{$row['comname']}</td>"
	//. "<td>{$row['category']}</td>"
	. "<td><a href='?searchterm=".urlencode($row['category'])."&searchtype=category&pageball={$pageball}&category={$row['category']}&table=myself_companies'>{$row['category']}</a></td>"
	. "<td>{$row['telone']}</td>"
	. "<td>{$row['comfax']}</td>"
	. "<td>{$row['connector']}</td>"
	. "<td>{$row['comaddr']}</td>"

	. "</tr>";
}
/*<td> <input name="searchterm" type="text" value="<?=$searchterm?>"></td>*/
?>

<body>
<form method="get"> 	
<table align="center">
<tr align="center">
  <td >
	  <select align="center" name="searchtype"> 
	  <option value="Union">联合</option>
	  <option value="all">不限</option>
	  <option value="day">公司</option>
	  <option value="name">行业</option>                           
	  <option value="hometeam">电话</option>
	  <option value="guestteam">ID</option>
    </select></td>
  <td >关键词:</td>
  <td> <input name="searchterm" type="text"></td>
  <td> <input name="sousuo" type="submit" value="搜索"></td>
    
</tr>

</table>
</form>


<!-- myself_matchtype表或myself_teams表的记录及分页 -->
<table width="100%">
<tr><td align="left">
<?php echo $content ?>
<td><tr>
</table>

<!-- myself_matchtype表或myself_teams表的记录及分页 -->



<!-- myself_matches表的记录及分页 -->
<table id="results" width="100%">
<tr><td align="left">
<?php echo $contentmyself_companies ?>
<td><tr>
</table>

<table width="100%">
<tr><td align="right">
<?php echo $pageationmyself_company ?>
<td><tr>
</table>

