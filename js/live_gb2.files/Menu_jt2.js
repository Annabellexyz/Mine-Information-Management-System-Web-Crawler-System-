var minute = new Date().getMinutes();
var prot = new Date().getSeconds();
minute = minute.toString().substring(minute.toString().length-1,minute.toString().length);
prot = prot.toString().substring(prot.toString().length-1,prot.toString().length);
if ((parseInt(minute) % 2) == 0)
	prot = (prot == "0") ? "8090" : "808" + prot;
else
	prot = (prot == "0") ? "10010" : "1000" + prot;
if (typeof(hk) == "undefined")
	var hk = 0;
var menu_www_host = "http://www.7m.cn";
var menu_data_host = "http://data.7m.cn";

function openMenu(cur)
{
	try
	{
		document.getElementById(cur).style.visibility = 'visible';
	}
	catch(e)
	{
	}
}

function closeMenu(cur)
{
	try
	{
		document.getElementById(cur).style.visibility = 'hidden';
	}
	catch(e)
	{
	}
}

var menu_code = '<table border="0" cellpadding="0" cellspacing="0" width="100%">' +
					'<tr>' +
						'<td width="11" height="45" class="ns_tnbg4"></td>' +
						'<td width="418" class="ns_tnbg5">' +
							'<table border="0" cellpadding="2" cellspacing="0" width="100%">' +
								'<tr align="left">' +
									'<td width="6"></td>' +
									'<td><a href="http://www.7m.cn" class="ns_tl1" target="_top">首页</a>&nbsp;</td>' +
									'<td>' +
									'<span onmouseover="openMenu(\'menu_v1\')" onmouseout="closeMenu(\'menu_v1\')"><a href="' + menu_www_host + ":" + prot + '/default_split_gb.aspx?line=no" class="ns_tl1" target="_top">足球比分</a>&nbsp;</span>' +
									'<div id="L1" style="z-index:1" class="LayerT1">' +
										'<div id="menu_v1" style="z-index:1" class="LayerT2" style="width: 80px;" onmouseover="openMenu(\'menu_v1\')" onmouseout="closeMenu(\'menu_v1\')">' +
											'<div class="menu_sp1" style="width: 80px;"></div>' +
											'<div class="menu" style="width: 80px; border-top: 1px solid #0A246A;" id="m1s1" onmouseover="sColor1(\'m1s1\')" onmouseout="sColor2(\'m1s1\')"><a href="' + menu_www_host + ":" + prot + '/default_split_gb.aspx?view=all&line=no" class="tmlct1" target="_top">分栏完全版</a></div>' +
											'<div class="menu" style="width: 80px;" id="m1s2" onmouseover="sColor1(\'m1s2\')" onmouseout="sColor2(\'m1s2\')"><a href="' + menu_www_host + ":" + prot + '/default_split_gb.aspx?view=simplify&line=no" class="tmlct1" target="_top">分栏精简版</a></div>' +
											'<div class="menu" style="width: 80px;" id="m1s3" onmouseover="sColor1(\'m1s3\')" onmouseout="sColor2(\'m1s3\')"><a href="' + menu_www_host + ":" + prot + '/default_gb.aspx?view=all&line=no" class="tmlct1" target="_top">单栏完全版</a></div>' +
											'<div class="menu" style="width: 80px;" id="m1s4" onmouseover="sColor1(\'m1s4\')" onmouseout="sColor2(\'m1s4\')"><a href="' + menu_www_host + ":" + prot + '/default_gb.aspx?view=simplify&line=no" class="tmlct1" target="_top">单栏精简版</a></div>' +
											'<div class="menu_b" style="width: 80px;"></div>' +
										'</div>' +
									'</div>' +
									'</td>' +
									'<td>' +
									'<span onmouseover="openMenu(\'menu_v2\')" onmouseout="closeMenu(\'menu_v2\')"><a href="' + menu_www_host + ":" + prot + '/pk_live_gb.aspx?line=no" class="ns_tl1" target="_top">比分指数2in1</a>&nbsp;</span>' +
									'<div id="L2" style="z-index:1" class="LayerT1">' +
										'<div id="menu_v2" style="z-index:1" class="LayerT2" style="width: 80px;" onmouseover="openMenu(\'menu_v2\')" onmouseout="closeMenu(\'menu_v2\')">' +
											'<div class="menu_sp1" style="width: 80px;"></div>' +
											'<div class="menu" style="width: 80px; border-top: 1px solid #0A246A;" id="m2s1" onmouseover="sColor1(\'m2s1\')" onmouseout="sColor2(\'m2s1\')"><a href="' + menu_www_host + ":" + prot + '/pk_live_gb.aspx?view=all&line=no" class="tmlct1" target="_top">完全版</a></div>' +
											'<div class="menu" style="width: 80px;" id="m2s2" onmouseover="sColor1(\'m2s2\')" onmouseout="sColor2(\'m2s2\')"><a href="' + menu_www_host + ":" + prot + '/pk_live_gb.aspx?view=simplify&line=no" class="tmlct1" target="_top">精简版</a></div>' +
											'<div class="menu_b" style="width: 80px;"></div>' +
										'</div>' +
									'</div>' +
									'</td>' +
									'<td><a href="http://www.zzc.cn/" class="ns_tl1" target="_blank">足彩</a>&nbsp;</td>' +
									'<td>' +
									'<span onmouseover="openMenu(\'menu_v3\')" onmouseout="closeMenu(\'menu_v3\')"><a href="http://am.7m.hk/gb/winodds.shtml" class="ns_tl1" target="_blank">指数</a>&nbsp;</span>' +
									'<div id="L3" style="z-index:1" class="LayerT1">' +
										'<div id="menu_v3" style="z-index:1" class="LayerT2" style="width: 80px;" onmouseover="openMenu(\'menu_v3\')" onmouseout="closeMenu(\'menu_v3\')">' +
											'<div class="menu_sp1" style="width: 80px;"></div>' +
											'<div class="menu" style="width: 80px; border-top: 1px solid #0A246A;" id="m3s1" onmouseover="sColor1(\'m3s1\')" onmouseout="sColor2(\'m3s1\')"><a href="http://am.7m.hk/gb/winodds.shtml" target="_blank" class="tmlct1">足球</a></div>' +
											'<div class="menu" style="width: 80px;" id="m3s2" onmouseover="sColor1(\'m3s2\')" onmouseout="sColor2(\'m3s2\')"><a href="http://bam.7m.hk/gb/winodds.shtml" target="_blank" class="tmlct1">篮球</a></div>' +
											'<div class="menu_b" style="width: 80px;"></div>' +
										'</div>' +
									'</div>' +
									'</td>' +
									'<td><a href="http://news.7m.cn/news/newsData/default/default.shtml" class="ns_tl1" target="_blank">足球资讯</a>&nbsp;</td>' +
									'<td><a href="' + menu_data_host + '/database/index_gb.htm" class="ns_tl1" target="_blank">资料库</a>&nbsp;</td>' +
									'<td><a href="http://free.7m.cn/apply_jt.aspx" class="ns_tl1" target="_blank">调用</a>&nbsp;</td>' +
									'<td><a href="http://data.7m.cn/wap.htm" class="ns_tl1" target="_blank">无线</a></td>' +
								'</tr>' +
							'</table>' +
							'<table border="0" cellpadding="2" cellspacing="0" width="55%">' +
								'<tr align="left">' +
									'<td width="6"></td>' +
									'<td><a href="http://basket.7m.cn/default_gb.aspx" class="ns_tl1" target="_blank">篮球比分</a>&nbsp;</td>' +
									'<td><a href="http://lc.7m.cn/" class="ns_tl1" target="_blank">篮彩</a>&nbsp;</td>' +
									'<td><a href="http://bnews.7m.cn/news/newsData/default/default.shtml" class="ns_tl1" target="_blank">篮球资讯</a>&nbsp;</td>' +
									'<td><a href="http://tennis.7m.cn/default_gb.aspx" class="ns_tl1" target="_blank">网球比分</a></td>' +
								'</tr>' +
							'</table>' +
						'</td>' +
						'<td width="11" class="ns_tnbg6"></td>' +
					'</tr>' +
				'</table>';
document.write(menu_code);