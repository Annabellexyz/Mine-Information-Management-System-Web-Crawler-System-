<?php 
	$fpath = str_replace('\\', '/',substr(dirname(__FILE__), 0, -17));
	require_once $fpath.'/include/common.inc.php'; 
	//echo $fpath.'/include/common.inc.php';//测试路径是否正确
  //include("conn.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160电信黄页单条数据录入系统</title>
<script src="/member/login.php?action=abc"></script>
<script language="javascript">
/*function F_submit()
{
if(confirm('确定提交这条黄页记录吗?'))
{
return true;
}
else
{
return false;
}
}*/
</script>
<script type="text/javascript"> 
function checkInput(form) 
{     
var a = form.new_phone.value; 
if(a.length   <   8) 
{ 
alert( "电话至少要输入8个字符 "); 
form.new_phone.focus(); 
} 
} 
</script> 
<script type="text/javascript"> 
function checkInput2(form) 
{     
var a = form.fax.value; 
if(a.length <  8 && a.length >  0 ) 
{ 
alert( "传真至少要输入8个字符 "); 
form.fax.focus(); 
} 
} 
</script> 
<script type="text/javascript">
function myConfirm()
{
  if(window.document.getElementById("remark").value=="")
  { 
     alert("请输入发行备注！");
     window.document.getElementById("remark").focus();
     return false;
  }
  else if(window.document.getElementById("envelopeid").value=="")
  { 
     alert("请输入信封编号！");    
      window.document.getElementById("envelopeid").focus();
     return false;
  }
  else if(window.document.getElementById("amount").value=="")
  { 
     alert("请输入发行数量！");    
      window.document.getElementById("amount").focus();
     return false;
  }
  else if(window.document.getElementById("fullname").value=="")
  { 
     alert("请输入公司发行名称！");    
      window.document.getElementById("fullname").focus();
     return false;
  }
  else if(window.document.getElementById("edifice").value=="")
  { 
     alert("请输入大厦或工业区名称！");    
      window.document.getElementById("edifice").focus();
     return false;
  }
  else if(window.document.getElementById("floor").value=="")
  { 
     alert("请输入剩余地址！");    
      window.document.getElementById("floor").focus();
     return false;
  }
  else if(window.document.getElementById("business").value=="")
  { 
     alert("请输入主营！");    
      window.document.getElementById("business").focus();
     return false;
  }
 else if(window.document.getElementById("new_phone").value=="")
  { 
     alert("请输入新电话！");    
      window.document.getElementById("new_phone").focus();
     return false;
  }
 else if(window.document.getElementById("principal").value=="")
  { 
     alert("请输入发行负责人！");    
      window.document.getElementById("principal").focus();
     return false;
  }
  else
  {
     //判断输入是否有非法字符
     //return true;
     if(confirm('确定提交这条黄页记录吗?'))
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
.STYLE3 {
	font-family: "华文琥珀";
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
    <td width="120"><a href="/mine/page_update">黄页数据修改</a></td>
    <td width="120"><a href="/mine/page_insert">黄页数据插入</a></td>
  </tr>
</table>
<br>
&nbsp;&nbsp;<font size=2 > 1.点击右下角的“插入”即可以插入一条新记录；</font><BR>
&nbsp;  &nbsp;<font size=2 color=red >2.请谨慎操作。</font>
<table align="center" width="620" border="1">
<form name="form1" method="post" onsubmit="return myConfirm();" action="index_insert.php">
<!---
  <tr><td width=120 align='center' class='STYLE3'>编码</td>
  <td><input name='pid' type='text' id='pid' size='6'></td></tr>-->
  <tr><td width=120 align='center' class='STYLE3'>信封编号（*）</td>
  <td><input name='envelopeid' type='text' id='envelopeid' size='4'></td></tr> 
  <tr><td width=120 align='center' class='STYLE3'>发行备注（*）</td>
  <td><input name='remark' type='text' id='remark' size='10'></td></tr>  
  <tr><td width=120 align='center' class='STYLE3'>发行数量（*）</td>
  <td><input name='amount' type='text' id='amount' size='2'></td></tr> 
  <tr><td width=120 align='center' class='STYLE3'>完整发行名称（*）</td>
  <td><input name='fullname' type='text' id='fullname'  size='30'></td></tr>   
  	      
  <!--- <tr><td width=120 align='center' class='STYLE3'>信息编码（不填）</td>
  <td><input name='info_code' type='text' id='info_code' readonly size='8'></td></tr> 
  <tr><td width=120 align='center' class='STYLE3'>原发行名称（不填）</td>
  <td><input name='name' type='text' id='name' readonly size='30'></td></tr>           
  
 <tr><td width=120 align='center' class='STYLE3'>可脱（名称）</td>
  <td><input name='omissible' type='text' id='omissible'  size='12'></td></tr> 
  <tr><td width=120 align='center' class='STYLE3'>不可脱（名称）</td>
  <td><input name='unomissible' type='text' id='unomissible'  size='12'></td></tr> 
  <tr><td width=120 align='center' class='STYLE3'>任意名</td>
  <td><input name='random_name' type='text' id='random_name'  size='12'></td></tr> 
  <tr><td width=120 align='center' class='STYLE3'>主营/类别</td>
  <td><input name='main_work' type='text' id='main_work' size='12'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>单位属性</td>
  <td><input name='attribute' type='text' id='attribute' size='12'></td></tr> 
  <tr><td width=120 align='center' class='STYLE3'>分支机构</td>
  <td><input name='branch' type='text' id='branch' size='12'></td></tr> 
  <tr><td width=120 align='center' class='STYLE3'>修饰字符</td>
  <td><input name='adjective' type='text' id='adjective' size='12'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>原地址（不填）</td>
  <td><input name='address' type='text' id='address' readonly size='30'></td></tr>-->
  <tr><td width=120 align='center' class='STYLE3'>区</td>
  <td><input name='district' type='text' id='district'  size='10'></td></tr>
<!--  <tr><td width=120 align='center' class='STYLE3'>街道</td>
  <td><input name='pid' type='text' id='pid' size='10'></td></tr> -->
  <tr><td width=120 align='center' class='STYLE3'>路</td>
  <td><input name='road' type='text' id='road' size='10'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>号</td>
  <td><input name='number' type='text' id='number' size='10'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>大厦/花园（*）</td>
  <td><input name='edifice' type='text' id='edifice' size='16'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>剩余地址（*）</td>
  <td><input name='floor' type='text' id='floor' size='8'></td></tr>
 <!-- <tr><td width=120 align='center' class='STYLE3'>修饰地址</td>
  <td><input name='cell' type='text' id='cell' size='8'></td></tr>-->
  <tr><td width=120 align='center' class='STYLE3'>企业联系人</td>
  <td><input name='linkman' type='text' id='linkman' size='10'></td></tr>
  <!---<tr><td width=120 align='center' class='STYLE3'>行业类别</td>
  <td><input name='category' type='text' id='category' size='25'></td></tr>-->
  <tr><td width=120 align='center' class='STYLE3'>主营（*）</td>
  <td><input name='business' type='text' id='business' size='25'></td></tr>
<!---  <tr><td width=120 align='center' class='STYLE3'>原电话</td>
  <td><input name='telephone' type='text' id='telephone' readonly size='60'></td></tr>-->
  <tr><td width=120 align='center' class='STYLE3'>新电话（*）</td>
  <td><input name='new_phone' type='text' id='new_phone'  size='60' onBlur='checkInput(this.form);'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>企业联系人电话</td>
  <td><input name='mobilephone' type='text' id='mobilephone'  size='30'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>传真</td>
  <td><input name='fax' type='text' id='fax' size='20' onBlur='checkInput2(this.form);'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>网址</td>
  <td><input name='website' type='text' id='website' size='20'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>邮箱</td>
  <td><input name='email' type='text' id='email' size='20'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>QQ/MSN</td>
  <td><input name='qqmsn' type='text' id='qqmsn' size='20'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>发行负责人（*）</td>
  <td><input name='principal' type='text' id='principal' size='20'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>录入人</td>
  <td><input name='editor' type='text' id='editor' value='<?php echo $_username ?>' readonly size='6'></td></tr>
  <tr><td width=120 align='center' class='STYLE3'>录入日期</td>
  <td><input name='edittime' type='text' id='edittime' readonly size='20'></td></tr>
  <tr>
    <td height="25" align="center">&nbsp;</td>
    <td align="left"><span class="STYLE2"><input type="submit" name="Submit" value="提交"></span></td>
  </tr> 
  <tr>
    <td height="25" colspan="2" align="center"><span class="STYLE3">版权所有<span class="STYLE2">:</span>中通信息服务有限公司</span></td>
  </tr>
  </form>
  
</table>
</body>
</html>
