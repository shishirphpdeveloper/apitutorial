<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json');

require("config/database.php");

$id=trim($_SERVER['PATH_INFO'],'/');
$data=json_decode(file_get_contents("php://input"),true);

$set='';
foreach ($data as $key => $value) {
	$set.=$key."='".$value."',";
}

$set=substr($set, 0,-1);


$query="select id from users where id=$id";
$updatequery="update users set $set where id=$id";

$result=mysqli_query($conn,$query);
$countrow=mysqli_num_rows($result);

$myarray=array();

if($countrow>0)
{
	$result=mysqli_query($conn,$updatequery);
	$arr=['msg'=>'Record Update Successfully','status'=>200];
	echo json_encode($arr);
}
elseif($countrow<0)
{
	$arr=['msg'=>'No Record Found','status'=>400];
	echo json_encode($arr);
}

?>