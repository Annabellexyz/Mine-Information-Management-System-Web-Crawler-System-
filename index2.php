<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>����160��PHPCMSϵͳ��ʷ���²�ѯ </title>
<script language="LiveScript">
<!-- Hiding
 /* today = new Date()
  document.write("�� �� ʱ �� �ǣ� ",today.getHours(),":",today.getMinutes())
  document.write("<br>�� �� �� �� Ϊ�� ", today.getMonth()+1,"/",today.getDate(),"/",today.getYear());*/
// end hiding contents -->
</script>
<script src="/member/login.php?action=abc"></script>
</head>
<?php
require './include/common.inc.php';
//$username=$HTTP_COOKIE_VARS["phpcms_user"];
echo "��ǰ�û���".$_username;
print_r($_SESSION);

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
$host='172.20.1.21';
$username='admin';
$password='xxzx160168';
$db_name='phpcms';
//$tb_name='phpcms_article_history';

// ÿҳ��ʾ��������
$linksize = 20;
// ÿҳ��ʾ��������
$pagesize = 50;
	
$link=@mysql_connect($host,$username,$password);
@mysql_query("SET NAMES GBK");//����

mysql_select_db($db_name, $link);

$content = '';  // ����
$pageation = ''; // ��ҳ

//////////////////////////////////////////////////////////////////////////////////////
///
/// phpcms_article_history. ��ļ�¼
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
	'articleid', 
	'channelname', 
	'catname',
	'title', 
	'editor',
	'edittime', 
	'content',
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
//$result7 = mysql_query($pageNumberSql7) OR die(mysql_error() . __LINE__);
//$row7 = mysql_fetch_assoc($result7) OR die(mysql_error());
//print_r($row7);
//echo $row7[PageNum7];
//echo "��ͨ��������"."{$row7['PageNum']}";

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
//$pageNumberSql = $pageNumberSql7+$pageNumberSql8+$pageNumberSql9+$pageNumberSql10+$pageNumberSql11+$pageNumberSql12+$pageNumberSql13+$pageNumberSql14+$pageNumberSql15+$pageNumberSql16+$pageNumberSql18;
//$pageNumberSql = "$pageNumberSql7+$pageNumberSql8+$pageNumberSql9+$pageNumberSql10+$pageNumberSql11+$pageNumberSql12+$pageNumberSql13+$pageNumberSql14+$pageNumberSql15+$pageNumberSql16+$pageNumberSql18";
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
//echo $row7[PageNum];
//echo $row_num;
// ��ҳ�ַ���
//$pageationphpcms_article_history = "��{$row['PageNum']}������ " . index_page($row['PageNum'], $linksize, $pagesize, 'pageball', array('searchterm', 'searchtype'));
$pageationphpcms_article_history = "��{$row_num}������ " . index_page($row_num, $linksize, $pagesize, 'pageball', array('searchterm', 'searchtype'));

//ȡ��ǰҳ����
$pageball = intval($_GET['pageball']);
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
ORDER BY id DESC LIMIT $offset,$pagesize";

$result = mysql_query($query);
/*
//��Ҫ�ٵ�����*/
$num_results = mysql_num_rows($result);
//echo '<p>һ���ҵ�'.$num_results.'����¼</p>';

$contentphpcms_article_history = '';
// ���ͷ
	$contentphpcms_article_history .= "<h4 align='CENTER'>����160��PHPCMSϵͳ��ʷ���²�ѯ���</h4>"
	        ."<p>һ���ҵ�'.$num_results.'����¼</p>"
					."<table border='1' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"
					. "<tr>"
					. "<TH align=center>ID</TH>"
					. "<TH align=center>Ƶ��</TH>"
					. "<TH align=center>��Ŀ</TH>"
					. "<TH align=center>����</TH>"
					. "<TH align=center>�༭ʱ��</TH>"
					. "<TH align=center>�༭��</TH>"
					. "<TH align=center>����ID</TH>"
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
	. "<td>{$id}</td>"
	. "<td>{$channelname}</td>"
	. "<td>{$catname}</td>"
	. "<td align=center><font color=red>{$title}</font></td>"
	. "<td>{$edittime}</td>"
	. "<td>{$editor}</td>"
	. "<td>{$articleid}</td>"
	. "</tr>"
	. "<tr>"
	. "<td width=760 colspan=7>{$content}</td>"
	. "</tr>"
	. "<tr>"
	. '<td width=760 align=right colspan=7>'
	. '<form action = "/mine/articles/index_insert.php" method = "post">
	  <input id="apple" type="radio" value="ƻ��" name="fruit" /><label for="apple" >ƻ��</label>
	  <input id="banana" type="radio" value="�㽶" name="fruit" /><label for="banana" >�㽶</label>
	  <input id="mango" type="radio" value="â��" name="fruit" /><label for="mango" >â��</label>
	  <input id="other" type="radio" value="����" name="fruit"/> <label for="other" >����</label>
	  <input id="remark" type="text" value="��ע" name="remark"  size="30"/>
	  <input type="submit" name="Submit" value="�ύ">
    </form></td>'
	. '</tr>'
	.'<tr>'
	. '<td colspan=7 bgcolor=yellow>&nbsp;</td>'
	.'</tr>';
 }
//}
$contentphpcms_article_history .= "</table>";

?>

<body>
<form method="get"> 	
<table align="center">
<tr align="center">
  <td >
	  <select align="center" name="searchtype"> 
	  <option value="Union">����</option>
	  <option value="all">����</option>
	  <option value="id">���</option>
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
<!---<tr><td colspan=4>&nbsp;</td><tr>-->
	<!---
<tr align="center">
  <td colspan=2>
  <A href="http://172.20.1.21/mine/searchteams2.php" target=_blank> <U><FONT color=#0000ff>����˴������������</FONT></U></A>
  </td>
  <td colspan=2>
  <A href="http://172.20.1.21/mine/searchball2.php" target=_blank> <U><FONT color=#0000ff>������곡����������ҳ</FONT></U></A>
  </td>
</tr>
-->
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