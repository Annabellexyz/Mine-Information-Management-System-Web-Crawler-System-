var hk = 0;

function Request(Variable)
{
	var query = location.search;
	if (query != "")
	{
		query = query.split("?")[1];
		query = query.split("&");
		for (var i=0;i<query.length;i++)
		{
			var querycoll = query[i].split("=");
			if (querycoll.length == 2)
			{
				if (querycoll[0].toUpperCase() == Variable.toUpperCase())
				{
					return querycoll[1];
					break;
				}
			}
		}
	}
	return "";
}

var datahost = "ctc.data.7m.cn";

function Team_big(id)
{
	window.open("http://" + datahost + "/Team_Data/default_big.shtml?id=" + id);
}

function Team_gb(id)
{
	window.open("http://" + datahost + "/Team_Data/default_gb.shtml?id=" + id);
}

function Team_en(id)
{
	window.open("http://" + datahost + "/Team_Data/default_en.shtml?id=" + id);
}

function Team_vn(id)
{
	window.open("http://" + datahost + "/Team_Data/default_vn.shtml?id=" + id);
}

function Team_th(id)
{
	window.open("http://" + datahost + "/Team_Data/default_en.shtml?id=" + id);
}

function Team_his_big(id)
{
	window.open("http://" + datahost + "/Team_Data/Team_his_big.aspx?id=" + id);
}

function Team_his_gb(id)
{
	window.open("http://" + datahost + "/Team_Data/Team_his_gb.aspx?id=" + id);
}

function Team_his_en(id)
{
	window.open("http://" + datahost + "/Team_Data/Team_his_en.aspx?id=" + id);
}

function Team_his_vn(id)
{
	window.open("http://" + datahost + "/Team_Data/Team_his_en.aspx?id=" + id);
}

function Team_his_th(id)
{
	window.open("http://" + datahost + "/Team_Data/Team_his_en.aspx?id=" + id);
}

function Player_big(id)
{
	window.open("http://" + datahost + "/Player_Data/" + id + "/big/index.shtml");
}

function Player_gb(id)
{
	window.open("http://" + datahost + "/Player_Data/" + id + "/gb/index.shtml");
}

function Player_en(id)
{
	window.open("http://" + datahost + "/Player_Data/" + id + "/en/index.shtml");
}

function Player_vn(id)
{
	window.open("http://" + datahost + "/Player_Data/default_vn.shtml?id=" + id);
}

function Player_th(id)
{
	window.open("http://" + datahost + "/Player_Data/" + id + "/en/index.shtml");
}

function ShowDetails_big(id)
{
	window.open("http://" + datahost + ":13000/GoalData/default_big.shtml?id=" + id,"","width=480,height=440,scrollbars=yes");
}

function ShowDetails_gb(id)
{
	window.open("http://" + datahost + ":13000/GoalData/default_gb.shtml?id=" + id,"","width=480,height=440,scrollbars=yes");
}

function ShowDetails_en(id)
{
	window.open("http://" + datahost + ":13000/GoalData/default_en.shtml?id=" + id,"","width=480,height=440,scrollbars=yes");
}

function ShowDetails_vn(id)
{
	window.open("http://" + datahost + ":13000/GoalData/default_vn.shtml?id=" + id,"","width=480,height=440,scrollbars=yes");
}

function ShowDetails_th(id)
{
	window.open("http://" + datahost + ":13000/GoalData/default_th.shtml?id=" + id,"","width=480,height=440,scrollbars=yes");
}
/*
function ShowPk_big(id)
{
	window.open("http://" + datahost + "/Odds_analyse/big/" + id + ".shtml");
}

function ShowPk_gb(id)
{
	window.open("http://" + datahost + "/Odds_analyse/big/" + id + ".shtml");
}
*/
function ShowPk_big(id)
{
	window.open("http://data.7m.hk/Odds_Analyse.htm?lng=big&id=" + id);
}

function ShowPk_gb(id)
{
	window.open("http://data.7m.hk/Odds_Analyse.htm?lng=big&id=" + id);
}

function ShowPk_en(id)
{
	window.open("http://" + datahost + "/Odds_analyse/flash/index_en.aspx?id=" + id);
}

function ShowPk_vn(id)
{
	window.open("http://" + datahost + "/Odds_analyse/flash/index_en.aspx?id=" + id);
}

function ShowPk_th(id)
{
	window.open("http://" + datahost + "/Odds_analyse/flash/index_en.aspx?id=" + id);
}

function ShowAnalyse_big(id)
{
	window.open("http://" + datahost + "/Analyse/default_big.shtml?id=" + id);
}

function ShowAnalyse_gb(id)
{
	window.open("http://" + datahost + "/Analyse/default_gb.shtml?id=" + id);
}

function ShowAnalyse_en(id)
{
	window.open("http://" + datahost + "/Analyse/default_en.shtml?id=" + id);
}

function ShowAnalyse_vn(id)
{
	window.open("http://" + datahost + "/Analyse/default_vn.shtml?id=" + id);
}

function ShowAnalyse_th(id)
{
	window.open("http://" + datahost + "/Analyse/default_en.shtml?id=" + id);
}

function Country_big(id)
{
	window.open("http://" + datahost + "/Country_Data/" + id + "/big/index.shtml");
}

function Country_gb(id)
{
	window.open("http://" + datahost + "/Country_Data/" + id + "/gb/index.shtml");
}

function Country_en(id)
{
	window.open("http://" + datahost + "/Country_Data/" + id + "/en/index.shtml");
}

function Country_vn(id)
{
	window.open("http://" + datahost + "/Country_Data/" + id + "/vn/index.shtml");
}

function Country_th(id)
{
	window.open("http://" + datahost + "/Country_Data/" + id + "/en/index.shtml");
}

function Stadium_big(id)
{
	window.open("http://" + datahost + "/Stadium_Data/" + id + "/index_big.shtml");
}

function Stadium_gb(id)
{
	window.open("http://" + datahost + "/Stadium_Data/" + id + "/index_gb.shtml");
}

function Stadium_en(id)
{
	window.open("http://" + datahost + "/Stadium_Data/" + id + "/index_en.shtml");
}

function Stadium_vn(id)
{
	window.open("http://" + datahost + "/Stadium_Data/" + id + "/index_en.shtml");
}

function Stadium_th(id)
{
	window.open("http://" + datahost + "/Stadium_Data/" + id + "/index_en.shtml");
}

function Referee_big(id)
{
	window.open("http://" + datahost + "/Referee_data/" + id + "/index_big.shtml");
}

function Referee_gb(id)
{
	window.open("http://" + datahost + "/Referee_data/" + id + "/index_gb.shtml");
}

function Referee_en(id)
{
	window.open("http://" + datahost + "/Referee_data/" + id + "/index_en.shtml");
}

function Referee_vn(id)
{
	window.open("http://" + datahost + "/Referee_data/" + id + "/index_en.shtml");
}

function Referee_th(id)
{
	window.open("http://" + datahost + "/Referee_data/" + id + "/index_en.shtml");
}

function t_History_OddsAway_big(path, id)
{
	window.open("http://" + datahost + "/Team_History_Odds_Data/" + path + "/" + id + "/Total/index_big.htm", "", "width=620,height=500,scrollbars=yes");
}

function t_History_OddsAway_gb(path, id)
{
	window.open("http://" + datahost + "/Team_History_Odds_Data/" + path + "/" + id + "/Total/index_gb.htm", "", "width=620,height=500,scrollbars=yes");
}

function t_History_OddsAway_en(path, id)
{
	window.open("http://" + datahost + "/Team_History_Odds_Data/" + path + "/" + id + "/Total/index_en.htm", "", "width=620,height=500,scrollbars=yes");
}

function t_History_OddsAway_vn(path, id)
{
	window.open("http://" + datahost + "/Team_History_Odds_Data/" + path + "/" + id + "/Total/index_en.htm", "", "width=620,height=500,scrollbars=yes");
}

function t_History_OddsAway_th(path, id)
{
	window.open("http://" + datahost + "/Team_History_Odds_Data/" + path + "/" + id + "/Total/index_en.htm", "", "width=620,height=500,scrollbars=yes");
}

function h_History_OddsAway_big(path, id)
{
	window.open("http://" + datahost + "/Team_History_Odds_Data/" + path + "/" + id + "/Home/index_big.htm", "", "width=620,height=500,scrollbars=yes");
}

function h_History_OddsAway_gb(path, id)
{
	window.open("http://" + datahost + "/Team_History_Odds_Data/" + path + "/" + id + "/Home/index_gb.htm", "", "width=620,height=500,scrollbars=yes");
}

function h_History_OddsAway_en(path, id)
{
	window.open("http://" + datahost + "/Team_History_Odds_Data/" + path + "/" + id + "/Home/index_en.htm", "", "width=620,height=500,scrollbars=yes");
}

function h_History_OddsAway_vn(path, id)
{
	window.open("http://" + datahost + "/Team_History_Odds_Data/" + path + "/" + id + "/Home/index_en.htm", "", "width=620,height=500,scrollbars=yes");
}

function h_History_OddsAway_th(path, id)
{
	window.open("http://" + datahost + "/Team_History_Odds_Data/" + path + "/" + id + "/Home/index_en.htm", "", "width=620,height=500,scrollbars=yes");
}

function a_History_OddsAway_big(path, id)
{
	window.open("http://" + datahost + "/Team_History_Odds_Data/" + path + "/" + id + "/Away/index_big.htm", "", "width=620,height=500,scrollbars=yes");
}

function a_History_OddsAway_gb(path, id)
{
	window.open("http://" + datahost + "/Team_History_Odds_Data/" + path + "/" + id + "/Away/index_gb.htm", "", "width=620,height=500,scrollbars=yes");
}

function a_History_OddsAway_en(path, id)
{
	window.open("http://" + datahost + "/Team_History_Odds_Data/" + path + "/" + id + "/Away/index_en.htm", "", "width=620,height=500,scrollbars=yes");
}

function a_History_OddsAway_vn(path, id)
{
	window.open("http://" + datahost + "/Team_History_Odds_Data/" + path + "/" + id + "/Away/index_en.htm", "", "width=620,height=500,scrollbars=yes");
}

function a_History_OddsAway_th(path, id)
{
	window.open("http://" + datahost + "/Team_History_Odds_Data/" + path + "/" + id + "/Away/index_en.htm", "", "width=620,height=500,scrollbars=yes");
}

function zlk_big(id)
{
	window.open("http://" + datahost + "/matches_data/" + id + "/big/index.shtml");
}

function zlk_gb(id)
{
	window.open("http://" + datahost + "/matches_data/" + id + "/gb/index.shtml");
}

function zlk_en(id)
{
	window.open("http://" + datahost + "/matches_data/" + id + "/en/index.shtml");
}

function zlk_vn(id)
{
	window.open("http://" + datahost + "/matches_data/" + id + "/en/index.shtml");
}

function zlk_th(id)
{
	window.open("http://" + datahost + "/matches_data/" + id + "/en/index.shtml");
}

function ShowRPk_big(id)
{
	window.open("http://royal.7m.cn:18000/chart.htm?ecd=0&id=" + id);
}

function ShowRPk_gb(id)
{
	window.open("http://royal.7m.cn:18000/chart.htm?ecd=1&id=" + id);
}

function ShowRPk_en(id)
{
	window.open("http://royal.7m.cn:18000/chart.htm?ecd=2&id=" + id);
}

function ShowRPk_vn(id)
{
	window.open("http://royal.7m.cn:18000/chart.htm?ecd=2&id=" + id);
}

function ShowRPk_th(id)
{
	window.open("http://royal.7m.cn:18000/chart.htm?ecd=2&id=" + id);
}
/*
function ShowCPk_big(id)
{
	window.open("http://crowns.7m.cn:18010/chart.htm?ecd=0&id=" + id);
}

function ShowCPk_gb(id)
{
	window.open("http://crowns.7m.cn:18010/chart.htm?ecd=1&id=" + id);
}
*/
function ShowCPk_big(id)
{
	window.open("http://crowns.7m.hk/chart.htm?ecd=0&id=" + id);
}

function ShowCPk_gb(id)
{
	window.open("http://crowns.7m.hk/chart.htm?ecd=1&id=" + id);
}
function ShowCPk_en(id)
{
	window.open("http://crowns.7m.cn:18010/chart.htm?ecd=2&id=" + id);
}

function ShowCPk_vn(id)
{
	window.open("http://crowns.7m.cn:18010/chart.htm?ecd=2&id=" + id);
}

function ShowCPk_th(id)
{
	window.open("http://crowns.7m.cn:18010/chart.htm?ecd=2&id=" + id);
}
/*
function ShowLBPk_big(id)
{
	window.open("http://" + datahost + "/Odds_analyse/chart.htm?ecd=0&id=" + id);
}

function ShowLBPk_gb(id)
{
	window.open("http://" + datahost + "/Odds_analyse/chart.htm?ecd=1&id=" + id);
}
*/
function ShowLBPk_big(id)
{
	window.open("http://data.7m.hk/lb_Odds_Analyse.htm?ecd=0&id=" + id);
}

function ShowLBPk_gb(id)
{
	window.open("http://data.7m.hk/lb_Odds_Analyse.htm?ecd=1&id=" + id);
}
function ShowLBPk_en(id)
{
	window.open("http://" + datahost + "/Odds_analyse/chart.htm?ecd=2&id=" + id);
}

function ShowLBPk_vn(id)
{
	window.open("http://" + datahost + "/Odds_analyse/chart.htm?ecd=2&id=" + id);
}

function ShowLBPk_th(id)
{
	window.open("http://" + datahost + "/Odds_analyse/chart.htm?ecd=2&id=" + id);
}
/*
function Show1x2_big(id)
{
	window.open("http://1x2.7m.cn/list_big.shtml?id=" + id);
}

function Show1x2_gb(id)
{
	window.open("http://1x2.7m.cn/list_gb.shtml?id=" + id);
}
*/
function Show1x2_big(id)
{
	window.open("http://1x2.7m.hk/list_big.shtml?id=" + id);
}

function Show1x2_gb(id)
{
	window.open("http://1x2.7m.hk/list_gb.shtml?id=" + id);
}

function Show1x2_en(id)
{
	window.open("http://1x2.7m.cn/list_en.shtml?id=" + id);
}

function Show1x2_vn(id)
{
	window.open("http://1x2.7m.cn/list_vn.shtml?id=" + id);
}

function Show1x2_th(id)
{
	window.open("http://1x2.7m.cn/list_en.shtml?id=" + id);
}