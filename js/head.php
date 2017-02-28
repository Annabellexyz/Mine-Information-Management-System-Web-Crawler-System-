

<?php
require "./Snoopy.class.php";
@mysql_query("SET NAMES GB2312");
$snoopy = new Snoopy;

 $snoopy->fetch("http://www.7m.cn:8085/js/head.js");

echo $snoopy->results;
?>