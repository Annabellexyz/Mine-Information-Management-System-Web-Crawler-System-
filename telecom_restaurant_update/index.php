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
<title>160���Ų������ݱ༭ϵͳ</title>
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

  <!--
    <td width="120"><a href="/mine/telecom_restaurant_update">���������޸�</a></td>
    <td width="120"><a href="/mine/telecom_restaurant_insert">�������ݲ���</a></td>-->
    <h5><font color = red>˵������עѡ��Ϊ���Ѻ˶ԡ������Ǻŵı��붼��ò����ύ���ݣ���עѡ��Ϊ�������ͣ�����Ҳ���ύ</font></h5>
   
 
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
 $content_id .= "<table align='center' width=98% border='1'>"
              ."<form name='form1' id='myform' method='post'  onsubmit='return ck()'  action='index_update.php?lmbs={$row[id]}'>"
              ."<tr><td width=15% align='center' class='STYLE1'>ID</td>"
              ."<td width=53%><input name='id' type='text' id='id' value='{$row[id]}' readonly size='10'></td>

              <td></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>��ע��*��</td>"
              //."<td><input name='remark' type='text' id='remark' value='{$row[remark]}' size='10'></td><td></td></tr>"
              ."<td colspan=2>
<input type='radio' name='remark'".($row['remark'] == '�Ѻ˶�' ?  'checked="checked"' : '')."  value = '�Ѻ˶�'>�Ѻ˶�
<input type='radio' name='remark'".($row['remark'] == '����' ?  'checked="checked"' : '')."  value = '����'>����
<input type='radio' name='remark'".($row['remark'] == '������' ?  'checked="checked"' : '')."  value = '������'>������
<input type='radio' name='remark'".($row['remark'] == '�������˽�' ?  'checked="checked"' : '')."  value = '�������˽�'>�������˽�
<input type='radio' name='remark'".($row['remark'] == '�Ҳ���' ?  'checked="checked"' : '')."  value = '�Ҳ���'>�Ҳ���
<input type='radio' name='remark'".($row['remark'] == '��ͣӪҵ' ?  'checked="checked"' : '')."  value = '��ͣӪҵ'>��ͣӪҵ
<input type='radio' name='remark'".($row['remark'] == '�ظ�' ?  'checked="checked"' : '')."  value = '�ظ�'>�ظ�
<input type='radio' name='remark'".($row['remark'] == '�û��ܷ�' ?  'checked="checked"' : '')."  value = '�û��ܷ�'>�û��ܷ�                           
              </td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>ȫ����*��</td>"
              ."<td><input name='fullname' type='text' id='fullname' value='{$row[fullname]}' size='50'></td><td></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>��������*��</td>"
              ."<td><input name='consumename' type='text' id='consumename' value='{$row[consumename]}' size='50'></td><td></td></tr>"                   
              ."<tr><td width=15% align='center' class='STYLE1'>�绰���루*��</td>"
              ."<td><input name='telephone' type='text' id='telephone' value='{$row[telephone]}' size='50'></td>
              <td><font size = 2>��ʾ����88450123��36589999-8122</font></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>��ַ��*��</td>"
              ."<td><input name='address' type='text' id='address' value='{$row[address]}'  size='50'></td><td></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>����*��</td>"
              //."<td><input name='district' type='text' id='district' value='{$row[district]}'  size='10'></td><td></td></tr>"
              ."<td colspan=2>
<input type='radio' name='district'".($row['district'] == '������' ? 'checked="checked"' : '')."  value = '������'>������
<input type='radio' name='district'".($row['district'] == '��ɽ��' ? 'checked="checked"' : '')."  value = '��ɽ��'>��ɽ��
<input type='radio' name='district'".($row['district'] == '�޺���' ? 'checked="checked"' : '')."  value = '�޺���'>�޺���
<input type='radio' name='district'".($row['district'] == '������' ? 'checked="checked"' : '')."  value = '������'>������
<input type='radio' name='district'".($row['district'] == '������' ? 'checked="checked"' : '')."  value = '������'>������
<input type='radio' name='district'".($row['district'] == '������' ? 'checked="checked"' : '')."  value = '������'>������
<input type='radio' name='district'".($row['district'] == '��������' ? 'checked="checked"' : '')."  value = '��������'>��������             
              </td>"
              ."<tr><td width=15% align='center' class='STYLE1'>·</td>"
              ."<td><input name='road' type='text' id='road' value='{$row[road]}' size='10'></td><td></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>����</td>"
              ."<td><input name='doorplate' type='text' id='doorplate' value='{$row[doorplate]}' size='10'></td><td></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>����/��԰/С��</td>"
              ."<td><input name='edifice' type='text' id='edifice' value='{$row[edifice]}' size='30'></td><td></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>ʣ���ַ</td>"
              ."<td><input name='floor' type='text' id='floor' value='{$row[floor]}' size='30'></td><td></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>�˳�·��</td>"
              ."<td><input name='busline' type='text' id='busline' value='{$row[busline]}' size='30'></td><td></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>��ҵ����</td>"
              ."<td colspan=2><input name='introduction' type='text' id='introduction' value='{$row[introduction]}' size='120'></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>Ӫҵʱ�䣨*��</td>"
              ."<td><input name='businesshours' type='text' id='businesshours' value='{$row[businesshours]}' size='65'></td>
              <td><font size = 2>��ʾ����
<br>��1��08:30-19:00�����գ�09:00-20:30
<br>��2�����磺09��00-11��45�����磺13��30-18��00��ҹ�䣺19��30-23��00
<br>��3����һ��Ϣ���������粻Ӫҵ���ƽ����ڼ䣺08��00-22��00
</font></td></tr>"
              ."<tr><td  align='center' class='STYLE1'>����ʣ�*��</td>"
              //."<td><input name='theme' type='text' id='theme' value='{$row[theme]}' size='30'></td>
              ."<td colspan = 2>

<input type='checkbox' id='theme' name='theme[]'".(in_array("��¥",$theme_array) ? 'checked="checked"' : '')."  value = '��¥'>��¥
<input type='checkbox' id='theme' name='theme[]'".(in_array("�տ���",$theme_array) ? 'checked="checked"' : '')."  value = '�տ���'>�տ���           
<input type='checkbox' id='theme' name='theme[]'".(in_array("�����",$theme_array) ? 'checked="checked"' : '')."  value = '�����'>�����
<input type='checkbox' id='theme' name='theme[]'".(in_array("��͵�",$theme_array) ? 'checked="checked"' : '')."  value = '��͵�'>��͵�          
<input type='checkbox' id='theme' name='theme[]'".(in_array("С�Ե�",$theme_array) ? 'checked="checked"' : '')."  value = 'С�Ե�'>С�Ե�
<input type='checkbox' id='theme' name='theme[]'".(in_array("������",$theme_array) ? 'checked="checked"' : '')."  value = '������'>������           
<input type='checkbox' id='theme' name='theme[]'".(in_array("����Ƽ�",$theme_array) ? 'checked="checked"' : '')."  value = '����Ƽ�'>����Ƽ�
<input type='checkbox' id='theme' name='theme[]'".(in_array("��������",$theme_array) ? 'checked="checked"' : '')."  value = '��������'>��������<br>          

<input type='checkbox' id='theme' name='theme[]'".(in_array("�ŵ�",$theme_array) ? 'checked="checked"' : '')."  value = '�ŵ�'>�ŵ�           

<input type='checkbox' id='theme' name='theme[]'".(in_array("���ȹ�",$theme_array) ? 'checked="checked"' : '')."  value = '���ȹ�'>���ȹ�
<input type='checkbox' id='theme' name='theme[]'".(in_array("�����",$theme_array) ? 'checked="checked"' : '')."  value = '�����'>�����           
<input type='checkbox' id='theme' name='theme[]'".(in_array("�̲���",$theme_array) ? 'checked="checked"' : '')."  value = '�̲���'>�̲���
<input type='checkbox' id='theme' name='theme[]'".(in_array("��Ʒ��",$theme_array) ? 'checked="checked"' : '')."  value = '��Ʒ��'>��Ʒ��           
<input type='checkbox' id='theme' name='theme[]'".(in_array("������",$theme_array) ? 'checked="checked"' : '')."  value = '������'>������
<input type='checkbox' id='theme' name='theme[]'".(in_array("��ʳ�㳡",$theme_array) ? 'checked="checked"' : '')."  value = '��ʳ�㳡'>��ʳ�㳡                        

<input type='checkbox' id='theme' name='theme[]'".(in_array("���������",$theme_array) ? 'checked="checked"' : '')."  value = '���������'>���������
<input type='checkbox' id='theme' name='theme[]'".(in_array("������������",$theme_array) ? 'checked="checked"' : '')."  value = '������������'>������������

              </td>
              </tr>"
             // ."<tr><td width=15% align='center' class='STYLE1'>��ҵ����</td>"
             // ."<td><input name='category' type='text' id='category' value='{$row[category]}' size='30'></td><td></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1' >���ݸ������ࣨ*��</td>"
              //."<td><input name='changetype' type='text' id='changetype' value='{$row[changetype]}' size='30'></td>
              ."<td colspan = 2>
<input type='checkbox' id='changetype' name='changetype[]'".(in_array("�ޱ仯",$changetype_array) ? 'checked="checked"' : '')."  value = '�ޱ仯'>�ޱ仯              
<input type='checkbox' id='changetype' name='changetype[]'".(in_array("�绰ͣ��",$changetype_array) ? 'checked="checked"' : '')."  value = '�绰ͣ��'>�绰ͣ��
<input type='checkbox' id='changetype' name='changetype[]'".(in_array("�绰�պ�",$changetype_array) ? 'checked="checked"' : '')."  value = '�绰�պ�'>�绰�պ�
<input type='checkbox' id='changetype' name='changetype[]'".(in_array("�绰���",$changetype_array) ? 'checked="checked"' : '')."  value = '�绰���'>�绰���
<input type='checkbox' id='changetype' name='changetype[]'".(in_array("���Ʊ��",$changetype_array) ? 'checked="checked"' : '')."  value = '���Ʊ��'>���Ʊ��
<input type='checkbox' id='changetype' name='changetype[]'".(in_array("��ַ���",$changetype_array) ? 'checked="checked"' : '')."  value = '��ַ���'>��ַ���            
              </td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>������Ϣ</td>"
              ."<td><input name='information' type='text' id='information' value='{$row[information]}' size='65'></td>
              <td><font size = 2>��ʾ����<br>
������ѣ�80Ԫ/�ˣ��˾����ѣ�100Ԫ/�ˣ��ֵ����ѣ�200-400Ԫ��500-800Ԫ��800Ԫ����</font>
</td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>�ò����ͣ�*��</td>"
              //."<td><input name='foodkind' type='text' id='foodkind' value='{$row[foodkind]}' size='30'>
              ."<td>
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("����Ӵ�",$foodkind_array) ? 'checked="checked"' : '')."  value = '����Ӵ�'>����Ӵ�            
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("��������",$foodkind_array) ? 'checked="checked"' : '')."  value = '��������'>��������
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("�����ײ�",$foodkind_array) ? 'checked="checked"' : '')."  value = '��ͨ�ײ�'>��ͨ�ײ�
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("��ͨ�ײ�",$foodkind_array) ? 'checked="checked"' : '')."  value = '����Ӵ�'>����Ӵ�
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("ϲ������",$foodkind_array) ? 'checked="checked"' : '')."  value = 'ϲ������'>ϲ������<br>
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("���Ѿۻ�",$foodkind_array) ? 'checked="checked"' : '')."  value = '���Ѿۻ�'>���Ѿۻ�
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("��ͥ�۲�",$foodkind_array) ? 'checked="checked"' : '')."  value = '��ͥ�۲�'>��ͥ�۲�
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("����Լ��",$foodkind_array) ? 'checked="checked"' : '')."  value = '����Լ��'>����Լ��
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("�����ò�",$foodkind_array) ? 'checked="checked"' : '')."  value = '�����ò�'>�����ò�
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("�����ò�",$foodkind_array) ? 'checked="checked"' : '')."  value = '�����ò�'>�����ò�

              </td>
              <td></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>���ÿ���*��</td>"
              //."<td><input name='creditcard' type='text' id='creditcard' value='{$row[creditcard]}' size='30'></td>
              ."<td>
<input type='checkbox' name='creditcard[]' id='creditcard'".(in_array("����",$creditcard_array) ? 'checked="checked"' : '')." value='����'>����
<input type='checkbox' name='creditcard[]' id='creditcard'".(in_array("VISA",$creditcard_array) ? 'checked="checked"' : '')." value='VISA'>VISA
<input type='checkbox' name='creditcard[]' id='creditcard'".(in_array("���´�",$creditcard_array) ? 'checked="checked"' : '')." value='���´�'>���´�
<input type='checkbox' name='creditcard[]' id='creditcard'".(in_array("��",$creditcard_array) ? 'checked="checked"' : '')." value='��'>��
              </td>
              <td></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>������</td>"
              ."<td><input name='capacity' type='text' id='capacity' value='{$row[capacity]}' size='65'></td>
              <td><font size = 2>�������ð���������+�˱�ʾ</font></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>������</td>"
              ."<td><input name='roomamount' type='text' id='roomamount' value='{$row[roomamount]}' size='65'></td>
              <td><font size = 2>��ʾ����������ׯ������䣺3�䣻�а��䣺20�䣻С���䣺5��</font></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>���Ʋ�</td>"
              ."<td><input name='signfood' type='text' id='signfood' value='{$row[signfood]}' size='65'></td>
              <td><font size = 2>��ʾ�����������㣻�л����������⣻��ɩ���</font></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1' >��ϵ</td>"
              ."<td colspan = 2>
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("����",$foodtype_array) ? 'checked="checked"' : '')." value='����'>����
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("����",$foodtype_array) ? 'checked="checked"' : '')." value='����'>����
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("���",$foodtype_array) ? 'checked="checked"' : '')." value='���'>���
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�ͼҲ�",$foodtype_array) ? 'checked="checked"' : '')." value='�ͼҲ�'>�ͼҲ�
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("���ݲ�",$foodtype_array) ? 'checked="checked"' : '')." value='���ݲ�'>���ݲ�
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("��۲�",$foodtype_array) ? 'checked="checked"' : '')." value='��۲�'>��۲�
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("���Ų�",$foodtype_array) ? 'checked="checked"' : '')." value='���Ų�'>���Ų�
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("̨���",$foodtype_array) ? 'checked="checked"' : '')." value='̨���'>̨���
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("������",$foodtype_array) ? 'checked="checked"' : '')." value='������'>������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�Ϻ���",$foodtype_array) ? 'checked="checked"' : '')." value='�Ϻ���'>�Ϻ���
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("���ϲ�",$foodtype_array) ? 'checked="checked"' : '')." value='���ϲ�'>���ϲ� <br>

<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�ղ�",$foodtype_array) ? 'checked="checked"' : '')." value='�ղ�'>�ղ�
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("���",$foodtype_array) ? 'checked="checked"' : '')." value='���'>���
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("³��",$foodtype_array) ? 'checked="checked"' : '')." value='³��'>³��
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("������",$foodtype_array) ? 'checked="checked"' : '')." value='������'>������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("������",$foodtype_array) ? 'checked="checked"' : '')." value='������'>������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("ɽ����",$foodtype_array) ? 'checked="checked"' : '')." value='ɽ����'>ɽ����
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("����",$foodtype_array) ? 'checked="checked"' : '')." value='����'>����
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�ӱ���",$foodtype_array) ? 'checked="checked"' : '')." value='�ӱ���'>�ӱ���
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("������",$foodtype_array) ? 'checked="checked"' : '')." value='������'>������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�±���",$foodtype_array) ? 'checked="checked"' : '')." value='�±���'>�±���
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�����",$foodtype_array) ? 'checked="checked"' : '')." value='�����'>�����   <br>

<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�ղ�",$foodtype_array) ? 'checked="checked"' : '')." value='�ղ�'>�ղ�
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("����",$foodtype_array) ? 'checked="checked"' : '')." value='����'>����
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("���",$foodtype_array) ? 'checked="checked"' : '')." value='���'>���
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("������",$foodtype_array) ? 'checked="checked"' : '')." value='������'>������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�ƹ��",$foodtype_array) ? 'checked="checked"' : '')." value='�ƹ��'>�ƹ��
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("������",$foodtype_array) ? 'checked="checked"' : '')." value='������'>������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("������",$foodtype_array) ? 'checked="checked"' : '')." value='������'>������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�ຣ��",$foodtype_array) ? 'checked="checked"' : '')." value='�ຣ��'>�ຣ��
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("���Ĳ�",$foodtype_array) ? 'checked="checked"' : '')." value='���Ĳ�'>���Ĳ�
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�½���",$foodtype_array) ? 'checked="checked"' : '')." value='�½���'>�½���
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("���ز�",$foodtype_array) ? 'checked="checked"' : '')." value='���ز�'>���ز�<br>
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("���ɹŲ�",$foodtype_array) ? 'checked="checked"' : '')." value='���ɹŲ�'>���ɹŲ�
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("���Ҳ�",$foodtype_array) ? 'checked="checked"' : '')." value='���Ҳ�'>���Ҳ�<br>

<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("��ʽ��",$foodtype_array) ? 'checked="checked"' : '')." value='��ʽ��'>��ʽ��
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("Ӣʽ��",$foodtype_array) ? 'checked="checked"' : '')." value='Ӣʽ��'>Ӣʽ��
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("��ʽ��",$foodtype_array) ? 'checked="checked"' : '')." value='��ʽ��'>��ʽ��
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("��ʽ��",$foodtype_array) ? 'checked="checked"' : '')." value='��ʽ��'>��ʽ��
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("��ʽ��",$foodtype_array) ? 'checked="checked"' : '')." value='��ʽ��'>��ʽ��
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�µ�����",$foodtype_array) ? 'checked="checked"' : '')." value='�µ�����'>�µ�����
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("��������",$foodtype_array) ? 'checked="checked"' : '')." value='��������'>��������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("��������",$foodtype_array) ? 'checked="checked"' : '')." value='��������'>��������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�������ǲ�",$foodtype_array) ? 'checked="checked"' : '')." value='�������ǲ�'>�������ǲ�<br>


<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("��ʽ��",$foodtype_array) ? 'checked="checked"' : '')." value='��ʽ��'>��ʽ��
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("Ų����",$foodtype_array) ? 'checked="checked"' : '')." value='Ų����'>Ų����
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�����",$foodtype_array) ? 'checked="checked"' : '')." value='�����'>�����
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("������",$foodtype_array) ? 'checked="checked"' : '')." value='������'>������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("����",$foodtype_array) ? 'checked="checked"' : '')." value='����'>����
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("��������",$foodtype_array) ? 'checked="checked"' : '')." value='��������'>��������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("��������",$foodtype_array) ? 'checked="checked"' : '')." value='��������'>��������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�������",$foodtype_array) ? 'checked="checked"' : '')." value='�������'>�������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�������ǲ�",$foodtype_array) ? 'checked="checked"' : '')." value='�������ǲ�'>�������ǲ�   <br>

<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("������",$foodtype_array) ? 'checked="checked"' : '')." value='������'>������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("ϣ����",$foodtype_array) ? 'checked="checked"' : '')." value='ϣ����'>ϣ����
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("������",$foodtype_array) ? 'checked="checked"' : '')." value='������'>������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("���޲�",$foodtype_array) ? 'checked="checked"' : '')." value='���޲�'>���޲�
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("���޲�",$foodtype_array) ? 'checked="checked"' : '')." value='���޲�'>���޲�
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�¼��²�",$foodtype_array) ? 'checked="checked"' : '')." value='�¼��²�'>�¼��²�
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�ձ�����",$foodtype_array) ? 'checked="checked"' : '')." value='�ձ�����'>�ձ�����
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("��������",$foodtype_array) ? 'checked="checked"' : '')." value='��������'>��������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�������ǲ�",$foodtype_array) ? 'checked="checked"' : '')." value='�������ǲ�'>�������ǲ�<br>

<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("������",$foodtype_array) ? 'checked="checked"' : '')." value='������'>������
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("̩����",$foodtype_array) ? 'checked="checked"' : '')." value='̩����'>̩����
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("ӡ�Ȳ�",$foodtype_array) ? 'checked="checked"' : '')." value='ӡ�Ȳ�'>ӡ�Ȳ�
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("Խ�ϲ�",$foodtype_array) ? 'checked="checked"' : '')." value='Խ�ϲ�'>Խ�ϲ�
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�ж���",$foodtype_array) ? 'checked="checked"' : '')." value='�ж���'>�ж���
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("ī�����",$foodtype_array) ? 'checked="checked"' : '')." value='ī�����'>ī�����
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("�����ǲ�",$foodtype_array) ? 'checked="checked"' : '')." value='�����ǲ�'>�����ǲ�

              </td>
              </tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>��ζ</td>"
              //."<td><input name='flavor' type='text' id='flavor' value='{$row[flavor]}' size='30'></td>
              ."<td colspan = 2>
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("Ұζ����",$flavor_array) ? 'checked="checked"' : '')." value='Ұζ����'>Ұζ����
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("���ʲ���",$flavor_array) ? 'checked="checked"' : '')." value='���ʲ���'>���ʲ���
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("���",$flavor_array) ? 'checked="checked"' : '')." value='���'>���
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("����",$flavor_array) ? 'checked="checked"' : '')." value='����'>����
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("ţ��",$flavor_array) ? 'checked="checked"' : '')." value='ţ��'>ţ��
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("����",$flavor_array) ? 'checked="checked"' : '')." value='����'>����
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("ҩ��",$flavor_array) ? 'checked="checked"' : '')." value='ҩ��'>ҩ��
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("�����",$flavor_array) ? 'checked="checked"' : '')." value='�����'>�����
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("�ҳ���",$flavor_array) ? 'checked="checked"' : '')." value='�ҳ���'>�ҳ���
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("˽����",$flavor_array) ? 'checked="checked"' : '')." value='˽����'>˽����<br>

<input type='checkbox' name='flavor[]' id='flavor'".(in_array("��ζ����",$flavor_array) ? 'checked="checked"' : '')." value='��ζ����'>��ζ����
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("Ѽζ����",$flavor_array) ? 'checked="checked"' : '')." value='Ѽζ����'>Ѽζ����
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("��ʳ",$flavor_array) ? 'checked="checked"' : '')." value='��ʳ'>��ʳ
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("����",$flavor_array) ? 'checked="checked"' : '')." value='����'>����
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("����",$flavor_array) ? 'checked="checked"' : '')." value='����'>����
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("���",$flavor_array) ? 'checked="checked"' : '')." value='���'>���
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("���",$flavor_array) ? 'checked="checked"' : '')." value='���'>���
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("������",$flavor_array) ? 'checked="checked"' : '')." value='������'>������
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("���ӹ�",$flavor_array) ? 'checked="checked"' : '')." value='���ӹ�'>���ӹ�
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("��⽵�",$flavor_array) ? 'checked="checked"' : '')." value='��⽵�'>��⽵�
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("������",$flavor_array) ? 'checked="checked"' : '')." value='������'>������
              </td>
              </tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>���ͷ���</td>"
              ."<td><input name='togo' type='text' id='togo' value='{$row[togo]}' size='65'></td>
              <td><font size = 2>��ʾ���� <br>����ʱ��Σ�12��00-22��00�����ͷ�Χ���������ڣ���ͽ�25Ԫ�����ͷ���ѣ�5Ԫ/���</font></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>ͣ��λ</td>"
              ."<td><input name='parking' type='text' id='parking' value='{$row[parking]}' size='20'></td>
              <td><font size = 2>��ʾ����<br>��,5Ԫ/Сʱ|��,6Ԫ/��|��|��,5Ԫ/Сʱ</font></td></tr>"
              
              ."<tr><td width=15% align='center' class='STYLE1'>¼����</td>"
              //. "<td align='center' class='STYLE1'><input name='editor' type='text' id='editor' value='{$_username}'readonly size='6'></td>"
              ."<td><input name='editor' type='text' id='editor' value='{$row[editor]}' readonly size='20'></td><td><font size = 2>�����ֹ�¼�룬��¼����Զ�����</font></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>¼������</td>"
              ."<td><input name='edittime' type='text' id='edittime' value='{$row[edittime]}' readonly size='20'></td><td><font size = 2>�����ֹ�¼�룬��¼����Զ�����</font></td></tr>"
              . "<tr><td width=15% align='center' class='STYLE1'>�ύ</td><td align='left'><input type='image' name='imageField' src='images/bg1.jpg'></td><td></td></tr>"
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
			//array_push($queryWhereArray, "`{$onlyField}` LIKE '%{$value}%'");
			array_push($queryWhereArray, "`{$onlyField}` BETWEEN $value AND ($value+19)");
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;

	// Ĭ�ϲ���ȫ��
	default:
		$sqlWhere = '';
}

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `telecom_restaurant` {$sqlWhere}";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// ��ҳ�ַ���
$pageation = "��{$row['PageNum']}������ " . index_page($row['PageNum'], $linksize, $pagesize);

//ȡ��ǰҳ����
$pageball = intval($__GET['page']);
$offset = $pagesize*($pageball - 1);

$query1 ="SELECT * FROM `telecom_restaurant` {$sqlWhere} ORDER BY id ASC LIMIT $offset,$pagesize";
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
	       ."<td width=100 height=25 align='center' class='STYLE1'>��ע</td>"//ԭ��Ϊ��������
	       ."<td width=180 align='center' class='STYLE1'>ȫ��</td>"//��˾ԭ��������
	       ."<td width=180 align='center' class='STYLE1'>������</td>"//��˾ԭ��������
	       ."<td width=15% align='center' class='STYLE1'>�绰����</td>"//���� omissible
	       ."<td width=15% align='center' class='STYLE1'>��ַ</td>"//���� unomissible
	       ."<td width=15% align='center' class='STYLE1'>��</td>"//���� random_name
	       ."<td width=15% align='center' class='STYLE1'>·</td>"//���� main_work
	       ."<td width=15% align='center' class='STYLE1'>����</td>"//���� attribute
	       ."<td width=15% align='center' class='STYLE1'>����/��԰/С��</td>"//���� branch
	       ."<td width=15% align='center' class='STYLE1'>ʣ���ַ</td>"//���� adjective
	       ."<td width=15% align='center' class='STYLE1'>�˳�·��</td>"//���� adjective
	       ."<td width=200 align='center' class='STYLE1'>��ҵ����</td>"
	       ."<td width=50 align='center' class='STYLE1'>Ӫҵʱ��</td>"//ԭΪ·
	       ."<td width=50 align='center' class='STYLE1'>�����</td>"//����
	      // ."<td width=50 align='center' class='STYLE1'>��ҵ����</td>"//����
	       ."<td width=80 align='center' class='STYLE1'>���ݸ�������</td>"//����
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
	       ."<td width=50 height=25 align='center' class='STYLE1'>¼����</td>"
	       ."<td width=15% height=25 align='center' class='STYLE1'>¼������</td>"
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
      . "<td align='center' class='STYLE1'><input name='remark' type='text' id='remark' value='{$row[remark]}' size='5'></td>"
      . "<td align='center' class='STYLE1'><input name='fullname' type='text' id='fullname' value='{$row[fullname]}'  size='20'></td>"
      . "<td align='center' class='STYLE1'><input name='consumename' type='text' id='consumename' value='{$row[consumename]}'  size='20'></td>"
      . "<td align='center' class='STYLE1'><input name='telephone' type='text' id='telephone' value='{$row[telephone]}' readonly size='10'></td>"
      . "<td align='center' class='STYLE1'><input name='address' type='text' id='address' value='{$row[address]}' readonly size='40'></td>"
      . "<td align='center' class='STYLE1'><input name='district' type='text' id='district' value='{$row[district]}' size='6'></td>"
      . "<td align='center' class='STYLE1'><input name='road' type='text' id='points' value='{$row[road]}' size='8'></td>"
      . "<td align='center' class='STYLE1'><input name='doorplate' type='text' id='doorplate' value='{$row[doorplate]}' readonly size='6'></td>"
      . "<td align='center' class='STYLE1'><input name='edifice' type='text' id='edifice' value='{$row[edifice]}' size='12'></td>"
      . "<td align='center' class='STYLE1'><input name='floor' type='text' id='floor' value='{$row[floor]}' size='8'></td>"
      . "<td align='center' class='STYLE1'><input name='busline' type='text' id='busline' value='{$row[busline]}' size='8'></td>"
      . "<td align='center' class='STYLE1'><input name='introduction' type='text' id='introduction' value='{$row[introduction]}' size='20'></td>"


      . "<td align='center' class='STYLE1'><input name='businesshours' type='text' id='businesshours' value='{$row[businesshours]}' size='20'></td>"
      . "<td align='center' class='STYLE1'><input name='theme' type='text' id='theme' value='{$row[theme]}' size='8'></td>"//����
      //. "<td align='center' class='STYLE1'><input name='category' type='text' id='category' value='{$row[category]}' size='8'></td>"//����

      . "<td align='center' class='STYLE1'><input name='changetype' type='text' id='changetype' value='{$row[changetype]}' size='16'></td>"//����

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


      . "<td align='center' class='STYLE1'><input name='editor' type='text' id='editor' value='{$row[editor]}' readonly size='6'></td>"
      . "<td align='center' class='STYLE1'><input name='edittime' type='text' id='edittime' value='{$row[edittime]}' readonly size='20'></td>"
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
