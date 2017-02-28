<?php session_start(); 
	$fpath = str_replace('\\', '/',substr(dirname(__FILE__), 0, -31));
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

$busline = isset($__POST['busline']) ? trim($__POST['busline']) : '';///
//$changetype = isset($__POST['changetype']) ? trim($__POST['changetype']) : '';///
$change2type=$__POST['changetype'];
$changetype = implode("|",$change2type);

$remark = isset($__POST['remark']) ? trim($__POST['remark']) : '';///
$consumename = isset($__POST['consumename']) ? trim($__POST['consumename']) : '';///
$fullname = isset($__POST['fullname']) ? trim($__POST['fullname']) : '';///
$address = isset($__POST['address']) ? trim($__POST['address']) : '';///
$district = isset($__POST['district']) ? trim($__POST['district']) : '';///
$road = isset($__POST['road']) ? trim($__POST['road']) : '';///
$doorplate = isset($__POST['doorplate']) ? trim($__POST['doorplate']) : '';///
$edifice = isset($__POST['edifice']) ? trim($__POST['edifice']) : '';///
$floor = isset($__POST['floor']) ? trim($__POST['floor']) : '';///
$introduction  = isset($__POST['introduction']) ? trim($__POST['introduction']) : '';///

$businesshours  = isset($__POST['businesshours']) ? trim($__POST['businesshours']) : '';///
$telephone = isset($__POST['telephone']) ? trim($__POST['telephone']) : '';///
//$theme = isset($__POST['theme']) ? trim($__POST['theme']) : '';///
$th2eme=$__POST['theme'];
$theme = implode("|",$th2eme);

$category = isset($__POST['category']) ? trim($__POST['category']) : '';///
$information  = isset($__POST['information']) ? trim($__POST['information']) : '';///

//$foodkind  = isset($__POST['foodkind']) ? trim($__POST['foodkind']) : '';///
$food2kind=$__POST['foodkind'];
$foodkind = implode("|",$food2kind);

//$creditcard  = isset($__POST['creditcard']) ? trim($__POST['creditcard']) : '';///
$credit2card = $__POST['creditcard'];
$creditcard = implode("|",$credit2card);

$capacity  = isset($__POST['capacity']) ? trim($__POST['capacity']) : '';///
$roomamount  = isset($__POST['roomamount']) ? trim($__POST['roomamount']) : '';///
$signfood  = isset($__POST['signfood']) ? trim($__POST['signfood']) : '';///

//$foodtype  = isset($__POST['foodtype']) ? trim($__POST['foodtype']) : '';///
$food2type=$__POST['foodtype'];
//$foodtype = implode("|",$food2type);
if (empty($food2type))
{$foodtype = ""; }
else
{$foodtype = implode("|",$food2type);}

//$flavor  = isset($__POST['flavor']) ? trim($__POST['flavor']) : '';///
$fla2vor=$__POST['flavor'];
//$flavor = implode("|",$fla2vor);
if (empty($fla2vor))
{$flavor = ""; }
else
{$flavor = implode("|",$fla2vor);}

$togo  = isset($__POST['togo']) ? trim($__POST['togo']) : '';///
$parking  = isset($__POST['parking']) ? trim($__POST['parking']) : '';///

$editor  = $_username;
$edittime  = isset($__POST['edittime']) ? trim($__POST['edittime']) : '';

echo "<pre>"; print_r($__POST); echo "</pre>";

if(phpversion()>='5.1.0')
{ 
    //echo date_default_timezone_get();////获取php当前使用时区
    date_default_timezone_set('Asia/Shanghai'); //设置时区
}
$edittime = date("Y-m-d H:i:s");

     if(intval($lmbs) > 0){
     	if (!empty($editor)) {
        $pid=$__POST['pid'];
        $query=mysql_query("update telecom_restaurant  set 
        changetype='$changetype', busline='$busline',fullname='$fullname',
        remark='$remark',consumename='$consumename',telephone='$telephone',
        address='$address',district='$district', road='$road',doorplate='$doorplate',
        edifice='$edifice',floor='$floor',introduction='$introduction', 
        businesshours='$businesshours',theme='$theme',category='$category',information='$information',
        foodkind='$foodkind',creditcard='$creditcard',capacity='$capacity',
        roomamount='$roomamount',parking='$parking',
        signfood='$signfood',foodtype='$foodtype',flavor='$flavor',togo='$togo',
        editor='$editor',edittime='$edittime' where id='$lmbs'") or die(mysql_error());
        if($query==true)
        { 
         echo "<script>alert('电信餐饮资料更新成功!!');window.location.href='';</script>";
        }
        
        else{echo "更新失败!!";}
      }
      else {echo "<font color = red>你没有登录系统没有操作权限！</font><a href=''>请点击此处登录后继续进行编辑！</a>";}
}
?>
</body>
</html>