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
<title>160餐饮数据纠错数据质检和编辑系统</title>
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
	if(!radio_value("reason")){
		alert("备注信息未填！") ;
		return false ;
	}else{
		if(radio_value("reason") == "已核对"){
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
	if(!ched('reason')){
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

  <!--
    <td width="120"><a href="/mine/telecom_rework_restaurant _update">餐饮数据修改</a></td>
    <td width="120"><a href="/mine/telecom_rework_restaurant _insert">餐饮数据插入</a></td>-->
    <h5><font color = red>说明：备注选择为“已核对”，加星号的必须都填好才能提交数据；备注选择为其他类型，则不填也可提交</font></h5>
   
 
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

if ($__GET['changeid'])//点击关键词
{
 $changeid = isset($__GET['changeid']) ? trim($__GET['changeid']) : '';
 $whereString = " WHERE `changeid` LIKE '{$changeid}'";
 $query = "SELECT * FROM `telecom_rework_restaurant` {$whereString}";
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
  
 	$reason = stripslashes($row['reason']);
	$fullname = stripslashes($row['fullname']);
	$consumename = stripslashes($row['consumename']);
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
 $content_id .= "<table align='center' width=98% border='1'>"
              ."<form name='form1' id='myform' method='post'  onsubmit='return ck()'  action='index_update.php?lmbs={$row[changeid]}'>"
              ."<tr><td width=15% align='center' class='STYLE1'>changeID</td>"
              ."<td width=53%><input name='changeid' type='text' id='changeid' value='{$row[changeid]}' readonly size='10'></td>

              <td></td></tr>"
             
              ."<tr><td width=15% align='center' class='STYLE1'>全名（*）</td>"
              ."<td><input name='fullname' type='text' id='fullname' value='{$row[fullname]}' size='50'></td><td></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>消费名（*）</td>"
              ."<td><input name='consumename' type='text' id='consumename' value='{$row[consumename]}' size='50'></td><td></td></tr>"                   
              ."<tr><td width=15% align='center' class='STYLE1'>电话号码（*）</td>"
              ."<td><input name='telephone' type='text' id='telephone' value='{$row[telephone]}' size='50'></td>
              <td><font size = 2>【示例】88450123；36589999-8122</font></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>地址（*）</td>"
              ."<td><input name='address' type='text' id='address' value='{$row[address]}'  size='50'></td><td></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>区（*）</td>"
              //."<td><input name='district' type='text' id='district' value='{$row[district]}'  size='10'></td><td></td></tr>"
              ."<td colspan=2>
<input type='radio' name='district'".($row['district'] == '福田区' ? 'checked="checked"' : '')."  value = '福田区'>福田区
<input type='radio' name='district'".($row['district'] == '南山区' ? 'checked="checked"' : '')."  value = '南山区'>南山区
<input type='radio' name='district'".($row['district'] == '罗湖区' ? 'checked="checked"' : '')."  value = '罗湖区'>罗湖区
<input type='radio' name='district'".($row['district'] == '盐田区' ? 'checked="checked"' : '')."  value = '盐田区'>盐田区
<input type='radio' name='district'".($row['district'] == '龙岗区' ? 'checked="checked"' : '')."  value = '龙岗区'>龙岗区
<input type='radio' name='district'".($row['district'] == '宝安区' ? 'checked="checked"' : '')."  value = '宝安区'>宝安区
<input type='radio' name='district'".($row['district'] == '光明新区' ? 'checked="checked"' : '')."  value = '光明新区'>光明新区             
              </td>"
              ."<tr><td width=15% align='center' class='STYLE1'>路</td>"
              ."<td><input name='road' type='text' id='road' value='{$row[road]}' size='10'></td><td></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>门牌</td>"
              ."<td><input name='doorplate' type='text' id='doorplate' value='{$row[doorplate]}' size='10'></td><td></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>大厦/花园/小区</td>"
              ."<td><input name='edifice' type='text' id='edifice' value='{$row[edifice]}' size='30'></td><td></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>剩余地址</td>"
              ."<td><input name='floor' type='text' id='floor' value='{$row[floor]}' size='30'></td><td></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>乘车路线</td>"
              ."<td><input name='busline' type='text' id='busline' value='{$row[busline]}' size='30'></td><td></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>企业介绍</td>"
              ."<td colspan=2><input name='introduction' type='text' id='introduction' value='{$row[introduction]}' size='120'></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>营业时间（*）</td>"
              ."<td><input name='businesshours' type='text' id='businesshours' value='{$row[businesshours]}' size='65'></td>
              <td><font size = 2>【示例】
<br>例1：08:30-19:00；周日：09:00-20:30
<br>例2：上午：09：00-11：45；下午：13：30-18：00；夜间：19：30-23：00
<br>例3：周一休息；周三上午不营业；黄金周期间：08：00-22：00
</font></td></tr>"
              ."<tr><td  align='center' class='STYLE1'>主题词（*）</td>"
              //."<td><input name='theme' type='text' id='theme' value='{$row[theme]}' size='30'></td>
              ."<td colspan = 2>

<input type='checkbox' id='theme' name='theme[]'".(in_array("茶楼",$theme_array) ? 'checked="checked"' : '')."  value = '茶楼'>茶楼
<input type='checkbox' id='theme' name='theme[]'".(in_array("烧烤店",$theme_array) ? 'checked="checked"' : '')."  value = '烧烤店'>烧烤店           
<input type='checkbox' id='theme' name='theme[]'".(in_array("火锅店",$theme_array) ? 'checked="checked"' : '')."  value = '火锅店'>火锅店
<input type='checkbox' id='theme' name='theme[]'".(in_array("快餐店",$theme_array) ? 'checked="checked"' : '')."  value = '快餐店'>快餐店          
<input type='checkbox' id='theme' name='theme[]'".(in_array("小吃店",$theme_array) ? 'checked="checked"' : '')."  value = '小吃店'>小吃店
<input type='checkbox' id='theme' name='theme[]'".(in_array("煲汤店",$theme_array) ? 'checked="checked"' : '')."  value = '煲汤店'>煲汤店           
<input type='checkbox' id='theme' name='theme[]'".(in_array("饭店酒家",$theme_array) ? 'checked="checked"' : '')."  value = '饭店酒家'>饭店酒家
<input type='checkbox' id='theme' name='theme[]'".(in_array("自助餐厅",$theme_array) ? 'checked="checked"' : '')."  value = '自助餐厅'>自助餐厅<br>          

<input type='checkbox' id='theme' name='theme[]'".(in_array("排档",$theme_array) ? 'checked="checked"' : '')."  value = '排档'>排档           

<input type='checkbox' id='theme' name='theme[]'".(in_array("咖啡馆",$theme_array) ? 'checked="checked"' : '')."  value = '咖啡馆'>咖啡馆
<input type='checkbox' id='theme' name='theme[]'".(in_array("凉茶店",$theme_array) ? 'checked="checked"' : '')."  value = '凉茶店'>凉茶店           
<input type='checkbox' id='theme' name='theme[]'".(in_array("奶茶铺",$theme_array) ? 'checked="checked"' : '')."  value = '奶茶铺'>奶茶铺
<input type='checkbox' id='theme' name='theme[]'".(in_array("甜品店",$theme_array) ? 'checked="checked"' : '')."  value = '甜品店'>甜品店           
<input type='checkbox' id='theme' name='theme[]'".(in_array("冷饮店",$theme_array) ? 'checked="checked"' : '')."  value = '冷饮店'>冷饮店
<input type='checkbox' id='theme' name='theme[]'".(in_array("美食广场",$theme_array) ? 'checked="checked"' : '')."  value = '美食广场'>美食广场                        

<input type='checkbox' id='theme' name='theme[]'".(in_array("西饼面包房",$theme_array) ? 'checked="checked"' : '')."  value = '西饼面包房'>西饼面包房
<input type='checkbox' id='theme' name='theme[]'".(in_array("其他餐饮服务",$theme_array) ? 'checked="checked"' : '')."  value = '其他餐饮服务'>其他餐饮服务

              </td>
              </tr>"
             // ."<tr><td width=15% align='center' class='STYLE1'>行业分类</td>"
             // ."<td><input name='category' type='text' id='category' value='{$row[category]}' size='30'></td><td></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1' >数据更新种类（*）</td>"
              //."<td><input name='changetype' type='text' id='changetype' value='{$row[changetype]}' size='30'></td>
              ."<td colspan = 2>
<input type='checkbox' id='changetype' name='changetype[]'".(in_array("无变化",$changetype_array) ? 'checked="checked"' : '')."  value = '无变化'>无变化              
<input type='checkbox' id='changetype' name='changetype[]'".(in_array("电话停机",$changetype_array) ? 'checked="checked"' : '')."  value = '电话停机'>电话停机
<input type='checkbox' id='changetype' name='changetype[]'".(in_array("电话空号",$changetype_array) ? 'checked="checked"' : '')."  value = '电话空号'>电话空号
<input type='checkbox' id='changetype' name='changetype[]'".(in_array("电话变更",$changetype_array) ? 'checked="checked"' : '')."  value = '电话变更'>电话变更
<input type='checkbox' id='changetype' name='changetype[]'".(in_array("名称变更",$changetype_array) ? 'checked="checked"' : '')."  value = '名称变更'>名称变更
<input type='checkbox' id='changetype' name='changetype[]'".(in_array("地址变更",$changetype_array) ? 'checked="checked"' : '')."  value = '地址变更'>地址变更            
              </td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>消费信息</td>"
              ."<td><input name='information' type='text' id='information' value='{$row[information]}' size='65'></td>
              <td><font size = 2>【示例】<br>
最低消费：80元/人；人均消费：100元/人；分档消费：200-400元，500-800元，800元以上</font>
</td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>用餐类型（*）</td>"
              //."<td><input name='foodkind' type='text' id='foodkind' value='{$row[foodkind]}' size='30'>
              ."<td>
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("会议接待",$foodkind_array) ? 'checked="checked"' : '')."  value = '会议接待'>会议接待            
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("商务宴请",$foodkind_array) ? 'checked="checked"' : '')."  value = '商务宴请'>商务宴请
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("商务套餐",$foodkind_array) ? 'checked="checked"' : '')."  value = '普通套餐'>普通套餐
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("普通套餐",$foodkind_array) ? 'checked="checked"' : '')."  value = '会议接待'>会议接待
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("喜庆宴请",$foodkind_array) ? 'checked="checked"' : '')."  value = '喜庆宴请'>喜庆宴请<br>
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("朋友聚会",$foodkind_array) ? 'checked="checked"' : '')."  value = '朋友聚会'>朋友聚会
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("家庭聚餐",$foodkind_array) ? 'checked="checked"' : '')."  value = '家庭聚餐'>家庭聚餐
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("情侣约会",$foodkind_array) ? 'checked="checked"' : '')."  value = '情侣约会'>情侣约会
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("个人用餐",$foodkind_array) ? 'checked="checked"' : '')."  value = '个人用餐'>个人用餐
<input type='checkbox' id='foodkind' name='foodkind[]'".(in_array("其他用餐",$foodkind_array) ? 'checked="checked"' : '')."  value = '其他用餐'>其他用餐

              </td>
              <td></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>信用卡（*）</td>"
              //."<td><input name='creditcard' type='text' id='creditcard' value='{$row[creditcard]}' size='30'></td>
              ."<td>
<input type='checkbox' name='creditcard[]' id='creditcard'".(in_array("银联",$creditcard_array) ? 'checked="checked"' : '')." value='银联'>银联
<input type='checkbox' name='creditcard[]' id='creditcard'".(in_array("VISA",$creditcard_array) ? 'checked="checked"' : '')." value='VISA'>VISA
<input type='checkbox' name='creditcard[]' id='creditcard'".(in_array("万事达",$creditcard_array) ? 'checked="checked"' : '')." value='万事达'>万事达
<input type='checkbox' name='creditcard[]' id='creditcard'".(in_array("无",$creditcard_array) ? 'checked="checked"' : '')." value='无'>无
              </td>
              <td></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>客容量</td>"
              ."<td><input name='capacity' type='text' id='capacity' value='{$row[capacity]}' size='65'></td>
              <td><font size = 2>【规则】用阿拉伯数字+人表示</font></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>包间数</td>"
              ."<td><input name='roomamount' type='text' id='roomamount' value='{$row[roomamount]}' size='65'></td>
              <td><font size = 2>【示例】西安饭庄：大包间：3间；中包间：20间；小包间：5间</font></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>招牌菜</td>"
              ."<td><input name='signfood' type='text' id='signfood' value='{$row[signfood]}' size='65'></td>
              <td><font size = 2>【示例】西湖醋鱼；叫化鸡；东坡肉；宋嫂鱼羹</font></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1' >菜系</td>"
              ."<td colspan = 2>
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("粤菜",$foodtype_array) ? 'checked="checked"' : '')." value='粤菜'>粤菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("闽菜",$foodtype_array) ? 'checked="checked"' : '')." value='闽菜'>闽菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("琼菜",$foodtype_array) ? 'checked="checked"' : '')." value='琼菜'>琼菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("客家菜",$foodtype_array) ? 'checked="checked"' : '')." value='客家菜'>客家菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("潮州菜",$foodtype_array) ? 'checked="checked"' : '')." value='潮州菜'>潮州菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("香港菜",$foodtype_array) ? 'checked="checked"' : '')." value='香港菜'>香港菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("澳门菜",$foodtype_array) ? 'checked="checked"' : '')." value='澳门菜'>澳门菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("台湾菜",$foodtype_array) ? 'checked="checked"' : '')." value='台湾菜'>台湾菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("广西菜",$foodtype_array) ? 'checked="checked"' : '')." value='广西菜'>广西菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("上海菜",$foodtype_array) ? 'checked="checked"' : '')." value='上海菜'>上海菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("河南菜",$foodtype_array) ? 'checked="checked"' : '')." value='河南菜'>河南菜 <br>

<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("苏菜",$foodtype_array) ? 'checked="checked"' : '')." value='苏菜'>苏菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("浙菜",$foodtype_array) ? 'checked="checked"' : '')." value='浙菜'>浙菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("鲁菜",$foodtype_array) ? 'checked="checked"' : '')." value='鲁菜'>鲁菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("东北菜",$foodtype_array) ? 'checked="checked"' : '')." value='东北菜'>东北菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("北京菜",$foodtype_array) ? 'checked="checked"' : '')." value='北京菜'>北京菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("山西菜",$foodtype_array) ? 'checked="checked"' : '')." value='山西菜'>山西菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("天津菜",$foodtype_array) ? 'checked="checked"' : '')." value='天津菜'>天津菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("河北菜",$foodtype_array) ? 'checked="checked"' : '')." value='河北菜'>河北菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("陕西菜",$foodtype_array) ? 'checked="checked"' : '')." value='陕西菜'>陕西菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("陕北菜",$foodtype_array) ? 'checked="checked"' : '')." value='陕北菜'>陕北菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("甘肃菜",$foodtype_array) ? 'checked="checked"' : '')." value='甘肃菜'>甘肃菜   <br>

<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("徽菜",$foodtype_array) ? 'checked="checked"' : '')." value='徽菜'>徽菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("川菜",$foodtype_array) ? 'checked="checked"' : '')." value='川菜'>川菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("湘菜",$foodtype_array) ? 'checked="checked"' : '')." value='湘菜'>湘菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("湖北菜",$foodtype_array) ? 'checked="checked"' : '')." value='湖北菜'>湖北菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("云贵菜",$foodtype_array) ? 'checked="checked"' : '')." value='云贵菜'>云贵菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("江西菜",$foodtype_array) ? 'checked="checked"' : '')." value='江西菜'>江西菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("西北菜",$foodtype_array) ? 'checked="checked"' : '')." value='西北菜'>西北菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("青海菜",$foodtype_array) ? 'checked="checked"' : '')." value='青海菜'>青海菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("宁夏菜",$foodtype_array) ? 'checked="checked"' : '')." value='宁夏菜'>宁夏菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("新疆菜",$foodtype_array) ? 'checked="checked"' : '')." value='新疆菜'>新疆菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("西藏菜",$foodtype_array) ? 'checked="checked"' : '')." value='西藏菜'>西藏菜<br>
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("内蒙古菜",$foodtype_array) ? 'checked="checked"' : '')." value='内蒙古菜'>内蒙古菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("傣家菜",$foodtype_array) ? 'checked="checked"' : '')." value='傣家菜'>傣家菜<br>

<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("法式菜",$foodtype_array) ? 'checked="checked"' : '')." value='法式菜'>法式菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("英式菜",$foodtype_array) ? 'checked="checked"' : '')." value='英式菜'>英式菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("意式菜",$foodtype_array) ? 'checked="checked"' : '')." value='意式菜'>意式菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("俄式菜",$foodtype_array) ? 'checked="checked"' : '')." value='俄式菜'>俄式菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("美式菜",$foodtype_array) ? 'checked="checked"' : '')." value='美式菜'>美式菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("奥地利菜",$foodtype_array) ? 'checked="checked"' : '')." value='奥地利菜'>奥地利菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("匈牙利菜",$foodtype_array) ? 'checked="checked"' : '')." value='匈牙利菜'>匈牙利菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("爱尔兰菜",$foodtype_array) ? 'checked="checked"' : '')." value='爱尔兰菜'>爱尔兰菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("保加利亚菜",$foodtype_array) ? 'checked="checked"' : '')." value='保加利亚菜'>保加利亚菜<br>


<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("德式菜",$foodtype_array) ? 'checked="checked"' : '')." value='德式菜'>德式菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("挪威菜",$foodtype_array) ? 'checked="checked"' : '')." value='挪威菜'>挪威菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("丹麦菜",$foodtype_array) ? 'checked="checked"' : '')." value='丹麦菜'>丹麦菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("芬兰菜",$foodtype_array) ? 'checked="checked"' : '')." value='芬兰菜'>芬兰菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("瑞典菜",$foodtype_array) ? 'checked="checked"' : '')." value='瑞典菜'>瑞典菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("葡萄牙菜",$foodtype_array) ? 'checked="checked"' : '')." value='葡萄牙菜'>葡萄牙菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("西班牙菜",$foodtype_array) ? 'checked="checked"' : '')." value='西班牙菜'>西班牙菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("土耳其菜",$foodtype_array) ? 'checked="checked"' : '')." value='土耳其菜'>土耳其菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("罗马尼亚菜",$foodtype_array) ? 'checked="checked"' : '')." value='罗马尼亚菜'>罗马尼亚菜   <br>

<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("波兰菜",$foodtype_array) ? 'checked="checked"' : '')." value='波兰菜'>波兰菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("希腊菜",$foodtype_array) ? 'checked="checked"' : '')." value='希腊菜'>希腊菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("拉丁菜",$foodtype_array) ? 'checked="checked"' : '')." value='拉丁菜'>拉丁菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("澳洲菜",$foodtype_array) ? 'checked="checked"' : '')." value='澳洲菜'>澳洲菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("非洲菜",$foodtype_array) ? 'checked="checked"' : '')." value='非洲菜'>非洲菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("新加坡菜",$foodtype_array) ? 'checked="checked"' : '')." value='新加坡菜'>新加坡菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("日本料理",$foodtype_array) ? 'checked="checked"' : '')." value='日本料理'>日本料理
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("韩国料理",$foodtype_array) ? 'checked="checked"' : '')." value='韩国料理'>韩国料理
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("马来西亚菜",$foodtype_array) ? 'checked="checked"' : '')." value='马来西亚菜'>马来西亚菜<br>

<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("埃及菜",$foodtype_array) ? 'checked="checked"' : '')." value='埃及菜'>埃及菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("泰国菜",$foodtype_array) ? 'checked="checked"' : '')." value='泰国菜'>泰国菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("印度菜",$foodtype_array) ? 'checked="checked"' : '')." value='印度菜'>印度菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("越南菜",$foodtype_array) ? 'checked="checked"' : '')." value='越南菜'>越南菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("中东菜",$foodtype_array) ? 'checked="checked"' : '')." value='中东菜'>中东菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("墨西哥菜",$foodtype_array) ? 'checked="checked"' : '')." value='墨西哥菜'>墨西哥菜
<input type='checkbox' name='foodtype[]' id='foodtype'".(in_array("叙利亚菜",$foodtype_array) ? 'checked="checked"' : '')." value='叙利亚菜'>叙利亚菜

              </td>
              </tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>风味</td>"
              //."<td><input name='flavor' type='text' id='flavor' value='{$row[flavor]}' size='30'></td>
              ."<td colspan = 2>
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("野味菜肴",$flavor_array) ? 'checked="checked"' : '')." value='野味菜肴'>野味菜肴
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("海鲜菜肴",$flavor_array) ? 'checked="checked"' : '')." value='海鲜菜肴'>海鲜菜肴
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("茶餐",$flavor_array) ? 'checked="checked"' : '')." value='茶餐'>茶餐
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("河鲜",$flavor_array) ? 'checked="checked"' : '')." value='河鲜'>河鲜
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("牛排",$flavor_array) ? 'checked="checked"' : '')." value='牛排'>牛排
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("御膳",$flavor_array) ? 'checked="checked"' : '')." value='御膳'>御膳
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("药膳",$flavor_array) ? 'checked="checked"' : '')." value='药膳'>药膳
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("清真菜",$flavor_array) ? 'checked="checked"' : '')." value='清真菜'>清真菜
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("家常菜",$flavor_array) ? 'checked="checked"' : '')." value='家常菜'>家常菜
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("私房菜",$flavor_array) ? 'checked="checked"' : '')." value='私房菜'>私房菜<br>

<input type='checkbox' name='flavor[]' id='flavor'".(in_array("鸡味佳肴",$flavor_array) ? 'checked="checked"' : '')." value='鸡味佳肴'>鸡味佳肴
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("鸭味佳肴",$flavor_array) ? 'checked="checked"' : '')." value='鸭味佳肴'>鸭味佳肴
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("蔬食",$flavor_array) ? 'checked="checked"' : '')." value='蔬食'>蔬食
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("比萨",$flavor_array) ? 'checked="checked"' : '')." value='比萨'>比萨
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("麻辣",$flavor_array) ? 'checked="checked"' : '')." value='麻辣'>麻辣
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("粥店",$flavor_array) ? 'checked="checked"' : '')." value='粥店'>粥店
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("面馆",$flavor_array) ? 'checked="checked"' : '')." value='面馆'>面馆
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("包子铺",$flavor_array) ? 'checked="checked"' : '')." value='包子铺'>包子铺
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("饺子馆",$flavor_array) ? 'checked="checked"' : '')." value='饺子馆'>饺子馆
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("馄饨店",$flavor_array) ? 'checked="checked"' : '')." value='馄饨店'>馄饨店
<input type='checkbox' name='flavor[]' id='flavor'".(in_array("豆花店",$flavor_array) ? 'checked="checked"' : '')." value='豆花店'>豆花店
              </td>
              </tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>外送服务</td>"
              ."<td><input name='togo' type='text' id='togo' value='{$row[togo]}' size='65'></td>
              <td><font size = 2>【示例】 <br>外送时间段：12：00-22：00；外送范围：三环以内；最低金额：25元；外送服务费：5元/公里。</font></td></tr>"

              ."<tr><td width=15% align='center' class='STYLE1'>停车位</td>"
              ."<td><input name='parking' type='text' id='parking' value='{$row[parking]}' size='20'></td>
              <td><font size = 2>【示例】<br>有,5元/小时|有,6元/次|无|有,5元/小时</font></td></tr>"
              
              ."<tr><td width=15% align='center' class='STYLE1'>录入人</td>"
              //. "<td align='center' class='STYLE1'><input name='editor' type='text' id='editor' value='{$_username}'readonly size='6'></td>"
              ."<td><input name='editor' type='text' id='editor' value='{$row[editor]}' readonly size='20'></td><td><font size = 2>不用手工录入，登录后会自动生成</font></td></tr>"
              ."<tr><td width=15% align='center' class='STYLE1'>录入日期</td>"
              ."<td><input name='edittime' type='text' id='edittime' value='{$row[edittime]}' readonly size='20'></td><td><font size = 2>不用手工录入，登录后会自动生成</font></td></tr>"
              . "<tr><td width=15% align='center' class='STYLE1'>提交</td><td align='left'><input type='image' name='imageField' src='images/bg1.jpg'></td><td></td></tr>"
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
  'changeid',
	'reason',

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
	case "fullname"://////////////////////////////////////////////////////////////////////////////////////
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

	case "changeid":
		$onlyField = $searchMethod;
		// 用来存储SQL语句数组
		$queryWhereArray = array();
		// 遍历去空格
		foreach ($teamArray as $value)
		{
			//array_push($queryWhereArray, "`{$onlyField}` LIKE '%{$value}%'");
			array_push($queryWhereArray, "`{$onlyField}` BETWEEN $value AND ($value+19)");
		}
		$sqlWhere = 'WHERE ' . implode(' OR ', $queryWhereArray);
		break;

	// 默认查找全部
	default:
		$sqlWhere = '';
}

$pageNumberSql = "SELECT COUNT(1) AS PageNum FROM `telecom_rework_restaurant` {$sqlWhere}";

$result = mysql_query($pageNumberSql) OR die(mysql_error() . __LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());


// 分页字符串
$pageation = "共{$row['PageNum']}条数据 " . index_page($row['PageNum'], $linksize, $pagesize);

//取当前页数据
$pageball = intval($__GET['page']);
$offset = $pagesize*($pageball - 1);

$query1 ="SELECT * FROM `telecom_rework_restaurant` {$sqlWhere} ORDER BY changeid ASC LIMIT $offset,$pagesize";
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
		     ."<tr><td></td>"
		     ."<td  align='center' class='STYLE1'>changeID</td>"
	       ."<td  height=25 align='center' class='STYLE1'>备注</td>"//原来为大厦类型
	       ."<td  align='center' class='STYLE1'>全名</td>"//公司原完整名称
	     ////  ."<td width=180 align='center' class='STYLE1'>消费名</td>"//公司原完整名称
	       ."<td  align='center' class='STYLE1'>电话号码</td>"//新增 omissible
	       ."<td  align='center' class='STYLE1'>地址</td>"//新增 unomissible
	       //// ."<td width=15% align='center' class='STYLE1'>区</td>"//新增 random_name
	      ////  ."<td width=15% align='center' class='STYLE1'>路</td>"//新增 main_work
	      ////  ."<td width=15% align='center' class='STYLE1'>门牌</td>"//新增 attribute
	      ////  ."<td width=15% align='center' class='STYLE1'>大厦/花园/小区</td>"//新增 branch
	      ////  ."<td width=15% align='center' class='STYLE1'>剩余地址</td>"//新增 adjective
	       ."<td  align='center' class='STYLE1'>乘车路线</td>"//新增 adjective
	       ."<td  align='center' class='STYLE1'>企业介绍</td>"
	       ."<td  align='center' class='STYLE1'>营业时间</td>"//原为路
	       ."<td  align='center' class='STYLE1'>主题词</td>"//新增
	      // ."<td width=50 align='center' class='STYLE1'>行业分类</td>"//新增
	       ."<td  align='center' class='STYLE1'>数据更新种类</td>"//新增
	       ."<td  align='center' class='STYLE1'>消费信息</td>"//新增
	       ."<td  align='center' class='STYLE1'>用餐类型</td>"
	       ."<td  align='center' class='STYLE1'>信用卡</td>"//原为栋、层
	       ."<td  align='center' class='STYLE1'>客容量</td>"
	       ."<td  align='center'><span class='STYLE1'>包间数</span></td>"
	       ."<td  height=25 align='center' class='STYLE1'>招牌菜</td>"
	       ."<td  height=25 align='center' class='STYLE1'>菜系</td>"
	       ."<td  height=25 align='center' class='STYLE1'>风味</td>"
	       ."<td  align='center' class='STYLE1'>外送服务</td>"
	       ."<td  align='center' class='STYLE1'>停车位</td>"
	       ."<td  height=25 align='center' class='STYLE1'>录入人</td>"
	       ."<td  height=25 align='center' class='STYLE1'>录入日期</td>"
	      //// ."<td width=80 align='center'></td>"
	       ."</tr>";

if($result)
{

while ($row = mysql_fetch_assoc($result))
{
	  $content .= "<form method=post action='quality_delete.php?lmbs={$row[changeid]}'>"
	//$content .= "<form method=post action='quality_delete.php?lmbs=".$row['changeid'].">"
      . "<tr>"
      ."<td align='center'><span>
          <input type='submit' name='Submit' onclick='javascript:if (confirm('您确定要删除吗？注意：此操作不可恢复，请谨慎操作！')){return true;} return false;' value='删除'>
        </span></td>"
     . "<td><a href='?searchtype=changeid&searchterm={$row[changeid]}&changeid={$row[changeid]}' target=_blank>{$row[changeid]}</a></td>"
      . "<td align='center' class='STYLE1'><input name='reason' type='text' id='reason' value='{$row[reason]}' size='5'></td>"
      . "<td align='center' class='STYLE1'><input name='fullname' type='text' id='fullname' value='{$row[fullname]}'  size='20'></td>"
      ////. "<td align='center' class='STYLE1'><input name='consumename' type='text' id='consumename' value='{$row[consumename]}'  size='20'></td>"
      . "<td align='center' class='STYLE1'><input name='telephone' type='text' id='telephone' value='{$row[telephone]}' readonly size='10'></td>"
      . "<td align='center' class='STYLE1'><input name='address' type='text' id='address' value='{$row[address]}' readonly size='30'></td>"
      //// . "<td align='center' class='STYLE1'><input name='district' type='text' id='district' value='{$row[district]}' size='6'></td>"
      //// . "<td align='center' class='STYLE1'><input name='road' type='text' id='points' value='{$row[road]}' size='8'></td>"
      //// . "<td align='center' class='STYLE1'><input name='doorplate' type='text' id='doorplate' value='{$row[doorplate]}' readonly size='6'></td>"
      //// . "<td align='center' class='STYLE1'><input name='edifice' type='text' id='edifice' value='{$row[edifice]}' size='12'></td>"
      //// . "<td align='center' class='STYLE1'><input name='floor' type='text' id='floor' value='{$row[floor]}' size='8'></td>"
      . "<td align='center' class='STYLE1'><input name='busline' type='text' id='busline' value='{$row[busline]}' size='8'></td>"
      . "<td align='center' class='STYLE1'><input name='introduction' type='text' id='introduction' value='{$row[introduction]}' size='20'></td>"


      . "<td align='center' class='STYLE1'><input name='businesshours' type='text' id='businesshours' value='{$row[businesshours]}' size='10'></td>"
      . "<td align='center' class='STYLE1'><input name='theme' type='text' id='theme' value='{$row[theme]}' size='8'></td>"//新增

      . "<td align='center' class='STYLE1'><input name='changetype' type='text' id='changetype' value='{$row[changetype]}' size='10'></td>"//新增

      . "<td align='center' class='STYLE1'><input name='information' type='text' id='information' value='{$row[information]}' size='16'></td>"//新增
      . "<td align='center' class='STYLE1'><input name='foodkind' type='text' id='foodkind' value='{$row[foodkind]}' size='10'></td>"//新增
      . "<td align='center' class='STYLE1'><input name='creditcard' type='text' id='creditcard' value='{$row[creditcard]}' size='5'></td>"//新增
      . "<td align='center' class='STYLE1'><input name='capacity' type='text' id='capacity' value='{$row[capacity]}' size='5'></td>"//新增
      . "<td align='center' class='STYLE1'><input name='roomamount' type='text' id='roomamount' value='{$row[roomamount]}' size='10'></td>"//新增


      . "<td align='center' class='STYLE1'><input name='signfood' type='text' id='signfood' value='{$row[signfood]}' size='10'></td>"


      . "<td align='center' class='STYLE1'><input name='foodtype' type='text' id='foodtype' value='{$row[foodtype]}' size='10'></td>"
      . "<td align='center' class='STYLE1'><input name='flavor' type='text' id='flavor' value='{$row[flavor]}' size='10'></td>"

      . "<td align='center' class='STYLE1'><input name='togo' type='text' id='togo' value='{$row[togo]}' size='10'></td>"
      . "<td align='center' class='STYLE1'><input name='parking' type='text' id='parking' value='{$row[parking]}' size='10'></td>"


      . "<td align='center' class='STYLE1'><input name='editor' type='text' id='editor' value='{$row[editor]}' readonly size='6'></td>"
      . "<td align='center' class='STYLE1'><input name='edittime' type='text' id='edittime' value='{$row[edittime]}' readonly size='20'></td>"
     //// . "<td align='center'><input type='image' name='imageField' src='images/bg1.jpg'></td>"
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
	  <option value="fullname">全称</option>
	  <option value="edifice">大厦名称</option>
	  <option value="changeid">changeID</option>
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
