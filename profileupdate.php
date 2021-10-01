<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:GET,POST,OPTIONS');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json');


require("config/database.php");

$id=$_POST['id'];
$name=$_POST['name'];
$phone=$_POST['phone'];
$city=$_POST['city'];

$photo=time().$_FILES['photo']['name'];

move_uploaded_file($_FILES['photo']['tmp_name'], $photo);


$query="update users set 
name='$name',phone='$phone',city='$city',photo='$photo' where id=$id";

$result=mysqli_query($conn,$query);

if($result)
{
	http_response_code(200);
	$arr=['msg'=>'Record Update Successfully'];
	echo json_encode($arr);
}
else
{
	http_response_code(401);
	$arr=['msg'=>'Record Not Update'];
	echo json_encode($arr);
}

?>