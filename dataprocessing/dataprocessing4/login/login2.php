<?
function login_filemanager()
{
global $PHP_AUTH_USER,$PHP_AUTH_PW;
if (empty($PHP_AUTH_USER)||empty($PHP_AUTH_PW))
{
//Header("WWW-Authenticate: Basic realm=\"�û���¼\"";
//Header("HTTP/1.0 401 Unauthorized";
//echo("<center><font size=6 face=���� color=red>�û���֤ʧ�ܣ�</font></center>";
Header("WWW-Authenticate: Basic realm=\"�û���¼\"");
Header("HTTP/1.0 401 Unauthorized");
echo("<center><font size=6 face=���� color=red>�û���֤ʧ�ܣ�</font></center>");
exit;
}
else
{
//$dbc=mysql_connect("localhost","admin","admin"; //
$dbc=mysql_connect("localhost","admin","admin"); //
$res=mysql_select_db("db_database18 ",$dbc); //
$res=mysql_query("select status from tb_user  where username='$PHP_AUTH_USER' and password='$PHP_AUTH_PW'",$dbc);
$count=mysql_num_rows($res);
mysql_free_result($res);
mysql_close($dbc);

if(!$count)
{
//Header("WWW-Authenticate: Basic realm=\"�û���¼\"";
Header("WWW-Authenticate: Basic realm=\"�û���¼\"");
header('HTTP/1.0 401 Unauthorized');
echo '��������ȷ���û��������룡';
exit;
}

}
}

login_filemanager();
echo "��½�ɹ���"  //������������Ĵ���
?>

