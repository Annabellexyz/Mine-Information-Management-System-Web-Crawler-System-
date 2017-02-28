<?php session_start(); 
include("conn.php");
$lmbs = isset($_GET['lmbs']) ? intval($_GET['lmbs']) : 0;

$remark = isset($_POST['remark']) ? trim($_POST['remark']) : '';
$info_code = isset($_POST['info_code']) ? trim($_POST['info_code']) : '';
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';//新增
$omissible = isset($_POST['omissible']) ? trim($_POST['omissible']) : '';//新增
$unomissible = isset($_POST['unomissible']) ? trim($_POST['unomissible']) : '';//新增
$random_name = isset($_POST['random_name']) ? trim($_POST['random_name']) : '';//新增
$main_work = isset($_POST['main_work']) ? trim($_POST['main_work']) : '';//新增
$attribute = isset($_POST['attribute']) ? trim($_POST['attribute']) : '';//新增
$adjective = isset($_POST['adjective']) ? trim($_POST['adjective']) : '';//新增
$address = isset($_POST['address']) ? trim($_POST['address']) : '';
$district = isset($_POST['district']) ? trim($_POST['district']) : '';//新增
$street = isset($_POST['street']) ? trim($_POST['street']) : '';//新增
$road = isset($_POST['road']) ? trim($_POST['road']) : '';
$number = isset($_POST['number']) ? trim($_POST['number']) : '';//新增
$edifice = isset($_POST['edifice']) ? trim($_POST['edifice']) : '';
$floor = isset($_POST['floor']) ? trim($_POST['floor']) : '';
$cell = isset($_POST['cell']) ? trim($_POST['cell']) : '';
$linkman  = isset($_POST['linkman']) ? trim($_POST['linkman']) : '';
//$area  = isset($_POST['area']) ? trim($_POST['area']) : '';
$category  = isset($_POST['category']) ? trim($_POST['category']) : '';
$business  = isset($_POST['business']) ? trim($_POST['business']) : '';
$telephone = isset($_POST['telephone']) ? trim($_POST['telephone']) : '';
$fax  = isset($_POST['fax']) ? trim($_POST['fax']) : '';
$website  = isset($_POST['website']) ? trim($_POST['website']) : '';
$email  = isset($_POST['email']) ? trim($_POST['email']) : '';
$principal  = isset($_POST['principal']) ? trim($_POST['principal']) : '';
$editor  = isset($_POST['editor']) ? trim($_POST['editor']) : '';
$edittime  = isset($_POST['edittime']) ? trim($_POST['edittime']) : '';
//$gift  = isset($_POST['gift']) ? trim($_POST['gift']) : '';

echo "<pre>"; print_r($_POST); echo "</pre>";

if(phpversion()>='5.1.0')
{ 
    //echo date_default_timezone_get();////获取php当前使用时区
    date_default_timezone_set('Asia/Shanghai'); //设置时区
}
$edittime = date("Y-m-d H:i:s");

     if(intval($lmbs) > 0){
     	if (!empty($editor)) {
        $pid=$_POST[pid];
        $query=mysql_query("update china_szpage set remark='$remark',info_code='$info_code',name='$name',fullname='$fullname',omissible='$omissible',
        unomissible='$unomissible',random_name='$random_name',main_work='$main_work',attribute='$attribute',adjective='$adjective',
        address='$address',district='$district', street='$street',road='$road',number='$number',
        edifice='$edifice',floor='$floor',cell='$cell',linkman='$linkman', category='$category',
        business='$business',telephone='$telephone',fax='$fax',
        website='$website',email='$email',principal='$principal',editor='$editor',       
        edittime='$edittime' where pid='$lmbs'") or die(mysql_error());
        if($query==true)
        { 
         echo "<script>alert('电信黄页资料更新成功!!');window.location.href='';</script>";
        }
        else{echo "更新失败!!";}
      }
      else {echo "你没有登录系统没有操作权限！<a href=''>请点击此处登录后继续进行编辑！</a>";}
}
?>