<HTML>
<HEAD>
<TITLE>�ɼ���ҳ</TITLE>
<?php
set_time_limit(0);
include_once("cprogbar.php");
include_once("function.php");
include_once('common.php');

$err=0;
$progbar=new CProgbar("�ɼ�����1");

//print("<p><b>�ɼ�����1</b><br>".$progbar->show()."<p>");
//$progbar->init();
if($par=='day')
{
	$day=mktime(0,0,0,date('m'),date('d')-26,date('Y'));
	$lastday=mktime(0,0,0,1,1,2007);
	//	$lastday=mktime(0,0,0,date('m'),date('d'),date('Y'));
	while ($day>=$lastday) //��������ѭ������
	{
		$progbar->step();
		$date=date('Y-m-d',$day);
		$day_match='http://data.7m.cn/Result_data/'.$date.'/index_gb.js';  //ĳ�����б�������
		$str=file_get_contents($day_match);
		
		//������ӱ��
		$str=substr($str,strpos($str,'Team_A_bh_Arr'));
$ht_bhs=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//��ÿͶӱ��
$str=substr($str,strpos($str,'Team_B_bh_Arr'));
$gt_bhs=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//������Ӷ���
$str=substr($str,strpos($str,'Team_A_Arr'));
$ht_names=new_iconv(new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1))));

//��ÿͶӶ���
$str=substr($str,strpos($str,'Team_B_Arr'));
$gt_names=new_iconv(new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1))));

//����������
$str=substr($str,strpos($str,'Match_bh_Arr'));
$L_bhs=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//���������������
$str=substr($str,strpos($str,'Match_name_Arr'));
$L_names=new_iconv(new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1))));

//��ñ����볡�ȷ�
$str=substr($str,strpos($str,'banc_Arr'));
$m_halfs=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//��ñ���ʱ�䣬��ʽ2008,02,21,01,00,0����,��,��,Сʱ,����,�룩
$str=substr($str,strpos($str,'Start_time_Arr')); 
$m_days=new_trim(explode('\',\'',substr($str,strpos($str,'[\'')+2,strpos($str,'\']')-strpos($str,'[')-2)));
$m_times=array();
foreach ($m_days as $k => $v) 
{
	$m_days[$k]=str_replace(',','-',substr($v,0,10));
	$m_times[$k]=str_replace(',',':',substr($v,11,5));
}
//������ӽ���
$str=substr($str,strpos($str,'live_a_Arr'));
$ht_scores=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//��ÿͶӽ���
$str=substr($str,strpos($str,'live_b_Arr'));
$gt_scores=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//��ñ������±��
$str=substr($str,strpos($str,'live_bh_Arr'));
$m_bhs=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//$progbar->text($day);
//echo $day.' ';
		foreach ($ht_bhs as $k => $v )
		{
			//�������ݿ�
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
		if($successed) echo '�ɹ��ɼ�'.$day.'����  ';	
		$day=mktime(0,0,0,date('m',$day),date('d',$day)-1,date('Y',$day));  //ǰһ��
	}
	$progbar->full();
	$progbar->text("�ɼ�����1 ���");

}
elseif($par=='team')
{
	$teamid=1;
	$total=1;
//	while ($teamid<=$total) 
//	{
		$team_info='http://data.7m.cn/Team_Data/'.$teamid.'/gb/dt.js';   //������ϣ�����
//		$team_info2='http://data.7m.cn/Team_Data/'.$teamid.'/big/dt.js';  //������ϣ�����
//		$str=file_get_contents($team_info);
//		$str2=file_get_contents($team_info2);
		
		//�����ӱ��
//		$str=substr($str,strpos($str,'team_bh'));
//		$team_bh=new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1));
		
		echo $team_info.' ';
		$teamid +=1;
//		flush();
//	}
//	$progbar->full();
//	$progbar->text("�ɼ�����1 ���");
}
else 
{
	echo '��������ȷ��';
}

?>
</BODY>
</HTML>