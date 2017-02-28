<?php session_start(); include("conn.php");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160�����곡�������ݱ༭ϵͳ</title>
<script src="/member/login.php?action=abc"></script>
<style type="text/css">
<!--
.STYLE1 {font-size: 12px}
-->
</style>
</head>
<body>

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

$linksize = 20;
$pagesize = 50;

$content = '';  // ����
$pageation = ''; // ��ҳ

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

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `chinatelecom_page` {$sqlWhere}";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// ��ҳ�ַ���
$pageation = "��{$row['PageNum']}������ " . index_page($row['PageNum'], $linksize, $pagesize);

//ȡ��ǰҳ����
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
	       ."<td width=60 height=25 align='center' class='STYLE1'>���</td>"
	       ."<td width=150 align='center' class='STYLE1'>����</td>"
	       ."<td width=60 align='center' class='STYLE1'>ʱ��</td>"
	       ."<td width=60 align='center' class='STYLE1'>����</td>"
	       ."<td width=100 align='center' class='STYLE1'>����</td>"
	       ."<td width=40 align='center' class='STYLE1'>�ȷ�</td>"
	       ."<td width=100 align='center' class='STYLE1'>�Ͷ�</td>"
	       ."<td width=40 align='center' class='STYLE1'>�볡</td>"
	       ."<td width=100 align='center' class='STYLE1'>��ע</td>"
	       ."<td width=100 align='center' class='STYLE1'>���ӷ���</td>"
	       ."<td width=100 align='center'><span class='STYLE1'>�Ͷӷ���</span></td>"  
	      // ."<td width=60 height=25 align='center' class='STYLE1'>�༭��</td>"   
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
	  <option value="Union">����</option>
	  <option value="all">����</option>
	  <option value="day">����</option>
	  <option value="typename">����</option>                           
    </select></td>
  <td >�ؼ���:</td>
  <td> <input name="searchterm" type="text"></td>
  <td> <input name="sousuo" type="submit" value="����"></td>    
</tr>
</table>
</form>

<!-- myself_teams��ļ�¼����ҳ -->
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
