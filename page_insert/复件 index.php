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
<style type="text/css">
<!--
.STYLE1 {
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
&nbsp; &nbsp;<font size=2 >2.��Ų��ò��룻</font><BR>
&nbsp;  &nbsp;<font size=2 color=red >3.�����������</font>
<table align="center" width="620" border="1">
<form name="form1" method="post" action="index_insert.php">
  <tr>
    <td height="40" colspan="3" align="center"><span class="STYLE1"><strong>160���Ż�ҳ��������¼��</strong></span></td>
  </tr>
  <tr>
    <td width="40" height="25" align="center" class="STYLE2">�༭:</td>
    <td><input name="editor" type="text" id="editor" value="<?php echo $_username; ?>" readonly size="64"></td>
    
    <td width="100"  class="STYLE2">��¼����ʾ</td>
  </tr>
  <tr>
    <td width="40" height="25" align="center" class="STYLE2">����:</td>
    <td><input name="day" type="text" id="day"  size="64"></td>
    <td width="100"  class="STYLE2">����2007-01-01</td>
  </tr>
  <tr>
    <td height="25" align="center" class="STYLE2">ʱ��:</td>
    <td><input name="time" type="text" id="time"  size="64"></td>
    <td  class="STYLE2">����23:00</td>
  </tr>
  <tr>
    <td height="25" align="center" class="STYLE2">����:</td>
    <td><input name="typename" type="text" id="typename"  size="64"></td>
    <td  class="STYLE2">����Ӣ��</td>
  </tr>
    <tr>
    <td height="25" align="center" class="STYLE2">����:</td>
    <td><input name="hometeam" type="text" id="hometeam"  size="64"></td>
    <td  class="STYLE2">�����ж���</td>
  </tr>
    <tr>
    <td height="25" align="center" class="STYLE2">�ȷ�:</td>
    <td><input name="points" type="text" id="points"  size="64"></td>
    <td  class="STYLE2">����2-0</td>
  </tr>
    <tr>
    <td height="25" align="center" class="STYLE2">�Ͷ�:</td>
    <td><input name="guestteam" type="text" id="guestteam"  size="64"></td>
    <td  class="STYLE2">����Ӣ����</td>
  </tr>
    <tr>
    <td height="25" align="center" class="STYLE2">�볡:</td>
    <td><input name="halfpoints" type="text" id="halfpoints"  size="64"></td>
    <td  class="STYLE2">����1-0</td>
  </tr>

  <tr>
    <td height="25" align="center" class="STYLE2">��ע</td>
    <td><input name="remarks" type="text" id="remarks"  size="64"></td>
    <td align="right"> <input type="submit" name="Submit" value="�ύ"></td>
  </tr>
  <tr>
    <td height="25" colspan="3" align="center"><span class="STYLE3">��Ȩ����<span class="STYLE2">:</span>��ͨ��Ϣ�������޹�˾</span></td>
  </tr>
  </form>
</table>
</body>
</html>
