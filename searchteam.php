<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>����160:��������������� </title>
</head>
<?php
//�������ݿ�
$host='172.20.1.21';
$username='admin';
$password='xxzx160168';
$db_name='phpcms';
$tb_name='myself_teams';
$link=@mysql_connect($host,$username,$password);
@mysql_query("SET NAMES GBK");//����
mysql_select_db($db_name, $link);

//$content = '';  // ����
$contentmyself_teams = '';

//$searchM = isset($_REQUEST['searchway']) ? trim($_REQUEST['searchway']) : '';
$searchwords = isset($_REQUEST['searchwords']) ? trim($_REQUEST['searchwords']) : '';//�����ؼ���

$limit = isset($_GET['limit']) ? trim($_GET['limit']) : ''; // ��������

$limitArray = array();
if (!empty($limit))
	$limitArray = explode(',', $limit);

// �洢��������ֶ�
$fieldArray = array(
  'tid',
	'teamname', 
	'teamname_big', 
	'ename', 
	'tintro'
);
// �ֿ��ؼ��ִ������ݿ�
//$teamsArray = explode(',', $searchwords);
if(strpos($searchwords,','))
   $teamsArray=explode(',',$searchwords);
elseif(strpos($searchwords,'��'))
   $teamsArray=explode('��',$searchwords);  
elseif(strpos($searchwords,'��'))      
   $teamsArray=explode('��',$searchwords);
else
   $teamsArray=explode(' ',$searchwords); 
   
// ѭ�����˿ո�
foreach ($teamsArray as $keytwo => $valuetwo)
	$teamsArray[$keytwo] = trim($valuetwo);
// ��ʼ��SqlWheretwo
$sqlWheretwo = '';
$queryWhereArray = array();
foreach ($teamArray as $key => $valuetwo)   // �ؼ���
$fieldFrameArray = array();  // �����ʱ�洢������Ƭ��
			foreach ($fieldArray as $fieldValue)  // �ֶ�
			{
				if (count($limitArray) > 0) {
					if (in_array($fieldValue, $limitArray))
						array_push($fieldFrameArray, "`{$fieldValue}` LIKE '%{$valuetwo}%'");
				}
				else
					array_push($fieldFrameArray, "`{$fieldValue}` LIKE '%{$valuetwo}%'");
			}
			// �ϲ�С��SqlWhere
			$smallSentence = '(' . implode(' OR ', $fieldFrameArray) . ')';
			// ��֯SQL���
			array_push($queryWhereArray, $smallSentence);
		$sqlWhere = 'WHERE ' . implode(' AND ', $queryWhereArray);
		
		$query ="SELECT * FROM `myself_teams` {$sqlWhere} ORDER BY tid DESC";
		$result = mysql_query($query);

    $contentmyself_teams = '';
    // ���ͷ
  	$contentmyself_teams .= "<h4 align='CENTER'>������������������</h4>"
					."<table width='90%' border='1' FRAME='box' cellspacing='0' cellpadding='0' align='CENTER' valign='middle'>"
					."<tr align=center>"
					. "<td width='7%'>{$row['tid']}</td>"
					. "<td width='31%'>{$row['teamname']}����ͨ����</td>"
					. "<td width='31%'>{$row['teamname_big']}���׻�����</td>"
					. "<td width='31%'>{$row['ename']}��Ӣ�ģ�</td>"
					. "</tr>"
					. "<tr>"
					. "<td align='center'><font color=orange>��<br>��<br>��<br>��</font></td>"
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
  <option value="qiudui">���</option>
</select></td>
<td >�ؼ���:</td>
<td> <input name="searchwords" type="text"></td>
<td> <input name="sousuotwo" type="submit" value="����"></td></tr>
</table>
</form>

<!-- myself_matchtype���myself_teams��ļ�¼����ҳ -->
<table width="100%">
<tr><td align="left">
<?php echo $contentmyself_teams ?>
<td><tr>
</table>
</body>
</html>