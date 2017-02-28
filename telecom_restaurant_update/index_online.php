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
<title>160电信餐饮数据查询系统</title>
<script src="/member/login.php?action=abc"></script>
<script type="text/javascript">
function _(v){return document.getElementById(v);}

function radio_value(name){
	for(i=0;i<_('myform').elements.length;i++){
		if(_('myform').elements[i].checked && _('myform').elements[i].name == name)
			return _('myform').elements[i].value;
	}
	return null;
}

function ck(){
	if(!radio_value("remark")){
		alert("备注信息未填！") ;
		return false ;
	}else{
		if(radio_value("remark") == "已核对"){
			if(_("telephone").value.length<8){
				alert("电话位数小于8位！") ;
				return false ;
			}else{
				return myConfirm();
			}
		}else{
			return true;
		}
	}
}

/*function ched(name){
	for(i=0;i<_('myform').elements.length;i++){
		if(_('myform').elements[i].checked && _('myform').elements[i].name == name)
			return true;
	}
	return false;
}*/

function ched(name){
	for(i=0,j=_('myform').elements.length;i<j;i++){
		if(_('myform').elements[i].name == name && _('myform').elements[i].checked)
			return true;
	}
	return false;
} 

function myConfirm(){
	if(!ched('remark')){
		alert("请选择备注！");
		return false;
	}
	
	if(!ched('district')){
		alert("请选择区！");
		return false;
	}

	if(!ched('theme[]')){
		alert("请选择主题词！");
		return false;
	}

	if(!ched('changetype[]')){
		alert("请选择数据更新种类！");
		return false;
	}

	if(!ched('foodkind[]')){
		alert("请选择用餐类型！");
		return false;
	}

	if(!ched('creditcard[]')){
		alert("请选择卡！");
		return false;
	}
	
	if(window.document.getElementById("fullname").value=="")
  { 
     alert("请输入全名！");    
      window.document.getElementById("fullname").focus();
     return false;
  }
  
  if(window.document.getElementById("consumename").value=="")
  { 
     alert("请输入消费名！");    
      window.document.getElementById("consumename").focus();
     return false;
  }
  
  if(window.document.getElementById("address").value=="")
  { 
     alert("请输入地址！");    
      window.document.getElementById("address").focus();
     return false;
  }
/*  if(window.document.getElementById("district").value=="")
  { 
     alert("请输入区！");    
      window.document.getElementById("district").focus();
     return false;
  }*/
  if(window.document.getElementById("businesshours").value=="")
  { 
     alert("请输入营业时间！");    
      window.document.getElementById("businesshours").focus();
     return false;
  }

	/*if(_("fullname").value == ""){
		alert("请输入全名！");
		_("fullname").focus();
		return false;
	}

	if(_("consumename").value==""){
		alert("请输入消费名！");
		_("consumename").focus();
		return false;
	}
	if(_("address").value==""){
		alert("请输入地址！");
		_("address").focus();
		return false;
	}
	if(_("district").value==""){
		alert("请输入区！");
		_("district").focus();
		return false;
	}
  
	if(_("businesshours").value==""){
		alert("请输入营业时间！");
		_("businesshours").focus();
		return false;
	}*/

	return confirm('确定提交这条记录吗?');
}
</script>

<style type="text/css">
<!--
.STYLE1 {font-size: 12px}
-->
</style>
</head>
<body>
<h5><a href = '' target=_blank>我发现有新的餐饮店铺</a></h5>
  <!--
    <td width="120"><a href="/mine/telecom_restaurant_update">餐饮数据修改</a></td>
    <td width="120"><a href="/mine/telecom_restaurant_insert">餐饮数据插入</a></td>-->
   
 
<?php

	// 处理分页
function index_page($totalNum, $page_num = null, $showNum = null, $page = 'page', $matchArray = null)
{
	global $__GET, $__POST;
	if ( is_null($page_num) ) $page_num = 10;  // 分页中每显示多少页码
	if ( is_null($showNum) ) $showNum  = 10;  // 每页显示的记录
	$curPage   = isset($__GET[$page]) && intval($__GET[$page]) > 0 ? intval($__GET[$page]) : 1;
	unset($__GET[$page],$__POST[$page]);
	$URL = '?';
	foreach ($__GET as $key => $value) {
		if ($matchArray != null) {
			if (in_array($key, $matchArray))
				$URL .= $key . '=' . $value . '&';
			continue;
		}
		$URL .= $key . '=' . $value . '&';
	}
	foreach ($__POST as $key => $value) {
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
	$__GET[$page] = $curPage;
	if (!$totalPage)
		return '';
	$halfNum      = intval($page_num/2);
	$startNum     = (($curPage - $halfNum) < 1) ? 1 : $curPage - $halfNum + ($page_num+1)%2;
	$endNum       = (($curPage + $halfNum) > $totalPage) ? $totalPage : $curPage + $halfNum;
	$pageString   = "<div>";
	$PreviousPage = $curPage-1;

	$pageString   .= ($curPage != 1) ? "<a href=\"{$URL}1\">首页</a>" : "<a>首页</a>";
	$pageString   .= ($PreviousPage > 0) ? "<a href=\"{$URL}{$PreviousPage}\">上一页</a>" : "";
	for ($i = $startNum; $i <= $endNum; $i++ ) {
		if ($i == $curPage) {
			$pageString .= "<a style=\"margin:auto 3px;\"><b>$i</b></a>";
			continue;
		}
		$pageString .= "<a style=\"margin:auto 3px;\" href=\"{$URL}{$i}\">{$i}</a>";
	}
	$NextPage = $curPage+1;
	//$pageString .= ($NextPage > $endNum) ? "" : "<a href=\"{$URL}{$NextPage}\">下一页</a></div>";
	$pageString .= ($NextPage > $endNum) ? "" : "<a href=\"{$URL}{$NextPage}\">下一页</a>";
	$pageString .= ($curPage == $totalPage) ? "尾页" : "<a href=\"{$URL}{$totalPage}\">尾页</a></div>";
	return $pageString;

}

$linksize = 20;
$pagesize = 100;

$content = '';  // 内容
$pageation = ''; // 分页

if ($__GET['id'])//点击关键词
{
 $id = isset($__GET['id']) ? trim($__GET['id']) : '';
 $whereString = " WHERE `id` LIKE '{$id}'";
 $query = "SELECT * FROM `telecom_restaurant` {$whereString}";
 $result = mysql_query($query);
 while ($row = mysql_fetch_assoc($result)){
 	
 	$changetype = stripslashes($row['changetype']);
 	if( (strpos($changetype,"|")) == false )
 	{ 
   $changetype_array[0] = $changetype;
  }
  else
  {
 	 $changetype_array = explode('|',$changetype);
  }
  
 	$remark = stripslashes($row['remark']);
	$name = stripslashes($row['name']);
	$telephone = stripslashes($row['telephone']);
	$address = stripslashes($row['address']);
	$district = stripslashes($row['district']);
	$road = stripslashes($row['road']);//新增
	
	$doorplate = stripslashes($row['doorplate']);
	$edifice = stripslashes($row['edifice']);//新增
	//$street = stripslashes($row['street']);//新增
	$floor = stripslashes($row['floor']);
	$busline = stripslashes($row['busline']);
	$introduction = stripslashes($row['introduction']);//新增
	$businesshours = stripslashes($row['businesshours']);
	
	$theme = stripslashes($row['theme']);
	//$theme_array = explode('；',$theme);
  if( (strpos($theme,"|")) == false )
 	{ 
   $theme_array[0] = $theme;
  }
  else
  {
 	 $theme_array = explode('|',$theme);
  }

	$category  = stripslashes($row['category']);
	//$area  = isset($_POST['area']) ? trim($_POST['area']) : '';
	//$category  = stripslashes($row['category']);
	$information  = stripslashes($row['information']);
	
	$foodkind = stripslashes($row['foodkind']);
  if( (strpos($foodkind,"|")) == false )
 	{ 
   $foodkind_array[0] = $foodkind;
  }
  else
  {
 	 $foodkind_array = explode('|',$foodkind);
  }
	
	$creditcard = stripslashes($row['creditcard']);
	if( (strpos($creditcard,"|")) == false )
 	{ 
   $creditcard_array[0] = $creditcard;
  }
  else
  {
 	 $creditcard_array = explode('|',$creditcard);
  }
	
	$capacity  = stripslashes($row['capacity']);
	$roomamount  = stripslashes($row['roomamount']);
	$signfood  = stripslashes($row['signfood']);
	
	$foodtype  = stripslashes($row['foodtype']);
  if( (strpos($foodtype,"|")) == false )
 	{ 
   $foodtype_array[0] = $foodtype;
  }
  else
  {
 	 $foodtype_array = explode('|',$foodtype);
  }
  
	$flavor  = stripslashes($row['flavor']);
	if( (strpos($flavor,"|")) == false )
 	{ 
   $flavor_array[0] = $flavor;
  }
  else
  {
 	 $flavor_array = explode('|',$flavor);
  }
  
	$togo  = stripslashes($row['togo']);
	$parking  = stripslashes($row['parking']);
	$editor  = stripslashes($row['editor']);
	$edittime  = stripslashes($row['edittime']);
//"<form name=form1 method=post action='index_update.php?lmbs={$row[id]}'"
 $content_id .= "<table align='center' width=75% border='1'>"
              ."<form name='form1' id='myform' method='post'  onsubmit='return ck()'  action='index_update.php?lmbs={$row[id]}'>"
              ."<tr><td width=20% align='center' class='STYLE1'>ID</td>"
              ."<td><input name='id' type='text' id='id' value='{$row[id]}' readonly size='10'></td></tr>"
              
              ."<tr><td align='center' class='STYLE1'>备注（*）</td>"
              ."<td>"
              .$row['remark']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>全名（*）</td>"
              ."<td>"
              .$row['fullname']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>消费名（*）</td>"
              ."<td>"
              .$row['consumename']              
              ."</td></tr>"                   
              ."<tr><td align='center' class='STYLE1'>电话号码（*）</td>"
              ."<td>"
              .$row['telephone'] 
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>地址（*）</td><td>"
              .$row['address']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>区（*）</td>"
              ."<td>"
              .$row['district']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>路</td>"
              ."<td>"
              .$row['road']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>门牌</td>"
              ."<td>"
              .$row['doorplate']              
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>大厦/花园/小区</td><td>"
              .$row['edifice']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>剩余地址</td><td>"
              .$row['floor']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>乘车路线</td><td>"
              .$row['busline']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>企业介绍</td><td>"
              .$row['introduction']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>营业时间（*）</td><td>"
              .$row['businesshours']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>主题词（*）</td><td>"
              .$row['theme']
              ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>消费信息</td><td>"
              .$row['information']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>用餐类型（*）</td><td>"
               .$row['foodkind']
               ."</td></tr>"
              ."<tr><td align='center' class='STYLE1'>信用卡（*）</td><td>"             
              .$row['creditcard']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>客容量</td><td>"
              .$row['capacity']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>包间数</td><td>"
              .$row['roomamount']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>招牌菜</td><td>"
              .$row['signfood']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1' >菜系</td><td>"
              .$row['foodtype']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>风味</td><td>"
              .$row['flavor']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>外送服务</td><td>"
              .$row['togo']
              ."</td></tr>"

              ."<tr><td align='center' class='STYLE1'>停车位</td><td>"
              .$row['parking']
              ."</td></tr>"
              
             
              ."<tr><td align='center' class='STYLE1'>录入日期</td><td>"
              .$row['edittime']
              . "</td></tr><tr><td align='center' class='STYLE1'><font color=red>我要纠错</font></td><td align='left'><a href ='/mine/telecom_restaurant_update/restaurant_edit.php?searchterm={$row[id]}&id={$row[id]}' target=_blank>点击修改这条记录</a></td></tr>"
              ."</form>"
              ."</table>" ;
}

echo $content_id;
}
else{
$content_id = "";
}

//$searchMethod = isset($_REQUEST['searchtype']) ? trim($_REQUEST['searchtype']) : '';
//$searchterm = isset($_REQUEST['searchterm']) ? trim($_REQUEST['searchterm']) : '';//搜索关键词
$searchMethod = isset($__GET['searchtype']) ? trim($__GET['searchtype']) : '';
$searchterm = isset($__GET['searchterm']) ? trim($__GET['searchterm']) : '';//搜索关键词
$limit = isset($__GET['limit']) ? trim($__GET['limit']) : ''; // 条件限制

$limitArray = array();
if (!empty($limit))
	{
	if(strpos($limit,','))
	   $limitArray=explode(',',$limit);
	elseif(strpos($limit,'，'))
	   $limitArray=explode('，',$limit);
	elseif(strpos($limit,'　'))
	   $limitArray=explode('　',$limit);
	else
	   $limitArray=explode(' ',$limit);
	}

// 存储球队字段
$fieldArray = array(
  'id',
  'pid',
	'remark',

	'fullname', //
	'consumename', //
	'address',//
	'district',//

	'road', //
	'doorplate',//
	'edifice', //
	'floor',//
	'busline',

	'telephone', //
	'introduction', //

	'businesshours',//
	'theme',//
	'category',//
	'information',//
	'foodkind',//
	'creditcard',//
	'capacity',//
	'roomamount',//
	'signfood',//
	'foodtype',//
	'flavor',//
	'togo',//
	'parking',//
	'editor',
	'edittime'
);

// 分开关键字存于数据库
if(strpos($searchterm,','))
   $teamArray=explode(',',$searchterm);
elseif(strpos($searchterm,'，'))
   $teamArray=explode('，',$searchterm);
elseif(strpos($searchterm,'　'))
   $teamArray=explode('　',$searchterm);
else
   $teamArray=explode(' ',$searchterm);
// 循环过滤空格
foreach ($teamArray as $key => $value)
	$teamArray[$key] = trim($value);

// 初始化SqlWhere
$sqlWhere = '';
switch ($searchMethod)
{
	case "Union":
		// 用来存储SQL语句数组
		$queryWhereArray = array();
		// 遍历去空格
		foreach ($teamArray as $key => $value)   // 关键字
		{
			$fieldFrameArray = array();  // 清空临时存储的数据片段
			foreach ($fieldArray as $fieldValue)  // 字段
			{
				if (count($limitArray) > 0) {
					if (in_array($fieldValue, $limitArray))
						array_push($fieldFrameArray, "`{$fieldValue}` LIKE '%{$value}%' AND remark like '已核对'");
				}
				else
					array_push($fieldFrameArray, "`{$fieldValue}` LIKE '%{$value}%' AND remark like '已核对'");
			}
			// 合并小的SqlWhere
			$smallSentence = '(' . implode(' OR ', $fieldFrameArray) . ')';
			// 组织SQL语句
			array_push($queryWhereArray, $smallSentence);
		}
		$sqlWhere = 'WHERE ' . implode(' AND ', $queryWhereArray);
		break;
	case "all":
		// 用来存储SQL语句数组
		$queryWhereArray = array();
		// 遍历去空格
		foreach ($fieldArray as $fieldValue)
		{
			foreach ($teamArray as $value)
			{
				array_push($queryWhereArray, "`{$fieldValue}` LIKE '%{$value}%' AND remark like '已核对'");
			}
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;
			// 下面语句处理单类型
	//case "info_code":
	case "name":
		$onlyField = $searchMethod;
		// 用来存储SQL语句数组
		$queryWhereArray = array();
		// 遍历去空格
		foreach ($teamArray as $value)
		{
			array_push($queryWhereArray, "`{$onlyField}` LIKE '%{$value}%' AND remark like '已核对'");
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;
	case "edifice":
		$onlyField = $searchMethod;
		// 用来存储SQL语句数组
		$queryWhereArray = array();
		// 遍历去空格
		foreach ($teamArray as $value)
		{
			array_push($queryWhereArray, "`{$onlyField}` LIKE '%{$value}%' AND remark like '已核对'");
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;

	case "pid":
		$onlyField = $searchMethod;
		// 用来存储SQL语句数组
		$queryWhereArray = array();
		// 遍历去空格
		foreach ($teamArray as $value)
		{
			//array_push($queryWhereArray, "`{$onlyField}` BETWEEN $value AND ($value+9)");
			//array_push($queryWhereArray, "`{$onlyField}` LIKE '%{$value}%'");
			array_push($queryWhereArray, "`{$onlyField}` LIKE '{$value}'");
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;
	case "id":
		$onlyField = $searchMethod;
		// 用来存储SQL语句数组
		$queryWhereArray = array();
		// 遍历去空格
		foreach ($teamArray as $value)
		{
			array_push($queryWhereArray, "`{$onlyField}` LIKE '{$value}'");
			//array_push($queryWhereArray, "`{$onlyField}` BETWEEN $value AND ($value+19)");
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;

	// 默认查找全部
	default:
		$sqlWhere = "WHERE remark like '已核对' ";
}

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `telecom_restaurant` {$sqlWhere}";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// 分页字符串
$pageation = "共{$row['PageNum']}条数据 " . index_page($row['PageNum'], $linksize, $pagesize);

//取当前页数据
$pageball = intval($__GET['page']);
$offset = $pagesize*($pageball - 1);

$query1 ="SELECT * FROM `telecom_restaurant` {$sqlWhere}  ORDER BY id ASC LIMIT $offset,$pagesize";
$result = mysql_query($query1);

$content ="";
$content .="<table height=264 border=0 cellpadding=0 cellspacing=0 >"
         ."<tr>"
	       ."<td  height=2>&nbsp;</td>"
	       ."<td >&nbsp;</td>"
	       ."<td >&nbsp;</td>"
	       ."</tr>"
	       ."<tr>"
	       ."<td height=125>&nbsp;</td>"
	       ."<td align='left' valign='top'><table border=1 cellpadding=0 cellspacing=0>"
		     ."<tr>"
		     ."<td width=15% align='center' class='STYLE1'>ID</td>"
	      ///// ."<td width=100 height=25 align='center' class='STYLE1'>备注</td>"//原来为大厦类型
	      ///// ."<td width=180 align='center' class='STYLE1'>全名</td>"//公司原完整名称
	       ."<td width=180 align='center' class='STYLE1'>消费名</td>"//公司原完整名称
	       ."<td width=15% align='center' class='STYLE1'>电话号码</td>"//新增 omissible
	       ."<td width=15% align='center' class='STYLE1'>地址</td>"//新增 unomissible
	    /////  ."<td width=15% align='center' class='STYLE1'>区</td>"//新增 random_name
	    /////    ."<td width=15% align='center' class='STYLE1'>路</td>"//新增 main_work
	       ///// ."<td width=15% align='center' class='STYLE1'>门牌</td>"//新增 attribute
	       ///// ."<td width=15% align='center' class='STYLE1'>大厦/花园/小区</td>"//新增 branch
	      /////  ."<td width=15% align='center' class='STYLE1'>剩余地址</td>"//新增 adjective
	     /////   ."<td width=15% align='center' class='STYLE1'>乘车路线</td>"//新增 adjective
	       ."<td width=200 align='center' class='STYLE1'>企业介绍</td>"
	       ."<td width=50 align='center' class='STYLE1'>营业时间</td>"//原为路
	       ."<td width=50 align='center' class='STYLE1'>主题词</td>"//新增
	      // ."<td width=50 align='center' class='STYLE1'>行业分类</td>"//新增
	    /////    ."<td width=80 align='center' class='STYLE1'>数据更新种类</td>"//新增
	       ."<td width=50 align='center' class='STYLE1'>消费信息</td>"//新增
	       ."<td width=15% align='center' class='STYLE1'>用餐类型</td>"
	       ."<td width=50 align='center' class='STYLE1'>信用卡</td>"//原为栋、层
	       ."<td width=50 align='center' class='STYLE1'>客容量</td>"
	       ."<td width=15% align='center'><span class='STYLE1'>包间数</span></td>"
	       ."<td width=15% height=25 align='center' class='STYLE1'>招牌菜</td>"
	       ."<td width=15% height=25 align='center' class='STYLE1'>菜系</td>"
	       ."<td width=15% height=25 align='center' class='STYLE1'>风味</td>"
	       ."<td width=15% align='center' class='STYLE1'>外送服务</td>"
	       ."<td width=15% align='center' class='STYLE1'>停车位</td>"
	   /////     ."<td width=50 height=25 align='center' class='STYLE1'>录入人</td>"
	   /////     ."<td width=15% height=25 align='center' class='STYLE1'>录入日期</td>"
	      // ."<td width=15% height=25 align='center' class='STYLE1'>派送物品</td>"
	       ."<td width=80 align='center'></td>"
	       ."</tr>";

if($result)
{

while ($row = mysql_fetch_assoc($result))
{
	$content .= "<form method=post action='index2_update.php?lmbs={$row[id]}'>"
      . "<tr>"
      //. "<td height=25 align=center class='STYLE1'><label>"
      //. "<td align='center' class='STYLE1'><input name='remark' type='text' id='remark' value='{$row[remark]}' size='10'></td>"
      //. "</label></td>"
      //. "<td height=25 align=center class='STYLE1'><label>"
      //mine/page_update/?searchtype=id&searchterm=4
     // . "<td><a href='?searchtype=id&searchterm={$row[id]}' target=_blank>{$row[id]}</a></td>"
     . "<td><a href='?searchtype=id&searchterm={$row[id]}&id={$row[id]}' target=_blank>{$row[id]}</a></td>"
      //. "<input name='id' type='text' id='id' value='{$row[id]}' readonly size='6'>"
     // . "</label></td>"
    /////   . "<td align='center' class='STYLE1'><input name='remark' type='text' id='remark' value='{$row[remark]}' size='5'></td>"
    /////   . "<td align='center' class='STYLE1'><input name='fullname' type='text' id='fullname' value='{$row[fullname]}'  size='20'></td>"
      . "<td align='center' class='STYLE1'><input name='consumename' type='text' id='consumename' value='{$row[consumename]}'  size='20'></td>"
      . "<td align='center' class='STYLE1'><input name='telephone' type='text' id='telephone' value='{$row[telephone]}' readonly size='10'></td>"
      . "<td align='center' class='STYLE1'><input name='address' type='text' id='address' value='{$row[address]}' readonly size='40'></td>"
   /////    . "<td align='center' class='STYLE1'><input name='district' type='text' id='district' value='{$row[district]}' size='6'></td>"
   /////    . "<td align='center' class='STYLE1'><input name='road' type='text' id='points' value='{$row[road]}' size='8'></td>"
   /////    . "<td align='center' class='STYLE1'><input name='doorplate' type='text' id='doorplate' value='{$row[doorplate]}' readonly size='6'></td>"
   /////    . "<td align='center' class='STYLE1'><input name='edifice' type='text' id='edifice' value='{$row[edifice]}' size='12'></td>"
   /////    . "<td align='center' class='STYLE1'><input name='floor' type='text' id='floor' value='{$row[floor]}' size='8'></td>"
   /////    . "<td align='center' class='STYLE1'><input name='busline' type='text' id='busline' value='{$row[busline]}' size='8'></td>"
      . "<td align='center' class='STYLE1'><input name='introduction' type='text' id='introduction' value='{$row[introduction]}' size='20'></td>"


      . "<td align='center' class='STYLE1'><input name='businesshours' type='text' id='businesshours' value='{$row[businesshours]}' size='20'></td>"
      . "<td align='center' class='STYLE1'><input name='theme' type='text' id='theme' value='{$row[theme]}' size='8'></td>"//新增
      //. "<td align='center' class='STYLE1'><input name='category' type='text' id='category' value='{$row[category]}' size='8'></td>"//新增

    /////   . "<td align='center' class='STYLE1'><input name='changetype' type='text' id='changetype' value='{$row[changetype]}' size='16'></td>"//新增

      . "<td align='center' class='STYLE1'><input name='information' type='text' id='information' value='{$row[information]}' size='16'></td>"//新增
      . "<td align='center' class='STYLE1'><input name='foodkind' type='text' id='foodkind' value='{$row[foodkind]}' size='20'></td>"//新增
      . "<td align='center' class='STYLE1'><input name='creditcard' type='text' id='creditcard' value='{$row[creditcard]}' size='20'></td>"//新增
      . "<td align='center' class='STYLE1'><input name='capacity' type='text' id='capacity' value='{$row[capacity]}' size='10'></td>"//新增
      . "<td align='center' class='STYLE1'><input name='roomamount' type='text' id='roomamount' value='{$row[roomamount]}' size='10'></td>"//新增


      . "<td align='center' class='STYLE1'><input name='signfood' type='text' id='signfood' value='{$row[signfood]}' size='20'></td>"


      . "<td align='center' class='STYLE1'><input name='foodtype' type='text' id='foodtype' value='{$row[foodtype]}' size='10'></td>"
      . "<td align='center' class='STYLE1'><input name='flavor' type='text' id='flavor' value='{$row[flavor]}' size='20'></td>"

      . "<td align='center' class='STYLE1'><input name='togo' type='text' id='togo' value='{$row[togo]}' size='20'></td>"
      . "<td align='center' class='STYLE1'><input name='parking' type='text' id='parking' value='{$row[parking]}' size='10'></td>"


   /////    . "<td align='center' class='STYLE1'><input name='editor' type='text' id='editor' value='{$row[editor]}' readonly size='6'></td>"
   /////    . "<td align='center' class='STYLE1'><input name='edittime' type='text' id='edittime' value='{$row[edittime]}' readonly size='20'></td>"
      //. "<td align='center' class='STYLE1'><input name='gift' type='text' id='gift' value='{$row[gift]}' size='16'></td>"
      . "<td align='center'><input type='image' name='imageField' src='images/bg1.jpg'></td>"
      . " </tr>"
	    . "</form>";
}
}
$content .= "</table>"
    . "</td>"
   . " <td>&nbsp;</td>"
  . "</tr>"
  . "<tr>"
    . "<td height=33>&nbsp;</td>"
    . "<td>&nbsp;</td>"
    . "<td>&nbsp;</td>"
  . "</tr>"
. "</table>";
?>

<form method="get">
<table align="center">
<tr align="center">
  <td >
	  <select align="center" name="searchtype">
	  <option value="Union">联合</option>
	  <option value="all">不限</option>
	  <option value="pid">电信编号</option>
	  <option value="fullname">全称</option>
	  <option value="edifice">大厦名称</option>
	  <option value="id">自编ID</option>
    </select></td>
  <td >关键词:</td>
  <td> <input name="searchterm" type="text"></td>
  <td> <input name="sousuo" type="submit" value="搜索"></td>
</tr>
</table>
</form>

<!-- 点击查询id的记录及分页 -->
<!--<table id="results" width="100%">
<tr><td align="left">
<?php echo $content_id ?>
<td><tr>
</table>-->

<!-- 总表的记录及分页 -->
<table id="results" width="100%">
<tr><td align="left">
<?php echo $content ?>
<td><tr>
</table>

<table width="100%">
<tr><td align="right">
<?php echo $pageation ?>
<td><tr>
</table>

</body>
</html>
