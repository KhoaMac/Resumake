<?php 
	include_once('dbObject.php');
	$db = new dbObject;
	$db->connect();

	$email = $_POST['email'];
	$password = $_POST['password'];
	//$user = $db->getUserByEmail($email);
	echo 'what is wrong';
	/*
	if($user->password == $password){
		//good to go
		$uid = $user->uid;
		$_SESSION['uid'] = $uid;
		echo '{"result":pass, "username":' . $user->username . '}';
	}else{
		echo '{"result":fail}';
	}*/
?>