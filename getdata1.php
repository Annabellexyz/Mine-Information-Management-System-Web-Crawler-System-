<HTML>
<HEAD>
<TITLE>采集首页</TITLE>
<?php
set_time_limit(0);
include_once("cprogbar.php");
include_once("function.php");
include_once('common.php');

$err=0;
$progbar=new CProgbar("采集任务1");

//print("<p><b>采集任务1</b><br>".$progbar->show()."<p>");
//$progbar->init();
if($par=='day')
{
	$day=mktime(0,0,0,date('m'),date('d')-26,date('Y'));
	$lastday=mktime(0,0,0,1,1,2007);
	//	$lastday=mktime(0,0,0,date('m'),date('d'),date('Y'));
	while ($day>=$lastday) //建立日期循环函数
	{
		$progbar->step();
		$date=date('Y-m-d',$day);
		$day_match='http://data.7m.cn/Result_data/'.$date.'/index_gb.js';  //某天所有比赛数据
		$str=file_get_contents($day_match);
		
		//获得主队编号
		$str=substr($str,strpos($str,'Team_A_bh_Arr'));
$ht_bhs=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//获得客队编号
$str=substr($str,strpos($str,'Team_B_bh_Arr'));
$gt_bhs=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//获得主队队名
$str=substr($str,strpos($str,'Team_A_Arr'));
$ht_names=new_iconv(new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1))));

//获得客队队名
$str=substr($str,strpos($str,'Team_B_Arr'));
$gt_names=new_iconv(new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1))));

//获得联赛编号
$str=substr($str,strpos($str,'Match_bh_Arr'));
$L_bhs=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//获得联赛类型名称
$str=substr($str,strpos($str,'Match_name_Arr'));
$L_names=new_iconv(new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1))));

//获得比赛半场比分
$str=substr($str,strpos($str,'banc_Arr'));
$m_halfs=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//获得比赛时间，格式2008,02,21,01,00,0（年,月,日,小时,分钟,秒）
$str=substr($str,strpos($str,'Start_time_Arr')); 
$m_days=new_trim(explode('\',\'',substr($str,strpos($str,'[\'')+2,strpos($str,'\']')-strpos($str,'[')-2)));
$m_times=array();
foreach ($m_days as $k => $v) 
{
	$m_days[$k]=str_replace(',','-',substr($v,0,10));
	$m_times[$k]=str_replace(',',':',substr($v,11,5));
}
//获得主队进球
$str=substr($str,strpos($str,'live_a_Arr'));
$ht_scores=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//获得客队进球
$str=substr($str,strpos($str,'live_b_Arr'));
$gt_scores=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//获得比赛赛事编号
$str=substr($str,strpos($str,'live_bh_Arr'));
$m_bhs=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//$progbar->text($day);
//echo $day.' ';
		foreach ($ht_bhs as $k => $v )
		{
			//插入数据库
			$point=$ht_scores[$k].'-'.$gt_scores[$k];
			$query=$db->query("select * from myself_matches where day='$m_days[$k]' and typename='$L_names[$k]' and hometeam='$ht_names[$k]' and points='$point' and guestteam='$gt_names[$k]' and halfpoints='$m_halfs[$k]'");
			if($db->num_rows($query))
			{
				continue;
			}
			else 
			{
				$query=$db->query("insert into myself_matches(day,time,typename,hometeam,points,guestteam,halfpoints) values('$m_days[$k]','$m_times[$k]','$L_names[$k]','$ht_names[$k]','$point','$gt_names[$k]','$m_halfs[$k]')");
				if($db->affected_rows($query))
				{
					$successed=1;
				}
				else 
				{
					$successed=0;
				}
			}
		
		}
		if($successed) echo '成功采集'.$day.'数据  ';	
		$day=mktime(0,0,0,date('m',$day),date('d',$day)-1,date('Y',$day));  //前一天
	}
	$progbar->full();
	$progbar->text("采集任务1 完成");

}
elseif($par=='team')
{
	$teamid=1;
	$total=1;
//	while ($teamid<=$total) 
//	{
		$team_info='http://data.7m.cn/Team_Data/'.$teamid.'/gb/dt.js';   //球队资料，简体
//		$team_info2='http://data.7m.cn/Team_Data/'.$teamid.'/big/dt.js';  //球队资料，繁体
//		$str=file_get_contents($team_info);
//		$str2=file_get_contents($team_info2);
		
		//获得球队编号
//		$str=substr($str,strpos($str,'team_bh'));
//		$team_bh=new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1));
		
		echo $team_info.' ';
		$teamid +=1;
//		flush();
//	}
//	$progbar->full();
//	$progbar->text("采集任务1 完成");
}
else 
{
	echo '参数不正确！';
}

?>
</BODY>
</HTML>