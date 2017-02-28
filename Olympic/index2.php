<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160 Olympic 2008奥运搜索</title>
</head>
<body>
	
<FONT size=4 color=#ff0000>2008年北京奥运 第29届奥林匹克运动会
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<FONT size=2 color=#000000>本届奥运会共设35个大项 302块金牌，8月8日-24日在北京举行</FONT></FONT><br><br>
<font size=2>使用说明：<br>
1 前3个条件为联动－即小项要选择了大项才能出来，大项要选择了奥运年份才能出来；<br>
2 后3个条件之间相互独立并和前面的联动条件独立，可选多项或一项参加搜索。第6个为文本输入框，可搜举行时间,赛事名,场馆,运动员(只能一个词)；<br>
3 夺金点：中国参赛队员或参赛队可能会拿金牌的项目；<br>
4 每搜索完一次如果选项不能出来，请<font color=red>重新刷新页面</font>。</font><br>

<?php
	$conn=mysql_connect("localhost","admin","xxzx160168");
	mysql_select_db("phpcms");
	mysql_query('set names gbk');
?>
<script language="javascript">
	var subolympic_match_big = new Array();
	var onecount;
<?php
	$res=mysql_query("select * from olympic_match_big ORDER BY id ASC");
	$count=0;
	while ($row=mysql_fetch_assoc($res)) {
?>
  subolympic_match_big[<?=$count?>]="<?=$row[olympic_match_big]."|".$row[olympic_year]?>";
<?php
  $count++; 
}
  echo "onecount=$count;";
?>
function getolympic_match_big(pname) { //显示大项
	document.getElementById("olympic_match_big").length = 0;
	var tmp;
	for (i=0;i<onecount;i++) {
			tmp=subolympic_match_big[i].split("|");
			if (pname==tmp[1]) {
			slct=document.createElement("Option");
	    slct.value=tmp[0];
	    slct.text=tmp[0];
	    document.getElementById("olympic_match_big").add(slct);
		}
	}
} 
	var subolympic_match_small=new Array();
	var twocount;
<?php
	$resu=mysql_query("select * from olympic_match_small ORDER BY id ASC");
	$count2=0;
	while ($row2=mysql_fetch_assoc($resu)) {
?>
  subolympic_match_small[<?=$count2?>]="<?=$row2[olympic_match_small]."|".$row2[olympic_match_big]."|".$row2[olympic_year]?>";
<?php
  $count2++;
}
  echo "twocount=$count2;";
?>
function getolympic_match_small(cname) { //显示小项
	var pname;
	pname=document.getElementById("olympic_year").value;
	document.getElementById("olympic_match_small").length = 0;
	var tmp;
	for (i=0;i<twocount;i++) {
		tmp=subolympic_match_small[i].split("|");
		if (cname==tmp[1] && pname==tmp[2]) {
			slct=document.createElement("Option");
	    slct.value=tmp[0];
	    slct.text=tmp[0];
	    document.getElementById("olympic_match_small").add(slct);
		}
	}
}
</script>

<form name="form1" method="post" action="display_search_SQL.php">
	

 <select name="condition1" id="olympic_year" onChange="getolympic_match_big(this.options.value)">
<option value="">奥运年份</option>
<?php
$result=mysql_query("select * from olympic_year");
while ($rs=mysql_fetch_assoc($result)) {
?>
 <option value="<?=$rs[olympic_year]?>"><?=$rs[olympic_year]?></option>
  <?php }?>
</select>

  <select name="condition2" id="olympic_match_big" onChange="getolympic_match_small(this.options.value)">
  <option value="">比赛大项</option>
</select>

<select name="condition3" id="olympic_match_small">
<option value="">比赛小项</option>
</select>
  
  <select name="condition4">
  <option value='' selected>比赛日期</option>
  <option value='20080806'>20080806（第-2天）</option>
  <option value='20080807'>20080807（第-1天）</option>
  <option value='20080808'>20080808</option>
  <option value='20080809'>20080809（第1天）</option>
  <option value='20080810'>20080810（第2天）</option>
  <option value='20080811'>20080811（第3天）</option>
  <option value='20080812'>20080812（第4天）</option>
  <option value='20080813'>20080813（第5天）</option>
  <option value='20080814'>20080814（第6天）</option>
  <option value='20080815'>20080815（第7天）</option>
  <option value='20080816'>20080816（第8天）</option>
  <option value='20080817'>20080817（第9天）</option>
  <option value='20080818'>20080818（第10天）</option>
  <option value='20080819'>20080819（第11天）</option>
  <option value='20080820'>20080820（第12天）</option>
  <option value='20080821'>20080821（第13天）</option>
  <option value='20080822'>20080822（第14天）</option>
  <option value='20080823'>20080823（第15天）</option>
  <option value='20080824'>20080824（第16天）</option>
  </select>
  
  <select name="condition5">
  <option value='' selected></option>
  <option value='决赛'>决赛</option>
  <option value='夺金点'>夺金点</option>
  </select>

  <input type="text" name="condition6">

  <input type='submit' name='search' value='查询'>
  
</form>



<TABLE cellSpacing=0 width=766 border=1><!--DWLayoutTable-->
<TBODY>
<TR bgColor=#ffffff>
<TD colSpan=11 height=1></TD></TR>
<TR bgColor=#ffffff>
<TD vAlign=center align=middle colSpan=2 height=30><A href="/tiyu/2008/0808/article_3608.html" target=_blank>本届奥运会中国奖牌榜</A></TD>
<TD vAlign=center align=middle colSpan=3><A href="/tiyu/2008/0808/article_3607.html" target=_blank>本届奥运会各国奖牌榜</A></TD>
<TD vAlign=center align=middle colSpan=3><A href="http://172.20.1.21/tiyu/2008/0731/article_3499.html" target=_blank><FONT color=#0000ff size=3><U>中国历届奥运会奖牌榜</U></FONT></A> </TD>
<TD vAlign=center align=middle colSpan=3>&nbsp;<A href="http://172.20.1.21/tiyu/2008/0731/article_3498.html" target=_blank><FONT color=#0000ff size=3><U>历届奥运会各国奖牌榜</U></FONT></A> </TD></TR>

<TR bgColor=#ffffff>
<TD colSpan=11 height=30>奥运赛程：<A class=tag_title_link title=2008北京奥运会单元竞赛日程（每日金牌、每项金牌数及赛事主要看点） href="http://172.20.1.21/tiyu/2008/0731/article_3495.html" target=_blank 0><FONT color=#0000ff><U>2008北京奥运会单元竞赛日程（每日金牌、每项金牌数及赛事主要看点）</U></FONT></A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<A style="COLOR: #0000ff" href="http://172.20.1.21/tiyu/2008/0721/article_3311.html" target=_blank><FONT color=#0000ff><U>北京奥运总赛程表</U></FONT></A> </TD></TR>
<TR bgColor=#ffffff>
<TD colSpan=11 height=30>
<TABLE cellSpacing=0 cellPadding=3 width="100%" border=0>
<FORM name=search action=/tiyu/search.php method=get target=_blank>
<TBODY>
<TR>
<TD align=right >赛程赛果搜索：<INPUT id=j_username size=40 name=keywords> </TD>
<TD align=middle width=120><SELECT name=catid> <OPTION value=723 selected>奥运赛事</OPTION></SELECT> </TD>
<TD align=left><INPUT type=hidden value=1 name=search> <INPUT class=btn type=submit value=" 搜 索 " name=submit> </TD></TR></TBODY></FORM></TABLE></TD></TR>
<TR bgColor=#ffffff>
<TD vAlign=top width=84 height=70><A href="http://172.20.1.21/tiyu/2008aysaishi/zq/" target=_blank><FONT color=#0000ff><U>足球</U></FONT></A>
	 <A href="http://172.20.1.21/tiyu/2008/0721/article_1442.html" target=_blank><FONT color=#0000ff><U>男</U></FONT></A>
	 <A href="http://172.20.1.21/tiyu/2008/0422/article_1483.html" target=_blank><FONT color=#0000ff><U>女</U></FONT></A>
	 <BR>
	 <A href="http://172.20.1.21/tiyu/2008aysaishi/zq/" target=_blank><FONT color=#0000ff><U>篮球</U></FONT></A>
	<A href="http://172.20.1.21/tiyu/2008/0529/article_2285.html" target=_blank><FONT color=#0000ff><U>男</U></FONT></A> 
	<A href="http://172.20.1.21/tiyu/2008/0529/article_2286.html" target=_blank><FONT color=#0000ff><U>女</U></FONT></A>
	<BR>
	<A href="http://172.20.1.21/tiyu/2008aysaishi/pq/" target=_blank><FONT color=#0000ff><U>排球</U></FONT></A>
	 <A href="http://172.20.1.21/tiyu/2008/0611/article_2658.html" target=_blank><FONT color=#0000ff><U>男</U></FONT></A> <A href="http://172.20.1.21/tiyu/2008/0611/article_2659.html" target=_blank><FONT color=#0000ff><U>女</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0728/article_3428.html" target=_blank><FONT color=#0000ff><U>沙滩排球</U></FONT></A></TD>
<TD vAlign=top width=90><A href="http://172.20.1.21/tiyu/2008aysaishi/qugunqiu/" target=_blank><FONT color=#0000ff><U>手球</U></FONT></A>
	 <A href="http://172.20.1.21/tiyu/2008/0722/article_3332.html" target=_blank><FONT color=#0000ff><U>男</U></FONT></A> 
	 <A href="http://172.20.1.21/tiyu/2008/0722/article_3331.html" target=_blank><FONT color=#0000ff><U>女</U></FONT></A> 
	 <A href="http://172.20.1.21/tiyu/2008aysaishi/qugunqiu/" target=_blank><FONT size=2 color=#0000ff><U>曲棍球</U></FONT></A> 
	 <A href="http://172.20.1.21/tiyu/2008/0617/article_2747.html" target=_blank><FONT size=2 color=#0000ff><U>男</U></FONT></A>
	  <A href="http://172.20.1.21/tiyu/2008/0617/article_2748.html" target=_blank><FONT size=2 color=#0000ff><U>女</U></FONT> </A>
	
	  <A href="http://172.20.1.21/tiyu/2008/0617/article_2746.html" target=_blank><FONT color=#0000ff><U>垒球</U></FONT></A> 
	  <A href="http://172.20.1.21/tiyu/2008/0617/article_2745.html" target=_blank><FONT color=#0000ff><U>棒球</U></FONT></A>
	  <BR>
	  <A href="http://172.20.1.21/tiyu/2008aysaishi/yy/" target=_blank><FONT color=#0000ff><U>水球</U></FONT></A> 
	  <A href="http://172.20.1.21/tiyu/2008/0620/article_2818.html" target=_blank><FONT color=#0000ff><U>男</U></FONT></A>
	  <A href="http://172.20.1.21/tiyu/2008/0620/article_2819.html" target=_blank><FONT color=#0000ff><U>女</U></FONT></A> <BR><A href="http://172.20.1.21/tiyu/2008aysaishi/yy/"></A></TD>
<TD vAlign=top width=80><A href="http://172.20.1.21/tiyu/2008/0728/article_3432.html" target=_blank><FONT color=#0000ff><U>乒乓球</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0724/article_3372.html" target=_blank><FONT color=#0000ff><U>羽毛球</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0728/article_3430.html" target=_blank><FONT color=#0000ff><U>网球</U></FONT></A></TD>
<TD vAlign=top width=80><A href="http://172.20.1.21/tiyu/2008/0728/article_3433.html" target=_blank><FONT color=#0000ff><U>田径</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0728/article_3441.html" target=_blank><FONT color=#0000ff><U>举重</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0728/article_3436.html" target=_blank><FONT color=#0000ff><U>射击</U></FONT></A><br>
	 <A href="http://172.20.1.21/tiyu/2008/0728/article_3435.html" target=_blank><FONT color=#0000ff><U>射箭</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0728/article_3437.html" target=_blank><FONT color=#0000ff><U>击剑</U></FONT></A></TD>
<TD vAlign=top colSpan=2><A href="http://172.20.1.21/tiyu/2008/0723/article_3355.html" target=_blank><FONT color=#0000ff><U>跆拳道</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0728/article_3440.html" target=_blank><FONT color=#0000ff><U>摔跤</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0728/article_3438.html" target=_blank><FONT color=#0000ff><U>柔道</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0723/article_3354.html" target=_blank><FONT color=#0000ff><U>拳击</U></FONT></A></TD>
<TD vAlign=top width=80><A href="http://172.20.1.21/tiyu/2008/0722/article_3330.html" target=_blank><FONT color=#0000ff><U>体操</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0722/article_3329.html" target=_blank><FONT color=#0000ff><U>艺术体操</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0722/article_3328.html" target=_blank><FONT color=#0000ff><U>蹦床</U></FONT></A></TD>
<TD vAlign=top colSpan=2><A href="http://172.20.1.21/tiyu/2008/0728/article_3424.html" target=_blank><FONT color=#0000ff><U>游泳</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0728/article_3427.html" target=_blank><FONT color=#0000ff><U>花样游泳</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0728/article_3425.html" target=_blank><FONT color=#0000ff><U>跳水</U></FONT></A></TD>
<TD vAlign=top width=81><A href="http://172.20.1.21/tiyu/2008/0728/article_3443.html" target=_blank><FONT color=#0000ff><U>赛艇</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0728/article_3442.html" target=_blank><FONT color=#0000ff><U>帆船</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0728/article_3444.html" target=_blank><FONT color=#0000ff><U>皮划艇静水</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0728/article_3445.html" target=_blank><FONT color=#0000ff><U>皮划艇激流</U></FONT></A></TD>
<TD vAlign=top width=82><A href="http://172.20.1.21/tiyu/2008/0728/article_3434.html" target=_blank><FONT color=#0000ff><U>自行车</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0728/article_3446.html" target=_blank><FONT color=#0000ff><U>铁人三项</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0728/article_3447.html" target=_blank><FONT color=#0000ff><U>现代五项</U></FONT></A><BR><A href="http://172.20.1.21/tiyu/2008/0728/article_3429.html" target=_blank><FONT color=#0000ff><U>马术</U></FONT></A></TD></TR>
<TR bgColor=#ffffff>
<TD colSpan=11 height=30>夺金项目：[<A href="http://172.20.1.21/tiyu/2008/0728/article_3425.html" target=_blank><FONT color=#0000ff><U>跳水</U></FONT></A>] [<A href="http://172.20.1.21/tiyu/2008/0728/article_3432.html" target=_blank><FONT color=#0000ff><U>乒乓球</U></FONT></A>] [<A href="http://172.20.1.21/tiyu/2008/0724/article_3372.html" target=_blank><FONT color=#0000ff><U>羽毛球</U></FONT></A>] [<A href="http://172.20.1.21/tiyu/2008/0722/article_3330.html" target=_blank><FONT color=#0000ff><U>体操</U></FONT></A>] [<A href="http://172.20.1.21/tiyu/2008/0728/article_3441.html" target=_blank><FONT color=#0000ff><U>举重</U></FONT></A>] [<A href="http://172.20.1.21/tiyu/2008/0728/article_3430.html" target=_blank><FONT color=#0000ff><U>网球女双</U></FONT></A>] [<A href="http://172.20.1.21/tiyu/2008/0611/article_2659.html" target=_blank><FONT color=#0000ff><U>女子排球</U></FONT></A>] [<A href="http://172.20.1.21/tiyu/2008/0728/article_3433.html" target=_blank><FONT color=#0000ff><U>男子110米栏</U></FONT></A>]</TD></TR>
<TR bgColor=#ffffff>
<TD colSpan=11 height=30>明星关注：<A href="http://172.20.1.21/baike/2008/0731/article_3851.html" target=_blank><FONT color=#0000ff><U>刘翔</U></FONT></A> <A href="http://172.20.1.21/baike/2008/0801/article_3852.html" target=_blank><FONT color=#0000ff><U>郭晶晶</U></FONT></A> <A href="http://172.20.1.21/baike/2008/0801/article_3853.html" target=_blank><FONT color=#0000ff><U>姚明</U></FONT></A> <A href="http://172.20.1.21/baike/2008/0801/article_3854.html" target=_blank><FONT color=#0000ff><U>张怡宁</U></FONT></A> <A href="http://172.20.1.21/baike/2008/0801/article_3855.html" target=_blank><FONT color=#0000ff><U>易建联</U></FONT></A> <A href="http://172.20.1.21/baike/2008/0801/article_3856.html" target=_blank><FONT color=#0000ff><U>王楠</U></FONT></A> <A href="http://172.20.1.21/baike/2008/0801/article_3857.html" target=_blank><FONT color=#0000ff><U>李小鹏</U></FONT></A> <A href="http://172.20.1.21/baike/2008/0801/article_3858.html" target=_blank><FONT color=#0000ff><U>郭跃</U></FONT></A> <A href="http://172.20.1.21/baike/2008/0801/article_3859.html" target=_blank><U><FONT color=#0000ff>郑洁</FONT></U></A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <FONT color=#0000ff><U>&gt;&gt;&gt;</U></FONT><A href="http://172.20.1.21/baike/MR/tymx/" target=_blank><FONT color=#0000ff><U>请点击搜索更多体育明星</U></FONT></A> </TD></TR>
<TR>
<TD height=5></TD>
<TD></TD>
<TD></TD>
<TD></TD>
<TD width=23></TD>
<TD width=57></TD>
<TD></TD>
<TD width=22></TD>
<TD width=54></TD>
<TD></TD>
<TD></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 width=770 border=1><!--DWLayoutTable-->
<TBODY>
<TR>
<TD width=42 height=2></TD>
<TD width=55></TD>
<TD width=42></TD>
<TD width=55></TD>
<TD width=47></TD>
<TD width=55></TD>
<TD width=23></TD>
<TD width=1></TD>
<TD width=60></TD>
<TD width=44></TD>
<TD width=62></TD>
<TD width=45></TD>
<TD width=55></TD>
<TD width=43></TD>
<TD width=97></TD></TR></TBODY></TABLE>




</body>
</html> 