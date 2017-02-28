var LANGUAGE_INDEX = 1;
var SOUND_CT = "点击：关闭提示音";
var SOUND_OT = "点击：打开提示音";
var SOUND_CSRC = "http://img.7m.cn/img2/lb_a3.gif";
var SOUND_OSRC = "http://img.7m.cn/img2/lb_a4.gif"
var WIN_CT = "点击：关闭提示窗";
var WIN_OT = "点击：打开提示窗";
var WIN_CSRC = "http://img.7m.cn/img2/twin1.gif";
var WIN_OSRC = "http://img.7m.cn/img2/twin0.gif"
var RQ_ARR = ["平手", "平/半", "半球", "半/一", "一球", "一/半", "球半", "球半/二", "二球", "二/半", "二半", "二半/三", "三球", "三/半", "三半", "三半/四", "四球", "四/半", "四半", "四半/五", "五", "五/五半", "五半", "五半/六", "六", "六/六半", "六半", "六半/七", "七"];
var STATE_ARR = ["", "上", "中", "下", "完", "断", "取", "加", "加", "加", "完", "点", "全", "延", "斩", "待", "金", ""];
var RESUME_ARR = ["90分钟", "120分钟", "点球", "100分钟", "终场", "总比分", "两回合", "加时中,现在比分"];
var WEEK_STR = "日一二三四五六".split("");
var RESULE_STR = "最新赛果";
var FIXTURE_LINK = "<a href=\"http://data.7m.cn/fixture_data/sc_jt1.shtml\" target=\"_top\">查看最新赛程</a>";
var LIVE_TABLE_HEAD = ["&nbsp;", "赛事", "时间", "&nbsp;", "主队", "比分", "客队", "半", "&nbsp;", "&nbsp;"];
var PK_LINK_FUN_NAME = "ShowPk_gb";
var RPK_LINK_FUN_NAME = "ShowCPk_gb";
var LBPK_LINK_FUN_NAME = "ShowLBPk_gb";
var TEAM_LINK_FUN_NAME = "Team_gb";
var DETAILS_LINK_FUN_NAME = "ShowDetails_gb";
var ANALYSE_LINK_FUN_NAME = "ShowAnalyse_gb";
var EURO1X2_LINK_FUN_NAME = "Show1x2_gb";
var ZLK_LINK_FUN_NAME = "zlk_gb";
var ANALYSE_STR = "析";
var EURO1X2_STR = "标";
var ASSIGN_BEFORE_STR = "之前受让";
var BEFORE_STR = "之前";
var CURRENT_WIN_STR = "√";
var GOAL_TIPS_WIDTH = 400;
var SPEAK_TITLE = "语音播报";
var WEATHER_ARR = ["", "晴天", "少云", "多云", "阴天", "小雨", "中到大雨", "雷阵雨", "雷暴", "小雪", "大雨", "晴天", "晴间多云", "少云", "多云", "雨加雪", "", "", "晴间多云", "小雷雨", "小阵雨", "汽雾", "冻雾", "零星小雨", "中雨", "小阵雪", "细雨", "阵雪", "风尘", "低空飘雪", "大阵雪", "中雪"];

function MAKEDTROW(sj, ssj)
{
	return ssj[0] + '年' + ssj[1] + '月' + ssj[2] + '日(星期' +  WEEK_STR[sj.getDay()] + ')';
}