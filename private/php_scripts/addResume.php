<?php 
	include_once("dbObject.php");
	$db = new dbObject();
	$db->connect();
	
	$resume = json_encode($_POST['resume']);
	$name = $_POST['name'];
	$uid = $_POST['uid'];
	
	echo $db->addResumeByUid($uid, $resume, $name);
?>
