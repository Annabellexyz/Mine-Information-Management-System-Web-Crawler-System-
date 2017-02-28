<?php
require "./Snoopy.class.php";
$snoopy = new Snoopy();
//$jsContent = $snoopy->fetch("http://www.7m.cn:8085/live_fun.js");
//$jsContent = $snoopy->fetch("http://www.7m.cn:8085/js/title.js");
$jsContent = $snoopy->fetch("http://www.7m.cn:8085/js/Open_Link.js");
//$jsContent = $snoopy->fetch("http://www.7m.cn:8085/timezone/timeZone.js");

//²é¿´JS
echo htmlspecialchars($jsContent); 
?>