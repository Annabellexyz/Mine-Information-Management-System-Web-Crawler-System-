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
<title>160电信黄页光盘数据编辑系统</title>
<script src="/member/login.php?action=abc"></script>
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
.STYLE1 {font-size: 12px}
-->
</style>
</head>
<body>
	<table  border="1" align="center">
  <tr>
    <td width="120"><a href="/mine/page_update2">黄页数据修改</a></td>
    <td width="120"><a href="/mine/page_insert2">黄页数据插入</a></td>
  </tr>
</table>
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
$pagesize = 500;

$content = '';  // 内容
$pageation = ''; // 分页

if ($__GET['id'])//点击关键词
{
 $id = isset($__GET['id']) ? trim($__GET['id']) : ''; 
 $whereString = " WHERE `id` LIKE '{$id}'";
 $query = "SELECT * FROM `china_szpage` {$whereString}";
 $result = mysql_query($query);
 while ($row = mysql_fetch_assoc($result)){
 	$id = stripslashes($row['id']);
 	$pid = stripslashes($row['pid']);
	$remark = stripslashes($row['remark']);
	$info_code = stripslashes($row['info_code']);
	$name = stripslashes($row['name']);
	$fullname = stripslashes($row['fullname']);//新增
	$omissible = stripslashes($row['omissible']);//新增
	$unomissible = stripslashes($row['unomissible']);//新增
	$random_name = stripslashes($row['random_name']);//新增
	$main_work = stripslashes($row['main_work']);//新增
	$attribute = stripslashes($row['attribute']);//新增
	$adjective = stripslashes($row['adjective']);//新增
	$address = stripslashes($row['address']);
	$district = stripslashes($row['district']);//新增
	$street = stripslashes($row['street']);//新增
	$road = stripslashes($row['road']);
	$number = stripslashes($row['number']);//新增
	$edifice = stripslashes($row['edifice']);
	$floor = stripslashes($row['floor']);
	$cell = stripslashes($row['cell']);
	$linkman  = stripslashes($row['linkman']);
	//$area  = isset($_POST['area']) ? trim($_POST['area']) : '';
	$category  = stripslashes($row['category']);
	$business  = stripslashes($row['business']);
	$telephone = stripslashes($row['telephone']);
	$new_phone = stripslashes($row['new_phone']);
	$mobilephone = stripslashes($row['mobilephone']);
	$fax  = stripslashes($row['fax']);
	$website  = stripslashes($row['website']);
	$email  = stripslashes($row['email']);
	$principal  = stripslashes($row['principal']);
	$editor  = stripslashes($row['editor']);
	$edittime  = stripslashes($row['edittime']);
//"<form name=form1 method=post action='index_update.php?lmbs={$row[id]}'"
 $content_id .= "<table align='center' width='620' border='1'>"
              ."<form name='form1' method='post' onsubmit='return myConfirm();' action='index_update.php?lmbs={$row[id]}'>"
              ."<tr><td width=150 align='center' class='STYLE1'>ID（不修改）</td>"
              ."<td><input name='id' type='text' id='id' value='{$row[id]}' readonly size='6'></td></tr>"
             // ."<tr><td width=150 align='center' class='STYLE1'>编码</td>"
             // ."<td><input name='id' type='text' id='id' value='{$row[pid]}' readonly size='6'></td></tr>"            
              ."<tr><td width=150 align='center' class='STYLE1'>发行备注</td>"
              ."<td><input name='remark' type='text' id='remark' value='{$row[remark]}' size='10'></td></tr>"           
              ."<tr><td width=150 align='center' class='STYLE1'>信息编码（不修改）</td>"
              ."<td><input name='info_code' type='text' id='info_code' value='{$row[info_code]}' readonly size='8'></td></tr>"             
              ."<tr><td width=150 align='center' class='STYLE1'>原发行名称（不修改）</td>"
              ."<td><input name='name' type='text' id='name' value='{$row[name]}' readonly size='30'></td></tr>"           
              ."<tr><td width=150 align='center' class='STYLE1'>完整发行名称</td>"
              ."<td><input name='fullname' type='text' id='fullname' value='{$row[fullname]}' size='30'></td></tr>"            
             // ."<tr><td width=150 align='center' class='STYLE1'>可脱（名称）</td>"
             // ."<td><input name='omissible' type='text' id='omissible' value='{$row[omissible]}' size='12'></td></tr>"             
             // ."<tr><td width=150 align='center' class='STYLE1'>不可脱（名称）</td>"
             // ."<td><input name='unomissible' type='text' id='unomissible' value='{$row[unomissible]}' size='12'></td></tr>"             
             // ."<tr><td width=150 align='center' class='STYLE1'>任意名</td>"
             // ."<td><input name='random_name' type='text' id='random_name' value='{$row[random_name]}' size='12'></td></tr>"             
            //  ."<tr><td width=150 align='center' class='STYLE1'>主营/类别</td>"
            //  ."<td><input name='main_work' type='text' id='main_work' value='{$row[main_work]}' size='12'></td></tr>"
            //  ."<tr><td width=150 align='center' class='STYLE1'>单位属性</td>"
            //  ."<td><input name='attribute' type='text' id='attribute' value='{$row[attribute]}' size='12'></td></tr>"
            //  ."<tr><td width=150 align='center' class='STYLE1'>分支机构</td>" 
            //  ."<td><input name='branch' type='text' id='branch' value='{$row[branch]}' size='12'></td></tr>"
            //  ."<tr><td width=150 align='center' class='STYLE1'>修饰字符</td>"
            //  ."<td><input name='adjective' type='text' id='adjective' value='{$row[adjective]}' size='12'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>原地址（不修改）</td>"
              ."<td><input name='address' type='text' id='address' value='{$row[address]}' readonly size='30'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>区</td>"
              ."<td><input name='district' type='text' id='district' value='{$row[district]}'  size='10'></td></tr>"
            //  ."<tr><td width=150 align='center' class='STYLE1'>街道</td>"
            //  ."<td><input name='street' type='text' id='street' value='{$row[street]}' size='20'></td></tr>"
           //   ."<tr><td width=150 align='center' class='STYLE1'>路</td>"
           //   ."<td><input name='road' type='text' id='road' value='{$row[road]}' size='10'></td></tr>"
           //   ."<tr><td width=150 align='center' class='STYLE1'>号</td>"
           //   ."<td><input name='number' type='text' id='number' value='{$row[number]}' size='10'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>大厦/工业区/花园</td>"
              ."<td><input name='edifice' type='text' id='edifice' value='{$row[edifice]}' size='16'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>剩余地址</td>"
              ."<td><input name='floor' type='text' id='floor' value='{$row[floor]}' size='8'></td></tr>"
           //   ."<tr><td width=150 align='center' class='STYLE1'>修饰地址</td>"
           //   ."<td><input name='cell' type='text' id='cell' value='{$row[cell]}' size='8'></td></tr>"
           //   ."<tr><td width=150 align='center' class='STYLE1'>企业法人</td>"
           //   ."<td><input name='person' type='text' id='person' value='{$row[person]}' size='10'></td></tr>"
          ////    ."<tr><td width=150 align='center' class='STYLE1'>行业类别</td>"
          ////    ."<td><input name='category' type='text' id='category' value='{$row[category]}' size='25'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>主营</td>"
              ."<td><input name='business' type='text' id='business' value='{$row[business]}' size='25'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>原电话（不修改）</td>"
              ."<td><input name='telephone' type='text' id='telephone' value='{$row[telephone]}' readonly size='50'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>新电话</td>"
              ."<td><input name='new_phone' type='text' id='new_phone' value='{$row[new_phone]}' size='60' onBlur='checkInput(this.form);' ></td></tr>"
          //    ."<tr><td width=150 align='center' class='STYLE1'>企业联系人手机</td>"
           //   ."<td><input name='mobilephone' type='text' id='mobilephone' value='{$row[mobilephone]}' size='40'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>传真</td>"
              ."<td><input name='fax' type='text' id='fax' value='{$row[fax]}' size='20' onBlur='checkInput2(this.form);'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>网址</td>"
              ."<td><input name='website' type='text' id='website' value='{$row[website]}' size='20'></td></tr>"
         //     ."<tr><td width=150 align='center' class='STYLE1'>邮箱</td>"
         //     ."<td><input name='email' type='text' id='email' value='{$row[email]}' size='20'></td></tr>"
         //     ."<tr><td width=150 align='center' class='STYLE1'>发行负责人</td>"
         //     ."<td><input name='principal' type='text' id='principal' value='{$row[principal]}' size='20'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>录入人</td>"
              //. "<td align='center' class='STYLE1'><input name='editor' type='text' id='editor' value='{$_username}'readonly size='6'></td>"  
              ."<td><input name='editor' type='text' id='editor' value='{$row[editor]}' readonly size='6'></td></tr>"
              ."<tr><td width=150 align='center' class='STYLE1'>录入日期</td>"
              ."<td><input name='edittime' type='text' id='edittime' value='{$row[edittime]}' readonly size='20'></td></tr>"
              . "<tr><td width=150 align='center' class='STYLE1'>提交</td><td align='left'><input type='image' name='imageField' src='images/bg1.jpg'></td></tr>"
              ."</form>"
              ."</table>" ;            
}
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
	
	'name', 
	'fullname',
	'omissible',
	'unomissible',
	'random_name',
	'main_work',
	'attribute',
	'adjective',
	'address',
	'district',
	'street',
	'road', 
	'number',
	'edifice', 
	'floor',
	'cell', 
	'telephone', 
	'new_phone',
	'mobilephone',
	'linkman',
	'category',
	'business',
	'fax',
	'website',
	'email',
	'principal',
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
						array_push($fieldFrameArray, "`{$fieldValue}` LIKE '%{$value}%'");
				}
				else
					array_push($fieldFrameArray, "`{$fieldValue}` LIKE '%{$value}%'");
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
				array_push($queryWhereArray, "`{$fieldValue}` LIKE '%{$value}%'");
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
			array_push($queryWhereArray, "`{$onlyField}` LIKE '%{$value}%'");
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
			array_push($queryWhereArray, "`{$onlyField}` LIKE '%{$value}%'");
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
			array_push($queryWhereArray, "`{$onlyField}` LIKE '%{$value}%'");
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;

	// 默认查找全部
	default:
		$sqlWhere = '';
}

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `china_szpage` {$sqlWhere}";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// 分页字符串
$pageation = "共{$row['PageNum']}条数据 " . index_page($row['PageNum'], $linksize, $pagesize);

//取当前页数据
$pageball = intval($__GET['page']);
$offset = $pagesize*($pageball - 1);

$query1 ="SELECT * FROM `china_szpage` {$sqlWhere} ORDER BY name ASC,ID ASC LIMIT $offset,$pagesize";
$result = mysql_query($query1);

$content ="";					
$content .="<table  height=264 border=0 cellpadding=0 cellspacing=0 >"
         ."<tr>"
	       ."<td  height=2>&nbsp;</td>"
	       ."<td >&nbsp;</td>"
	       ."<td >&nbsp;</td>"
	       ."</tr>"
	       ."<tr>"
	       ."<td height=125>&nbsp;</td>"
	       ."<td align='left' valign='top'><table  border=1 cellpadding=0 cellspacing=0>"
		     ."<tr>"
		     ."<td width=150 align='center' class='STYLE1'>ID</td>"
		     //."<td width=150 align='center' class='STYLE1'>编码</td>"
	       ."<td width=150 height=25 align='center' class='STYLE1'>发行备注</td>"//原来为大厦类型
	       ."<td width=120 align='center' class='STYLE1'>信息编码</td>"
	       ."<td width=180 align='center' class='STYLE1'>原发行名称</td>"//公司原完整名称
	      // ."<td width=180 align='center' class='STYLE1'>完整发行名称</td>"//新增
	      // ."<td width=150 align='center' class='STYLE1'>可脱（名称）</td>"//新增 omissible 
	      // ."<td width=150 align='center' class='STYLE1'>不可脱（名称）</td>"//新增 unomissible
	     //  ."<td width=150 align='center' class='STYLE1'>任意名</td>"//新增 random_name 
	     //  ."<td width=150 align='center' class='STYLE1'>主营/类别</td>"//新增 main_work
	     //  ."<td width=150 align='center' class='STYLE1'>单位属性</td>"//新增 attribute
	     //  ."<td width=150 align='center' class='STYLE1'>分支机构</td>"//新增 branch
	     //  ."<td width=150 align='center' class='STYLE1'>修饰字符</td>"//新增 adjective
	       ."<td width=200 align='center' class='STYLE1'>原地址</td>"
	     //  ."<td width=50 align='center' class='STYLE1'>区</td>"//原为路
	    //   ."<td width=50 align='center' class='STYLE1'>街道</td>"//新增
	     //  ."<td width=50 align='center' class='STYLE1'>路</td>"//新增
	     //  ."<td width=50 align='center' class='STYLE1'>号</td>"//新增
	       ."<td width=150 align='center' class='STYLE1'>大厦/工业区/花园</td>"
	       ."<td width=50 align='center' class='STYLE1'>剩余地址</td>"//原为栋、层
	    //   ."<td width=50 align='center' class='STYLE1'>修饰地址</td>"
	     //  ."<td width=150 align='center'><span class='STYLE1'>企业联系人</span></td>"  
	       //."<td width=150 height=25 align='center' class='STYLE1'>行政区域</td>"   
	   //    ."<td width=150 height=25 align='center' class='STYLE1'>行业类别</td>" 
	       ."<td width=150 height=25 align='center' class='STYLE1'>主营</td>"
	       ."<td width=150 align='center' class='STYLE1'>原电话</td>" 
	       ."<td width=150 align='center' class='STYLE1'>新电话</td>" 
	    //   ."<td width=150 align='center' class='STYLE1'>企业联系人手机</td>" 
	       ."<td width=50 height=25 align='center' class='STYLE1'>传真</td>" 
	       ."<td width=150 height=25 align='center' class='STYLE1'>网址</td>" 
	    //   ."<td width=150 height=25 align='center' class='STYLE1'>邮箱</td>" 
	    //   ."<td width=150 height=25 align='center' class='STYLE1'>发行负责人</td>" 
	       ."<td width=50 height=25 align='center' class='STYLE1'>录入人</td>" 
	       ."<td width=150 height=25 align='center' class='STYLE1'>录入日期</td>" 
	      // ."<td width=150 height=25 align='center' class='STYLE1'>派送物品</td>" 	       
	       ."<td width=80 align='center'></td>"
	       ."</tr>";					
	       
if($result)
{
	
while ($row = mysql_fetch_assoc($result))
{
	$content .= "<form name=form1 method=post action='index_update.php?lmbs={$row[id]}'"
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
    //  . "<td align='center' class='STYLE1'><input name='pid' type='text' id='pid' value='{$row[pid]}' readonly size='6'></td>"
      . "<td align='center' class='STYLE1'><input name='remark' type='text' id='remark' value='{$row[remark]}' size='10'></td>"
      . "<td align='center' class='STYLE1'><input name='info_code' type='text' id='info_code' value='{$row[info_code]}' readonly size='8'></td>"
      . "<td align='center' class='STYLE1'><input name='name' type='text' id='name' value='{$row[name]}' readonly size='30'></td>"
    //  . "<td align='center' class='STYLE1'><input name='fullname' type='text' id='fullname' value='{$row[fullname]}' size='30'></td>"
    //  . "<td align='center' class='STYLE1'><input name='omissible' type='text' id='omissible' value='{$row[omissible]}' size='12'></td>"//新增
    //  . "<td align='center' class='STYLE1'><input name='unomissible' type='text' id='unomissible' value='{$row[unomissible]}' size='12'></td>"//新增
    //  . "<td align='center' class='STYLE1'><input name='random_name' type='text' id='random_name' value='{$row[random_name]}' size='12'></td>"//新增
    //  . "<td align='center' class='STYLE1'><input name='main_work' type='text' id='main_work' value='{$row[main_work]}' size='12'></td>"//新增
    //  . "<td align='center' class='STYLE1'><input name='attribute' type='text' id='attribute' value='{$row[attribute]}' size='12'></td>"//新增
    //  . "<td align='center' class='STYLE1'><input name='branch' type='text' id='branch' value='{$row[branch]}' size='12'></td>"//新增
    //  . "<td align='center' class='STYLE1'><input name='adjective' type='text' id='adjective' value='{$row[adjective]}' size='12'></td>"//新增
      . "<td align='center' class='STYLE1'><input name='address' type='text' id='address' value='{$row[address]}' readonly size='30'></td>"
   //   . "<td align='center' class='STYLE1'><input name='district' type='text' id='district' value='{$row[district]}' size='10'></td>"
   //   . "<td align='center' class='STYLE1'><input name='street' type='text' id='street' value='{$row[street]}' size='10'></td>"
    //  . "<td align='center' class='STYLE1'><input name='road' type='text' id='points' value='{$row[road]}' size='10'></td>"
    //  . "<td align='center' class='STYLE1'><input name='number' type='text' id='number' value='{$row[number]}' size='10'></td>"
      . "<td align='center' class='STYLE1'><input name='edifice' type='text' id='edifice' value='{$row[edifice]}' size='16'></td>"
      . "<td align='center' class='STYLE1'><input name='floor' type='text' id='floor' value='{$row[floor]}' size='8'></td>"
    //  . "<td align='center' class='STYLE1'><input name='cell' type='text' id='cell' value='{$row[cell]}' size='8'></td>"   
    //  . "<td align='center' class='STYLE1'><input name='linkman' type='text' id='linkman' value='{$row[linkman]}' size='10'></td>"   
     // . "<td align='center' class='STYLE1'><input name='area' type='text' id='area' value='{$row[area]}' size='12'></td>"  
    //  . "<td align='center' class='STYLE1'><input name='category' type='text' id='category' value='{$row[category]}' size='25'></td>"  
      . "<td align='center' class='STYLE1'><input name='business' type='text' id='business' value='{$row[business]}' size='25'></td>"  
      . "<td align='center' class='STYLE1'><input name='telephone' type='text' id='telephone' value='{$row[telephone]}' readonly size='30'></td>"
      . "<td align='center' class='STYLE1'><input name='new_phone' type='text' id='new_phone' value='{$row[new_phone]}' size='30'></td>"
   //   . "<td align='center' class='STYLE1'><input name='mobilephone' type='text' id='mobilephone' value='{$row[mobilephone]}' size='30'></td>"
      . "<td align='center' class='STYLE1'><input name='fax' type='text' id='fax' value='{$row[fax]}' size='20'></td>"  
      . "<td align='center' class='STYLE1'><input name='website' type='text' id='website' value='{$row[website]}' size='20'></td>"  
    //  . "<td align='center' class='STYLE1'><input name='email' type='text' id='email' value='{$row[email]}' size='20'></td>"  
   //   . "<td align='center' class='STYLE1'><input name='principal' type='text' id='principal' value='{$row[principal]}' size='10'></td>"  
      . "<td align='center' class='STYLE1'><input name='editor' type='text' id='editor' value='{$row[editor]}'readonly size='6'></td>"  
      . "<td align='center' class='STYLE1'><input name='edittime' type='text' id='edittime' value='{$row[edittime]}' size='20'></td>"  
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
	  <option value="pid">编号</option>
	  <option value="name">公司名称</option>    
	  <option value="edifice">大厦名称</option>    
	  <option value="id">ID</option>                   
    </select></td>
  <td >关键词:</td>
  <td> <input name="searchterm" type="text"></td>
  <td> <input name="sousuo" type="submit" value="搜索"></td>    
</tr>
</table>
</form>

<!-- 点击查询id的记录及分页 -->
<table id="results" width="100%">
<tr><td align="left">
<?php echo $content_id ?>
<td><tr>
</table>

<!-- 总表的记录及分页 -->
<table align=left id="results" width="100%">
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
