function PopUp(Page,WinName)
{
    return showModalDialog(Page,WinName,'scrollbars=yes;resizable=no;help=no;status=no;dialogTop=130; dialogLeft=190;dialogWidth:750px;dialogHeight=490px');
}

function SelectTimeZone(Page)
{
	TimeZoneList.innerHTML = '<iframe src="' + Page + '" frameborder="0" width="660" height="455"></iframe>';
	with(TimeZoneList_div.style)
	{
		left = (document.body.clientWidth-parseInt(width))/2;
		top = (document.body.clientHeight-parseInt(height))/2;
		display = "";
	}
}

function GetCurrentTimeZone()
{
	var now = new Date();
	var tz = 0 - now.getTimezoneOffset() / 60;
	var mtz = Math.floor(tz);
	var stz = (tz - mtz) * 60;
	var tzstr = "";
	if (tz >= 0)
		tzstr = "+";
	else
		tzstr = "-";
	if (mtz == 0)
		tzstr += "0";
	if ((tz > 0 && mtz < 10) || (tz < 0 && mtz > -10))
		tzstr += "0";
	tzstr += Math.abs(mtz).toString() + Math.abs(stz).toString();
	if (stz == 0)
		tzstr += "0";
	return tzstr;
}

function CloseTimeZoneList()
{
	TimeZoneList_div.style.display = 'none';
}

var difference_Hour = 0;
var difference_Minute = 0;
var timezone_TZ = "";

function GetTimeZone(lg, DefaultTZ)	//获取时区设置
{
	if (typeof(DefaultTZ) == "undefined")
		DefaultTZ = GetCurrentTimeZone();	//默认时区

	var STZ_Hour = 8;
	var DST = false;
	var rlt = "";
	if (document.cookie.indexOf("7mTZbegin") != -1 && document.cookie.indexOf("7mTZend") != -1)
		timezone_TZ = document.cookie.substring(document.cookie.indexOf("7mTZbegin") + 10, document.cookie.indexOf("7mTZend")).toUpperCase();
	if (document.cookie.indexOf("7mDSTbegin") != -1 && document.cookie.indexOf("7mDSTend") != -1)
		DST = (document.cookie.substring(document.cookie.indexOf("7mDSTbegin") + 11, document.cookie.indexOf("7mDSTend")) == "1") ? true : false;

	if (timezone_TZ == "")
		timezone_TZ = DefaultTZ;
	
	if (timezone_TZ != "AUTO")
	{
		rlt = 'GMT' + timezone_TZ;
		var TZ_Hour = parseFloat(timezone_TZ.substring(0, 3));
		var TZ_Minute = parseFloat(timezone_TZ.substring(3, 5));
		difference_Minute = TZ_Minute;
		if (TZ_Hour < 0)
		{
			difference_Hour = 0 - (STZ_Hour - TZ_Hour);
			difference_Minute = 0 - difference_Minute;
		}
		else
		{	
			difference_Hour = TZ_Hour - STZ_Hour;
		}
	}
	else if (timezone_TZ == "AUTO")
	{
		DST = false;          //自动状况去掉夏令时cookie
		if (lg == 0)
			rlt = "自動";
		else if (lg == 1)
			rlt = "自动";
		else if (lg == 2)
			rlt = "Auto";
		else if (lg == 3)
			rlt = "Tự động";
		else if (lg == 4)
			rlt = "อัตโนมัติ";
		var LTimeZone = new Date().getTimezoneOffset() / 60;
		STZ_Hour = 0 - STZ_Hour;
		if (LTimeZone < 0)
		{
			difference_Hour = STZ_Hour - LTimeZone;
		}
		else
		{
			difference_Hour = 0 - (LTimeZone - STZ_Hour);
			difference_Minute = 0 - difference_Minute;
		}
	}
	if (DST)	//Daylight Saving Time夏令时
	{
		difference_Hour += 1;
		if (lg == 0)
			rlt += "(夏令時)";
		else if (lg == 1)
			rlt += "(夏令时)";
		else if (lg == 2)
			rlt += "(DST)";
		else if (lg == 3)
			rlt += "(Giờ mùa)";
		else if (lg == 4)
			rlt += "(DST)";
	}
	return rlt;
}

function TimeZone_formatNumber(s)
{
	if (s < 10)
		return "0" + s;
	return s;
}

function AmountTimeDiff(dateStr, rtvFormat)
{
	var date_sl = dateStr.split(",");
	var d1 = new Date(parseFloat(date_sl[0]), parseFloat(date_sl[1]) - 1, parseFloat(date_sl[2]), parseFloat(date_sl[3])+difference_Hour, parseFloat(date_sl[4])+difference_Minute, parseFloat(date_sl[5]), 0);
	var year = d1.getFullYear();
	var month = TimeZone_formatNumber(d1.getMonth() + 1);
	var day = TimeZone_formatNumber(d1.getDate());
	var hour = TimeZone_formatNumber(d1.getHours());
	var minute = TimeZone_formatNumber(d1.getMinutes());
	var second = TimeZone_formatNumber(d1.getSeconds());
	
	switch(rtvFormat)
	{
		case 0:
			return year + "," + month + "," + day + "," + hour + "," + minute + "," + second;
			break;
		case 1:
			return year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
			break;
		case 2:
			return month + "-" + day + "-" + year + " " + hour + ":" + minute + ":" + second;
			break;
		case 3:
			return year + "-" + month + "-" + day + " " + hour + ":" + minute;
			break;
		case 4:
			return day + "/" + month + "<br>" + hour + ":" + minute;
			break;
		case 5:
			return year + "" + month + "" + day + " " + hour + ":" + minute;
			break;
		case 6:
			return month + "-" + day + " " + hour + ":" + minute;
			break;
	}
}
