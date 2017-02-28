<?php
$sql = "SELECT * FROM myself_station";
$result = mysql_query($sql) OR die(mysql_error().__LINE__);
$row = mysql_fetch_assoc($result) OR die(mysql_error());

?>