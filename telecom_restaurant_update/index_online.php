<?php session_start();
	$fpath = str_replace('\\', '/',substr(dirname(__FILE__), 0, -31));
	require_once $fpath.'/include/common.inc.php';
	//echo $fpath.'/include/common.inc.php';//����·���Ƿ���ȷ
  //include("conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160���Ų������ݲ�ѯϵͳ</title>
<script src="/member/login.php?action=abc"></script>
<script type="text/javascript">
function _(v){return document.getElementById(v);}

function radio_value(name){
	for(i=0;i<_('myform').elements.length;i++){
		if(_('myform').elements[i].checked && _('myform').elements[i].name == name)
			return _('myform').elements[i].value;
	}
	return null;
}

function ck(){
	if(!radio_value("remark")){
		alert("��ע��Ϣδ�") ;
		return false ;
	}else{
		if(radio_value("remark") == "�Ѻ˶�"){
			if(_("telephone").value.length<8){
				alert("�绰λ��С��8λ��") ;
				return false ;
			}else{
				return myConfirm();
			}
		}else{
			return true;
		}
	}
}

/*function ched(name){
	for(i=0;i<_('myform').elements.length;i++){
		if(_('myform').elements[i].checked && _('myform').elements[i].name == name)
			return true;
	}
	return false;
}*/

function ched(name){
	for(i=0,j=_('myform').elements.length;i<j;i++){
		if(_('myform').elements[i].name == name && _('myform').elements[i].checked)
			return true;
	}
	return false;
} 

function myConfirm(){
	if(!ched('remark')){
		alert("��ѡ��ע��");
		return false;
	}
	
	if(!ched('district')){
		alert("��ѡ������");
		return false;
	}

	if(!ched('theme[]')){
		alert("��ѡ������ʣ�");
		return false;
	}

	if(!ched('changetype[]')){
		alert("��ѡ�����ݸ������࣡");
		return false;
	}

	if(!ched('foodkind[]')){
		alert("��ѡ���ò����ͣ�");
		return false;
	}

	if(!ched('creditcard[]')){
		alert("��ѡ�񿨣�");
		return false;
	}
	
	if(window.document.getElementById("fullname").value=="")
  { 
     alert("������ȫ����");    
      window.document.getElementById("fullname").focus();
     return false;
  }
  
  if(window.document.getElementById("consumename").value=="")
  { 
     alert("��������������");    
      window.document.getElementById("consumename").focus();
     return false;
  }
  
  if(window.document.getElementById("address").value=="")
  { 
     alert("�������ַ��");    
      window.document.getElementById("address").focus();
     return false;
  }
/*  if(window.document.getElementById("district").value=="")
  { 
     alert("����������");    
      window.document.getElementById("district").focus();
     return false;
  }*/
  if(window.document.getElementById("businesshours").value=="")
  { 
     alert("������Ӫҵʱ�䣡");    
      window.document.getElementById("businesshours").focus();
     return false;
  }

	/*if(_("fullname").value == ""){
		alert("������ȫ����");
		_("fullname").focus();
		return false;
	}

	if(_("consumename").value==""){
		alert("��������������");
		_("consumename").focus();
		return false;
	}
	if(_("address").value==""){
		alert("�������ַ��");
		_("address").focus();
		return false;
	}
	if(_("district").value==""){
		alert("����������");
		_("district").focus();
		return false;
	}
  
	if(_("businesshours").value==""){
		alert("������Ӫҵʱ�䣡");
		_("businesshours").focus();
		return false;
	}*/

	return confirm('ȷ���ύ������¼��?');
}
</script>

<style type="text/css">
<!--
.STYLE1 {font-size: 12px}
-->
</style>
</head>
<body>
<h5><a href = '' target=_blank>�ҷ������µĲ�������</a></h5>
  <!--
    <td width="120"><a href="/mine/telecom_restaurant_update">���������޸�</a></td>
    <td width="120"><a href="/mine/telecom_restaurant_insert">�������ݲ���</a></td>-->
   
 
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
 $query = "SELECT * FROM `telecom_restaurant` {$whereString}";
 $result = mysql_query($query);
 while ($row = mysql_fetch_assoc($result)){
 	
 	$changetype = stripslashes($row['changetype']);
 	if( (strpos($changetype,"|")) == false )
 	{ 
   $changetype_array[0] = $changetype;
  }
  else
  {
 	 $changetype_array = explode('|',$changetype);
  }
  
 	$remark = stripslashes($row['remark']);
	$name = stripslashes($row['name']);
	$telephone = stripslashes($row['telephone']);
	$address = stripslashes($row['address']);
	$district = stripslashes($row['district']);
	$road = stripslashes($row['road']);//����
	
	$doorplate = stripslashes($row['doorplate']);
	$edifice = stripslashes($row['edifice']);//����
	//$street = stripslashes($row['street']);//����
	$floor = stripslashes($row['floor']);
	$busline = stripslashes($row['busline']);
	$introduction = stripslashes($row['introduction']);//����
	$businesshours = stripslashes($row['businesshours']);
	
	$theme = stripslashes($row['theme']);
	//$theme_array = explode('��',$theme);
  if( (strpos($theme,"|")) == false )
 	{ 
   $theme_array[0] = $theme;
  }
  else
  {
 	 $theme_array = explode('|',$theme);
  }

	$category  = stripslashes($row['category']);
	//$area  = isset($_POST['area']) ? trim($_POST['area']) : '';
	//$category  = stripslashes($row['category']);
	$information  = stripslashes($row['information']);
	
	$foodkind = stripslashes($row['foodkind']);
  if( (strpos($foodkind,"|")) == false )
 	{ 
   $foodkind_array[0] = $foodkind;
  }
  else
  {
 	 $foodkind_array = explode('|',$foodkind);
  }
	
	$creditcard = stripslashes($row['creditcard']);
	if( (strpos($creditcard,"|")) == false )
 	{ 
   $creditcard_array[0] = $creditcard;
  }
  else
  {
 	 $creditcard_array = explode('|',$creditcard);
  }
	
	$capacity  = stripslashes($row['capacity']);
	$roomamount  = stripslashes($row['roomamount']);
	$signfood  = stripslashes($row['signfood']);
	
	$foodtype  = stripslashes($row['foodtype']);
  if( (strpos($foodtype,"|")) == false )
 	{ 
   $foodtype_array[0] = $foodtype;
  }
  else
  {
 	 $foodtype_array = explode('|',$foodtype);
  }
  
	$flavor  = stripslashes($row['flavor']);
	if( (strpos($flavor,"|")) == false )
 	{ 
   $flavor_array[0] = $flavor;
  }
  else
  {
 	 $flavor_array = explode('|',$flavor);
  }
  
	$togo  = stripslashes($row['togo']);
	$parking  = stripslashes($row['parking']);
	$editor  = stripslashes($row['editor']);
	$edittime  = stripslashes($row['edittime']);
//"<form name=form1 method=post action='index_update.php?lmbs={$row[id]}'"
 $content_id .= "<table align='center' width=75% border='1'>"
              ."<form name='form1' id='myform' method='post'  onsubmit='return ck()'  action='index_update.php?lmbs={$row[id]}'>"
              ."<tr><td width=20% align='center' class='STYLE1'>ID</td>"
              ."<td><input name='id' type='text' id='id' value='{$row[id]}' readonly size='10'></td></tr>"
              
              ."<tr><td align='center' class='STYLE1'>��ע��*��</td>"
              ."<td>"
              .$row['remark']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>ȫ����*��</td>"
              ."<td>"
              .$row['fullname']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>��������*��</td>"
              ."<td>"
              .$row['consumename']              
              ."</td></tr>"                   
              ."<tr><td align='center' class='STYLE1'>�绰���루*��</td>"
              ."<td>"
              .$row['telephone'] 
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>��ַ��*��</td><td>"
              .$row['address']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>����*��</td>"
              ."<td>"
              .$row['district']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>·</td>"
              ."<td>"
              .$row['road']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>����</td>"
              ."<td>"
              .$row['doorplate']              
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>����/��԰/С��</td><td>"
              .$row['edifice']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>ʣ���ַ</td><td>"
              .$row['floor']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>�˳�·��</td><td>"
              .$row['busline']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>��ҵ����</td><td>"
              .$row['introduction']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>Ӫҵʱ�䣨*��</td><td>"
              .$row['businesshours']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>����ʣ�*��</td><td>"
              .$row['theme']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>������Ϣ</td><td>"
              .$row['information']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>�ò����ͣ�*��</td><td>"
               .$row['foodkind']
               ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>���ÿ���*��</td><td>"             
              .$row['creditcard']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>������</td><td>"
              .$row['capacity']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>������</td><td>"
              .$row['roomamount']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>���Ʋ�</td><td>"
              .$row['signfood']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1' >��ϵ</td><td>"
              .$row['foodtype']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>��ζ</td><td>"
              .$row['flavor']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>���ͷ���</td><td>"
              .$row['togo']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>ͣ��λ</td><td>"
              .$row['parking']
              ."</td></tr>"
              
             
              ."<tr><td align='center' class='STYLE1'>¼������</td><td>"
              .$row['edittime']
              . "</td></tr><tr><td align='center' class='STYLE1'><font color=red>��Ҫ����</font></td><td align='left'><a href ='/mine/telecom_restaurant_update/restaurant_edit.php?searchterm={$row[id]}&id={$row[id]}' target=_blank>����޸�������¼</a></td></tr>"
              ."</form>"
              ."</table>" ;
}

echo $content_id;
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

	'fullname', //
	'consumename', //
	'address',//
	'district',//

	'road', //
	'doorplate',//
	'edifice', //
	'floor',//
	'busline',

	'telephone', //
	'introduction', //

	'businesshours',//
	'theme',//
	'category',//
	'information',//
	'foodkind',//
	'creditcard',//
	'capacity',//
	'roomamount',//
	'signfood',//
	'foodtype',//
	'flavor',//
	'togo',//
	'parking',//
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
						array_push($fieldFrameArray, "`{$fieldValue}` LIKE '%{$value}%' AND remark like '�Ѻ˶�'");
				}
				else
					array_push($fieldFrameArray, "`{$fieldValue}` LIKE '%{$value}%' AND remark like '�Ѻ˶�'");
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
				array_push($queryWhereArray, "`{$fieldValue}` LIKE '%{$value}%' AND remark like '�Ѻ˶�'");
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
			array_push($queryWhereArray, "`{$onlyField}` LIKE '%{$value}%' AND remark like '�Ѻ˶�'");
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
			array_push($queryWhereArray, "`{$onlyField}` LIKE '%{$value}%' AND remark like '�Ѻ˶�'");
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;

	case "pid":
		$onlyField = $searchMethod;
		// �����洢SQL�������
		$queryWhereArray = array();
		// ����ȥ�ո�
		foreach ($teamArray as $value)
		{
			//array_push($queryWhereArray, "`{$onlyField}` BETWEEN $value AND ($value+9)");
			//array_push($queryWhereArray, "`{$onlyField}` LIKE '%{$value}%'");
			array_push($queryWhereArray, "`{$onlyField}` LIKE '{$value}'");
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;
	case "id":
		$onlyField = $searchMethod;
		// �����洢SQL�������
		$queryWhereArray = array();
		// ����ȥ�ո�
		foreach ($teamArray as $value)
		{
			array_push($queryWhereArray, "`{$onlyField}` LIKE '{$value}'");
			//array_push($queryWhereArray, "`{$onlyField}` BETWEEN $value AND ($value+19)");
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;

	// Ĭ�ϲ���ȫ��
	default:
		$sqlWhere = "WHERE remark like '�Ѻ˶�' ";
}

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `telecom_restaurant` {$sqlWhere}";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// ��ҳ�ַ���
$pageation = "��{$row['PageNum']}������ " . index_page($row['PageNum'], $linksize, $pagesize);

//ȡ��ǰҳ����
$pageball = intval($__GET['page']);
$offset = $pagesize*($pageball - 1);

$query1 ="SELECT * FROM `telecom_restaurant` {$sqlWhere}  ORDER BY id ASC LIMIT $offset,$pagesize";
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
	       ."<td align='left' valign='top'><table border=1 cellpadding=0 cellspacing=0>"
		     ."<tr>"
		     ."<td width=15% align='center' class='STYLE1'>ID</td>"
	      ///// ."<td width=100 height=25 align='center' class='STYLE1'>��ע</td>"//ԭ��Ϊ��������
	      ///// ."<td width=180 align='center' class='STYLE1'>ȫ��</td>"//��˾ԭ��������
	       ."<td width=180 align='center' class='STYLE1'>������</td>"//��˾ԭ��������
	       ."<td width=15% align='center' class='STYLE1'>�绰����</td>"//���� omissible
	       ."<td width=15% align='center' class='STYLE1'>��ַ</td>"//���� unomissible
	    /////  ."<td width=15% align='center' class='STYLE1'>��</td>"//���� random_name
	    /////    ."<td width=15% align='center' class='STYLE1'>·</td>"//���� main_work
	       ///// ."<td width=15% align='center' class='STYLE1'>����</td>"//���� attribute
	       ///// ."<td width=15% align='center' class='STYLE1'>����/��԰/С��</td>"//���� branch
	      /////  ."<td width=15% align='center' class='STYLE1'>ʣ���ַ</td>"//���� adjective
	     /////   ."<td width=15% align='center' class='STYLE1'>�˳�·��</td>"//���� adjective
	       ."<td width=200 align='center' class='STYLE1'>��ҵ����</td>"
	       ."<td width=50 align='center' class='STYLE1'>Ӫҵʱ��</td>"//ԭΪ·
	       ."<td width=50 align='center' class='STYLE1'>�����</td>"//����
	      // ."<td width=50 align='center' class='STYLE1'>��ҵ����</td>"//����
	    /////    ."<td width=80 align='center' class='STYLE1'>���ݸ�������</td>"//����
	       ."<td width=50 align='center' class='STYLE1'>������Ϣ</td>"//����
	       ."<td width=15% align='center' class='STYLE1'>�ò�����</td>"
	       ."<td width=50 align='center' class='STYLE1'>���ÿ�</td>"//ԭΪ������
	       ."<td width=50 align='center' class='STYLE1'>������</td>"
	       ."<td width=15% align='center'><span class='STYLE1'>������</span></td>"
	       ."<td width=15% height=25 align='center' class='STYLE1'>���Ʋ�</td>"
	       ."<td width=15% height=25 align='center' class='STYLE1'>��ϵ</td>"
	       ."<td width=15% height=25 align='center' class='STYLE1'>��ζ</td>"
	       ."<td width=15% align='center' class='STYLE1'>���ͷ���</td>"
	       ."<td width=15% align='center' class='STYLE1'>ͣ��λ</td>"
	   /////     ."<td width=50 height=25 align='center' class='STYLE1'>¼����</td>"
	   /////     ."<td width=15% height=25 align='center' class='STYLE1'>¼������</td>"
	      // ."<td width=15% height=25 align='center' class='STYLE1'>������Ʒ</td>"
	       ."<td width=80 align='center'></td>"
	       ."</tr>";

if($result)
{

while ($row = mysql_fetch_assoc($result))
{
	$content .= "<form method=post action='index2_update.php?lmbs={$row[id]}'>"
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
    /////   . "<td align='center' class='STYLE1'><input name='remark' type='text' id='remark' value='{$row[remark]}' size='5'></td>"
    /////   . "<td align='center' class='STYLE1'><input name='fullname' type='text' id='fullname' value='{$row[fullname]}'  size='20'></td>"
      . "<td align='center' class='STYLE1'><input name='consumename' type='text' id='consumename' value='{$row[consumename]}'  size='20'></td>"
      . "<td align='center' class='STYLE1'><input name='telephone' type='text' id='telephone' value='{$row[telephone]}' readonly size='10'></td>"
      . "<td align='center' class='STYLE1'><input name='address' type='text' id='address' value='{$row[address]}' readonly size='40'></td>"
   /////    . "<td align='center' class='STYLE1'><input name='district' type='text' id='district' value='{$row[district]}' size='6'></td>"
   /////    . "<td align='center' class='STYLE1'><input name='road' type='text' id='points' value='{$row[road]}' size='8'></td>"
   /////    . "<td align='center' class='STYLE1'><input name='doorplate' type='text' id='doorplate' value='{$row[doorplate]}' readonly size='6'></td>"
   /////    . "<td align='center' class='STYLE1'><input name='edifice' type='text' id='edifice' value='{$row[edifice]}' size='12'></td>"
   /////    . "<td align='center' class='STYLE1'><input name='floor' type='text' id='floor' value='{$row[floor]}' size='8'></td>"
   /////    . "<td align='center' class='STYLE1'><input name='busline' type='text' id='busline' value='{$row[busline]}' size='8'></td>"
      . "<td align='center' class='STYLE1'><input name='introduction' type='text' id='introduction' value='{$row[introduction]}' size='20'></td>"


      . "<td align='center' class='STYLE1'><input name='businesshours' type='text' id='businesshours' value='{$row[businesshours]}' size='20'></td>"
      . "<td align='center' class='STYLE1'><input name='theme' type='text' id='theme' value='{$row[theme]}' size='8'></td>"//����
      //. "<td align='center' class='STYLE1'><input name='category' type='text' id='category' value='{$row[category]}' size='8'></td>"//����

    /////   . "<td align='center' class='STYLE1'><input name='changetype' type='text' id='changetype' value='{$row[changetype]}' size='16'></td>"//����

      . "<td align='center' class='STYLE1'><input name='information' type='text' id='information' value='{$row[information]}' size='16'></td>"//����
      . "<td align='center' class='STYLE1'><input name='foodkind' type='text' id='foodkind' value='{$row[foodkind]}' size='20'></td>"//����
      . "<td align='center' class='STYLE1'><input name='creditcard' type='text' id='creditcard' value='{$row[creditcard]}' size='20'></td>"//����
      . "<td align='center' class='STYLE1'><input name='capacity' type='text' id='capacity' value='{$row[capacity]}' size='10'></td>"//����
      . "<td align='center' class='STYLE1'><input name='roomamount' type='text' id='roomamount' value='{$row[roomamount]}' size='10'></td>"//����


      . "<td align='center' class='STYLE1'><input name='signfood' type='text' id='signfood' value='{$row[signfood]}' size='20'></td>"


      . "<td align='center' class='STYLE1'><input name='foodtype' type='text' id='foodtype' value='{$row[foodtype]}' size='10'></td>"
      . "<td align='center' class='STYLE1'><input name='flavor' type='text' id='flavor' value='{$row[flavor]}' size='20'></td>"

      . "<td align='center' class='STYLE1'><input name='togo' type='text' id='togo' value='{$row[togo]}' size='20'></td>"
      . "<td align='center' class='STYLE1'><input name='parking' type='text' id='parking' value='{$row[parking]}' size='10'></td>"


   /////    . "<td align='center' class='STYLE1'><input name='editor' type='text' id='editor' value='{$row[editor]}' readonly size='6'></td>"
   /////    . "<td align='center' class='STYLE1'><input name='edittime' type='text' id='edittime' value='{$row[edittime]}' readonly size='20'></td>"
      //. "<td align='center' class='STYLE1'><input name='gift' type='text' id='gift' value='{$row[gift]}' size='16'></td>"
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
	  <option value="pid">���ű��</option>
	  <option value="fullname">ȫ��</option>
	  <option value="edifice">��������</option>
	  <option value="id">�Ա�ID</option>
    </select></td>
  <td >�ؼ���:</td>
  <td> <input name="searchterm" type="text"></td>
  <td> <input name="sousuo" type="submit" value="����"></td>
</tr>
</table>
</form>

<!-- �����ѯid�ļ�¼����ҳ -->
<!--<table id="results" width="100%">
<tr><td align="left">
<?php echo $content_id ?>
<td><tr>
</table>-->

<!-- �ܱ�ļ�¼����ҳ -->
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
