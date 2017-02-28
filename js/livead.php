<?php
require "./Snoopy.class.php";
@mysql_query("SET NAMES GB2312");
$snoopy = new Snoopy;

 $snoopy->fetch("http://www.7m.cn:8085/banner/split_live_ad_jt.js");//读到广告图片链接

echo $snoopy->results;
?>