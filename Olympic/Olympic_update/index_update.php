<?php session_start(); 
include("conn.php");
$lmbs = isset($_GET['lmbs']) ? intval($_GET['lmbs']) : 0;

$id = isset($_POST['id']) ? trim($_POST['id']) : '';
//$olympic_year = isset($_POST['olympic_year']) ? trim($_POST['olympic_year']) : '';
$bigmatch = isset($_POST['bigmatch']) ? trim($_POST['bigmatch']) : '';
//$olympic_match_small = isset($_POST['olympic_match_small']) ? trim($_POST['olympic_match_small']) : '';
$heldday = isset($_POST['heldday']) ? trim($_POST['heldday']) : '';
$heldtime = isset($_POST['heldtime']) ? trim($_POST['heldtime']) : '';
$matchname = isset($_POST['matchname']) ? trim($_POST['matchname']) : '';
//$gym = isset($_POST['gym']) ? trim($_POST['gym']) : '';
$finals = isset($_POST['finals']) ? trim($_POST['finals']) : '';
$goldpoint  = isset($_POST['goldpoint']) ? trim($_POST['goldpoint']) : '';
$athlete  = isset($_POST['athlete']) ? trim($_POST['athlete']) : '';
echo "<pre>"; print_r($_POST); echo "</pre>";
     if(intval($lmbs) > 0){
        $sid=$_POST[sid];
        $query=mysql_query("update olympic_match_detail set id='$id',bigmatch='$bigmatch',
        heldday='$heldday',heldtime='$heldtime',matchname='$matchname',finals='$finals',goldpoint='$goldpoint',
        athlete='$athlete' where id='$lmbs'") or die(mysql_error());
        if($query==true)
        { echo "<script>alert('2008奥运资料更新成功!!');window.location.href='/mine/Olympic/Olympic_update/';</script>";
        }
        else{echo "更新失败!!";}
}
?>