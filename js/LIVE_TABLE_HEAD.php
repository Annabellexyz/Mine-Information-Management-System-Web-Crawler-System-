

<?php
require "./Snoopy.class.php";
@mysql_query("SET NAMES GB2312");
$snoopy = new Snoopy;

  $snoopy->fetch("http://www.7m.cn:8085/js/LIVE_TABLE_HEAD.js");

echo $snoopy->results;
?>