<?php session_start(); include("conn.php");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>�����곡���µ������ݸ���</title>
<style type="text/css">
<!--
.STYLE1 {font-size: 12px}
-->
</style>
</head>

<body>
<table width="535" height="264" border="0" cellpadding="0" cellspacing="0" >

  <tr>
    <td height="125">&nbsp;</td>
    <td align="left" valign="top"><table width="425" border="1" cellpadding="0" cellspacing="0">
	  <tr>
        <td width="60" height="25" align="center" class="STYLE1">���</td>
        <td width="60" align="center" class="STYLE1">����</td>
        <td width="80" align="center" class="STYLE1">ʱ��</td>
        <td width="80" align="center" class="STYLE1">����</td>
        <td width="80" align="center" class="STYLE1">����</td>
        <td width="80" align="center" class="STYLE1">�ȷ�</td>
        <td width="80" align="center" class="STYLE1">�Ͷ�</td>
        <td width="80" align="center" class="STYLE1">�볡</td>
        <td width="80" align="center" class="STYLE1">��ע</td>
        <td width="80" align="center" class="STYLE1">���ӷ���</td>
        <td width="145" align="center"><span class="STYLE1">�Ͷӷ���</span></td>        
        <td width="80" align="center"></td>
      </tr>
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

// ÿҳ��ʾ��������
$linksize = 20;
// ÿҳ��ʾ��������
$pagesize = 2;

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `myself_matches` ";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// ��ҳ�ַ���
$pageationmyself_matches = "��{$row['PageNum']}������ " . index_page($row['PageNum'], $linksize, $pagesize);

//ȡ��ǰҳ����
$pageball = intval($_GET['page']);
$offset = $pagesize*($pageball - 1);

$query1 ="SELECT * FROM `myself_matches` ORDER BY day DESC,time DESC LIMIT $offset,$pagesize";

$result = mysql_query($query1);

	//$query=mysql_query("select * from myself_matches ");
	       if($result){
		   while($myrow=mysql_fetch_array($result)){
		   $sid=$myrow[id];
	
	?>
	<form name="form1" method="post" action="index_ok.php?lmbs=<?php echo $sid;?>">
      <tr>
        <td height="25" align="center" class="STYLE1"><label>
          <input name="id" type="text" id="id" value="<?php echo $myrow[id];?>" size="6">
        </label></td>
        <td align="center" class="STYLE1"><input name="day" type="text" id="day" value="<?php echo $myrow[day];?>" size="10"></td>
        <td align="center" class="STYLE1"><input name="time" type="text" id="time" value="<?php echo $myrow[time];?>" size="6"></td>
        <td align="center" class="STYLE1"><input name="typename" type="text" id="typename" value="<?php echo $myrow[typename];?>" size="10"></td>
        <td align="center" class="STYLE1"><input name="hometeam" type="text" id="hometeam" value="<?php echo $myrow[hometeam];?>" size="16"></td>
        <td align="center" class="STYLE1"><input name="points" type="text" id="points" value="<?php echo $myrow[points];?>" size="4"></td>
        <td align="center" class="STYLE1"><input name="guestteam" type="text" id="guestteam" value="<?php echo $myrow[guestteam];?>" size="16"></td>
        <td align="center" class="STYLE1"><input name="halfpoints" type="text" id="halfpoints" value="<?php echo $myrow[halfpoints];?>" size="4"></td>
        <td align="center" class="STYLE1"><input name="remarks" type="text" id="remarks" value="<?php echo $myrow[remarks];?>" size="12"></td>
        <td align="center" class="STYLE1"><input name="hometeam_big" type="text" id="hometeam_big" value="<?php echo $myrow[hometeam_big];?>" size="12"></td>
        <td align="center" class="STYLE1"><input name="guestteam_big" type="text" id="guestteam_big" value="<?php echo $myrow[guestteam_big];?>" size="12"></td>        

        <td align="center"><input type="image" name="imageField" src="images/bg1.jpg"></td>
      </tr>
	   </form>
	  <?php }}?>
	  
    </table>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="33">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="100%">
<tr><td align="right">
<?php echo $pageationmyself_matches ?>
<td><tr>
</table>

</body>
</html>
