<?php
require "./Snoopy.class.php";
@mysql_query("SET NAMES GB2312");
$snoopy = new Snoopy;

/*$snoopy->fetch("http://www.7m.cn:8085/js/title.js");
  echo "<br>"; echo "<br>"; echo "<br>";
   $snoopy->fetch("http://www.7m.cn:8085/js/Open_Link.js");
   echo "<br>"; echo "<br>"; echo "<br>";
   $snoopy->fetch("http://www.7m.cn:8085/timezone/timeZone.js");
    echo "<br>"; echo "<br>"; echo "<br>";
    $snoopy->fetch("http://www.7m.cn:8085/js/head.js");
 echo "<br>"; echo "<br>"; echo "<br>";
$snoopy->fetch("http://www.7m.cn:8085/include/Menu_ft.js");//读到很多+号
 echo "<br>"; echo "<br>"; echo "<br>";
 $snoopy->fetch("http://www.7m.cn:8085/banner/split_live_ad_ft.js");//页头的广告
 echo "<br>"; echo "<br>"; echo "<br>";
  $snoopy->fetch("http://www.7m.cn:8085/js/CONST/big.js");//读到天气等
 echo "<br>"; echo "<br>"; echo "<br>";
 $snoopy->fetch("http://www.7m.cn:8085/live_fun.js");
 echo "<br>"; echo "<br>"; echo "<br>";
 $snoopy->fetch("http://www.7m.cn:8085/Soccer_Split.js");
 echo "<br>"; echo "<br>"; echo "<br>";
  $snoopy->fetch("http://www.7m.cn:8085/js/nav/ql_big.js");
 echo "<br>"; echo "<br>"; echo "<br>";//读到很少的代码
 
  $snoopy->fetch("http://js.tongji.yahoo.com.cn/0/492/496/ystat.js");//读yahoo的东西
 echo "<br>"; echo "<br>"; echo "<br>";
 
   $snoopy->fetch("http://www.7m.cn:8085/datafile/matchcount.js");//读到?var MATCHCOUNT_1 = 47;var MATCHCOUNT_2 = 34;var MATCHCOUNT_3 = 47;var MATCHCOUNT_4 = 34; 
 echo "<br>"; echo "<br>"; echo "<br>";*/
  $snoopy->fetch("http://www.7m.cn:8085/banner/move_ad.js");
 echo "<br>"; echo "<br>"; echo "<br>";
 

echo $snoopy->results;
?>


