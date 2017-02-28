<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0078)http://www.7m.cn:10006/live_F.aspx?encode=gb&Classid=&view=all&match=&ordType= -->
<HTML><HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<SCRIPT language=javascript>
var sDt = new Array();
var sDt2 = new Array();
</SCRIPT>

<SCRIPT language=javascript src="http://www.7m.cn:10006/datafile/fgb.js?nocache=<?php echo time();?>"></SCRIPT>

<SCRIPT language=javascript src="http://www.7m.cn:10006/datafile/sXl.js?nocache=<?php echo time();?>"></SCRIPT>

<SCRIPT language=javascript>

var LIVE_TABLE_COLWIDTH = [2, 12, 6, 7, 24, 9, 24, 5, 9, 2];
var LIVE_TABLE_COLWIDTH2 = [2, 6, 7, 30, 9, 30, 5, 9, 2];

var Encode = "gb";
var ServerYear = "2008";
var ServerMonth = "1";
var ServerDay = "16";
var ServerHour = "<?php echo (date("H",time())+8)%24;?>";
var ServerMinute = "<?php echo date("i",time());?>";
var Timegap = parseInt((new Date(ServerYear, Number(ServerMonth) - 1, ServerDay, ServerHour, ServerMinute, 0) - new Date()) / 1000 / 60);

var HtmlCode = new Array();
HtmlCode.push('<table border="1" bordercolor="#FFFFFF" cellpadding="2" cellspacing="0" width="100%" id="live_Table" style="font-size:13px;border-collapse: collapse;">');
var EndHtmlCode = new Array();
var Rows = 0;
var fsj = "";
var classId = "";

var ObjArr = new Array();
function ElementObj(bh)
{
	this.row = parent.document.getElementById("bh" + bh);
	if (this.row == null)
		return;
	this.stime = parent.document.getElementById("sj" + bh);
	this.ptime = parent.document.getElementById("bssj" + bh);
	this.pstatus = parent.document.getElementById("isstart" + bh);
	this.teamA = parent.document.getElementById("t_at" + bh);
	this.teamB = parent.document.getElementById("t_bt" + bh);
	this.score = parent.document.getElementById("bf" + bh);
	this.hscore = parent.document.getElementById("bc" + bh);
	this.lA = parent.document.getElementById("la" + bh);
	this.lB = parent.document.getElementById("lb" + bh);
	this.rA = parent.document.getElementById("ra" + bh);
	this.rB = parent.document.getElementById("rb" + bh);
	this.resume = parent.document.getElementById("resume_" + bh);
	this.resume_td = parent.document.getElementById("resume_td" + bh);
}

var sys_time_zone = parent.GetCurrentTimeZone();

parent.document.getElementById("TimeZone").innerHTML = parent.GetTimeZone(1, sys_time_zone);



var ORD_TYPE = "";
var preMatches = "";
/*
var Match_Table = '<table border="0">';
var MList = '';
var Matches_Count = 0;
function MatchesTable(Mn, Mid)
{
	if ((',' + MList).indexOf(',' + Mid + ',') == -1)
	{
		Match_Table += '<td><input type="checkbox" id="sM_' + Mid + '" onclick="SelectMatch(this)" value="' + Mid + '" checked><label for="sM_' + Mid + '" style="cursor:pointer">' + Mn + '</label></td>';
		MList += Mid + ',';
		++Matches_Count;
		if (Matches_Count % 3 == 0)
			Match_Table += '</tr><tr>';
	}
}
*/

var selMatch = "";
if (selMatch != "")
	selMatch = "," + selMatch + ",";

for (var i in sDt)
{
	if (selMatch != "")
	{
		if (selMatch.indexOf("," + sDt[i][16] + ",") == -1)
		{
			continue;
		}
	}
	if (typeof(sDt2[i]) == "object")
	{
		//MatchesTable(sDt[i][0], sDt[i][16]);

	Wr(i, sDt[i][0], sDt[i][1], sDt[i][2], sDt[i][3], sDt[i][4], sDt[i][5], sDt[i][6], sDt[i][7], sDt[i][8], sDt[i][9], sDt[i][10], sDt[i][11], 
		sDt[i][12], sDt[i][13], sDt[i][14], sDt[i][15], sDt2[i][0], sDt2[i][1], sDt2[i][2], sDt2[i][3], sDt2[i][4], sDt2[i][5], sDt2[i][6], 
		sDt2[i][7], sDt2[i][8], sDt2[i][9], sDt2[i][10], sDt2[i][11], sDt2[i][12], sDt2[i][13], sDt[i][17]);

	}
}

function Wr(bh,gl,cr,live_a,live_b,memo,weather,wd,pm1,pm2,abh,bbh,isDisplay,glbh,bir,r_bh,r_bir,isstart,la,lb,ra,rb,difftime,bc,resume,sj,sx,rq,sw1,sw2,sy,euro1x2)
{
	if (isDisplay == 0) return;
	
	if (parent.timezone_TZ != "+0800")
	{
		sj = parent.AmountTimeDiff(sj, 0);
	}
	var ssj = sj.split(",");
	var bssj = (isstart == 2) ? 46 : 0;
	var bf_display = ""
	var ProcessTime_Display = ' style="display:none"';
	var isFinishLive = false;
	var state_color = "";
	if (isstart == 4 || isstart == 6 || isstart == 10 || (isstart >= 12 && isstart <= 15))
	{
		isFinishLive = true;
		parent.EndGamebh += "[" + bh + "]";
	}
	if (isstart == 1 || isstart == 3)
	{
		var p_ssj = difftime.split(",");
		var p_sj = new Date(p_ssj[0], parseFloat(p_ssj[1])-1, p_ssj[2], p_ssj[3], p_ssj[4], p_ssj[5]);
		sDt2[bh][5] = p_sj;
		if (isstart == 1)
		{
			bssj = parseInt((new Date - Date.parse(p_sj)) / 1000 /60 + Timegap)
			if (bssj < 0)
				bssj = 1;
			if (bssj > 45)
				bssj = 45;
		}
		else
		{
			bssj = parseInt((new Date - Date.parse(p_sj)) / 1000 /60 + Timegap) + 45;
			if (bssj < 46)
				bssj = 46;
			if (bssj > 90)
				bssj = 90;
		}
		ProcessTime_Display = "";
	}
	else
	{
		var p_ssj = sj.split(",");
		var p_sj = new Date(p_ssj[0], parseFloat(p_ssj[1])-1, p_ssj[2], p_ssj[3], p_ssj[4], p_ssj[5]);
		sDt2[bh][5] = p_sj;
	}
	
	sj = new Date(ssj[0], parseFloat(ssj[1])-1, ssj[2], ssj[3], ssj[4], ssj[5]);
	
	if (isstart == 4 || isstart == 10 || isstart == 12 || isstart == 16)
	{
		state_color = "#FF0000";
	}
	else if (isstart == 5 || isstart == 6 || isstart == 13 || isstart == 14)
	{
		state_color = "#364DA3";
		if (isstart != 5)
		{
			la = "";
			lb = "";
			ra = 0;
			rb = 0;
			bc = "";
			bf_display = ' style="display:none" ';
		}
	}
	else
	{
		state_color = "#000000";
		if (isstart == 17)
		{
			la = "";
			lb = "";
			ra = 0;
			rb = 0;
			bc = "";
			if (memo != "")
				bc = '<a href="#" class="ns_ltv1"><img src="http://img.7m.cn/nsimg/ns_tv_1.gif" border="0"><span>' + memo + '</span></a>';
			if (memo =="")
				bc = "";
		}
	}
	if (bc == "-")
		bc = "";
	if (resume != "")
		resume = parent.ChangeRsmEncode(resume);
	
	if (Encode == "en" || Encode == "vn")
	{
		if (!/^[\w]+$/i.test(pm1))
			pm1 = "";
		if (!/^[\w]+$/i.test(pm2))
			pm2 = "";
	}
	if (pm1 != "") pm1 = "[" + pm1 + "]";
	if (pm2 != "") pm2 = "[" + pm2 + "]";
	
	live_a = '<a href="javascript:' + parent.TEAM_LINK_FUN_NAME + '(' + abh + ')" title="' + pm1 + '">' + live_a + '</a>';
	live_b = '<a href="javascript:' + parent.TEAM_LINK_FUN_NAME + '(' + bbh + ')" title="' + pm2 + '">' + live_b + '</a>';
	var bf = '<a href="javascript:' + parent.DETAILS_LINK_FUN_NAME + '(' + bh + ')" id="bf' + bh + '"' + bf_display + ' class="bflk"><span id="la' + bh + '">' + la + '</span>&nbsp;-&nbsp;<span id="lb' + bh + '">' + lb + '</span></a>';
	var analyse = '<a href="javascript:' + parent.ANALYSE_LINK_FUN_NAME + '(' + bh + ')">' + parent.ANALYSE_STR + '</a>';
	if (euro1x2 == 1)
		analyse += '<a href="javascript:' + parent.EURO1X2_LINK_FUN_NAME + '(' + bh + ')">' + parent.EURO1X2_STR + '</a>'; 
	if (r_bir == 1)
		analyse += '<img src="http://img.7m.cn/img3/birs.gif" border="0" onclick="' + parent.RPK_LINK_FUN_NAME + '(' + r_bh + ')" style="cursor:pointer">'; 
	ra = (ra > 0) ? '<img src="http://img.7m.cn/icon/' + ra + '.gif">&nbsp;' : '';
	rb = (rb > 0) ? '&nbsp;<img src="http://img.7m.cn/icon/' + rb + '.gif">' : '';
	live_a = '<span id="ra' + bh + '">' + ra + '</span> ' + live_a;
	live_b = live_b + ' <span id="rb' + bh + '">' + rb + '</span>';
	
	var state = (isstart != 17) ? parent.ChangeState(isstart) : '';

	if (!isFinishLive)
	{
		if (fsj != sj.getDate())
		{
			HtmlCode.push('<tr><td colspan="' + LIVE_TABLE_COLWIDTH.length + '" class="ns_xq1">' + parent.MAKEDTROW(sj, ssj) + '</td></tr>');
			fsj = sj.getDate();
		}
	}
	var time_alt = (classId != "" && isFinishLive) ? " title=\"" + ssj[0] + "-" + ssj[1] + "-" + ssj[2] + "\"" : "";
	HtmlCode.push('<tr id="bh' + bh + '">');
	HtmlCode.push('<td class="l1"><input type="checkbox" checked onclick="hiderow(' + bh + ')"></td>');
	HtmlCode.push('<td class="l2" bgcolor="#' + cr + '">' + gl + '</td>');
	HtmlCode.push('<td class="l3" id="sj' + bh + '"' + time_alt + '>' + ssj[3] + ':' + ssj[4] + '</td>');
	HtmlCode.push('<td class="l4"><span id="isstart' + bh + '" style="color:' + state_color + '">' + state + '</span><span id="bssj' + bh + '" class="ns_f1"' + ProcessTime_Display + '>' + bssj + '\'</span></td>');
	HtmlCode.push('<td class="l5" id="t_at' + bh + '">' + live_a + '</td>');
	HtmlCode.push('<td class="l6">' + bf + '</td>');
	HtmlCode.push('<td class="l7" id="t_bt' + bh + '">' + live_b + '</td>');
	HtmlCode.push('<td class="l8 zti1" id="bc' + bh + '">' + bc + '</td>');
	HtmlCode.push('<td class="l9 zti2">' + analyse + '</td>');
	
	HtmlCode.push('<td><input type="checkbox" onclick="SelectVoi(this, ' + bh + ')" title=\"" + parent.SPEAK_TITLE + "\"></td>');
	
	HtmlCode.push('</tr>');
	if (resume != "")
		HtmlCode.push('<tr id="resume_' + bh + '" style=\"height:0px;\"><td id="resume_td' + bh + '" colspan="' + LIVE_TABLE_COLWIDTH.length + '" class="ls1">' + resume + '</td></tr>');
	else
		HtmlCode.push('<tr id="resume_' + bh + '" style="display:none;height:0px;"><td id="resume_td' + bh + '" colspan="' + LIVE_TABLE_COLWIDTH.length + '" class="ls1"></td></tr>');
	if (isFinishLive)
		EndHtmlCode = EndHtmlCode.concat(HtmlCode.splice(HtmlCode.length - 13, HtmlCode.length));

	Rows++;
}

WriteHtm();

function WriteHtm()
{
	//if (parent.document.getElementById("ls") != null)
	//{
		if (Rows > 0)
		{
			var over_Display = (EndHtmlCode.length > 0) ? "" : " style=\"display:none\"";

			HtmlCode.push('<tr id="gameover"' + over_Display + '>');
			HtmlCode.push('<td colspan="' + LIVE_TABLE_COLWIDTH.length + '" class="ns_xq1">' + parent.RESULE_STR + '</td>');
			HtmlCode.push('</tr>');
			HtmlCode.push(EndHtmlCode.join(""));
			HtmlCode.push('<tr id="topwidth" style="height:0px;">');
			for (var i = 0; i < LIVE_TABLE_COLWIDTH.length; ++i)
				HtmlCode.push("<td width=\"" + LIVE_TABLE_COLWIDTH[i] + "%\"></td>");
			HtmlCode.push('</tr>');
			HtmlCode.push('</table>');

			parent.document.getElementById("ls").innerHTML = HtmlCode.join("");
			parent.hideCount = 0;
			parent.getcfed = false;
			parent.document.getElementById("hider").innerHTML = "0";
			parent.setRefreshValue = false;
			parent.reflag = 0;
			parent.ProcessTime_Timer = setTimeout("parent.ProcessTime()", 60000);
			parent.ReadSetting();
			parent.oldxml = "";
			parent.OpenXml_Timer = setTimeout("parent.OpenXml()", parent.bfRefreshTime);
			//parent.document.getElementById("MatchList").innerHTML = Match_Table + '</tr></table>';
			clearTempValue();
			parent.updateRowColor_Timer = setTimeout("parent.updateRowColor()", 500);
		}
		else
		{
			//parent.document.getElementById("ls").innerHTML = "<br><br><center><br><img src=\"http://img.7m.cn/img/err.jpg\"><br></center><br><br>" + parent.FIXTURE_LINK;
			location.reload();
		}
		parent.loader = true;
	//}
	//else
	//{
	//	setTimeout("WriteHtm();", 1000);
	//}
}

function clearTempValue()
{
	HtmlCode = null;
	EndHtmlCode = null;
	//Match_Table = null;
}
</SCRIPT>

<META content="MSHTML 6.00.2900.3243" name=GENERATOR></HEAD>
<BODY></BODY></HTML>
