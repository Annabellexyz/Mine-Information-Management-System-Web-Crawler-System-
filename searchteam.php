<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>深圳160:足球球队资料搜索 </title>
</head>
<?php
//连接数据库
$host='172.20.1.21';
$username='admin';
$password='xxzx160168';
$db_name='phpcms';
$tb_name='myself_teams';
$link=@mysql_connect($host,$username,$password);
@mysql_query("SET NAMES GBK");//编码
mysql_select_db($db_name, $link);

//$content = '';  // 内容
$contentmyself_teams = '';

//$searchM = isset($_REQUEST['searchway']) ? trim($_REQUEST['searchway']) : '';
$searchwords = isset($_REQUEST['searchwords']) ? trim($_REQUEST['searchwords']) : '';//搜索关键词

$limit = isset($_GET['limit']) ? trim($_GET['limit']) : ''; // 条件限制

$limitArray = array();
if (!empty($limit))
	$limitArray = explode(',', $limit);

// 存储球队资料字段
$fieldArray = array(
  'tid',
	'teamname', 
	'teamname_big', 
	'ename', 
	'tintro'
);
// 分开关键字存于数据库
//$teamsArray = explode(',', $searchwords);
if(strpos($searchwords,','))
   $teamsArray=explode(',',$searchwords);
elseif(strpos($searchwords,'，'))
   $teamsArray=explode('，',$searchwords);  
elseif(strpos($searchwords,'　'))      
   $teamsArray=explode('　',$searchwords);
else
   $teamsArray=explode(' ',$searchwords); 
   
// 循环过滤空格
foreach ($teamsArray as $keytwo => $valuetwo)
	$teamsArray[$keytwo] = trim($valuetwo);
// 初始化SqlWheretwo
$sqlWheretwo = '';
$queryWhereArray = array();
foreach ($teamArray as $key => $valuetwo)   // 关键字
$fieldFrameArray = array();  // 清空临时存储的数据片段
			foreach ($fieldArray as $fieldValue)  // 字段
			{
				if (count($limitArray) > 0) {
					if (in_array($fieldValue, $limitArray))
						array_push($fieldFrameArray, "`{$fieldValue}` LIKE '%{$valuetwo}%'");
				}
				else
					array_push($fieldFrameArray, "`{$fieldValue}` LIKE '%{$valuetwo}%'");
			}
			// 合并小的SqlWhere
			$smallSentence = '(' . implode(' OR ', $fieldFrameArray) . ')';
			// 组织SQL语句
			array_push($queryWhereArray, $smallSentence);
		$sqlWhere = 'WHERE ' . implode(' AND ', $queryWhereArray);
		
		$query ="SELECT * FROM `myself_teams` {$sqlWhere} ORDER BY tid DESC";
		$result = mysql_query($query);

    $contentmyself_teams = '';
    // 表格头
  	$contentmyself_teams .= "<h4 align='CENTER'>足球球队资料搜索结果</h4>"
					."<table width='90%' border='1' FRAME='box' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"
					."<tr align=center>"
					. "<td width='7%'>{$row['tid']}</td>"
					. "<td width='31%'>{$row['teamname']}（普通话）</td>"
					. "<td width='31%'>{$row['teamname_big']}（白话音）</td>"
					. "<td width='31%'>{$row['ename']}（英文）</td>"
					. "</tr>"
					. "<tr>"
					. "<td align='center'><font color=orange>球<br>队<br>资<br>料</font></td>"
					. "<td colspan=3>{$row['tintro']}</td>"
					. "</tr>"
					."<table>";
?>

<body>

<form method="get"> 	
<table align="center">
<tr align="center">
 <td >
  <select align="center" name="searchway"> 
  <option value="qiudui">球队</option>
</select></td>
<td >关键词:</td>
<td> <input name="searchwords" type="text"></td>
<td> <input name="sousuotwo" type="submit" value="搜索"></td></tr>
</table>
</form>

<!-- myself_matchtype表或myself_teams表的记录及分页 -->
<table width="100%">
<tr><td align="left">
<?php echo $contentmyself_teams ?>
<td><tr>
</table>
</body>
</html>