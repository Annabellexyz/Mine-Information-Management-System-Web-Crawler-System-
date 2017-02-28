<HTML>
<HEAD>
<TITLE>删除足球完场赛事重复记录</TITLE>
<BODY>
<?php
set_time_limit(0);
include_once("common.php");

//$query = $db->query("SELECT *,max(id) as ids FROM 'myself_matches' WHERE 1 group by day,
$query = $db->query("SELECT *,max(id) as ids FROM `myself_matches` WHERE 1 group by day,
typename,hometeam,points,guestteam,halfpoints HAVING count(*)>1 ORDER BY count(*) desc");


while($record = $db->fetch_array($query))
{
	  $db->query("delete from myself_matches where day = '".$record['day']."' and typename = 
	  '".$record['typename']."' and hometeam = '".$record['hometeam']."' and points = 
	  '".$record['points']."' and guestteam = '".$record['guestteam']."' and halfpoints = 
	  '".$record['halfpoints']."' and id != '".$record['ids']."'");
}
echo "删除足球完场赛事重复记录完成";
?>
</BODY>
</HTML>