<?php 
	$fpath = str_replace('\\', '/',substr(dirname(__FILE__), 0, -17));
	require_once $fpath.'/include/common.inc.php'; 
	//echo $fpath.'/include/common.inc.php';//����·���Ƿ���ȷ
  //include("conn.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160���Ż�ҳ��������¼��ϵͳ</title>
<script src="/member/login.php?action=abc"></script>
<script language="javascript">
function F_submit()
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
</script>
<style type="text/css">
<!--
.STYLE3 {
	font-family: "��������";
	font-size: 20px;
	color: #000000;
}
.STYLE2 {font-size: 13px}
.STYLE3 {font-size: 12px}
-->
</style>
</head>

<body>
	<table  border="1" align="center">
  <tr>
    <td width="120"><a href="/mine/page_update">��ҳ�����޸�</a></td>
    <td width="120"><a href="/mine/page_insert">��ҳ���ݲ���</a></td>
  </tr>
</table>
<br>
&nbsp;&nbsp;<font size=2 > 1.������½ǵġ����롱�����Բ���һ���¼�¼��</font><BR>
&nbsp;  &nbsp;<font size=2 color=red >2.�����������</font>
<table align="center" width="620" border="1">
<form name="form1" method="post" onsubmit="return F_submit()" action="index_insert.php">

  <tr><td width=120 align='center' class='STYLE3'>����</td>
  <td><input name='pid' type='text' id='pid' size='6'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>���б�ע</td>
  <td><input name='remark' type='text' id='remark' size='10'></td></tr>           
  <tr><td width=120 align='center' class='STYLE3'>��Ϣ���루���</td>
  <td><input name='info_code' type='text' id='info_code' readonly size='8'></td></tr> 
  <tr><td width=120 align='center' class='STYLE3'>ԭ�������ƣ����</td>
  <td><input name='name' type='text' id='name' readonly size='30'></td></tr>           
  <tr><td width=120 align='center' class='STYLE3'>������������</td>
  <td><input name='fullname' type='text' id='fullname'  size='30'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>���ѣ����ƣ�</td>
  <td><input name='omissible' type='text' id='omissible'  size='12'></td></tr> 
  <tr><td width=120 align='center' class='STYLE3'>�����ѣ����ƣ�</td>
  <td><input name='unomissible' type='text' id='unomissible'  size='12'></td></tr> 
  <tr><td width=120 align='center' class='STYLE3'>������</td>
  <td><input name='random_name' type='text' id='random_name'  size='12'></td></tr> 
  <tr><td width=120 align='center' class='STYLE3'>��Ӫ/���</td>
  <td><input name='main_work' type='text' id='main_work' size='12'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>��λ����</td>
  <td><input name='attribute' type='text' id='attribute' size='12'></td></tr> 
  <tr><td width=120 align='center' class='STYLE3'>��֧����</td>
  <td><input name='branch' type='text' id='branch' size='12'></td></tr> 
  <tr><td width=120 align='center' class='STYLE3'>�����ַ�</td>
  <td><input name='adjective' type='text' id='adjective' size='12'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>ԭ��ַ�����</td>
  <td><input name='address' type='text' id='address' readonly size='30'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>��</td>
  <td><input name='district' type='text' id='district'  size='10'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>�ֵ�</td>
  <td><input name='pid' type='text' id='pid' size='10'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>·</td>
  <td><input name='road' type='text' id='road' size='10'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>��</td>
  <td><input name='number' type='text' id='number' size='10'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>����/��ҵ��/��԰</td>
  <td><input name='edifice' type='text' id='edifice' size='16'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>ʣ���ַ</td>
  <td><input name='floor' type='text' id='floor' size='8'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>���ε�ַ</td>
  <td><input name='cell' type='text' id='cell' size='8'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>��ҵ��ϵ��</td>
  <td><input name='linkman' type='text' id='linkman' size='10'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>��ҵ���</td>
  <td><input name='category' type='text' id='category' size='25'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>��Ӫ</td>
  <td><input name='business' type='text' id='business' size='25'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>ԭ�绰</td>
  <td><input name='telephone' type='text' id='telephone' readonly size='60'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>�µ绰</td>
  <td><input name='new_phone' type='text' id='new_phone'  size='60'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>��ҵ��ϵ���ֻ�</td>
  <td><input name='mobilephone' type='text' id='mobilephone'  size='30'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>����</td>
  <td><input name='fax' type='text' id='fax' size='20'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>��ַ</td>
  <td><input name='website' type='text' id='website' size='20'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>����</td>
  <td><input name='email' type='text' id='email' size='20'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>���и�����</td>
  <td><input name='principal' type='text' id='principal' size='20'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>¼����</td>
  <td><input name='editor' type='text' id='editor' value='<?php echo $_username ?>' readonly size='6'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>¼������</td>
  <td><input name='edittime' type='text' id='edittime' readonly size='20'></td></tr>

  <tr>
    <td height="25" align="center">&nbsp;</td>
    <td align="left"><span class="STYLE2"><input type="submit" name="Submit" value="�ύ"></span></td>
  </tr> 
  <tr>
    <td height="25" colspan="2" align="center"><span class="STYLE3">��Ȩ����<span class="STYLE2">:</span>��ͨ��Ϣ�������޹�˾</span></td>
  </tr>
  </form>
  
</table>
</body>
</html>
