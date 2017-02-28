<?php session_start(); include("conn/conn.php");
if($Submit=="提交"){
$query=mysql_query("insert into tb_insert (name,number,tel,address)values('$name','$number','$tel','$address')");}
if($query==true){
echo "数据添加成功!!";
}else{echo "数据插入失败!!";};
?>