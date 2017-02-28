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
<title>160电信黄页数据编辑系统</title>
<script src="/member/login.php?action=abc"></script>
</head>
<body>
<?php
$lmbs = isset($__GET['lmbs']) ? intval($__GET['lmbs']) : 0;
//$pid = isset($__POST['pid']) ? trim($__POST['pid']) : '';
$remark = isset($__POST['remark']) ? trim($__POST['remark']) : '';
$info_code = isset($__POST['info_code']) ? trim($__POST['info_code']) : '';
$name = isset($__POST['name']) ? trim($__POST['name']) : '';
$fullname = isset($__POST['fullname']) ? trim($__POST['fullname']) : '';//新增
//$omissible = isset($__POST['omissible']) ? trim($__POST['omissible']) : '';//新增
//$unomissible = isset($__POST['unomissible']) ? trim($__POST['unomissible']) : '';//新增
//$random_name = isset($__POST['random_name']) ? trim($__POST['random_name']) : '';//新增
//$main_work = isset($__POST['main_work']) ? trim($__POST['main_work']) : '';//新增
//$attribute = isset($__POST['attribute']) ? trim($__POST['attribute']) : '';//新增
//$branch = isset($__POST['branch']) ? trim($__POST['branch']) : '';//新增
//$adjective = isset($__POST['adjective']) ? trim($__POST['adjective']) : '';//新增
$address = isset($__POST['address']) ? trim($__POST['address']) : '';
$district = isset($__POST['district']) ? trim($__POST['district']) : '';//新增
//$street = isset($__POST['street']) ? trim($__POST['street']) : '';//新增
//$road = isset($__POST['road']) ? trim($__POST['road']) : '';
//$number = isset($__POST['number']) ? trim($__POST['number']) : '';//新增
$edifice = isset($__POST['edifice']) ? trim($__POST['edifice']) : '';
$floor = isset($__POST['floor']) ? trim($__POST['floor']) : '';
//$cell = isset($__POST['cell']) ? trim($__POST['cell']) : '';
//$linkman  = isset($__POST['linkman']) ? trim($__POST['linkman']) : '';
//$area  = isset($__POST['area']) ? trim($__POST['area']) : '';
//$category  = isset($__POST['category']) ? trim($__POST['category']) : '';
$business  = isset($__POST['business']) ? trim($__POST['business']) : '';
$telephone = isset($__POST['telephone']) ? trim($__POST['telephone']) : '';
$new_phone = isset($__POST['new_phone']) ? trim($__POST['new_phone']) : '';
//$mobilephone = isset($__POST['mobilephone']) ? trim($__POST['mobilephone']) : '';
$fax  = isset($__POST['fax']) ? trim($__POST['fax']) : '';
$website  = isset($__POST['website']) ? trim($__POST['website']) : '';
//$email  = isset($__POST['email']) ? trim($__POST['email']) : '';
//$principal  = isset($__POST['principal']) ? trim($__POST['principal']) : '';
//$editor  = isset($__POST['editor']) ? trim($__POST['editor']) : '';
$person = isset($__POST['person'])?trim($__POST['person']):'';
$types = isset($__POST['types'])?trim($__POST['types']):'';
$editor  = $_username;
$edittime  = isset($__POST['edittime']) ? trim($__POST['edittime']) : '';
//$gift  = isset($__POST['gift']) ? trim($__POST['gift']) : '';

echo "<pre>"; print_r($__POST); echo "</pre>";

if(phpversion()>='5.1.0')
{ 
    //echo date_default_timezone_get();////获取php当前使用时区
    date_default_timezone_set('Asia/Shanghai'); //设置时区
}
$edittime = date("Y-m-d H:i:s");

     if(intval($lmbs) > 0){
     	if (!empty($editor)) {
        $pid=$__POST[pid];
        $query=mysql_query("update china_szpage set remark='$remark',info_code='$info_code',name='$name',
        fullname='$fullname',linkman='$linkman',
        address='$address',district='$district', 
        edifice='$edifice',floor='$floor',
        business='$business',telephone='$telephone',new_phone='$new_phone',fax='$fax',
        website='$website',person='$person',types='$types',editor='$editor',       
        edittime='$edittime' where id='$lmbs'") or die(mysql_error());
        if($query==true)
        { 
         echo "<script>alert('电信黄页资料更新成功!!');window.location.href='';</script>";
        }
        
        else{echo "更新失败!!";}
      }
      else {echo "你没有登录系统没有操作权限！<a href=''>请点击此处登录后继续进行编辑！</a>";}
}
?>
</body>
</html>