<?php

define('IN_PHPCMS', TRUE);
require '../include/global.func.php';
require '../config.inc.php';

//$search_arr = array("/ union /i","/ select /i","/ update /i","/ outfile /i","/ or /i");
//$replace_arr = array('&nbsp;union&nbsp;','&nbsp;select&nbsp;','&nbsp;update&nbsp;','&nbsp;outfile&nbsp;','&nbsp;or&nbsp;');
//$_POST = strip_sql($_POST);
//$_GET = strip_sql($_GET);
//$_COOKIE = strip_sql($_COOKIE);
//unset($search_arr, $replace_arr);

$magic_quotes_gpc = get_magic_quotes_gpc();
if(!$magic_quotes_gpc)
{
	$_POST = new_addslashes($_POST);
	$_GET = new_addslashes($_GET);
}
@extract($_POST, EXTR_OVERWRITE);
@extract($_GET, EXTR_OVERWRITE);
unset($_POST, $_GET);

$db_file = $db_class = 'db_'.$CONFIG['database'];
require '../include/'.$db_file.'.class.php';
$db = new $db_class;
$db->connect($CONFIG['db2host'], $CONFIG['dbuser'], $CONFIG['dbpw'], $CONFIG['dbname'], $CONFIG['pconnect']);
$db->iscache = $CONFIG['dbiscache'];
$db->expires = $CONFIG['dbexpires'];


?>
