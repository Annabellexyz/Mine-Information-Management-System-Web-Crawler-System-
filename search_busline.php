<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>����160:����busline���� </title>
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
$host='localhost';
$username='admin';
$password='xxzx160168';
$db_name='phpcms';
$tb_name='myself_busline';

// ÿҳ��ʾ��������
$linksize = 20;
// ÿҳ��ʾ��������
$pagesize = 50;
	
$link=@mysql_connect($host,$username,$password);
@mysql_query("SET NAMES GBK");//����

mysql_select_db($db_name, $link);

// print_r($_POST);

$content = '';  // ����
$pageation = ''; // ��ҳ

//////////////////////////////////////////////////////////////////////////////////////
///
/// myself_busline ��ļ�¼
///
//////////////////////////////////////////////////////////////////////////////////////

$searchMethod = isset($_REQUEST['searchtype']) ? trim($_REQUEST['searchtype']) : '';

$searchterm = isset($_REQUEST['searchterm']) ? trim($_REQUEST['searchterm']) : '';//�����ؼ���

$limit = isset($_GET['limit']) ? trim($_GET['limit']) : ''; // ��������

$limitArray = array();
if (!empty($limit))
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

// �洢��������ֶ�
$fieldArray = array(
  'id',
	'busid', 
	'stationid', 
	'stationname', 
	'symbol',
	'sequence', 
	'isdelete',
	'isupdate'
);

// �ֿ��ؼ��ִ������ݿ�
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
		case "busid":
		case "stationname":
		$onlyField = $searchMethod;
		// �����洢SQL�������
		$queryWhereArray = array();
		// ����ȥ�ո�
		foreach ($teamArray as $value)
		{
			array_push($queryWhereArray, "`{$onlyField}` like '%{$value}%'");
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;

	// Ĭ�ϲ���ȫ��
	default:
		$sqlWhere = '';
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `myself_busline` {$sqlWhere}";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// ��ҳ�ַ���
$pageationmyself_busline = "��{$row['PageNum']}������ " . index_page($row['PageNum'], $linksize, $pagesize, 'pageball', array('searchterm', 'searchtype'));

//ȡ��ǰҳ����
$pageball = intval($_GET['pageball']);
$offset = $pagesize*($pageball - 1);

$query ="SELECT * FROM `myself_busline` {$sqlWhere} ORDER BY id ASC LIMIT $offset,$pagesize";

$result = mysql_query($query);

$contentmyself_busline = '';
// ���ͷ
	$contentmyself_busline .= 	"<h4 align='CENTER'>����busline�������</h4>"
					."<table width='75%' border='1' FRAME='box' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"
					."<tr>"
					."<th width=8%>���</th>"
					."<th >��·���</th>"
					."<th >վ����</th>"
					."<th>վ����</th>"
					."<th>���߱�ʶ��</th>"
					."<th>����</th>"
					."<th>�Ƿ�ɾ��</th>"
					."<th>�Ƿ����</th>"
					. "</tr>";

while ($row = mysql_fetch_assoc($result))
{
	 $id = htmlspecialchars(stripslashes($row['id']));
	 $busid = stripslashes($row['busid']);
	 $stationid = stripslashes($row['stationid']);
	 $stationname = stripslashes($row['stationname']);
	 $symbol = stripslashes($row['symbol']);
	 $sequence = stripslashes($row['sequence']);
	 $isdelete = stripslashes($row['isdelete']);
	 $isupdate = stripslashes($row['isupdate']);

     
	$contentmyself_busline .= "<tr>"

	. "<td>$id</td>"
	. "<td>$busid</td>"
	. "<td> $stationid</td>"
	. "<td> $stationname</td>"
	. "<td> $symbol</td>"
	. "<td> $sequence</td>"
	. "<td> $isdelete</td>"
	. "<td> $isupdate</td>"
	. "</tr>";

} 
$contentmyself_busline .= "</table>";

?>

<body>
<form method="get"> 	
<table align="center">
<tr align="center">
  <td >
	  <select align="center" name="searchtype"> 
	  <option value="Union">����</option>
	  <option value="all">����</option>
	  <option value="busid">��·���</option>
	  <option value="stationname">վ����</option>
    </select></td>
  <td >�ؼ���:</td>
  <td> <input name="searchterm" type="text"></td>
  <td> <input name="sousuo" type="submit" value="����"></td>
    
</tr>

</table>
</form>
<table align="center">
  <tr >
  <td >
  <A href="/mine/search_station.php" > <U><FONT color=#0000ff>����վ��</FONT></U></A>
  </td>
  <td >
  <A href="/mine/search_bus.php" > <U><FONT color=#0000ff>������·</FONT></U></A>
  </td>
  <td >
  <A href="/mine/search_busline.php" > <U><FONT color=#0000ff>����busline</FONT></U></A>
  </td>
  </tr>
</table>

<!-- myself_busline��ļ�¼����ҳ -->
<table id="results" width="100%">
<tr><td align="left">
<?php echo $contentmyself_busline ?>
<td><tr>
</table>

<table width="100%">
<tr><td align="right">
<?php echo $pageationmyself_busline ?>
<td><tr>
</table>
<!-- myself_busline��ļ�¼����ҳ -->
</body>
</html>

