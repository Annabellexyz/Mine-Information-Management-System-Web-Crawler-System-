<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>用户安全登录</title>
</head>
<script language="javascript">
function mycheck(){
if(myform.username.value=="")
{alert("用户名称不能为空！！");myform.username.focus();return false;}
if(myform.password.value=="")
{alert("用户密码不能为空！！");myform.password.focus();return false;}
}
</script>
<body>
<form name="myform" method="post" action="checklogin.php">
  <table width="350" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#4F8C0A">
    <tr>
      <td><table width="350" height="223" border="0" align="center" cellpadding="0" cellspacing="0" background="images/bg.jpg">
        <tr>
          <td height="86" colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td width="222" height="33" align="center"><p>用户名：
                  <input name="username" type="text" id="username" size="18"style="width:140;height:22">
          </p></td>
          <td width="128" height="102" rowspan="3" valign="top"><p>&nbsp;</p></td>
        </tr>
        <tr>
          <td height="29" align="center">密&nbsp;&nbsp;码：
              <input name="password" type="password" id="password" size="18" style=" font-family:Wingdings; width:140;height:22" oncopy="return false" oncut="return false" onpaste="return false"></td>
        </tr>
        <tr>
          <td height="31" align="center"><input type="submit" name="submit" onClick="return mycheck();" value="登录">
&nbsp;
      <input type="reset" name="Submit2" value="重置"></td>
        </tr>
        <tr>
          <td height="31" colspan="2">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
