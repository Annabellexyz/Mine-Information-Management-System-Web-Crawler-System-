<?php
	$fpath = str_replace('\\', '/',substr(dirname(__FILE__), 0, -14));
	require_once $fpath.'/include/common.inc.php'; 
	//echo $fpath.'/include/common_test.inc.php';//����·���Ƿ���ȷ
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>����160:PHPCMSϵͳ��ʷ¼�����²�ѯ���ʼ�ϵͳ </title>
<script src="/member/login.php?action=abc"></script>
</head>
<?php
echo "<a href = '/mine/articles/instruction.txt' target=_blank>����鿴ʹ��˵��||</a>";
echo "<a href = '/mine/articles/quality_search.php' target=_blank>����鿴�ʼ����б�</a>";
 // echo "��ǰ�û���".$_username;
 // �����ҳ
function index_page($totalNum, $page_num = null, $showNum = null, $page = 'page', $matchArray = null) 
{
	global $__GET, $__POST;
	if ( is_null($page_num) ) $page_num = 10;  // ��ҳ��ÿ��ʾ����ҳ��
	if ( is_null($showNum) ) $showNum  = 10;  // ÿҳ��ʾ�ļ�¼
	$curPage   = isset($__GET[$page]) && intval($__GET[$page]) > 0 ? intval($__GET[$page]) : 1;
	unset($__GET[$page],$__POST[$page]);
	$URL = '?';

	foreach ($__GET as $key => $value) {
		if ($matchArray != null) {
			if (in_array($key, $matchArray))
				$URL .= $key . '=' . $value . '&';
			continue;
		}
		$URL .= $key . '=' . $value . '&';
	}
	foreach ($__POST as $key => $value) {
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
	$__GET[$page] = $curPage;
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
include("conn.php");//�������ݿ�

// ÿҳ��ʾ��������
$linksize = 20;
// ÿҳ��ʾ��������
$pagesize = 50;
	
@mysql_query("SET NAMES GBK");//����

$content = '';  // ����
$pageation = ''; // ��ҳ
$MatchRequest = isset($__GET['table']) ? trim($__GET['table']) : '';//081215��
//////////////////////////////////////////////////////////////////////////////////////
///
/// phpcms_article_history. ��ļ�¼
///
//////////////////////////////////////////////////////////////////////////////////////
$MatchRequest = isset($__GET['matchrequest']) ? trim($__GET['matchrequest']) : '';//��ȡ������Ϣ��//081215��

$searchMethod = isset($__GET['searchtype']) ? trim($__GET['searchtype']) : '';

$searchterm = isset($__GET['searchterm']) ? trim($__GET['searchterm']) : '';//�����ؼ���

$limit = isset($__GET['limit']) ? trim($__GET['limit']) : ''; // ��������

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

// �洢���������ֶ�
$fieldArray = array(
	'articleid', 
	'channelname', 
	'catname',
	'title', 
	'editor',
	'edittime', 
	'content'
);

// �ֿ��ؼ��ִ������ݿ�
if(strpos($searchterm,','))
   $articleArray=explode(',',$searchterm);
elseif(strpos($searchterm,'��'))
   $articleArray=explode('��',$searchterm);  
elseif(strpos($searchterm,'��'))      
   $articleArray=explode('��',$searchterm);
else
   $articleArray=explode(' ',$searchterm); 

// ѭ�����˿ո�
foreach ($articleArray as $key => $value)
	$articleArray[$key] = trim($value);

// ��ʼ��SqlWhere
$sqlWhere = '';
switch ($searchMethod)
{
	case "Union":
		// �����洢SQL�������
		$queryWhereArray = array();
		// ����ȥ�ո�
		foreach ($articleArray as $key => $value)   // �ؼ���
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
			foreach ($articleArray as $value)
			{
				array_push($queryWhereArray, "`{$fieldValue}` LIKE '%{$value}%'");
			}
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;
			// ������䴦������
		case "articleid":
		case "channelname":
		case "catname":
		case "title":
		case "editor":
		case "edittime":
		case "content":
		$onlyField = $searchMethod;
		// �����洢SQL�������
		$queryWhereArray = array();
		// ����ȥ�ո�
		foreach ($articleArray as $value)
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

$pageNumberSql7 = "SELECT COUNT(1) AS PageNum7 FROM `phpcms_article_7_new` {$sqlWhere}";
$pageNumberSql8 = "SELECT COUNT(1) AS PageNum8 FROM `phpcms_article_8_new` {$sqlWhere}";
$pageNumberSql9 = "SELECT COUNT(1) AS PageNum9 FROM `phpcms_article_9_new` {$sqlWhere}";
$pageNumberSql10 = "SELECT COUNT(1) AS PageNum10 FROM `phpcms_article_10_new` {$sqlWhere}";
$pageNumberSql11 = "SELECT COUNT(1) AS PageNum11 FROM `phpcms_article_11_new` {$sqlWhere}";
$pageNumberSql12 = "SELECT COUNT(1) AS PageNum12 FROM `phpcms_article_12_new` {$sqlWhere}";
$pageNumberSql13 = "SELECT COUNT(1) AS PageNum13 FROM `phpcms_article_13_new` {$sqlWhere}";
$pageNumberSql14 = "SELECT COUNT(1) AS PageNum14 FROM `phpcms_article_14_new` {$sqlWhere}";
$pageNumberSql15 = "SELECT COUNT(1) AS PageNum15 FROM `phpcms_article_15_new` {$sqlWhere}";
$pageNumberSql16 = "SELECT COUNT(1) AS PageNum16 FROM `phpcms_article_16_new` {$sqlWhere}";
$pageNumberSql18 = "SELECT COUNT(1) AS PageNum18 FROM `phpcms_article_18_new` {$sqlWhere}";

//$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$result7 = mysql_query($pageNumberSql7) OR die(mysql_error() . __LINE__);
$result8 = mysql_query($pageNumberSql8) OR die(mysql_error() . __LINE__);
$result9 = mysql_query($pageNumberSql9) OR die(mysql_error() . __LINE__);
$result10 = mysql_query($pageNumberSql10) OR die(mysql_error() . __LINE__);
$result11 = mysql_query($pageNumberSql11) OR die(mysql_error() . __LINE__);
$result12 = mysql_query($pageNumberSql12) OR die(mysql_error() . __LINE__);
$result13 = mysql_query($pageNumberSql13) OR die(mysql_error() . __LINE__);
$result14 = mysql_query($pageNumberSql14) OR die(mysql_error() . __LINE__);
$result15 = mysql_query($pageNumberSql15) OR die(mysql_error() . __LINE__);
$result16 = mysql_query($pageNumberSql16) OR die(mysql_error() . __LINE__);
$result18 = mysql_query($pageNumberSql18) OR die(mysql_error() . __LINE__);

//$row = mysql_fetch_assoc($result) OR die(mysql_error());
$row7 = mysql_fetch_assoc($result7) OR die(mysql_error());
$row8 = mysql_fetch_assoc($result8) OR die(mysql_error());
$row9 = mysql_fetch_assoc($result9) OR die(mysql_error());
$row10 = mysql_fetch_assoc($result10) OR die(mysql_error());
$row11 = mysql_fetch_assoc($result11) OR die(mysql_error());
$row12 = mysql_fetch_assoc($result12) OR die(mysql_error());
$row13 = mysql_fetch_assoc($result13) OR die(mysql_error());
$row14 = mysql_fetch_assoc($result14) OR die(mysql_error());
$row15 = mysql_fetch_assoc($result15) OR die(mysql_error());
$row16 = mysql_fetch_assoc($result16) OR die(mysql_error());
$row18 = mysql_fetch_assoc($result18) OR die(mysql_error());

//$row_num = "{$row7['PageNum']}+{$row8['PageNum']}+{$row9['PageNum']}+{$row10['PageNum']}+{$row11['PageNum']}+{$row12['PageNum']}+{$row13['PageNum']}+{$row14['PageNum']}+{$row15['PageNum']}+{$row16['PageNum']}+{$row18['PageNum']}";
//$row_num = $row7['PageNum']+$row8['PageNum']+$row9['PageNum']+$row10['PageNum']+$row11['PageNum']+$row12['PageNum']+$row13['PageNum']+$row14['PageNum']+$row15['PageNum']+$row16['PageNum']+$row18['PageNum'];
$row_num = $row7[PageNum7]+$row8[PageNum8]+$row9[PageNum9]+$row10[PageNum10]+$row11[PageNum11]+$row12[PageNum12]+$row13[PageNum13]+$row14[PageNum14]+$row15[PageNum15]+$row16[PageNum16]+$row18[PageNum18];

// ��ҳ�ַ���
$pageationphpcms_article_history = "��{$row_num}������ " . index_page($row_num, $linksize, $pagesize, 'pageball', array('searchterm', 'searchtype'));

//ȡ��ǰҳ����
$pageball = intval($__GET['pageball']);
$offset = $pagesize*($pageball - 1);

$query ="SELECT * FROM `phpcms_article_7_new` {$sqlWhere} 
UNION SELECT * FROM `phpcms_article_8_new` {$sqlWhere} 
UNION SELECT * FROM `phpcms_article_9_new` {$sqlWhere} 
UNION SELECT * FROM `phpcms_article_10_new` {$sqlWhere} 
UNION SELECT * FROM `phpcms_article_11_new` {$sqlWhere} 
UNION SELECT * FROM `phpcms_article_12_new` {$sqlWhere} 
UNION SELECT * FROM `phpcms_article_13_new` {$sqlWhere} 
UNION SELECT * FROM `phpcms_article_14_new` {$sqlWhere} 
UNION SELECT * FROM `phpcms_article_15_new` {$sqlWhere} 
UNION SELECT * FROM `phpcms_article_16_new` {$sqlWhere} 
UNION SELECT * FROM `phpcms_article_18_new` {$sqlWhere} 
ORDER BY edittime DESC,channelid ASC,articleid DESC, id DESC LIMIT $offset,$pagesize";

$result = mysql_query($query);
//$num_results = mysql_num_rows($result);
//echo '<p>һ���ҵ�'.$row_num.'����¼</p>';//����$num_resultsֻ���ҵ���ǰҳ�ļ�¼����

$contentphpcms_article_history = '';
// ���ͷ
	$contentphpcms_article_history .= "<h4 align='CENTER'>PHPCMS��ʷ¼�����²�ѯ���ʼ�ϵͳ</h4>"
	        ."<p>һ���ҵ�'.$row_num.'����¼</p>"
					."<table border='1' width='777' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"
					. "<tr>"
					. "<TH align=center width=6%>ID</TH>"
					. "<TH align=center width=6%>Ƶ��</TH>"
					. "<TH align=center width=16%>��Ŀ</TH>"
					. "<TH align=center width=45%>����</TH>"
					. "<TH align=center width=21%>�༭ʱ��</TH>"
					. "<TH align=center width=6%>�༭</TH>"
					. "</tr>";

while ($row = mysql_fetch_assoc($result))
{
	 $id = htmlspecialchars(stripslashes($row['id']));
	 $articleid = stripslashes($row['articleid']);
	 $catid = stripslashes($row['catid']);
	 $title = stripslashes($row['title']);
	 $editor = stripslashes($row['editor']);
	 $edittime = stripslashes($row['edittime']);
	 $content = stripslashes($row['content']);
	 $channelname = stripslashes($row['channelname']);
	 $catname = stripslashes($row['catname']);
	 $channelid = stripslashes($row['channelid']);
	 $grade = stripslashes($row['grade']);
	 $remark = stripslashes($row['remark']);
	 $qualitytime = stripslashes($row['qualitytime']);
	 $qualityuser = stripslashes($row['qualityuser']);

//////////////////////////����Ϊ������ĿID�ҳ�Ƶ������Ŀ���ƣ�����article.class.phpʵ��/////////////////////////////////////////////////////////////////////////////// 
/* $query_cat = "SELECT * FROM `phpcms_category` WHERE catid = $catid";
	 $rs_cat = mysql_query($query_cat);
	 $row_cat = mysql_fetch_assoc($rs_cat);
	 //echo "<pre>";print_r($row_cat);echo "</pre>";
	 
	 $catname = htmlspecialchars(stripslashes($row_cat['catname']));
	 $channelid = stripslashes($row_cat['channelid']);//Ƶ��ID
	
	 if (!empty($channelid))
	{
	 $query_channel = "SELECT * FROM  `phpcms_channel` WHERE channelid = $channelid";
	 $rs_channel = mysql_query($query_channel);
	 
	 $row_channel = mysql_fetch_assoc($rs_channel);
		
	 $channelname = stripslashes($row_channel['channelname']);*/
	// echo "$channelname";echo "<br>";

	$contentphpcms_article_history .= '<tr>'
	. "<td>{$articleid}</td>"
	. "<td>{$channelname}</td>"
	. "<td>{$catname}</td>"
	. "<td align=center><font color=red>{$title}</font></td>"
	. "<td>{$edittime}</td>"
	. "<td>{$editor}</td>"
	. "</tr>"
	. "<tr>"
	. "<td width=777 colspan=6>{$content}</td>"
	. "</tr>"
	. "<tr>"
	. '<td width=777 align=right colspan=6>'
  . '<form action = "/mine/articles/index_insert.php" method = "post">
    <input id="qualityuser" type="text" value="'.$_username.'" readonly name="qualityuser" size="5"/> 
	  <input id="channelid" type="text" value="'.$channelid.'" readonly name="channelid" size="2"/> 
	  <input id="id" type="text" value="'.$id.'" readonly name="id" size="5"/> 
	  <input id="apple" type="radio" value="��" name="grade" checked/>��
	  <input id="banana" type="radio" value="��" name="grade" />��
	  <input id="mango" type="radio" value="��" name="grade" />��
	  <input id="other" type="radio" value="����" name="grade"/>����
	  <input id="remark" type="text" value="��ע" name="remark"  size="20"/>
	  <input type="submit" name="Submit" value="�ύ">
    </form></td>'
	. '</tr>'
	. "<tr><td colspan=6 align=right><font size=2 color=orange>"
	."�ʼ�����{$grade}|��ע��{$remark}|ʱ�䣺{$qualitytime}|��Ա��{$qualityuser}</td></tr>"
	.'<tr>'
	. '<td colspan=6 bgcolor=#ffcccc>&nbsp;</td>'
	.'</tr>';
 }
//}
$contentphpcms_article_history .= "</table>";

?>

<body>
<form method="get" target="_blank"> 	
<table align="center">
<tr align="center">
  <td >
	  <select align="center" name="searchtype"> 
	  <option value="Union">����</option>
	  <option value="all">����</option>
	  <option value="articleid">����ID</option>
	  <option value="channelname">Ƶ��</option>
	  <option value="catname">��Ŀ</option>
	  <option value="title">����</option>
	  <option value="editor">�༭��</option>
	  <option value="edittime">�༭ʱ��</option>
	  <option value="content">����</option>
    </select></td>
  <td >�ؼ���:</td>
  <td> <input name="searchterm" type="text"></td>
  <td> <input name="sousuo" type="submit" value="����"></td>
    
</tr>
</table>
</form>

<!-- phpcms_article_history��ļ�¼����ҳ -->
<table id="results" width="100%">
<tr><td align="left">
<?php echo $contentphpcms_article_history ?>
<td><tr>
</table>

<table width="100%">
<tr><td align="right">
<?php echo $pageationphpcms_article_history ?>
<td><tr>
</table>
<!-- phpcms_article_history��ļ�¼����ҳ -->
</body>
</html>