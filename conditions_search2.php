<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>160 olympic try</title>
</head>
<body>
	
Conditions_Search多条件查询:

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

<form name="form1" method="post" action="display_search_SQL2.php">
	
 Condition1:<select name="condition1" id="olympic_year" onChange="getolympic_match_big(this.options.value)">
<option value="">请选择奥运年份</option>
<?php
$result=mysql_query("select * from olympic_year");
while ($rs=mysql_fetch_assoc($result)) {
?>
 <option value="<?=$rs[olympic_year]?>"><?=$rs[olympic_year]?></option>
  <?php }?>
</select>

  Condition2:<select name="condition2" id="olympic_match_big" onChange="getolympic_match_small(this.options.value)">
  <option value="">请选择比赛大项</option>
</select>

Condition3:<select name="condition3" id="olympic_match_small">
<option value="">请选择比赛小项</option>
</select>

  Condition4:<select name="condition4">
  <option value='' selected>比赛日期</option>
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



  Condition5:<input type="text" name="condition5"><br>

  <input type='submit' name='search' value='查询'>
  
</form>


</body>
</html> 