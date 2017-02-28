<?php 
session_start(); 
include("conn.php");
$lmbs = isset($_GET['lmbs']) ? intval($_GET['lmbs']) : 0;
/*
        <td height="25" align="center" class="STYLE1"><label>
          <input name="id" type="text" id="id" value="0" size="6">
        </label></td>
        <td align="center" class="STYLE1"><input name="day" type="text" id="day" value="0000-00-00" size="6"></td>
        <td align="center" class="STYLE1"><input name="time" type="text" id="time" value="" size="9"></td>
        <td align="center" class="STYLE1"><input name="typename" type="text" id="typename" value="" size="18"></td>
        <td align="center" class="STYLE1"><input name="hometeam" type="text" id="hometeam" value="" size="9"></td>
        <td align="center" class="STYLE1"><input name="points" type="text" id="points" value="" size="9"></td>
        <td align="center" class="STYLE1"><input name="guestteam" type="text" id="guestteam" value="" size="9"></td>
        <td align="center" class="STYLE1"><input name="halfpoints" type="text" id="halfpoints" value="" size="9"></td>
        <td align="center" class="STYLE1"><input name="remarks" type="text" id="remarks" value="" size="9"></td>
        <td align="center" class="STYLE1"><input name="hometeam_big" type="text" id="hometeam_big" value="艾恩" size="9"></td>
        <td align="center" class="STYLE1"><input name="guestteam_big" type="text" id="guestteam_big" value="阿尔沙巴柏" size="9"></td>  
*/
$day = isset($_POST['day']) ? trim($_POST['day']) : '';
$time = isset($_POST['time']) ? trim($_POST['time']) : '';
$typename = isset($_POST['typename']) ? trim($_POST['typename']) : '';
$hometeam = isset($_POST['hometeam']) ? trim($_POST['hometeam']) : '';
$points = isset($_POST['points']) ? trim($_POST['points']) : '';
$guestteam = isset($_POST['guestteam']) ? trim($_POST['guestteam']) : '';
$halfpoints = isset($_POST['halfpoints']) ? trim($_POST['halfpoints']) : '';
$remarks = isset($_POST['remarks']) ? trim($_POST['remarks']) : '';
$hometeam_big = isset($_POST['hometeam_big']) ? trim($_POST['hometeam_big']) : '';
$guestteam_big  = isset($_POST['guestteam_big']) ? trim($_POST['guestteam_big']) : '';
print_r($_POST);
     if(intval($lmbs) > 0){
        $sid=$_POST[sid];
        $query=mysql_query("update myself_matches set day='$day',time='$time',typename='$typename',hometeam='$hometeam',
        points='$points',guestteam='$guestteam',halfpoints='$halfpoints',remarks='$remarks',hometeam_big='$hometeam_big',
        guestteam_big='$guestteam_big' where id='$lmbs'") or die(mysql_error());
        if($query==true)
        { echo "<script>alert('足球完场赛事资料更新成功!!');window.location.href='http://localhost/dataprocessing4/update/football_edit.php';</script>";
        }
        else{echo "更新失败!!";}
}
?>