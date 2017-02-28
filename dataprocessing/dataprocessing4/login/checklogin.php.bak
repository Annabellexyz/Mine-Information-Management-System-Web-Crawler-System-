<?php
include "conn.php"; 
if($_POST[submit]!=""){
$username=$_POST[username];
$password=$_POST[password];
$sql=mysql_query("select * from tb_user where username='$username' and password='$password'");
$info=mysql_fetch_array($sql);
if($info){
?>
<script language="javascript">
alert("恭喜您，登录成功！");window.location.href="index.php";
</script>
<?php
}
else{
?>
<script language="javascript">
alert("对不起，您输入的用户名或密码错误！");window.location.href="index.php";
</script>
<?php
}
}
?>