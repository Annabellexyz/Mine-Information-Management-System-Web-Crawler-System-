<?php
set_time_limit(0);
$link = mysql_connect("localhost", "admin", "xxzx160168") or die(mysql_error());
mysql_select_db("phpcms", $link) or die(mysql_error());
$oldTeamBig = array();
mysql_query("set names gbk");
$result = mysql_query("SELECT teamname, teamname_big FROM myself_teams");
while ($field = mysql_fetch_assoc($result))
{
	$oldTeamBig[$field['teamname']] = $field['teamname_big'];
}

$start = 0;
$step  = 4629;
$flag  = true;

while ($flag)
{
	$sql = "SELECT id, hometeam, guestteam FROM myself_matches LIMIT {$start}, {$step}";
	$result = mysql_query($sql) or die(mysql_error() . __LINE__);

	if (($num = mysql_num_rows($result)) == 0)
		break;

	while ($row = mysql_fetch_assoc($result))
	{
		$sqlUpdate = "UPDATE myself_matches SET hometeam_big='{$oldTeamBig[$row['hometeam']]}', guestteam_big='{$oldTeamBig[$row['guestteam']]}' WHERE id={$row['id']}";
		mysql_query($sqlUpdate) or die(mysql_error() . __LINE__ . $sqlUpdate);
	}
	$start += $num;
}
echo "finished!球队资料更新完成!";
?>