<HTML>
<HEAD>
<TITLE>�ɼ���ҳ</TITLE>
<BODY>
	 &nbsp; <A href="http://172.20.1.21/mine/getdata.php?par=day"> <U><FONT color=#0000ff>��һ��������ɼ����������곡��������</FONT></U></A><BR>
	&nbsp;   <A href="http://172.20.1.21/mine/getdata.php?par=delay"> <U><FONT color=#0000ff>�ڶ���������ɼ����������������</FONT></U></A><BR>
	 &nbsp;   <A href="http://172.20.1.21/mine/change.php"> <U><FONT color=#0000ff>����������������������</FONT></U></A><BR>
	      <BR>
	      &nbsp;&nbsp;�ɼ�˵����<BR>
	      1.�������Ӽ�Ϊ���ڲɼ��Ĺ��̣��������������⡣Ҫ�ȴ������ֹͣ���У�IE�����½�����ɵ���ʾ����ֹͣ�˲ɼ���<BR>
	      2.�ɼ���ɺ�����������ظ���¼����һ������ɼ���������������ݣ���ʡ�Ե�һ������<BR>
	      &nbsp;&nbsp;����������ظ���¼�����ظ���һ������
	      <A href="http://172.20.1.21/mine/repetition_delete.php"> <font color=red>����˴�ɾ���ظ���¼</font></a>��<BR>
	      3.�������������������������(��Ҫ���ĵȴ�Լ������)��<BR>
	      4.�ɼ���Ϻ���˶ԣ��緢�ֵ��������곡���ݺ�7m����������ݲ�һ�£������²ɼ���<BR><BR>&nbsp;  
	      
<?php
set_time_limit(0);
include_once("cprogbar.php");
include_once("function.php");
include_once('common.php');

//$err=0;
//$progbar=new CProgbar("�ɼ�����1");

//print("<p><b>�ɼ�����1</b><br>".$progbar->show()."<p>");
//$progbar->init();
if($par=='day')         //�ɼ�ĳ������б�������
{
	$day=mktime(0,0,0,date('m'),date('d')-1,date('Y'));	
 // $lastday=mktime(0,0,0,12,14,2008);//ʹ���˺ܳ�һ��ʱ����ֶ������ڷ�ʽ
	//$lastday=mktime(0,0,0,date('m'),date('d')-2,date('Y'));
	$lastday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
	while ($day>=$lastday) //��������ѭ������
	{
		//$progbar->step();
		$date=date('Y-m-d',$day);
		$day_match='http://data.7m.cn/result_data/'.$date.'/index_gb.js';  //ĳ�����б������ݣ����ݴ�ǰһ�쿪ʼ����ǰ����
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

//��ñ�����ע
$str=substr($str,strpos($str,'meno_Arr'));
$str1=substr($str,strpos($str,'[')+1,strpos($str,'];')-strpos($str,'[')-1);
$m_remarks=explode('\',\'',$str1);
//print_r($m_remarks).'<br><br>';

//��ñ����볡�ȷ�
$str=substr($str,strpos($str,'banc_Arr'));
$m_halfs=new_trim(explode(',',substr($str,strpos($str,'[')+1,strpos($str,']')-strpos($str,'[')-1)));

//��ñ���ʱ�䣬��ʽ2008,02,21,01,00,0����,��,��,Сʱ,����,�룩
$str=substr($str,strpos($str,'Start_time_Arr')); 
$m_days=new_trim(explode('\',\'',substr($str,strpos($str,'\'')+1,strpos($str,'\']')-strpos($str,'\'')-1)));
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

//print_r($m_remarks);
//print_r($m_bhs);

//$progbar->text($day);
//echo $day.' ';
		foreach ($m_bhs as $k => $v )
		{
//			echo $v.' |'.$m_remarks[$k].'<br>';
//			�������ݿ�
//			if(!strpos($m_remarks[$k],'['))
//			{
//				continue;			   
//			}
//			else 
//			{	
				$m_remarks[$k]=str_replace(array('0[','1[','2[','\''),array('90����[','120����[','����[',''),$m_remarks[$k]);
				$point=$ht_scores[$k].'-'.$gt_scores[$k];
				//$query=$db->query("select * from myself2_matches where day='$m_days[$k]' and time='$m_times[$k]' and typename='$L_names[$k]' and hometeam='$ht_names[$k]' and points='$point' and guestteam='$gt_names[$k]' and halfpoints='$m_halfs[$k]'");
				//$query=$db->query("select * from myself2_matches where day='$m_days[$k]' and typename='$L_names[$k]' and hometeam='$ht_names[$k]' and points='$point' and guestteam='$gt_names[$k]' and halfpoints='$m_halfs[$k]'");
				$query=$db->query("select * from myself2_matches where day='$m_days[$k]' and time='$m_times[$k]' and hometeam='$ht_names[$k]' and halfpoints='$m_halfpoints[$k]'");
				$record=$db->fetch_array($query);
				if($record)
				{					
					//update remarks
					if($record['remarks']=='' && $m_remarks[$k]!='')
					{
						$query=$db->query("update myself2_matches set remarks='$m_remarks[$k]' where id='".$record['id']."'");
						if($db->affected_rows($query)) $successed=1;
					}
					else continue;				
				}
				else 
				{	
						$query=$db->query("insert into myself2_matches(day,time,typename,hometeam,points,guestteam,halfpoints,remarks) 
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
		if($successed) echo '�ɹ��ɼ�'.date('Y-m-d',$day).'����';	
		$day=mktime(0,0,0,date('m',$day),date('d',$day)-1,date('Y',$day));  //ǰһ��
	}
//	$progbar->full();
	//$progbar->text("�ɼ�����1 ��ɣ�������ڵ�ַ������http://172.20.1.21/mine/change.php");
	//$progbar->text("�ɼ�����1 ���");

//����5�д���ɾ���ظ���¼�����ظ���¼��ʱ���ٵ�����*/
	$query=$db->query("SELECT *,min(id) as ids FROM `myself2_matches` WHERE 1 group by day,typename,hometeam,points,
  guestteam,halfpoints HAVING count(*)>1 order by count(*) desc");
	while($record=$db->fetch_array($query))
	{
	    $db->query("delete from myself2_matches where day='".$record['day']."' and typename='".$record['typename']."'
	     and hometeam='".$record['hometeam']."' and points='".$record['points']."' and guestteam='".$record['guestteam']."'
	     and halfpoints='".$record['halfpoints']."' and id != '".$record['ids']."'"); 
	}

	//����7�д���һ��ɾ��һ���ظ���¼
	/*$query=$db->query("SELECT min(id) as id FROM `myself2_matches` WHERE 1 group by day,typename,hometeam,points,guestteam,halfpoints HAVING count(*)>1 order by count(*) desc");
	while($record=$db->fetch_array($query))
	{
	$del[] = "'".$record['id']."'";
	}
	$del = join($del,",");
	$db->query("delete from myself2_matches where id in (".$del.")"); */

	
}
elseif($par=='team')
{
	$teamid=999;
	$total=7688;      //����7688
	//while ($teamid<=$total) 
	while ($teamid<=$total) 
	{
		$progbar->step();
		$team_info='http://data.7m.cn/Team_Data/'.$teamid.'/gb/dt.js';   //������ϣ�����
		$team_info2='http://data.7m.cn/Team_Data/'.$teamid.'/big/dt.js';  //������ϣ�����
		$str=file_get_contents($team_info);
		$str2=file_get_contents($team_info2);
		
		//�����ӱ��
		$str=substr($str,strpos($str,'team_bh'));
		$team_bh=new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1));
//		print $team_bh.' ';
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
				//�����Ӷ�������
				$str=substr($str,strpos($str,'team_name'));
				$team_name=new_iconv(new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1)));         //��Ӣ����һ�� 
				$team_ename=substr($team_name,strpos($team_name,'(')+1,strpos($team_name,')')-strpos($team_name,'(')-1);     //��ȡӢ����
				$team_name=substr($team_name,0,strpos($team_name,'('));                                                      //��ȡ������
	
				//�����Ӷ�������
				$str2=substr($str2,strpos($str2,'team_name'));
				$team_fname=new_iconv(new_trim(substr($str2,strpos($str2,'=')+1,strpos($str2,';')-strpos($str2,'=')-1)));       //��Ӣ����һ�� 
				$team_fname=substr($team_fname,0,strpos($team_fname,'('));     
	
				//�����ӽ������
				if(strpos($str,'team_edate'))  //���ж���û�����ڣ���Ϊ��Щ������ϲ��㣬����Ҫ���жϲ��ܻ�ȡ
				{
					$str=substr($str,strpos($str,'team_edate'));
					$team_edate=new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1));
				}
				
				if(strpos($str,'team_country_bh'))  
				{
					//��ù��ұ��
					$str=substr($str,strpos($str,'team_country_bh')+13);
					$team_country_bh=new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1));
				}
				
				if(strpos($str,'team_country'))  
				{
					//��ù������Ƽ���
					$str=substr($str,strpos($str,'team_country'));
					$team_country=new_iconv(new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1)));
				}
				
				if(strpos($str2,'team_country_bh'))  
				{
					//��ù������Ʒ���
					$str2=substr($str2,strpos($str2,'team_country_bh')+13);
					$str2=substr($str2,strpos($str2,'team_country'));
					$team_fcountry=new_iconv(new_trim(substr($str2,strpos($str2,'=')+1,strpos($str2,';')-strpos($str2,'=')-1)));
				}
				
				if(strpos($str,'team_city'))  
				{	
					//���������ڳ��м���
					$str=substr($str,strpos($str,'team_city'));
					$team_city=new_iconv(new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1)));
				}
				
				if(strpos($str,'team_city'))  
				{	
					//���������ڳ��з���
					$str2=substr($str2,strpos($str2,'team_city'));
					$team_fcity=new_iconv(new_trim(substr($str2,strpos($str2,'=')+1,strpos($str2,';')-strpos($str2,'=')-1)));
				}
				
				if(strpos($str,'team_stadium'))  
				{	
					//�����������򳡼���
					$str=substr($str,strpos($str,'team_stadium'));
					$team_stadium=new_iconv(new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1)));
				}
				
				if(strpos($str2,'team_stadium'))  //���ж���û�����ڣ���Ϊ��Щ������ϲ��㣬����Ҫ���жϲ��ܻ�ȡ
				{	
					//�����������򳡷���
					$str2=substr($str2,strpos($str2,'team_stadium'));
					$team_fstadium=new_iconv(new_trim(substr($str2,strpos($str2,'=')+1,strpos($str2,';')-strpos($str2,'=')-1)));
				}
				
				if(strpos($str,'team_addr'))  
				{	
					//�����Ӿ����ַ
					$str=substr($str,strpos($str,'team_addr')); 
					$team_addr=new_iconv(new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1)));
				}
				
				if(strpos($str,'team_capacity'))  
				{	
					//���������������
					$str=substr($str,strpos($str,'team_capacity'));
					$team_capacity=str_replace(',','',new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1)));
				}
				
				if(strpos($str,'team_website')) 
				{	
					//��������ַ
					$str=substr($str,strpos($str,'team_website'));
					$team_website=new_trim(substr($str,strpos($str,'=')+1,strpos($str,';')-strpos($str,'=')-1));
				}
				
//				echo $team_bh.' '.$team_name.' '.$team_ename.' '.$team_fname.' '.$team_edate.' '.$team_country_bh.' '.$team_country.' '.$team_fcountry.' '.$team_city.' '
//				.$team_fcity.' '.$team_stadium
//				.' '.$team_fstadium.' '.$team_addr.' '.$team_capacity.' '.$team_website;
				$tintro="��ӽ�����ݣ�$team_edate<br>�������ң�$team_country<br>�������У�$team_city<br>�����ƣ�$team_stadium<br>�򳡾����ַ��$team_addr<br>������������$team_capacity<br>�����ַ��$team_website";
					
					$query=$db->query("insert into myself_teams(tid,teamname,teamname_big,ename,tintro) values('$team_bh','$team_name','$team_fname','$team_ename','$tintro')");
					if($db->affected_rows($query))
					{
							$successed_1= '�ɹ����'.$team_name;
							$query=$db->query("select * from myself_country where cid='$team_country_bh'");
							if(!$db->num_rows($query))
							{
								$query=$db->query("insert into myself_country(cid, cname, cname_big) values ('$team_country_bh','$team_country','$team_fcountry')");
								if($db->affected_rows($query))
								$successed_1.=' ��ӳɹ�'.$team_country;
								else 
								$successed_1.=' ���ʧ��'.$team_country;
							}										
							
					}
					else 
					{
						$successed_1= '���ʧ��'.$team_name;
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
	$progbar->text("�ɼ�����1 ���");
}
elseif($par=='delay')
{
	//�������ڱ���
	$day=mktime(0,0,0,date('m'),date('d')+1,date('Y'));  //����ı������ݣ�һ��ֻ�����ڵļ�¼
	$date=date('Y-m-d',$day);
	$day_delay_match='http://data.7m.cn/result_data/default_gb.shtml?date='.$date;  //ĳ�����б�������
	$str=file_get_contents($day_delay_match);
	
	$str=substr($str,strpos($str,'<tr><td colspan="6" class="qx_bg1">'));
	$str=substr($str,strpos($str,'</tr>')+5); //ȥ��һ��<tr></tr>
	$str=substr($str,0,strpos($str,'</table>'));
	$delay_matches=new_iconv(new_trim(explode('</tr><tr',$str)));
	
	//��ÿһ��delay match���д���
	foreach ($delay_matches as $k => $v)
	{
		//$progbar->step();
		if(strpos($v,'color=blue>'))
		{
			//����ԭ��
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
			
			if(strpos($delay_matches[$k+1],'color=blue>')) //˵���¸���¼���ϸ���¼������ԭ��
			{
				$remarks=new_substr($delay_matches[$k+1],'blue>','</font>');
			}
			else 
			{
				$v=substr($v,strpos($v,'<td')+3);
				$remarks=new_substr($v,'>','</td>');
			}
			
			$query=$db->query("select * from myself2_matches where day='$day' and typename='$typename' and hometeam='$hometeam' and guestteam='$guestteam'");
			if($db->num_rows($query))
			{
				continue;
			}
			else 
			{
				$query=$db->query("insert into myself2_matches(day,time,typename,hometeam,guestteam,remarks) values('$day','$time','$typename','$hometeam','$guestteam','$remarks')");
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
//	$progbar->full();
//	$progbar->text("�ɼ�����2 ���");

}
elseif($par=='matchtype')
{
	
}
else 
{
	echo '��������ȷ��';
}

?>
	      <br>
	      <script language="LiveScript">
				<!-- Hiding
				  today = new Date()
				  document.write("�� �� ʱ �� �ǣ� ",today.getHours(),":",today.getMinutes())
				  document.write("<br>�� �� �� �� Ϊ�� ", today.getMonth()+1,"/",today.getDate(),"/",today.getYear());
				// end hiding contents -->
				</script><br><br>

				Last changes:
				  <script language="LiveScript">
				  <!--  hide script from old browsers
				    document.write(document.lastModified)
				  // end hiding contents -->
				  </script> 
</BODY>
</HTML>