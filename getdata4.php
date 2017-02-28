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

print("<p><b>采集任务1</b><br>".$progbar->show()."<p>");
$progbar->init();
if($par=='day')
{
	$day=mktime(0,0,0,date('m'),date('d')-1,date('Y'));	
	$lastday=mktime(0,0,0,3,3,2008);
//	$lastday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
	while ($day>=$lastday) //建立日期循环函数
	{
		$progbar->step();
		$date=date('Y-m-d',$day);
		$day_match='http://data.7m.cn/result_data/'.$date.'/index_gb.js';  //某天所有比赛数据，数据从前一天开始，后前推移
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

//获得比赛备注
$str=substr($str,strpos($str,'meno_Arr'));
$str1=substr($str,strpos($str,'[')+1,strpos($str,'];')-strpos($str,'[')-1);
$m_remarks=explode('\',\'',$str1);
//print_r($m_remarks).'<br><br>';

//获得比赛半场比分
$str=substr($str,strpos($str,'banc_Arr'));
$m_halfs=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//获得比赛时间，格式2008,02,21,01,00,0（年,月,日,小时,分钟,秒）
$str=substr($str,strpos($str,'Start_time_Arr')); 
$m_days=new_trim(explode('\',\'',substr($str,strpos($str,'\'')+1,strpos($str,'\']')-strpos($str,'\'')-1)));
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

//print_r($m_remarks);
//print_r($m_bhs);

//$progbar->text($day);
//echo $day.' ';
		foreach ($m_bhs as $k => $v )
		{
//			echo $v.' |'.$m_remarks[$k].'<br>';
//			插入数据库
//			if(!strpos($m_remarks[$k],'['))
//			{
//				continue;			   
//			}
//			else 
//			{	
				$m_remarks[$k]=str_replace(array('0[','1[','2[','\''),array('90分钟[','120分钟[','点球[',''),$m_remarks[$k]);
				$point=$ht_scores[$k].'-'.$gt_scores[$k];
				$query=$db->query("select * from myself_matches where day='$m_days[$k]' and time='$m_times[$k]' and typename='$L_names[$k]' and hometeam='$ht_names[$k]' and points='$point' and guestteam='$gt_names[$k]' and halfpoints='$m_halfs[$k]'");
				$record=$db->fetch_array($query);
				if($record)
				{					
					//update remarks
					if($record['remarks']=='' && $m_remarks[$k]!='')
					{
						$query=$db->query("update myself_matches set remarks='$m_remarks[$k]' where id='".$record['id']."'");
						if($db->affected_rows($query)) $successed=1;
					}					
				}
				else 
				{	
						$query=$db->query("insert into myself_matches(day,time,typename,hometeam,points,guestteam,halfpoints,remarks) 
						values('$m_days[$k]','$m_times[$k]','$L_names[$k]','$ht_names[$k]','$point','$gt_names[$k]','$m_halfs[$k]','$m_remarks[$k]')");
					
					if($db->affected_rows($query))
					{
						$successed=1;
					}
					else 
					{
						$successed=0;
					}
				}
//			}
		
		
		}
		if($successed) echo '成功采集'.date('Y-m-d',$day).'数据  ';	
		$day=mktime(0,0,0,date('m',$day),date('d',$day)-1,date('Y',$day));  //前一天
	}
	$progbar->full();
	$progbar->text("采集任务1 完成");

}
elseif($par=='team')
{
	$teamid=423;
	$total=7688;      //总数7688
	while ($teamid<=$total) 
	{
		$progbar->step();
		$team_info='http://data.7m.cn/Team_Data/'.$teamid.'/gb/dt.js';   //球队资料，简体
		$team_info2='http://data.7m.cn/Team_Data/'.$teamid.'/big/dt.js';  //球队资料，繁体
		$str=file_get_contents($team_info);
		$str2=file_get_contents($team_info2);
		
		//获得球队编号
		$str=substr($str,strpos($str,'team_bh'));
		$team_bh=new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1));
		if($team_bh)
		{
		$query=$db->query("select * from myself_teams where tid='$team_bh'");
		if($db->num_rows($query))
		{
			$teamid++;
			continue;
		}
		else 
		{
			//获得球队队名简体
			$str=substr($str,strpos($str,'team_name'));
			$team_name=new_iconv(new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1)));         //中英都放一起 
			$team_ename=substr($team_name,strpos($team_name,'(')+1,strpos($team_name,')')-strpos($team_name,'(')-1);     //提取英文名
			$team_name=substr($team_name,0,strpos($team_name,'('));                                                      //提取中文名
			
			//获得球队队名繁体
			$str2=substr($str2,strpos($str2,'team_name'));
			$team_fname=new_iconv(new_trim(substr($str2,strpos($str2,'=')+1,strpos($str2,';')-strpos($str2,'=')-1)));       //中英都放一起 
			$team_fname=substr($team_fname,0,strpos($team_fname,'('));     
			
			//获得球队建立年份
			$str=substr($str,strpos($str,'team_edate'));
			$team_edate=new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1));
			
			//获得国家编号
			$str=substr($str,strpos($str,'team_country_bh')+13);
			$team_country_bh=new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1));
			
			//获得国家名称简体
			$str=substr($str,strpos($str,'team_country'));
			$team_country=new_iconv(new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1)));
			
			//获得国家名称繁体
			$str2=substr($str2,strpos($str2,'team_country_bh')+13);
			$str2=substr($str2,strpos($str2,'team_country'));
			$team_fcountry=new_iconv(new_trim(substr($str2,strpos($str2,'=')+1,strpos($str2,';')-strpos($str2,'=')-1)));
			
			//获得球队所在城市简体
			$str=substr($str,strpos($str,'team_city'));
			$team_city=new_iconv(new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1)));
			
			//获得球队所在城市繁体
			$str2=substr($str2,strpos($str2,'team_city'));
			$team_fcity=new_iconv(new_trim(substr($str2,strpos($str2,'=')+1,strpos($str2,';')-strpos($str2,'=')-1)));
			
			//获得球队所在球场简体
			$str=substr($str,strpos($str,'team_stadium'));
			$team_stadium=new_iconv(new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1)));
			
			//获得球队所在球场繁体
			$str2=substr($str2,strpos($str2,'team_stadium'));
			$team_fstadium=new_iconv(new_trim(substr($str2,strpos($str2,'=')+1,strpos($str2,';')-strpos($str2,'=')-1)));
			
			//获得球队具体地址
			$str=substr($str,strpos($str,'team_addr')); 
			$team_addr=new_iconv(new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1)));
			
			//获得球场容纳总人数
			$str=substr($str,strpos($str,'team_capacity'));
			$team_capacity=str_replace(',','',new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1)));
			
			//获得球队网址
			$str=substr($str,strpos($str,'team_website'));
			$team_website=new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1));
			
//			echo $team_bh.' '.$team_name.' '.$team_ename.' '.$team_fname.' '.$team_edate.' '.$team_country_bh.' '.$team_country.' '.$team_fcountry.' '.$team_city.' '
//			.$team_fcity.' '.$team_stadium
//			.' '.$team_fstadium.' '.$team_addr.' '.$team_capacity.' '.$team_website;
			$tintro="球队建立年份：$team_edate<br>所属国家：$team_country<br>所属城市：$team_city<br>球场名称：$team_stadium<br>球场具体地址：$team_addr<br>球场容纳人数：$team_capacity<br>球队网址：$team_website";
		
			
			$query=$db->query("insert into myself_teams(tid,teamname,teamname_big,ename,tintro) values('$team_bh','$team_name','$team_fname','$team_ename','$tintro')");
			if($db->affected_rows($query))
			{
					$successed_1= '添加成功'.$team_name;
					$query=$db->query("select * from myself_country where cid='$team_country_bh'");
					if(!$db->num_rows($query))
					{
						$query=$db->query("insert into myself_country(cid, cname, cname_big) values ('$team_country_bh','$team_country','$team_fcountry')");
						if($db->affected_rows($query))
						$successed_1.=' 添加成功'.$team_country;
						else 
						$successed_1.=' 添加失败'.$team_country;
					}										
					
			}
			else 
			{
				$successed_1= '添加失败'.$team_name;
			}
			$teamid ++;
		}
		}
		else 
		{
			$teamid++;
			continue;
		}
			
		echo $successed_1.' <br>';
		
	}
	$progbar->full();
	$progbar->text("采集任务1 完成");
}
elseif($par=='delay')
{
	//近期延期比赛
	$day=mktime(0,0,0,date('m'),date('d')+1,date('Y'));  //明天的比赛数据，一般只有延期的记录
	$date=date('Y-m-d',$day);
	$day_delay_match='http://data.7m.cn/result_data/default_gb.shtml?date='.$date;  //某天所有比赛数据
	$str=file_get_contents($day_delay_match);
	
	$str=substr($str,strpos($str,'<tr><td colspan="6" class="qx_bg1">'));
	$str=substr($str,strpos($str,'</tr>')+5); //去掉一个<tr></tr>
	$str=substr($str,0,strpos($str,'</table>'));
	$delay_matches=new_iconv(new_trim(explode('</tr><tr',$str)));
	
	//对每一个delay match进行处理
	foreach ($delay_matches as $k => $v)
	{
		$progbar->step();
		if(strpos($v,'color=blue>'))
		{
			//延期原因
			$delay_matches[$k]=new_substr($v,'blue>','</font>');
		}
		else 
		{
			$v=substr($v,strpos($v,'<td')+3);
			$typename=new_substr($v,'>','</td>');
			
			$v=substr($v,strpos($v,'<td')+3);
			$daytime=new_substr($v,'>','</td>');
			$day=substr($daytime,0,strpos($daytime,' '));
			$time=substr($daytime,strpos($daytime,' ')+1);
			
			$v=substr($v,strpos($v,'<td')+3);
			$hometeam=new_substr($v,'>','</td>');
			
			$v=substr($v,strpos($v,'<td')+3);
			$v=substr($v,strpos($v,'<td')+3);
			
			$guestteam=new_substr($v,'>','</td>');		
			
			if(strpos($delay_matches[$k+1],'color=blue>')) //说明下个记录是上个记录的延期原因
			{
				$remarks=new_substr($delay_matches[$k+1],'blue>','</font>');
			}
			else 
			{
				$v=substr($v,strpos($v,'<td')+3);
				$remarks=new_substr($v,'>','</td>');
			}
			
			$query=$db->query("select * from myself_matches where day='$day' and typename='$typename' and hometeam='$hometeam' and guestteam='$guestteam'");
			if($db->num_rows($query))
			{
				continue;
			}
			else 
			{
				$query=$db->query("insert into myself_matches(day,time,typename,hometeam,guestteam,remarks) values('$day','$time','$typename','$hometeam','$guestteam','$remarks')");
				if($db->affected_rows($query))
				{
					$successed=1;
				}
				else 
				{
					$successed=0;
				}
			}			
			if($successed) 
			echo $day.','.$time.','.$typename.','.$hometeam.','.$guestteam.','.$remarks.'<br>';
		}
		
	}
	$progbar->full();
	$progbar->text("采集任务1 完成");

}
else 
{
	echo '参数不正确！';
}

?>
</BODY>
</HTML>