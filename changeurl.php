<?php
set_time_limit(0);
$link = mysql_connect("172.20.1.21", "admin", "xxzx160168") or die(mysql_error());
mysql_select_db("phpcms", $link) or die(mysql_error());
mysql_query("set names gbk");

$start = 0;
$step  = 1000;
$flag  = true;

while ($flag)
{
	$sql = "SELECT tid,teamname FROM myself_teams LIMIT {$start}, {$step}";
	$result = mysql_query($sql) or die(mysql_error() . __LINE__);

	if (($num = mysql_num_rows($result)) == 0)
		break;

	while ($row = mysql_fetch_assoc($result))
	{
		//"UPDATE myself_matches SET hometeam_big='{$oldTeamBig[$row['hometeam']]}', guestteam_big='{$oldTeamBig[$row['guestteam']]}' WHERE id={$row['id']}";
		//$sqlUpdate = "UPDATE myself_teams SET url='<a href=\"http:\/\/data2.7m.cn\/Team_Data\/'.'{$row['tid']}'.'\/gb\/index.shtml\" target=\"_blank\">'.'{$row['teamname']}'.'<\/a>' WHERE tid={$row['tid']}";
		//$sqlUpdate = "UPDATE myself_teams SET url='<a href=\"http://data2.7m.cn/Team_Data/'.'{$row['tid']}'.'/gb/index.shtml\" target=\"_blank\">'.'{$row['teamname']}'.'</a>' WHERE tid={$row['tid']}";
		$sqlUpdate = "UPDATE myself_teams SET url='<a href=\"http://data2.7m.cn/Team_Data/{$row['tid']}/gb/index.shtml\" target=\"_blank\">{$row['teamname']}</a>' WHERE tid={$row['tid']}";
		echo "$sqlUpdate"."<br><br>";
		mysql_query($sqlUpdate) or die(mysql_error() . __LINE__ . $sqlUpdate);
	}
	$start += $num;
}
echo "finished!增加球队网址完成!";
?>