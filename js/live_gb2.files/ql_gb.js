function writeNav() {
	var divNav = '<table border="0" cellpadding="0" cellspacing="0" width="100%" id="qlc1"><tr><td width="100%" align="right" style="padding-right: 20px; height: 30px;">' +
	'<div class="qla0">' +
	'<div style="display: none; position: absolute;" id="divDialog" onmouseover="clearTimeout(timer)" onmouseout="timer=setTimeout(\'hideDialog()\',1000)">' +
	'	<div class="qla1" style="height: 280px;">' +
	'		<div class="qlt1">' +
	'			<span class="qlr1">&raquo;</span><span class="qlr2">快速导航：</span>' +
	'		</div>' +
	'		<div class="qld1"></div>' +
	'		<div class="qlt2">' +
	'			<table class="qltb1">' +
	'				<tr>' +
	'					<td width="37%" valign="top" rowspan="2">' +
	'					<ul class="qlul1">' +
	'						<li class="qlult1">足球</li>' +
	'						<li><a href="http://www.7m.cn/pk_live_gb.aspx?line=no" target="_blank">比分指数2合1</a></li>' +
	'						<li><a href="http://www.7m.cn/default_split_gb.aspx?view=all&line=no" target="_blank">比分分栏完全版</a></li>' +
	'						<li><a href="http://www.7m.cn/default_split_gb.aspx?view=simplify&line=no" target="_blank">比分分栏精简版</a></li>' +
	'						<li><a href="http://data.7m.cn/result_data/index_gb.shtml" target="_blank">完场赛事</a></li>' +
	'						<li><a href="http://data.7m.cn/fixture_data/default_gb.shtml?date=1" target="_blank">未来赛程</a></li>' +
	'						<li><a href="http://am.7m.hk/gb/winodds.shtml" target="_blank">澳彩让球指数</a></li>' +
	'						<li><a href="http://crowns.7m.hk/crowns_gb.aspx" target="_blank">皇冠即时参数</a></li>' +
	'						<li><a href="http://1x2.7m.hk/default_gb.shtml" target="_blank">百家欧盘</a></li>' +
	'						<li><a href="http://news.7m.cn/news/newsData/default/default.shtml" target="_blank">足球新闻</a></li>' +
	'					</ul>' +
	'					</td>' +
	'					<td width="27%" valign="top">' +
	'					<ul class="qlul1">' +
	'						<li class="qlult1">篮球</li>' +
	'						<li><a href="http://basket.7m.cn/default_gb.aspx" target="_blank">篮球比分</a></li>' +
	'						<li><a href="http://bdata.7m.cn/Result_data/index_gb.htm" target="_blank">完场赛事</a></li>' +
	'						<li><a href="http://bdata.7m.cn/Fixture_data/default_gb.aspx?date=1" target="_blank">未来赛程</a></li>' +
	'						<li><a href="http://bam.7m.hk/gb/winodds.shtml" target="_blank">澳彩篮球指数</a></li>' +
	'						<li><a href="http://lc.7m.cn/" target="_blank">篮球彩票</a></li>' +
	'						<li><a href="http://bnews.7m.cn/news/newsData/default/default.shtml" target="_blank">篮球新闻</a></li>' +
	'						<li></li>' +
	'						<li></li>' +
	'						<li class="qlult1">网球</li>' +
	'						<li><a href="http://tennis.7m.cn/default_gb.aspx" target="_blank">网球比分</a></li>' +
	'					</ul>' +
	'					</td>' +
	'					<td width="36%" valign="top">' +
	'					<ul class="qlul1">' +
	'						<li class="qlult1">其他</li>' +
	'						<li><a href="http://data.7m.cn/database/index_gb.htm" target="_blank">赛事资料库</a></li>' +
	'						<li><a href="http://data.7m.cn/transfer/index_gb.htm" target="_blank">五大联赛转会</a></li>' +
	'						<li><a href="http://free.7m.cn/apply_jt.aspx" target="_blank">免费调用</a></li>' +
	'						<li><a href="http://win.7m.cn/" target="_blank" style="color: #CC0000; font-weight: bold;">在线彩票</a></li>' +
	'						<li></li>' +
	'						<li></li>' +
	'						<li class="qlult1">热门赛事</li>' +
	'						<li><a href="http://data.7m.cn/matches_data/92/gb/index.shtml" target="_blank" style="color: #CC0000; font-weight: bold;">英超</a>&nbsp;&nbsp;<a href="http://data.7m.cn/matches_data/34/gb/index.shtml" target="_blank">意甲</a>&nbsp;&nbsp;<a href="http://data.7m.cn/matches_data/85/gb/index.shtml" target="_blank">西甲</a></li>' +
	'						<li><a href="http://data.7m.cn/matches_data/39/gb/index.shtml" target="_blank">德甲</a>&nbsp;&nbsp;<a href="http://data.7m.cn/matches_data/93/gb/index.shtml" target="_blank">法甲</a>&nbsp;&nbsp;<a href="http://data.7m.cn/database/index_gb.htm" target="_blank">更多...</a></li>' +
	'					</ul>' +
	'					</td>' +
	'				</tr>' +
	'			</table>' +
	'		</div>' +
	'	</div>' +
	'</div>' +
	'</div>' +
	'<a href="javascript:void(0);" onmouseover="showDialog(this)" onmouseout="timer=setTimeout(\'hideDialog()\',1000)" class="qll1">快速链接</a>' +
	'</td></tr></table>';
	document.write(divNav);
}

var timer;
function showDialog(obj)
{
	clearTimeout(timer);
	var divDlg = document.getElementById("divDialog");
	divDlg.style.display = "";
	//divDlg.style.left = obj.offsetLeft - divDlg.offsetWidth + 50 + "px";
	//divDlg.style.top = obj.offsetTop - divDlg.offsetHeight - 5 + "px";
	divDlg.style.left = -420 + "px";
	divDlg.style.top = -295 + "px";
}
function hideDialog()
{
	document.getElementById("divDialog").style.display="none";
}