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
$snoopy->fetch("http://www.7m.cn:8085/include/Menu_ft.js");//�����ܶ�+��
 echo "<br>"; echo "<br>"; echo "<br>";
 $snoopy->fetch("http://www.7m.cn:8085/banner/split_live_ad_ft.js");//ҳͷ�Ĺ��
 echo "<br>"; echo "<br>"; echo "<br>";
  $snoopy->fetch("http://www.7m.cn:8085/js/CONST/big.js");//����������
 echo "<br>"; echo "<br>"; echo "<br>";
 $snoopy->fetch("http://www.7m.cn:8085/live_fun.js");
 echo "<br>"; echo "<br>"; echo "<br>";
 $snoopy->fetch("http://www.7m.cn:8085/Soccer_Split.js");
 echo "<br>"; echo "<br>"; echo "<br>";
  $snoopy->fetch("http://www.7m.cn:8085/js/nav/ql_big.js");
 echo "<br>"; echo "<br>"; echo "<br>";//�������ٵĴ���
 
  $snoopy->fetch("http://js.tongji.yahoo.com.cn/0/492/496/ystat.js");//��yahoo�Ķ���
 echo "<br>"; echo "<br>"; echo "<br>";
 
   $snoopy->fetch("http://www.7m.cn:8085/datafile/matchcount.js");//����?var MATCHCOUNT_1 = 47;var MATCHCOUNT_2 = 34;var MATCHCOUNT_3 = 47;var MATCHCOUNT_4 = 34; 
 echo "<br>"; echo "<br>"; echo "<br>";*/
  $snoopy->fetch("http://www.7m.cn:8085/banner/move_ad.js");
 echo "<br>"; echo "<br>"; echo "<br>";
 

echo $snoopy->results;
?>


