

<?php
require "./Snoopy.class.php";
@mysql_query("SET NAMES GB2312");
$snoopy = new Snoopy;

 $snoopy->fetch("http://ctc.data.7m.cn:13000/GoalData/default_gb.shtml?id=158687");

echo $snoopy->results;
?>