<? 
include_once( "conn.php "); 
session_start(); 
ob_start(); 
$CUR_TIME=date( "Y-m-d   H:i:s ",time()); 
?> 

<html> 
<head> 
<title> 会员登录 </title> 
<meta   http-equiv= "Content-Type "   content= "text/html;   charset=gb2312 "> 
<link   rel= "stylesheet "   type= "text/css "   href= "style.css "> 
</head> 

<body   class= "bodycolor "   topmargin= "5 "> 

<? 
function   re_login_button() 
{ 
?> 
<br> 
<div   align= "center "> 
    <input   type= "button "   value= "重新登录 "   class= "BigButton "   onClick= "location= '/ ' "> 
</div> 
<? 
} 
$LOGIN_MSG=login_check($USERNAME,$PASSWORD); 
if($LOGIN_MSG!= "1 ") 
{ 
      Message( "错误 ",$LOGIN_MSG); 
      re_login_button(); 
      exit; 
} 

$query   =   "SELECT   *   from   tb_user   where   USER_ID= '$LOGIN_USER_ID ' "; 
$cursor=   exequery($connection,$query); 
if($ROW=mysql_fetch_array($cursor)) 
      $MENU_TYPE=$ROW[ "MENU_TYPE "]; 

if($MENU_TYPE==1||stristr($HTTP_USER_AGENT, "Opera ")||stristr($HTTP_USER_AGENT, "Firefox ")||stristr($HTTP_USER_AGENT, "MSIE   5.0 ")||stristr($HTTP_USER_AGENT, "MSIE   6.0 ")||stristr($HTTP_USER_AGENT, "MSIE   7.0 ")||stristr($HTTP_USER_AGENT, "TencentTraveler ")) 
{ 
      Header( "location:general "); 
      exit; 
} 
?> 
<script> 
function   goto_vip() 
{ 
                location= "http://172.16.1.61/dataprocessing2/index.php"; 
} 
window.setTimeout( 'goto_vip(); ',3000); 
var   open_flag=window.open( "http://172.16.1.61/dataprocessing2/index.php", ' <?=md5($USERNAME).time()?> ', "menubar=0,toolbar= <?if($MENU_TYPE==2)echo   "1 ";else   echo   "0 ";?> ,status=1,resizable=1 "); 
if(open_flag==   null) 
      goto_vip(); 
else 
{ 
      focus(); 
      window.opener   =window.self; 
      window.close(); 
} 
</script> 

<div   class=big1> 正在进入会员管理系统，请稍候... </div> 

</body> 
</html> 
