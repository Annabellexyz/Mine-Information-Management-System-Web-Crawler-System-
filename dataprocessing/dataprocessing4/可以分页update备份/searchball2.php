<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>����160:����������� </title>
</head>
<?php
// �����ҳ
function index_page($totalNum, $page_num = null, $showNum = null, $page = 'page', $matchArray = null) 
{
	if ( is_null($page_num) ) $page_num = 10;  // ��ҳ��ÿ��ʾ����ҳ��
	if ( is_null($showNum) ) $showNum  = 10;  // ÿҳ��ʾ�ļ�¼
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

	$pageString   .= ($curPage != 1) ? "<a href=\"{$URL}1\">��ҳ</a>" : "<a>��ҳ</a>";
	$pageString   .= ($PreviousPage > 0) ? "<a href=\"{$URL}{$PreviousPage}\">��һҳ</a>" : "";
	for ($i = $startNum; $i <= $endNum; $i++ ) {
		if ($i == $curPage) {
			$pageString .= "<a style=\"margin:auto 3px;\"><b>$i</b></a>";
			continue;
		}
		$pageString .= "<a style=\"margin:auto 3px;\" href=\"{$URL}{$i}\">{$i}</a>";
	}
	$NextPage = $curPage+1;
	//$pageString .= ($NextPage > $endNum) ? "" : "<a href=\"{$URL}{$NextPage}\">��һҳ</a></div>";
	$pageString .= ($NextPage > $endNum) ? "" : "<a href=\"{$URL}{$NextPage}\">��һҳ</a>";
	$pageString .= ($curPage == $totalPage) ? "βҳ" : "<a href=\"{$URL}{$totalPage}\">βҳ</a></div>";
	return $pageString;

}

//�������ݿ�
$host='172.16.1.61';
$username='admin';
$password='admin';
$db_name='phpcms';
$tb_name='myself_matches';

// ÿҳ��ʾ��������
$linksize = 20;
// ÿҳ��ʾ��������
$pagesize = 50;
	
$link=@mysql_connect($host,$username,$password);
@mysql_query("SET NAMES GBK");//����
//mysql_query("SET NAMES UTF8");
//mysql_query("SET CHARACTER_SET_CLIENT=utf8");
//mysql_query("SET CHARACTER_SET_RESULTS=utf8");

mysql_select_db($db_name, $link);

// print_r($_POST);

$content = '';  // ����
$pageation = ''; // ��ҳ

$MatchRequest = isset($_REQUEST['table']) ? trim($_REQUEST['table']) : '';

if ($MatchRequest == 'myself_matchtype')
{
	$myself_matchtype = isset($_GET['typename']) ? trim($_GET['typename']) : '';
	
	// myself_matches �ֶ�typename=> myself_matchtype�������ֶ�typename��
	$whereString = " WHERE `typename` LIKE '%{$myself_matchtype}%'";

	$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `myself_matchtype` {$whereString}";

	$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
	$row = mysql_fetch_assoc($result) OR die(mysql_error());
	
	// ��ҳ�ַ���
	$pageation = "��{$row['PageNum']}������ " . index_page($row['PageNum'], $linksize, $pagesize);
	
	//ȡ��ǰҳ����
	$page = intval($_GET['page']);
	$offset = $pagesize*($page - 1);
	
	$query ="SELECT * FROM `myself_matchtype` {$whereString} LIMIT $offset,$pagesize";

	$result = mysql_query($query);
	
	// ���ͷ
			$content .= 	"<h4 align='CENTER'>��������</h4>"
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
	// myself_matches �ֶ�hometeam=>myself_teams�������ֶ�teamname��
	// myself_matches�ֶ�guestteam=>myself_teams�������ֶ�teamname��
	$teamname = isset($_GET['teamname']) ? trim($_GET['teamname']) : '';  
  if (($pos = strpos($teamname, '(')) !== false)  
  {
    $teamname = substr($teamname, 0, $pos);
  }
  //echo $str; 
	// myself_matches �ֶ�typename=> myself_matchtype�������ֶ�typename��
	$whereString = " WHERE `teamname` LIKE '%{$teamname}%'";
	
	$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `myself_teams` {$whereString}";
	
	$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
	$row = mysql_fetch_assoc($result) OR die(mysql_error());
	

	// ��ҳ�ַ���
	$pageation = "��{$row['PageNum']}������ " . index_page($row['PageNum'], $linksize, $pagesize);
	
	//ȡ��ǰҳ����
	$page = intval($_GET['page']);
	$offset = $pagesize*($page - 1);
	
	$query ="SELECT * FROM `myself_teams` {$whereString} LIMIT $offset,$pagesize";
	$result = mysql_query($query);
	
		// ���ͷ
			$content .= 	"<h4 align='CENTER'>�������</h4>"
						."<table width='90%' border='1' FRAME='box' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>";

	while ($row = mysql_fetch_assoc($result))
	{
		$content .= "<tr align=center>"
		. "<td width='4%'>{$row['tid']}</td>"
		. "<td width='30%'>{$row['teamname']}����ͨ����</td>"
		. "<td width='30%'>{$row['teamname_big']}����������</td>"
		. "<td width='36%'>{$row['ename']}��Ӣ�ģ�</td>"
		. "</tr>"
		. "<tr>"
		. "<td></td>"
		. "<td colspan=3>����������̣�{$row['url']}<br>{$row['tintro']}</td>"
		. "</tr>";
		//"<h4 align=CENTER>����������̣�{$row['url']}</h4>"
	}


/*	while ($row = mysql_fetch_assoc($result))
	{
		$content .= "<tr align=center>"
		. "<td width='4%'>{$row['tid']}</td>"
		. "<td width='30%'>{$row['teamname']}����ͨ����</td>"
		. "<td width='30%'>{$row['teamname_big']}����������</td>"
		. "<td width='36%'>{$row['ename']}��Ӣ�ģ�</td>"
		. "</tr>"
		. "<tr>"
		. "<td></td>"
		. "<td colspan=3>{$row['tintro']}</td>"
		. "</tr>";
	}*/
	
}

//////////////////////////////////////////////////////////////////////////////////////
///
/// myself_matches ��ļ�¼
///
//////////////////////////////////////////////////////////////////////////////////////
$MatchRequest = isset($_REQUEST['matchrequest']) ? trim($_REQUEST['matchrequest']) : '';  // ��ȡ������Ϣ��

$searchMethod = isset($_REQUEST['searchtype']) ? trim($_REQUEST['searchtype']) : '';

$searchterm = isset($_REQUEST['searchterm']) ? trim($_REQUEST['searchterm']) : '';//�����ؼ���

$limit = isset($_GET['limit']) ? trim($_GET['limit']) : ''; // ��������

$limitArray = array();
if (!empty($limit))
	//$limitArray = explode(',', $limit);
	{	
	if(strpos($limit,','))
	   $limitArray=explode(',',$limit);
	elseif(strpos($limit,'��'))
	   $limitArray=explode('��',$limit);  
	elseif(strpos($limit,'��'))      
	   $limitArray=explode('��',$limit);
	else
	   $limitArray=explode(' ',$limit); 
	}

// �洢����ֶ�
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

// �ֿ��ؼ��ִ������ݿ�
//$teamArray = explode(',', $searchterm);
//�ֿ��ؼ��ִ������ݿ�
if(strpos($searchterm,','))
   $teamArray=explode(',',$searchterm);
elseif(strpos($searchterm,'��'))
   $teamArray=explode('��',$searchterm);  
elseif(strpos($searchterm,'��'))      
   $teamArray=explode('��',$searchterm);
else
   $teamArray=explode(' ',$searchterm); 

// ѭ�����˿ո�
foreach ($teamArray as $key => $value)
	$teamArray[$key] = trim($value);

// ��ʼ��SqlWhere
$sqlWhere = '';
switch ($searchMethod)
{
	case "Union":
		// �����洢SQL�������
		$queryWhereArray = array();
		// ����ȥ�ո�
		foreach ($teamArray as $key => $value)   // �ؼ���
		{
			$fieldFrameArray = array();  // �����ʱ�洢������Ƭ��
			foreach ($fieldArray as $fieldValue)  // �ֶ�
			{
				if (count($limitArray) > 0) {
					if (in_array($fieldValue, $limitArray))
						array_push($fieldFrameArray, "`{$fieldValue}` LIKE '%{$value}%'");
				}
				else
					array_push($fieldFrameArray, "`{$fieldValue}` LIKE '%{$value}%'");
			}
			// �ϲ�С��SqlWhere
			$smallSentence = '(' . implode(' OR ', $fieldFrameArray) . ')';
			// ��֯SQL���
			array_push($queryWhereArray, $smallSentence);
		}
		$sqlWhere = 'WHERE ' . implode(' AND ', $queryWhereArray);
		break;
	case "all":
		// �����洢SQL�������
		$queryWhereArray = array();
		// ����ȥ�ո�
		foreach ($fieldArray as $fieldValue)
		{
			foreach ($teamArray as $value)
			{
				array_push($queryWhereArray, "`{$fieldValue}` LIKE '%{$value}%'");
			}
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;
	// ������䴦������
	case "day":
	case "typename":
	case "hometeam":
	case "guestteam":
		$onlyField = $searchMethod;
		// �����洢SQL�������
		$queryWhereArray = array();
		// ����ȥ�ո�
		foreach ($teamArray as $value)
		{
			array_push($queryWhereArray, "`{$onlyField}` LIKE '%{$value}%'");
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;
	// Ĭ�ϲ���ȫ��
	default:
		$sqlWhere = '';
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `myself_matches` {$sqlWhere}";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// ��ҳ�ַ���
$pageationmyself_matches = "��{$row['PageNum']}������ " . index_page($row['PageNum'], $linksize, $pagesize, 'pageball', array('searchterm', 'searchtype'));

//ȡ��ǰҳ����
$pageball = intval($_GET['pageball']);
$offset = $pagesize*($pageball - 1);

$query ="SELECT * FROM `myself_matches` {$sqlWhere} ORDER BY day DESC,time DESC LIMIT $offset,$pagesize";
$result = mysql_query($query);

$contentmyself_matches = '';
// ���ͷ
	$contentmyself_matches .= 	"<h4 align='CENTER'>�����곡�����������</h4>"
					."<table width='95%' border='1' FRAME='box' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"
					."<tr>"
					."<th width=8%>���</th>"
					."<th width=13%>����</th>"
					."<th width=7%>ʱ��</th>"
					."<th width=10%>����</th>"
					."<th width=21%>����</th>"
					."<th width=5%>�ȷ�</th>"
					."<th width=20%>�Ͷ�</th>"
					."<th width=5%>�볡</th>"
					."<th width=11%>��ע</th>"
					."</tr>";
/*while ($row = mysql_fetch_assoc($result))
{
	$contentmyself_matches .= "<tr>"
	. "<td>{$row['id']}</td>"
	//. "<td><a href='?searchterm={$row['day']}&searchtype=day'>{$row['day']}</a></td>"
	. "<td><a href='?searchterm=".urlencode($row['day'])."&searchtype=day'>{$row['day']}</a></td>"
	. "<td>{$row['time']}</td>"
	. "<td><a href='?searchterm=".urlencode($row['typename'])."&searchtype=typename&pageball={$pageball}&typename={$row['typename']}&table=myself_matchtype'>{$row['typename']}</a></td>"
	. "<td><a href='?searchterm=".urlencode($row['hometeam'])."&searchtype=all&limit=hometeam,guestteam&pageball={$pageball}&teamname={$row['hometeam']}&table=myself_teams'>{$row['hometeam']}</a></td>"
	. "<td>{$row['points']}</td>"
	//. "<td><a href='?searchterm={$row['guestteam']}&searchtype=all&limit=hometeam,guestteam&pageball={$pageball}&teamname={$row['guestteam']}&table=myself_teams'>{$row['guestteam']}</a></td>"
	. "<td><a href='?searchterm=".urlencode($row['guestteam'])."&searchtype=all&limit=hometeam,guestteam&pageball={$pageball}&teamname={$row['guestteam']}&table=myself_teams'>{$row['guestteam']}</a></td>"
	. "<td>{$row['halfpoints']}</td>"
	. "<td>{$row['remarks']}</td>"
	. "</tr>";
}*/
/*<td> <input name="searchterm" type="text" value="<?=$searchterm?>"></td>*/
while ($row = mysql_fetch_assoc($result))
{
	$contentmyself_matches .= "<tr>"
	. "<td>{$row['id']}</td>";
	//. "<td><a href='?searchterm={$row['day']}&searchtype=day'>{$row['day']}</a></td>"
        if($row['day']==date('Y-m-d'))
        {
           $contentmyself_matches .= "<td><a href='?searchterm=".urlencode($row['day'])."&searchtype=day'><font color=red>{$row['day']}</font></a></td>";
        }
        else
        {
           $contentmyself_matches .= "<td><a href='?searchterm=".urlencode($row['day'])."&searchtype=day'>{$row['day']}</a></td>";
        }
	
	$contentmyself_matches .= "<td>{$row['time']}</td>"
	. "<td><a href='?searchterm=".urlencode($row['typename'])."&searchtype=typename&pageball={$pageball}&typename={$row['typename']}&table=myself_matchtype'>{$row['typename']}</a></td>"
	. "<td><a href='?searchterm=".urlencode($row['hometeam'])."&searchtype=all&limit=hometeam,guestteam&pageball={$pageball}&teamname={$row['hometeam']}&table=myself_teams'>{$row['hometeam']}</a></td>"
	. "<td>{$row['points']}</td>"
	//. "<td><a href='?searchterm={$row['guestteam']}&searchtype=all&limit=hometeam,guestteam&pageball={$pageball}&teamname={$row['guestteam']}&table=myself_teams'>{$row['guestteam']}</a></td>"
	. "<td><a href='?searchterm=".urlencode($row['guestteam'])."&searchtype=all&limit=hometeam,guestteam&pageball={$pageball}&teamname={$row['guestteam']}&table=myself_teams'>{$row['guestteam']}</a></td>"
	. "<td>{$row['halfpoints']}</td>"
	. "<td>{$row['remarks']}</td>"
	. "</tr>";
} 
?>

<body>
<form method="get"> 	
<table align="center">
<tr align="center">
  <td >
	  <select align="center" name="searchtype"> 
	  <option value="Union">����</option>
	  <option value="all">����</option>
	  <option value="day">����</option>
	  <option value="name">����</option>                           
	  <option value="hometeam">����</option>
	  <option value="guestteam">�Ͷ�</option>
    </select></td>
  <td >�ؼ���:</td>
  <td> <input name="searchterm" type="text"></td>
  <td> <input name="sousuo" type="submit" value="����"></td>
    
</tr>
<tr><td colspan=4>&nbsp;</td><tr>
<tr align="center">
  <td colspan=2>
  <A href="http://172.20.1.21/mine/searchteams2.php" target=_blank> <U><FONT color=#0000ff>����˴������������</FONT></U></A>
  </td>
  <td colspan=2>
  <A href="http://172.20.1.21/mine/searchball2.php" target=_blank> <U><FONT color=#0000ff>������곡����������ҳ</FONT></U></A>
  </td>
</tr>

</table>
</form>


<!-- myself_matchtype���myself_teams��ļ�¼����ҳ -->
<table width="100%">
<tr><td align="left">
<?php echo $content ?>
<td><tr>
</table>

<!-- myself_matchtype���myself_teams��ļ�¼����ҳ -->



<!-- myself_matches��ļ�¼����ҳ -->
<table id="results" width="100%">
<tr><td align="left">
<?php echo $contentmyself_matches ?>
<td><tr>
</table>

<table width="100%">
<tr><td align="right">
<?php echo $pageationmyself_matches ?>
<td><tr>
</table>
<!-- myself_matches��ļ�¼����ҳ -->
</body>
</html>

