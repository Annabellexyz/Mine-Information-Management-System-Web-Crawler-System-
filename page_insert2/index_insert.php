<?php session_start(); 
	$fpath = str_replace('\\', '/',substr(dirname(__FILE__), 0, -17));
	require_once $fpath.'/include/common.inc.php'; 
	//echo $fpath.'/include/common.inc.php';//测试路径是否正确
  //include("conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160电信黄页光盘发行数据插入系统</title>
<script src="/member/login.php?action=abc"></script>
</head>
<body>
	
<?php
$Submit = isset($__POST['Submit']) ? trim($__POST['Submit']) : '';
//$pid = isset($__POST['pid']) ? trim($__POST['pid']) : '';
$remark = isset($__POST['remark']) ? trim($__POST['remark']) : '';
//$info_code = isset($__POST['info_code']) ? trim($__POST['info_code']) : '';
//$name = isset($__POST['name']) ? trim($__POST['name']) : '';
$fullname = isset($__POST['fullname']) ? trim($__POST['fullname']) : '';//新增
//$omissible = isset($__POST['omissible']) ? trim($__POST['omissible']) : '';//新增
//$unomissible = isset($__POST['unomissible']) ? trim($__POST['unomissible']) : '';//新增
//$random_name = isset($__POST['random_name']) ? trim($__POST['random_name']) : '';//新增
//$main_work = isset($__POST['main_work']) ? trim($__POST['main_work']) : '';//新增
//$attribute = isset($__POST['attribute']) ? trim($__POST['attribute']) : '';//新增
//$branch = isset($__POST['branch']) ? trim($__POST['branch']) : '';//新增branch
//$adjective = isset($__POST['adjective']) ? trim($__POST['adjective']) : '';//新增
//$address = isset($__POST['address']) ? trim($__POST['address']) : '';
$district = isset($__POST['district']) ? trim($__POST['district']) : '';//新增
//$street = isset($__POST['street']) ? trim($__POST['street']) : '';//新增
//$road = isset($__POST['road']) ? trim($__POST['road']) : '';
//$number = isset($__POST['number']) ? trim($__POST['number']) : '';//新增
$edifice = isset($__POST['edifice']) ? trim($__POST['edifice']) : '';
$floor = isset($__POST['floor']) ? trim($__POST['floor']) : '';
//$cell = isset($__POST['cell']) ? trim($__POST['cell']) : '';
$linkman  = isset($__POST['linkman']) ? trim($__POST['linkman']) : '';
//$category  = isset($__POST['category']) ? trim($__POST['category']) : '';
$business  = isset($__POST['business']) ? trim($__POST['business']) : '';
//$telephone = isset($__POST['telephone']) ? trim($__POST['telephone']) : '';
$new_phone = isset($__POST['new_phone']) ? trim($__POST['new_phone']) : '';
//$mobilephone = isset($__POST['mobilephone']) ? trim($__POST['mobilephone']) : '';
$fax  = isset($__POST['fax']) ? trim($__POST['fax']) : '';
$website  = isset($__POST['website']) ? trim($__POST['website']) : '';
//$email  = isset($__POST['email']) ? trim($__POST['email']) : '';
//$principal  = isset($__POST['principal']) ? trim($__POST['principal']) : '';
//$editor  = isset($__POST['editor']) ? trim($__POST['editor']) : '';
$editor  = $_username;
//$edittime  = isset($__POST['edittime']) ? trim($__POST['edittime']) : '';
if(phpversion()>='5.1.0')
{ 
    //echo date_default_timezone_get();////获取php当前使用时区
    date_default_timezone_set('Asia/Shanghai'); //设置时区
}
$edittime = date("Y-m-d H:i:s");

//print_r($_POST);
if($Submit=="提交"){
if(!empty($editor)){
$sqlstr = "INSERT INTO china_szpage ( 
           remark, fullname,linkman,
           district,edifice,floor,business,
           new_phone,fax,website,editor,edittime) 
           VALUES (
           '$remark', '$fullname' ,'$linkman',
           '$district','$edifice',
           '$floor','$business','$new_phone','$fax','$website',
           '$editor','$edittime'
)";
echo "<br>";
echo $sqlstr;
//$query=mysql_query( $sqlstr, $link ) or die(mysql_error());
$query=mysql_query( $sqlstr) or die(mysql_error());
if($query==true)
     {	     	
	     	echo "<br>";echo "<br>";
	     	echo "<font color=red>"."数据插入成功!!请检查数据是否正确！"."</font>"."<br>"."<br>"
	     	."<a href='/mine/page_insert2'>点击此处继续插入电信光盘发行数据</a>";
	     	//."继续插入数据－后退或者在地址栏输入：http://172.20.1.21/mine/football_insert/";
	    echo "<br>";
	    }
else
    {echo "数据插入失败!!";}
}
else 
{
  echo "你没有登录系统没有操作权限！<a href=''>请点击此处登录后继续进行数据录入！</a>";}
}
/*
以下浏览器自动跳转到插入界面
$query=mysql_query("INSERT INTO china_szpage ( 
					id, day, time, typename, hometeam, points, guestteam, halfpoints, remarks
					) VALUES (
					'$id', '$day' ,'$time' ,'$typename' ,'$hometeam' ,'$points' ,'$guestteam' ,'$halfpoints' ,'$remarks'  
					)") or die(mysql_error());
        if($query==true)
        { echo "<script>alert('足球完场赛事资料插入成功!!');window.location.href='http://172.20.1.21/mine/football_insert/';</script>";
        }
        else
        {echo "数据插入失败!!";}*/
    
else
{echo "...未提交数据!!";};
//mysql_close( $link );
?>