<?php session_start(); include("conn.php");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160足球完场赛事数据编辑系统</title>
<script src="/member/login.php?action=abc"></script>
<style type="text/css">
<!--
.STYLE1 {font-size: 12px}
-->
</style>
</head>
<body>

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

$linksize = 20;
$pagesize = 50;

$content = '';  // 内容
$pageation = ''; // 分页

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
	
// 存储球队字段
$fieldArray = array(
  'id',
	'day', 
	'time', 
	'typename', 
	'hometeam',
	'hometeam_big', 
	'points', 
	'guestteam',
	'guestteam_big', 
	'halfpoints', 
	'remarks'
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
		case "day":
		case "typename":
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

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `chinatelecom_page` {$sqlWhere}";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// 分页字符串
$pageation = "共{$row['PageNum']}条数据 " . index_page($row['PageNum'], $linksize, $pagesize);

//取当前页数据
$pageball = intval($_GET['page']);
$offset = $pagesize*($pageball - 1);

$query1 ="SELECT * FROM `chinatelecom_page` {$sqlWhere} ORDER BY day DESC,time DESC LIMIT $offset,$pagesize";
$result = mysql_query($query1);

$content ="";					
$content .="<table height=264 border=0 cellpadding=0 cellspacing=0 >"
         ."<tr>"
	       ."<td width=100 height=2>&nbsp;</td>"
	       ."<td width=500>&nbsp;</td>"
	       ."<td width=100>&nbsp;</td>"
	       ."</tr>"
	       ."<tr>"
	       ."<td height=125>&nbsp;</td>"
	       ."<td align='left' valign='top'><table border=1 cellpadding=0 cellspacing=0>"
		     ."<tr>"
	       ."<td width=60 height=25 align='center' class='STYLE1'>编号</td>"
	       ."<td width=150 align='center' class='STYLE1'>日期</td>"
	       ."<td width=60 align='center' class='STYLE1'>时间</td>"
	       ."<td width=60 align='center' class='STYLE1'>赛事</td>"
	       ."<td width=100 align='center' class='STYLE1'>主队</td>"
	       ."<td width=40 align='center' class='STYLE1'>比分</td>"
	       ."<td width=100 align='center' class='STYLE1'>客队</td>"
	       ."<td width=40 align='center' class='STYLE1'>半场</td>"
	       ."<td width=100 align='center' class='STYLE1'>备注</td>"
	       ."<td width=100 align='center' class='STYLE1'>主队繁体</td>"
	       ."<td width=100 align='center'><span class='STYLE1'>客队繁体</span></td>"  
	      // ."<td width=60 height=25 align='center' class='STYLE1'>编辑者</td>"   
	       ."<td width=80 align='center'></td>"
	       ."</tr>";					
	       
if($result){
while ($row = mysql_fetch_assoc($result))
{
	//$sid=$row[id];
	//$sid=trim($sid);
	//echo $sid; echo "<br>";//searchterm={$row['day']}
	//$content .= "<form name=form1 method=post action='index_update.php?lmbs=<?php echo $sid}'>"
	//$content .= "<form name=form1 method=post action='index_update.php?lmbs={$row['id']}'"
	$content .= "<form name=form1 method=post action='index_update.php?lmbs={$row[id]}'"
      . "<tr>"
      . "<td height=25 align=center class='STYLE1'><label>"
      . "<input name='id' type='text' id='id' value='{$row[id]}' size='6'>"
      . "</label></td>"
      . "<td align='center' class='STYLE1'><input name='day' type='text' id='day' value='{$row[day]}' size='10'></td>"
      . "<td align='center' class='STYLE1'><input name='time' type='text' id='time' value='{$row[time]}' size='6'></td>"
      . "<td align='center' class='STYLE1'><input name='typename' type='text' id='typename' value='{$row[typename]}' size='10'></td>"
      . "<td align='center' class='STYLE1'><input name='hometeam' type='text' id='hometeam' value='{$row[hometeam]}' size='16'></td>"
      . "<td align='center' class='STYLE1'><input name='points' type='text' id='points' value='{$row[points]}' size='4'></td>"
      . "<td align='center' class='STYLE1'><input name='guestteam' type='text' id='guestteam' value='{$row[guestteam]}' size='16'></td>"
      . "<td align='center' class='STYLE1'><input name='halfpoints' type='text' id='halfpoints' value='{$row[halfpoints]}' size='4'></td>"
      . "<td align='center' class='STYLE1'><input name='remarks' type='text' id='remarks' value='{$row[remarks]}' size='12'></td>"
      . "<td align='center' class='STYLE1'><input name='hometeam_big' type='text' id='hometeam_big' value='{$row[hometeam_big]}' size='12'></td>"
      . "<td align='center' class='STYLE1'><input name='guestteam_big' type='text' id='guestteam_big' value='{$row[guestteam_big]}' size='12'></td>"  
      //<input id="qualityuser" type="text" value="'.$_username.'" readonly name="qualityuser" size="5"/>        
      //. "<input name='editor' type='text' id='editor' value="'.$_username.'" readonly size='6'>"
      . "<td align='center'><input type='image' name='imageField' src='images/bg1.jpg'></td>"
      . " </tr>"
	    . "</form>";
}
}
$content .= "</table>"
    . "</td>"
   . " <td>&nbsp;</td>"
  . "</tr>"
  . "<tr>"
    . "<td height=33>&nbsp;</td>"
    . "<td>&nbsp;</td>"
    . "<td>&nbsp;</td>"
  . "</tr>"
. "</table>";			
?>

<form method="get"> 	
<table align="center">
<tr align="center">
  <td >
	  <select align="center" name="searchtype"> 
	  <option value="Union">联合</option>
	  <option value="all">不限</option>
	  <option value="day">日期</option>
	  <option value="typename">赛事</option>                           
    </select></td>
  <td >关键词:</td>
  <td> <input name="searchterm" type="text"></td>
  <td> <input name="sousuo" type="submit" value="搜索"></td>    
</tr>
</table>
</form>

<!-- myself_teams表的记录及分页 -->
<table id="results" width="100%">
<tr><td align="left">
<?php echo $content ?>
<td><tr>
</table>

<table width="100%">
<tr><td align="right">
<?php echo $pageation ?>
<td><tr>
</table>

</body>
</html>
