<?php session_start(); 
	$fpath = str_replace('\\', '/',substr(dirname(__FILE__), 0, -17));
	require_once $fpath.'/include/common.inc.php'; 
	//echo $fpath.'/include/common.inc.php';//����·���Ƿ���ȷ
  //include("conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160���Ż�ҳ�������ݱ༭ϵͳ</title>
<script src="/member/login.php?action=abc"></script>
<script type="text/javascript"> 
function checkInput2(form) 
{     
var a = form.fax.value; 
if(a.length <  8 && a.length >  0 ) 
{ 
alert( "��������Ҫ����8���ַ� "); 
form.fax.focus(); 
} 
} 
</script>
<script type="text/javascript"> 
var ck=function()
{
	if(document.getElementById("remark").value=="")
		{
			alert("��ע��Ϣδ�")
			return false
		}
	else
		{
			
			if(document.getElementById("remark").value=="��ȷ")
				{	 	
					if(document.getElementById("new_phone").value.length<8)  		
						{
							alert("�绰λ�����ԣ�")
							return false
						}
					else
						return (myConfirm())?true:false;
				}
			else
				return true;
		}
			
}  

function myConfirm()
{
  if(window.document.getElementById("remark").value=="")
  { 
     alert("�����뷢�б�ע��");
     window.document.getElementById("remark").focus();
     return false;
  }
  else if(window.document.getElementById("fullname").value=="")
  { 
     alert("�����빫˾�������ƣ�");    
      window.document.getElementById("fullname").focus();
     return false;
  }
  else if(window.document.getElementById("edifice").value=="")
  { 
     alert("��������û�ҵ�����ƣ�");    
      window.document.getElementById("edifice").focus();
     return false;
  }
  else if(window.document.getElementById("floor").value=="")
  { 
     alert("������ʣ���ַ��");    
      window.document.getElementById("floor").focus();
     return false;
  }
  else if(window.document.getElementById("business").value=="")
  { 
     alert("��������Ӫ��");    
      window.document.getElementById("business").focus();
     return false;
  }
 else if(window.document.getElementById("new_phone").value=="")
  { 
     alert("�������µ绰��");    
      window.document.getElementById("new_phone").focus();
     return false;
  }
 else if(window.document.getElementById("principal").value=="")
  { 
     alert("�����뷢�и����ˣ�");    
      window.document.getElementById("principal").focus();
     return false;
  }
  else
  {
     if(confirm('ȷ���ύ������ҳ��¼��?'))
     {
     return true;
     }
     else
     {
     return false;
     }
  }
 
}
</script>
<style type="text/css">
<!--
.STYLE1 {font-size: 12px}
-->
</style>
</head>
<body>
	<table  border="1" align="center">
  <tr>
    <td width="120"><a href="/mine/page_update2">��ҳ�����޸�</a></td>
    <td width="120"><a href="/mine/page_insert2">��ҳ���ݲ���</a></td>
    <td width="120"><a href="/mine/page_update2/instruction.txt">ʹ��˵��</a></td>
  </tr>
</table>
<?php 
	
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

$linksize = 20;
$pagesize = 100;

$content = '';  // ����
$pageation = ''; // ��ҳ

if ($__GET['id'])//����ؼ���
{
 $id = isset($__GET['id']) ? trim($__GET['id']) : ''; 
 $whereString = " WHERE `id` LIKE '{$id}'";
 $query = "SELECT * FROM `china_szpage` {$whereString}";
 $result = mysql_query($query);
 while ($row = mysql_fetch_assoc($result)){
 	$id = stripslashes($row['id']);
 	$pid = stripslashes($row['pid']);
	$remark = stripslashes($row['remark']);
	$info_code = stripslashes($row['info_code']);
	$name = stripslashes($row['name']);
	$fullname = stripslashes($row['fullname']);//����
	$omissible = stripslashes($row['omissible']);//����
	$unomissible = stripslashes($row['unomissible']);//����
	$random_name = stripslashes($row['random_name']);//����
	$main_work = stripslashes($row['main_work']);//����
	$attribute = stripslashes($row['attribute']);//����
	$adjective = stripslashes($row['adjective']);//����
	$address = stripslashes($row['address']);
	$district = stripslashes($row['district']);//����
	$street = stripslashes($row['street']);//����
	$road = stripslashes($row['road']);
	$number = stripslashes($row['number']);//����
	$edifice = stripslashes($row['edifice']);
	$floor = stripslashes($row['floor']);
	$cell = stripslashes($row['cell']);
	$linkman  = stripslashes($row['linkman']);
	//$area  = isset($_POST['area']) ? trim($_POST['area']) : '';
	$category  = stripslashes($row['category']);
	$business  = stripslashes($row['business']);
	$telephone = stripslashes($row['telephone']);
	$new_phone = stripslashes($row['new_phone']);
	$mobilephone = stripslashes($row['mobilephone']);
	$fax  = stripslashes($row['fax']);
	$website  = stripslashes($row['website']);
	$email  = stripslashes($row['email']);
	$principal  = stripslashes($row['principal']);
	$editor  = stripslashes($row['editor']);
	$edittime  = stripslashes($row['edittime']);
//"<form name=form1 method=post action='index_update.php?lmbs={$row[id]}'"
 $content_id .= "<table align='center' width='620' border='1'>"
             // ."<form name='form1' method='post' onsubmit='return myConfirm();' action='index_update.php?lmbs={$row[id]}'>"
             ."<form name='form1' method='post' onsubmit='return ck()' action='index_update.php?lmbs={$row[id]}'>"
              ."<tr><td width=150 align='center' class='STYLE1'>ID�����޸ģ�</td>"
              ."<td><input name='id' type='text' id='id' value='{$row[id]}' readonly size='6'></td></tr>"           
              ."<tr><td width=150 align='center' class='STYLE1'>���б�ע��*��</td>"
              ."<td><input name='remark' type='text' id='remark' value='{$row[remark]}' size='10'></td></tr>"           
              ."<tr><td width=150 align='center' class='STYLE1'>��Ϣ���루���޸ģ�</td>"
              ."<td><input name='info_code' type='text' id='info_code' value='{$row[info_code]}' readonly size='8'></td></tr>"             
              ."<tr><td width=150 align='center' class='STYLE1'>ԭ�������ƣ����޸ģ�</td>"
              ."<td><input name='name' type='text' id='name' value='{$row[name]}' readonly size='30'></td></tr>"           
              ."<tr><td width=150 align='center' class='STYLE1'>�����������ƣ�*��</td>"
              ."<td><input name='fullname' type='text' id='fullname' value='{$row[fullname]}' size='30'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>��ϸ���ϣ����޸ģ�</td>"
              ."<td>{$row['detail']}</td></tr>"   
              ."<tr><td width=150 align='center' class='STYLE1'><font color=red>��ҵ��ϵ��</font></td>" 
              ."<td><input name='linkman' type='text' id='linkman' value='{$row[linkman]}' size='30'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>����</td>" 
              ."<td><input name='person' type='text' id='person' value='{$row[person]}' size='30'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>��ҵ����</td>" 
              ."<td><input name='types' type='text' id='types' value='{$row[types]}' size='30'></td></tr>"     
              ."<tr><td width=150 align='center' class='STYLE1'>ԭ��ַ�����޸ģ�</td>"
              ."<td><input name='address' type='text' id='address' value='{$row[address]}' readonly size='30'></td></tr>"

              ."<tr><td width=150 align='center' class='STYLE1'>��</td>"
              ."<td><input name='district' type='text' id='district' value='{$row[district]}'  size='10'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>����/��ҵ��/��԰��*��</td>"
              ."<td><input name='edifice' type='text' id='edifice' value='{$row[edifice]}' size='16'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>ʣ���ַ��*��</td>"
              ."<td><input name='floor' type='text' id='floor' value='{$row[floor]}' size='8'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>��Ӫ��*��</td>"
              ."<td><input name='business' type='text' id='business' value='{$row[business]}' size='25'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>ԭ�绰�����޸ģ�</td>"
              ."<td><input name='telephone' type='text' id='telephone' value='{$row[telephone]}' readonly size='50'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>�µ绰��*��</td>" //onBlur='(remak.value=="��ȷ")?checkInput(this.form):return'
           //   ."<td><input name='new_phone' type='text' id='new_phone' value='{$row[new_phone]}' size='60' onBlur='checkInput(this.form);' ></td></tr>"
           //   ."<td><input name='new_phone' type='text' id='new_phone' value='{$row[new_phone]}' size='60' onBlur='javascript:(remak.value==\"��ȷ\")?checkInput(this.form):void(0)' ></td></tr>"
           //��ʱ��Ҫ ."<td><input name='new_phone' type='text' id='new_phone' value='{$row[new_phone]}' size='60' onBlur='javascript:(remark.value==\"��ȷ\")?checkInput(this.form):void(0)' ></td></tr>"
              ."<td><input name='new_phone' type='text' id='new_phone' value='{$row[new_phone]}' size='60' ></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>����</td>"
              ."<td><input name='fax' type='text' id='fax' value='{$row[fax]}' size='20' onBlur='checkInput2(this.form);'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>��ַ</td>"
              ."<td><input name='website' type='text' id='website' value='{$row[website]}' size='20'></td></tr>"
         //     ."<tr><td width=150 align='center' class='STYLE1'>����</td>"
         //     ."<td><input name='email' type='text' id='email' value='{$row[email]}' size='20'></td></tr>"
         //     ."<tr><td width=150 align='center' class='STYLE1'>���и�����</td>"
         //     ."<td><input name='principal' type='text' id='principal' value='{$row[principal]}' size='20'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>¼����</td>"
              //. "<td align='center' class='STYLE1'><input name='editor' type='text' id='editor' value='{$_username}'readonly size='6'></td>"  
              ."<td><input name='editor' type='text' id='editor' value='{$row[editor]}' readonly size='6'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>¼������</td>"
              ."<td><input name='edittime' type='text' id='edittime' value='{$row[edittime]}' readonly size='20'></td></tr>"
              . "<tr><td width=150 align='center' class='STYLE1'>�ύ</td><td align='left'><input type='image' name='imageField' src='images/bg1.jpg'></td></tr>"
              ."</form>"
              ."</table>" ;            
}
}
else{
$content_id = "";	
}

//$searchMethod = isset($_REQUEST['searchtype']) ? trim($_REQUEST['searchtype']) : '';
//$searchterm = isset($_REQUEST['searchterm']) ? trim($_REQUEST['searchterm']) : '';//�����ؼ���
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
	
// �洢����ֶ�
$fieldArray = array(
  'id',
  'pid',
	'remark', 
	
	'name', 
	'fullname',
	'omissible',
	'unomissible',
	'random_name',
	'main_work',
	'attribute',
	'adjective',
	'address',
	'district',
	'street',
	'road', 
	'number',
	'edifice', 
	'floor',
	'cell', 
	'telephone', 
	'new_phone',
	'mobilephone',
	'linkman',
	'category',
	'business',
	'fax',
	'website',
	'email',
	'principal',
	'person',
	'types',
	'editor',
	'edittime'
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
	//case "info_code":
	case "name":
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
	case "edifice":
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

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `china_szpage` {$sqlWhere}";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// ��ҳ�ַ���
$pageation = "��{$row['PageNum']}������ " . index_page($row['PageNum'], $linksize, $pagesize);

//ȡ��ǰҳ����
$pageball = intval($__GET['page']);
$offset = $pagesize*($pageball - 1);

$query1 ="SELECT * FROM `china_szpage` {$sqlWhere} ORDER BY name ASC,ID ASC LIMIT $offset,$pagesize";
$result = mysql_query($query1);

$content ="";					
$content .="<table height=264 border=0 cellpadding=0 cellspacing=0 >"
         ."<tr>"
	       ."<td  height=2>&nbsp;</td>"
	       ."<td >&nbsp;</td>"
	       ."<td >&nbsp;</td>"
	       ."</tr>"
	       ."<tr>"
	       ."<td height=125>&nbsp;</td>"
	       ."<td align='left' valign='top'><table width=150 border=1 cellpadding=0 cellspacing=0>"
		     ."<tr>"
		     ."<td  align='center' class='STYLE1'>ID</td>"
		     //."<td width=150 align='center' class='STYLE1'>����</td>"
	       ."<td  height=25 align='center' class='STYLE1'>���б�ע</td>"//ԭ��Ϊ��������
	       ."<td  align='center' class='STYLE1'>��Ϣ����</td>"
	       ."<td  align='center' class='STYLE1'>ԭ��������</td>"//��˾ԭ��������
	       ."<td  align='center' class='STYLE1'>ԭ�绰</td>" 
	       ."<td  align='center' class='STYLE1'>�µ绰</td>" 
	       //."<td width=100 align='center' class='STYLE1' >��ϸ����</td>" 
	       ."<td  align='center' class='STYLE1'>��ҵ��ϵ��</td>" 
	       ."<td  align='center' class='STYLE1'>����</td>" 
	       ."<td  align='center' class='STYLE1'>��ҵ����</td>" 
	       ."<td  align='center' class='STYLE1'>ԭ��ַ</td>"
	       ."<td  align='center' class='STYLE1'>����/��ҵ��/��԰</td>"
	       ."<td  align='center' class='STYLE1'>ʣ���ַ</td>"//ԭΪ������
	       ."<td  height=25 align='center' class='STYLE1'>��Ӫ</td>"
	       ."<td  height=25 align='center' class='STYLE1'>����</td>" 
	       ."<td height=25 align='center' class='STYLE1'>��ַ</td>" 
	    //   ."<td width=150 height=25 align='center' class='STYLE1'>����</td>" 
	    //   ."<td width=150 height=25 align='center' class='STYLE1'>���и�����</td>" 
	       ."<td  height=25 align='center' class='STYLE1'>¼����</td>" 
	       ."<td  height=25 align='center' class='STYLE1'>¼������</td>" 
	      // ."<td width=150 height=25 align='center' class='STYLE1'>������Ʒ</td>" 	       
	       //."<td width=80 align='center'></td>"
	       ."</tr>";					
	       
if($result)
{
	
while ($row = mysql_fetch_assoc($result))
{
	$content .= "<form name=form1 method=post action='index_update.php?lmbs={$row[id]}'"
      . "<tr>"
      //. "<td height=25 align=center class='STYLE1'><label>"
      //. "<td align='center' class='STYLE1'><input name='remark' type='text' id='remark' value='{$row[remark]}' size='10'></td>"
      //. "</label></td>"
      //. "<td height=25 align=center class='STYLE1'><label>"
      //mine/page_update/?searchtype=id&searchterm=4
     // . "<td><a href='?searchtype=id&searchterm={$row[id]}' target=_blank>{$row[id]}</a></td>"
     . "<td><a href='?searchtype=id&searchterm={$row[id]}&id={$row[id]}' target=_blank>{$row[id]}</a></td>"
      //. "<input name='id' type='text' id='id' value='{$row[id]}' readonly size='6'>"
     // . "</label></td>"
    //  . "<td align='center' class='STYLE1'><input name='pid' type='text' id='pid' value='{$row[pid]}' readonly size='6'></td>"
      . "<td align='center' class='STYLE1' ><input name='remark' type='text' id='remark' value='{$row[remark]}' size='10'></td>"
      . "<td align='center' class='STYLE1'><input maxlength='5' name='info_code' type='text' id='info_code' value='{$row[info_code]}' readonly size='6'></td>"
     . "<td align='center' class='STYLE1'><input name='name' type='text' id='name' value='{$row[name]}' readonly size='24'></td>"
    
    . "<td align='center' class='STYLE1'><input name='telephone' type='text' id='telephone' value='{$row[telephone]}' readonly size='10'></td>"
    . "<td align='center' class='STYLE1'><input name='new_phone' type='text' id='new_phone' value='{$row[new_phone]}' size='10'></td>"
    . "<td align='center' class='STYLE1'><input name='linkman' type='text' id='linkman' value='{$row[linkman]}' size='10'></td>"
    //. "<td align='center' class='STYLE1'><input name='detail' type='text' id='detail' value='{$row[detail]}' size='30'></td>"
    //."<td  style='font-size: 9pt;width:30px' >{$row['detail']}</td>"
    . "<td align='center' class='STYLE1'><input name='person' type='text' id='person' value='{$row[person]}' size='10'></td>"
    . "<td align='center' class='STYLE1'><input name='types' type='text' id='types' value='{$row[types]}' size='20'></td>"
    //  . "<td align='center' class='STYLE1'><input name='fullname' type='text' id='fullname' value='{$row[fullname]}' size='30'></td>"
    //  . "<td align='center' class='STYLE1'><input name='omissible' type='text' id='omissible' value='{$row[omissible]}' size='12'></td>"//����
    //  . "<td align='center' class='STYLE1'><input name='unomissible' type='text' id='unomissible' value='{$row[unomissible]}' size='12'></td>"//����
    //  . "<td align='center' class='STYLE1'><input name='random_name' type='text' id='random_name' value='{$row[random_name]}' size='12'></td>"//����
    //  . "<td align='center' class='STYLE1'><input name='main_work' type='text' id='main_work' value='{$row[main_work]}' size='12'></td>"//����
    //  . "<td align='center' class='STYLE1'><input name='attribute' type='text' id='attribute' value='{$row[attribute]}' size='12'></td>"//����
    //  . "<td align='center' class='STYLE1'><input name='branch' type='text' id='branch' value='{$row[branch]}' size='12'></td>"//����
    //  . "<td align='center' class='STYLE1'><input name='adjective' type='text' id='adjective' value='{$row[adjective]}' size='12'></td>"//����
      . "<td align='center' class='STYLE1'><input name='address' type='text' id='address' value='{$row[address]}' readonly size='25'></td>"
   //   . "<td align='center' class='STYLE1'><input name='district' type='text' id='district' value='{$row[district]}' size='10'></td>"
   //   . "<td align='center' class='STYLE1'><input name='street' type='text' id='street' value='{$row[street]}' size='10'></td>"
    //  . "<td align='center' class='STYLE1'><input name='road' type='text' id='points' value='{$row[road]}' size='10'></td>"
    //  . "<td align='center' class='STYLE1'><input name='number' type='text' id='number' value='{$row[number]}' size='10'></td>"
      . "<td align='center' class='STYLE1'><input name='edifice' type='text' id='edifice' value='{$row[edifice]}' size='12'></td>"
      . "<td align='center' class='STYLE1'><input name='floor' type='text' id='floor' value='{$row[floor]}' size='8'></td>"
    //  . "<td align='center' class='STYLE1'><input name='cell' type='text' id='cell' value='{$row[cell]}' size='8'></td>"   
    //  . "<td align='center' class='STYLE1'><input name='linkman' type='text' id='linkman' value='{$row[linkman]}' size='10'></td>"   
     // . "<td align='center' class='STYLE1'><input name='area' type='text' id='area' value='{$row[area]}' size='12'></td>"  
    //  . "<td align='center' class='STYLE1'><input name='category' type='text' id='category' value='{$row[category]}' size='25'></td>"  
      . "<td align='center' class='STYLE1'><input name='business' type='text' id='business' value='{$row[business]}' size='20'></td>"  
      
   //   . "<td align='center' class='STYLE1'><input name='mobilephone' type='text' id='mobilephone' value='{$row[mobilephone]}' size='30'></td>"
      . "<td align='center' class='STYLE1'><input name='fax' type='text' id='fax' value='{$row[fax]}' size='10'></td>"  
      . "<td align='center' class='STYLE1'><input name='website' type='text' id='website' value='{$row[website]}' size='20'></td>"  
    //  . "<td align='center' class='STYLE1'><input name='email' type='text' id='email' value='{$row[email]}' size='20'></td>"  
   //   . "<td align='center' class='STYLE1'><input name='principal' type='text' id='principal' value='{$row[principal]}' size='10'></td>"  
      . "<td align='center' class='STYLE1'><input name='editor' type='text' id='editor' value='{$row[editor]}' readonly size='5'></td>"  
      . "<td align='center' class='STYLE1'><input name='edittime' type='text' id='edittime' value='{$row[edittime]}' readonly size='20'></td>"  
      //. "<td align='center' class='STYLE1'><input name='gift' type='text' id='gift' value='{$row[gift]}' size='16'></td>"  
      //. "<td align='center'><input type='image' name='imageField' src='images/bg1.jpg'></td>"//��ʱ����¼��Ա�ڴ˴�����޸�����
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
	  <option value="name">��˾����</option>    
	  <option value="edifice">��������</option>                      
    </select></td>
  <td >�ؼ���:</td>
  <td> <input name="searchterm" type="text"></td>
  <td> <input name="sousuo" type="submit" value="����"></td>    
</tr>
</table>
</form>

<!-- �����ѯid�ļ�¼����ҳ -->
<table id="results" width="100%">
<tr><td align="left">
<?php echo $content_id ?>
<td><tr>
</table>

<!-- �ܱ�ļ�¼����ҳ -->
<table  id="results" width="100%">
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
