<?php 
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	include_once("dbObject.php");
	$db = new dbObject();
	$db->connect;
	$user = $db->getUserByEmail($email);
	
	if($user->password == $password){
		//good to go
		$uid = $user->uid;
		$_SESSION['uid'] = $uid;
		echo '{"result":pass, "uid":' . $user->username . '}';
	}else{
		echo '{"result":fail}';
	}
?>