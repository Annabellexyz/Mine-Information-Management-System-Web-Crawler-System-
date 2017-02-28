var bfRefreshTime = 2000;
var setRefreshValue = false;
var reflag = 0;
var oldxml = "";
var old_Pk_xml = "";
var EndGamebh = "";
var GoalSound = false;
var SelectGoalSound = true;
var SelectGoalTips = true;
var jqsy = "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' WIDTH='1' HEIGHT='1'><param name='movie' value='sound/default.swf'><param name='quality' value='high'><param name='wmode' value='transparent'><embed src='sound/default.swf' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='1' height='1'></embed></object>";
var hideCount = 0;
var laT1 = new Array(), laT2 = new Array(), lbT1 = new Array(), lbT2 = new Array(), pkT = new Array(), aswT1 = new Array(), aswT2 = new Array(), bswT1 = new Array(), bswT2 = new Array();
var sPopupS;
//var isXPsp2IE = (window.navigator.userAgent.indexOf("SV1") != -1);
var GoalTips = "", GoalTips_Count = 0;
var tipswidth = 0, tipsheight = 0;
var loader = false;
var voi_lng = LANGUAGE_INDEX;
var speak_away = 0;
var speak_red = 0;

SOUND_CSRC = "http://img.7m.cn/nsimg/ns_fm_icon3_1.gif";
SOUND_OSRC = "http://img.7m.cn/nsimg/ns_fm_icon3_2.gif"
WIN_CSRC = "http://img.7m.cn/nsimg/ns_fm_icon4_1.gif";
WIN_OSRC = "http://img.7m.cn/nsimg/ns_fm_icon4_2.gif"

function set_Attribute(bh, obj, attribute, val)
{
	if (typeof(live_f.ObjArr[bh]) == "object")
		eval("if (live_f.ObjArr[" + bh + "]." + obj + " != null){live_f.ObjArr[" + bh + "]." + obj + "." + attribute + " = '" + val + "';}");
}

function getCookie(Name)
{
	var search = Name + "=";
	if(document.cookie.length > 0)
	{
		offset = document.cookie.indexOf(search);
		if(offset != -1)
		{
			offset += search.length;
			end = document.cookie.indexOf(";", offset);
			if(end == -1)
				end = document.cookie.length;
			return unescape(document.cookie.substring(offset, end));
		}
    	else
    	{
    		return "";
    	}
   }
   return "";
}

function ApplySound(v, n)
{
	var exp = new Date();
	exp.setTime(exp.getTime() + (30*24*60*60*1000));
	document.cookie = "7mSound=" + v + "{7mSound};expires=" + exp.toGMTString();
	jqsy = "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0'><param name='movie' value='sound/" + v + ".swf'><param name='quality' value='high'><param name='wmode' value='transparent'><embed src='sound/" + v + ".swf' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='1' height='1'></embed></object>";
	select_sound.innerHTML = n;
	PlaySound();
}

function resetSound()
{
	if (document.cookie.indexOf("7mSound=") != -1)
	{
		var CookieValue = document.cookie.substring(document.cookie.indexOf("7mSound=")+8,document.cookie.indexOf("{7mSound}"));
		if (CookieValue == "no")
			ApplySound('default');
	}
}

function sColor1(c_id)
{
	document.getElementById(c_id).style.color = '#FFFFFF';
	document.getElementById(c_id).style.background = '#8592B5';
}

function sColor2(c_id)
{
	document.getElementById(c_id).style.color='#000000';
	document.getElementById(c_id).style.background='#FFFFFF';
}

function SoundOnSelect(obj)
{
	if(!SelectGoalSound)
	{
		obj.title = SOUND_CT;
		obj.src = SOUND_CSRC;
		resetSound();
		SelectGoalSound = true;
		SetCookie('7mSoundCheckBox', '1{7mSoundCheckBox}');
	}
	else
	{
		obj.title = SOUND_OT;
		obj.src = SOUND_OSRC;
		SelectGoalSound = false;
		SetCookie('7mSoundCheckBox', '0{7mSoundCheckBox}');
	}
}

function WinOnSelect(obj)
{
	if(!SelectGoalTips)
	{
		obj.title = WIN_CT;
		obj.src = WIN_CSRC;
		resetSound();
		SelectGoalTips = true;
		SetCookie('7mWinCheckBox', '1{7mWinCheckBox}');
	}
	else
	{
		obj.title = WIN_OT;
		obj.src = WIN_OSRC;
		SelectGoalTips = false;
		SetCookie('7mWinCheckBox', '0{7mWinCheckBox}');
	}
}

function ReadSetting()
{
	if (document.cookie.indexOf("7mSound=") != -1)
	{
		var CookieValue = document.cookie.substring(document.cookie.indexOf("7mSound=")+8,document.cookie.indexOf("{7mSound}"));
		jqsy = "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' WIDTH='1' HEIGHT='1'><param name='movie' value='sound/" + CookieValue + ".swf'><param name='quality' value='high'><param name='wmode' value='transparent'><embed src='sound/" + CookieValue + ".swf' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='1' height='1'></embed></object>";
	}
	if (document.cookie.indexOf("7mSoundCheckBox=") != -1)
	{
		var sound_v = document.cookie.substring(document.cookie.indexOf("7mSoundCheckBox=")+16, document.cookie.indexOf("{7mSoundCheckBox}"));
		if (sound_v == "1")
		{
			sound.title = SOUND_CT;
			sound.src = SOUND_CSRC;
			SelectGoalSound = true;
		}
		else
		{
			sound.title = SOUND_OT;
			sound.src = SOUND_OSRC;
			SelectGoalSound = false;
		}
	}
	else
	{
		sound.title = SOUND_CT;
		sound.src = SOUND_CSRC;
		SelectGoalSound = true;
	}
	if (document.cookie.indexOf("7mWinCheckBox=") != -1)
	{
		var win_v = document.cookie.substring(document.cookie.indexOf("7mWinCheckBox=")+14, document.cookie.indexOf("{7mWinCheckBox}"));
		if (win_v == "1")
		{
			win.title = WIN_CT;
			win.src = WIN_CSRC;
			SelectGoalTips = true;
		}
		else
		{
			win.title = WIN_OT;
			win.src = WIN_OSRC;
			SelectGoalTips = false;
		}
	}
	else
	{
		win.title = WIN_CT;
		win.src = WIN_CSRC;
		SelectGoalTips = true;
	}
	if (LANGUAGE_INDEX == 0 && document.cookie.indexOf("voi_lng=") != -1)
		voi_lng = getCookie("voi_lng");
	if (document.cookie.indexOf("speak_away=") != -1)
		speak_away = getCookie("speak_away");
	if (document.cookie.indexOf("speak_red=") != -1)
		speak_red = getCookie("speak_red");
}

function SetCookie(n,v)
{
	var exp = new Date();
	exp.setTime(exp.getTime() + (365*24*60*60*1000));
	document.cookie = n + "=" + v + ";expires=" + exp.toGMTString();
}

function ChangeState(startIndex)
{
	if (startIndex < 0 || startIndex > 18)
		startIndex = 0;
	return STATE_ARR[startIndex];
}
/*
function SelectMatch(chkObj)
{
	var Mid = chkObj.value;
	var objs = document.getElementsByName("m" + Mid);
	for (var i = 0; i < objs.length; ++i)
	{
		var row1 = objs[i].parentNode.parentNode;
		var row2 = row1.parentNode.parentNode.rows[row1.rowIndex + 1];
		var headRow = document.getElementById("mHead" + Mid);
		if (chkObj.checked)
		{
			row1.style.display = "";
			if (row2.childNodes[0].innerHTML != "")
				row2.style.display = "";
			if (headRow != null)
				headRow.style.display = "";
			if (!objs[i].checked)
				objs[i].checked = true;
			--hideCount;
		}
		else
		{
			row1.style.display = "none";
			row2.style.display = "none";
			if (headRow != null)
				headRow.style.display = "none";
			if (objs[i].checked)
				++hideCount;
		}
	}
	hider.innerHTML = hideCount;
}

function ShowMatchList(t)
{
	document.getElementById("MatchList_div").style.visibility = (t == 0) ? "visible" : "hidden";
}

function SelectReverseMatch()
{
	var objs = MatchList.getElementsByTagName("input");
	for (var i = 0; i < objs.length; ++i)
	{
		objs[i].click();
	}
}

function SelectAllMatch()
{
	var chkObjs = MatchList.getElementsByTagName("input");
	for (var i = 0; i < chkObjs.length; ++i)
	{
		if (!chkObjs[i].checked)
		{
			chkObjs[i].checked = true;
			var Mid = chkObjs[i].value;
			var objs = document.getElementsByName("m" + Mid);
			for (var j = 0; j < objs.length; ++j)
			{
				var row1 = objs[j].parentNode.parentNode;
				var row2 = row1.parentNode.parentNode.rows[row1.rowIndex + 1];
				var headRow = document.getElementById("mHead" + Mid);
				row1.style.display = "";
				if (row2.childNodes[0].innerHTML != "")
					row2.style.display = "";
				if (headRow != null)
					headRow.style.display = "";
				if (!objs[j].checked)
					objs[j].checked = true;
			}
		}
	}
	hideCount = 0;
	hider.innerHTML = hideCount;
}

function unChangeState(str)
{
	var Res;
	if (live_f.Encode == "en")
	{
		switch (str)
		{
			case "1ST":
			case "HT":
			case "2ND":
			case "EXTRA":
			case "PAUSE":
			case "PEN":
			case "GOLD":
				Res = 1
				break;	
			case "FT":
			case "CANCEL":
			case "120 MINUTES":
			case "FINISHED":
			case "POSTPONED":
			case "CUT":
			case "UNDECIDED":
				Res = 2;
				break;
			default :
				Res = 0;
				break;
		}
	}
	else if (live_f.Encode == "gb")
	{
		switch (str)
		{
			case "上":
			case "中":
			case "下":
			case "加":
			case "断":
			case "点":
			case "金":
				Res = 1;
				break;
			case "完":
			case "取":
			case "全":
			case "延":
			case "斩":
			case "待":
				Res = 2;
				break;
			default:
				Res = 0;
				break;
		}
	}
	else
	{
		switch (str)
		{
			case "上":
			case "中":
			case "下":
			case "加":
			case "斷":
			case "點":
			case "金":
				Res = 1;
				break;
			case "完":
			case "取":
			case "全":
			case "延":
			case "斬":
			case "待":
				Res = 2;
				break;
			default:
				Res = 0;
				break;
		}
	}
	return Res;
}
*/
function updateRowColor()
{
	var obj = document.getElementById("live_Table");
	var rowId = 0;
	for (var i=0;i<obj.rows.length;++i)
	{
		if (obj.rows[i].style.display == "" && obj.rows[i].id.substring(0, 2) == "bh")
		{
			obj.rows[i].className = (rowId % 2) ? "ns_tr2" : "ns_tr1";
			rowId++;
		}
	}
	if (typeof(updateRowColor_Timer) == "number")
		clearTimeout(updateRowColor_Timer);
	updateRowColor_Timer = setTimeout("updateRowColor()", 1800000);
}

function ChangeRsmEncode(str)
{
	if (str == "" || str == "[ad]" || str == "[ad2]")
	{
		return "";
	}
	if (location.host.indexOf("hk.7m.cn") != -1 || location.host.indexOf("7m.hk") != -1)
	{
		str = str.replace(/<a\s+href=http:\/\/218.16.224.17\/video\d+?.htm\s+target=_blank>[\s\S]+?<\/a>/i, "");
		if (str.indexOf("218.16.224.17") != -1)
			return "";
	}
	var rltstr = "";
	var tmpstr = new Array();
	var i=0;

	if ((live_f.Encode == "en" || live_f.Encode == "vn") && str.substring(0, 1) == "*")
	{
		str = str.substring(1, str.length);
		if (str.indexOf("{") != -1 && str.indexOf("}") != -1)
		{
			str = str.substring(str.indexOf("{")+1, str.indexOf("}"));
			var tmpsource = str.split("|");
			if (live_f.Encode == "en")
				str = tmpsource[0];
			if (live_f.Encode == "vn")
				str = (tmpsource.length > 1) ? tmpsource[1] : "";
		}
		else
		{
			str = "";
		}
	}
	else
	{
		if (str.substring(0,1) == "*")
			str = str.substring(1, str.length);
		if (str.indexOf("{") != -1 && str.indexOf("}") != -1)
			str = str.replace(str.substring(str.indexOf("{"), str.indexOf("}")+1), "");
	}
	if (str == "")
		return "";
	tmpstr = str.split(",");
	if (tmpstr.length >0)
	{
		for (i=0;i<tmpstr.length;i++)
		{
			if (typeof(RESUME_ARR[tmpstr[i].substring(0,1)]) != "undefined" && tmpstr[i].substring(1,2) == "[")
				tmpstr[i] = RESUME_ARR[tmpstr[i].substring(0,1)] + tmpstr[i].substring(1,tmpstr[i].length);
			rltstr += tmpstr[i] + ",";
		}
	}
	else
	{
		rltstr = str;
	}
	if (rltstr != "")
		rltstr = "<font color=blue>" + rltstr.substring(0,rltstr.length-1).replace("^", "") + "</font>";
	
	return rltstr
}

function hiderow(bh)
{
	var row = document.getElementById("bh" + bh);
	if (row != null)
	{
		row.style.display = "none";
		document.getElementById("resume_" + bh).style.display = "none";
		hideCount++;
		hider.innerHTML = hideCount;
	}
}

function ProcessTime()
{
	if (typeof(live_f.sDt2) == "object")
	{
		var AmountTime = 0;
		var objBssj = null;
		for (var i in live_f.sDt2)
		{
			if (live_f.sDt2[i][0] == 1)
			{
				AmountTime = parseInt((new Date() - Date.parse(live_f.sDt2[i][5])) / 1000 /60) + live_f.Timegap;
				if (AmountTime < 0) AmountTime = 0;
				if (AmountTime > 45) AmountTime = 45;
				objBssj = (typeof(live_f.ObjArr[i]) == "object" && live_f.ObjArr[i].row != null) ? live_f.ObjArr[i].ptime : document.getElementById("bssj" + i);
				if (objBssj != null && objBssj.innerHTML != AmountTime + "'")
				{
					objBssj.innerHTML = AmountTime + "'";
				}
			}
			else if (live_f.sDt2[i][0] == 3)
			{
				AmountTime = parseInt((new Date() - Date.parse(live_f.sDt2[i][5])) / 1000 /60) + live_f.Timegap + 45;
				if (AmountTime < 46) AmountTime = 46;
				if (AmountTime > 90) AmountTime = 90;
				objBssj = (typeof(live_f.ObjArr[i]) == "object" && live_f.ObjArr[i].row != null) ? live_f.ObjArr[i].ptime : document.getElementById("bssj" + i);
				if (objBssj != null && objBssj.innerHTML != AmountTime + "'")
				{
					objBssj.innerHTML = AmountTime + "'";
				}
			}
		}
	}
	if (typeof(ProcessTime_Timer) == "number")
		clearTimeout(ProcessTime_Timer);
	ProcessTime_Timer = setTimeout("ProcessTime()", 60000);
}

function PlaySound()
{
	bs.innerHTML = jqsy;
}
/*
var XmlVersion = new Array("MSXML4.DOMDocument", "MSXML3.DOMDocument", "MSXML2.DOMDocument", "MSXML.DOMDocument", "Microsoft.XmlDom");
var XmlDoc = null;
for(var i=0;i<XmlVersion.length;i++)
{
	try
	{
		XmlDoc = new ActiveXObject(XmlVersion[i]);
		break;
	}
	catch(e)
	{
		XmlDoc = null;
	}
}

function OpenXml()
{
	try
	{
		var d = Math.round(Math.random()*90000)+10000;
		XmlDoc.load("liveData/sXl.xml?" + d);
		XmlDoc.onreadystatechange = livexmlonreadystatechange;
	}
	catch(e)
	{
	}
	if (typeof(OpenXml_Timer) == "number")
		clearTimeout(OpenXml_Timer);
	OpenXml_Timer = setTimeout("OpenXml()", bfRefreshTime);
}

function livexmlonreadystatechange()
{
	if (XmlDoc.readyState != 4) return;
	if (XmlDoc.xml == "") return;
	if (oldxml == XmlDoc.xml) return;
	GoalTips = "";
	GoalTips_Count = 0;
	var root = XmlDoc.documentElement;
	var ResetPage = root.childNodes[0].text;
	if (!setRefreshValue)
	{
		reflag = ResetPage;
		setRefreshValue = true;
	}
	if (reflag != ResetPage)
	{
		setRefreshValue = false;
		var Rnd = Math.round(Math.random()*9000)+1000;
		setTimeout("live_f.location.reload()", Rnd);
		return;
	}
	var nextfn = parseInt(root.childNodes[root.childNodes.length-1].text);
	if ((nextfn - 1) > live_f.GetFlagNum)
	{
		OpenXml2();
	}
	else
	{
		for(var i=1;i<root.childNodes.length-1;i++)
			eval('Update_Live(' + root.childNodes[i].text +')');
		live_f.GetFlagNum++;
		oldxml = XmlDoc.xml;
		if (GoalSound && SelectGoalSound)
		{
			PlaySound();
			GoalSound = false;
		}
		if (GoalTips_Count > 0)
		{
			ShowGoalTips();
		}
	}
}

function OpenXml2()
{
	try
	{
		var d = Math.round(Math.random()*90000)+10000;
		XmlDoc.load("liveData/sxl_" + live_f.GetFlagNum + ".xml?" + d);
		XmlDoc.onreadystatechange = livexmlonreadystatechange2;
	}
	catch(e)
	{
	}
}

function livexmlonreadystatechange2()
{
	if (XmlDoc.readyState != 4) return;
	if (XmlDoc.xml == "") return;
	GoalTips = "";
	GoalTips_Count = 0;
	var root = XmlDoc.documentElement;
	for(var i=1;i<root.childNodes.length-1;i++)
		eval('Update_Live(' + root.childNodes[i].text +')');
	live_f.GetFlagNum = parseInt(root.childNodes[i].text);
	if (GoalSound && SelectGoalSound)
	{
		PlaySound();
		GoalSound = false;
	}
	if (GoalTips_Count > 0)
	{
		ShowGoalTips();
	}
}
*/

var xmlhttp = null;
var xmlhttp2 = null;
var isIE = true;
var parser = null;
var oSerializer = null;
var XmlDoc = null;
var XmlDoc2 = null;

if(window.ActiveXObject)
{         
	try
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	catch(e)
	{ 
		xmlhttp = new ActiveXObject("MsXml2.XMLHTTP");
		xmlhttp2 = new ActiveXObject("MsXml2.XMLHTTP");
	}
}
else
{
	xmlhttp = new XMLHttpRequest();
	xmlhttp2 = new XMLHttpRequest();
	parser = new DOMParser();
	oSerializer = new XMLSerializer();
	isIE = false;
}

function OpenXml()
{
	try
	{
		xmlhttp.open("get", "livedata/sXl.xml?" + Date.parse(new Date()), true);
		xmlhttp.onreadystatechange = livexmlonreadystatechange;
		xmlhttp.send(null);
	}
	catch(e)
	{
	}
	if (typeof(OpenXml_Timer) == "number")
		clearTimeout(OpenXml_Timer);
	OpenXml_Timer = setTimeout("OpenXml()", bfRefreshTime);
}

function livexmlonreadystatechange()
{
	if (xmlhttp.readyState != 4 || (xmlhttp.status != 200 && xmlhttp.status != 0))
		return;
	var newxml = "";
	if(isIE)
	{
		XmlDoc = xmlhttp.responseXML;
		newxml = XmlDoc.xml;
		if(newxml == "" || newxml == oldxml)
			return;
	}
	else
	{
		XmlDoc = parser.parseFromString(xmlhttp.responseText, "text/xml");
		if(XmlDoc.documentElement.tagName == "parsererror")
			return;
		newxml= oSerializer.serializeToString(XmlDoc.documentElement);
		if(newxml == "" || newxml == oldxml)
			return;
	}
	GoalTips = "";
	GoalTips_Count = 0;
	var root = XmlDoc.documentElement;
	var ResetPage = root.getElementsByTagName("Rst")[0].firstChild.nodeValue;
	if (!setRefreshValue)
	{
		reflag = ResetPage;
		setRefreshValue = true;
	}
	if (reflag != ResetPage)
	{
		setRefreshValue = false;
		var Rnd = Math.round(Math.random()*9000)+1000;
		setTimeout("live_f.location.reload()", Rnd);
		return;
	}
	var nextfn = parseInt(root.getElementsByTagName("fn")[0].firstChild.nodeValue);
	if ((nextfn - 1) > live_f.GetFlagNum)
	{
		OpenXml2();
		return;
	}
	var cNode = root.getElementsByTagName("C");
	for(var i=0;i<cNode.length;++i)
		eval('Update_Live(' + cNode[i].firstChild.nodeValue +')');
	oldxml = newxml;
	live_f.GetFlagNum++;
	if(GoalSound && SelectGoalSound)
	{
		PlaySound();
		GoalSound = false;
	}
	if (GoalTips_Count > 0)
	{
		ShowGoalTips();
	}
}

function OpenXml2()
{
	try
	{
		xmlhttp2.open("Get", "livedata/sxl_" + live_f.GetFlagNum + ".xml?" + Date.parse(new Date()), true);
		xmlhttp2.onreadystatechange = livexmlonreadystatechange2;
		xmlhttp2.send(null);
	}
	catch(e)
	{
	}
}

function livexmlonreadystatechange2()
{
	if (xmlhttp2.readyState != 4 || (xmlhttp2.status != 200 && xmlhttp2.status != 0))
		return;
	if(isIE)
	{
		XmlDoc2 = xmlhttp2.responseXML;
		if(XmlDoc2.xml == "")
			return;
	}
	else
	{
		XmlDoc2 = parser.parseFromString(xmlhttp2.responseText, "text/xml");
		if(XmlDoc2.documentElement.tagName == "parsererror")
			return;
	}
	GoalTips = "";
	GoalTips_Count = 0;
	var root = XmlDoc2.documentElement;
	var cNode = root.getElementsByTagName("C");
	for(var i=0;i<cNode.length;++i)
		eval('Update_Live(' + cNode[i].firstChild.nodeValue +')');
	live_f.GetFlagNum =	parseInt(root.getElementsByTagName("fn")[0].firstChild.nodeValue);
	if(GoalSound && SelectGoalSound)
	{
		PlaySound();
		GoalSound = false;
	}
	if (GoalTips_Count > 0)
	{
		ShowGoalTips();
	}
}

function InsertInfo(c0,c1,c2,c3)
{
	last_info.insertRow(0);
	last_info.rows[0].insertCell(0);
	last_info.rows[0].cells[0].colSpan = 4;
	last_info.rows[0].cells[0].align = "center";
	last_info.rows[0].cells[0].innerHTML = "<img src=http://img.7m.cn/icon/shade.gif width=100% height=1>"
	last_info.insertRow(0);
	last_info.rows[0].insertCell(0);
	last_info.rows[0].insertCell(0);
	last_info.rows[0].insertCell(0);
	last_info.rows[0].insertCell(0);
	last_info.rows[0].cells[0].innerHTML = c0;
	last_info.rows[0].cells[1].innerHTML = c1;
	last_info.rows[0].cells[2].align = "center";
	last_info.rows[0].cells[2].innerHTML = c2;
	last_info.rows[0].cells[3].align = "right";
	last_info.rows[0].cells[3].innerHTML = c3;
	last_info.rows[0].cells[0].width = "9%";
	last_info.rows[0].cells[1].width = "38%";
	last_info.rows[0].cells[2].width = "15%";
	last_info.rows[0].cells[3].width = "38%";
	if (last_info.rows.length >= 70)
	{
		for(var i=0;i<4;i++)
			last_info.deleteRow(last_info.rows.length - 1);
	}
}

var jqsy2 = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="1" height="1" id="v' + 'o' + 'i" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="img/v' + 'o' + 'i' + '.' + 's' + 'w' + 'f" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="img/v' + 'o' + 'i' + '.' + 's' + 'w' + 'f" quality="high" bgcolor="#ffffff" width="1" height="1" name="v' + 'o' + 'i" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>';var voiobj;function goaltips(){if (document.getElementById("bs2").innerHTML == ""){document.getElementById("bs2").innerHTML = jqsy2;voiobj = (document.embeds.length) ? document.embeds["voi"] : document.getElementById("voi");}}var getcfed = false;function GetCF(){if (!getcfed && voiobj != null){try{voiobj.GCF(voi_lng);getcfed = true;}catch(e){}}}function SetVoiLs(v){if (voiobj != null){try{voiobj.SetList(v);}catch(e){}}}
var voiArr = new Array();
function SelectVoi(chkobj, bh)
{
	if (chkobj.checked)
	{
		GetCF();
		SetVoiLs(live_f.sDt[bh][9]);SetVoiLs("#VS");SetVoiLs(live_f.sDt[bh][10]);
		voiArr[bh] = 1;
	}
	else
	{
		voiArr[bh] = null;
	}
}

function Replace_Team_name(str)
{
	var rltstr = str;
	if (live_f.Encode == "en" || live_f.Encode == "vn")
	{
		if (rltstr.length > 21)
			rltstr = rltstr.substring(0, 21);
	}
	else
	{
		if (rltstr.length > 8)
			rltstr = rltstr.substring(0, 8);
	}	
	return rltstr.replace("(中)", "").replace("(H)", "");
}

function MoveGame(bh)
{
	if (document.getElementById("gameover") != null)
	{
		if (gameover.style.display == "none")
			gameover.style.display = "";
	}
	if (EndGamebh.indexOf("[" + bh + "]") == -1)
	{
		var row1 = document.getElementById("bh" + bh);
		if (row1 == null)
			return;
		var row2 = document.getElementById("resume_" + bh)
		row1.parentNode.appendChild(row1);
		row2.parentNode.appendChild(row2);
		EndGamebh += "[" + bh + "]";
		if ((live_Table.rows[0].id == "" && live_Table.rows[1].id == "") || (live_Table.rows[0].id == "" && live_Table.rows[1].id == "gameover"))
			live_Table.deleteRow(0);
	}
}

function ChkIe()
{
	var isMinIE4 = (document.all) ? 1 : 0;
	var verDetail = 0;
	try{
		verDetail = parseFloat(navigator.appVersion.substring(navigator.appVersion.indexOf("MSIE")+4));
	}
	catch(e){
		verDetail = 0;
	}
	var isMinIE55 = (isMinIE4 && verDetail > 5) ? 1 : 0;
	var bcontinue = true;
	if(!isMinIE55){
		bcontinue = false;
	}
	return bcontinue;
}

function Gold(live,bf,an,bn,Class,glColor)
{
	GoalTips += '<span style="width: 100%;height: 6px;font-size: 1px;"></span>' +
				'<span style="width: 100%;background: #FFFFFF;font-size: 14px;">' +
				'<span style="width: 26%;color: #FFFFFF;text-align: center;font-weight: bold;padding-top: 3px;padding-bottom: 2px;background: ' + glColor + ';">' + Class + '</span>' +
				'<span style="background-color: #FFFFFF;width: 32%;font-size: 14px;padding-top: 3px;padding-bottom: 2px;padding-left: 3px;text-align: right;word-break: break-all;">' + an + '</span>' +
				'<span style="background-color: #FFFFFF;width: 8%;font-size: 14px;padding-top: 3px;padding-bottom: 2px;text-align: center;word-break: break-all;">' + bf + '</span>' +
				'<span style="background-color: #FFFFFF;width: 32%;font-size: 14px;padding-top: 3px;padding-bottom: 2px;padding-right: 3px;text-align: left;word-break: break-all;">' + bn + '</span>' +
				'</span>';
	GoalTips_Count++;
}

var TipsC = 30;
function ShowGoalTips()
{
	if (isIE)
	{
		tipswidth = GOAL_TIPS_WIDTH;
		tipsheight = GoalTips_Count * 27 - 1;
		GoalTips = 	'<div style="border: 1px solid #999999;width: ' + tipswidth + 'px;background: #FFFFFF;">' +
						'<div style="border: 1px solid #FFFFFF;font-size: 12px;background: #EFEFEF;padding: 2px;">' +
							'<span style="color: #FFFFFF;font-size: 12px;background: #006633;font-family: Tahoma;font-weight: bold;text-align: right;padding-top: 2px;padding-bottom: 2px;padding-right: 6px;width: 100%;height: 19px;">www.7m.cn</span>' + GoalTips + 
						'</div>' +
					'</div>';
		sPopup = window.createPopup();
		sPopupBody = sPopup.document.body;
		sPopupBody.style.cursor="pointer";
		sPopupBody.innerHTML = GoalTips;
		sPopup.document.body.onmouseover = new Function("clearTimeout(topMost)");
		sPopup.document.body.onmouseout = PopupSoccerShow;
		sPopup.document.body.oncontextmenu = PopupSoccerClose;
		sPopup.document.body.onclick = PopupSoccerClose;
		TipsC = 30;
		PopupSoccerShow();
	}
}

function PopupSoccerShow()
{
	sPopup.show(screen.width / 2 - (tipswidth / 2), 0, tipswidth, 28 + tipsheight);
	if (typeof(topMost) == "number")
		clearTimeout(topMost);
	topMost=setTimeout("PopupSoccerShow()", 500);
	sPopupS = true;
	if (TipsC < 0)
		PopupSoccerClose();
	--TipsC;
}

function PopupSoccerClose()
{
	clearTimeout(topMost);
	sPopup.hide();
	sPopupS = false;
}

function SpeakSetting(ecd)
{
	var obj = document.getElementById("speak_setting");
	if (obj.innerHTML == "")
		obj.innerHTML = '<iframe src="speak_setting_' + ecd + '.htm" frameborder="0" width="220" height="150"></iframe>';
	with(obj.style)
	{
		left = (document.body.clientWidth-parseInt(width))/2;
		top = (document.body.clientHeight-parseInt(height))/3;
		display = "";
	}
}

function CloseSpeakSetting(ecd)
{
	document.getElementById("speak_setting").style.display = "none";
}