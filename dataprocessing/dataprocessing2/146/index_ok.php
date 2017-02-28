<?php session_start(); include("conn/conn.php");
    if($Submit==true){
    for($i=0;$i<count($sp_name);$i++){
		$path=$_POST["sp_name"][$i];
		$path1=$_POST["sp_number"][$i];
		$path2=$_POST["price"][$i];
		$path3=$_POST["counts"][$i];
		$path4=$_POST["address"][$i];
		$query=mysql_query("insert into tb_inserts (sp_name,sp_number,price,counts,address,data)values('$path','$path1','$path2','$path3','$path4','$data')");
	}
	if($query==true){
		echo "³É¹¦!!";
		}else{
		echo "Ê§°Ü!!";}}
?>