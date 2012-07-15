<!--
  --  Resumake Front Page	
  -->


<?php
	include_once('private/php_scripts/dbObject.php');
	$db = new dbObject;
	$db->connect();
	session_start();
	if(isset($_COOKIE['remember'])){
		if(!isset($_SESSION['uid'])){
			$_SESSION['uid'] = $_COOKIE['remember'];
		}
		$user = $db->getUserById($_COOKIE['remember']);
		header('Location: /users/' .  $user->username) ;
	}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Resumake | Online Resumes</title>
	<link rel="stylesheet" type="text/css" href="private/bootstrap/css/bootstrap.css"></link>
	<link rel="stylesheet" type="text/css" href="private/bootstrap/css/bootstrap-responsive.css"></link>
	<style type="text/css">
	</style>
	
</head>
<body>
	<div class="container">
	<br>
	<div class="row">
		<div class="page-header">
			<h1 class="offset1">
			<img src="private/imgs/logo.png"></img>
			<small>Here's an idea, let's give everyone an online resume, for free.</small>
			</h1>
		</div>
	</div>
	<br>	
	<div class="row">
		<div class="modal hide" id="registermodal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">�</button>
				<h3>Register | The Right Thing To Do</h3>
			</div>
			<div class="modal-body">
				<form class="well">
					
					<label id="register-modal-name-label">Name</label>
					<input type="text" class="span5" placeholder="Name" id="register-modal-name">
				
					<label id="register-modal-email-label">Email</label>
					<input type="text" class="span5" placeholder="Email" id="register-modal-email">
					
					<label id="register-modal-username-label">Username</label>
					<input type="text" class="span5" placeholder="Username" id="register-modal-username">
					
					<label id="register-modal-password-label">Password</label>
					<input type="password" class="span5" placeholder="Password" id="register-modal-password">
					
				</form>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal" id="register-modal-cancel">Close</a>
				<a href="#messagemodal" class="btn btn-primary" id="register-modal-submit">Register</a>
			</div>
		</div>
		
		<div class="modal hide" id="messagemodal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">�</button>
				<h3>Thanks For Registering</h3>
			</div>
			<div class="modal-body">
				<h2>You should recieve an email soon!</h2>
				<h3>Please follow the instructions in the email to confirm your account</h3>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal" id="register-modal-cancel">Close</a>
			</div>
		</div>
		
		<div class="span6 offset1 columns">
			<div id="carousel" class="carousel slide">
				<div class="carousel-inner">
					<div class="item active">
						<img src="private/imgs/home1.png" alt="">
						<div class="carousel-caption">
							<h4>Bringing resume websites to the masses</h4>
							<p>Now you don't need to know how to make a website to have an online resume. You don't need your own webspace either. Making a website resume is tricky, if you don't do it right, it can be unattractive. Luckily, resumake is here to make a professional looking website resume for you, for free.</p>
						</div>
					</div>
					
					<div class="item">
						<img src="private/imgs/home2.png" alt="">
						<div class="carousel-caption">
							<h4>Create a professional resume website in minutes</h4>
							<p>Make an online copy of a resume in minutes. Upload the information you want to include in your resume; resumake does the rest. No web programming needed. Bring your resume into the modern age and impress your future employers with a neat and professional looking online resume.</p>
						</div>
					</div>
					
					<div class="item">
						<img src="private/imgs/home3.png" alt="">
						<div class="carousel-caption">
							<h4>Powered by Twitter's powerful Bootstrap API</h4>
							<p>Twitter's Bootstrap API is a service offered by Twitter. It can be used to make a website look sleek, innovative, and professional. By utilizing this webservice, we can do the same to your online resume. Your resume will be formatted into a web template that implements Bootstrap, making it and you look great.</p>
						</div>
					</div>
				</div>
				<a class="left carousel-control" href="#carousel" data-slide="prev">&lsaquo;</a>
				<a class="right carousel-control" href="#carousel" data-slide="next">&rsaquo;</a>
			</div>
		</div>
		
		<div class="span4 well">
			<h2>Login</h2>
			<form>
				<br>
				<p>Email</p>
				<input type="text" class="span3" placeholder="email" id="login-email">
				<br>
				<p>Password</p>
				<input type="password" class="span3" placeholder="password" id="login-pass">
				<br>
				<div class="checkbox-row" class="span3">
					Remeber Me <input type="checkbox" id="login-remember">
				</div>
				<br>
				<a href="#" class="btn btn-primary btn-large" id="login-submit">Login</a>
			</form>
			<br>
			<br>
			
			<h2>Or Get Started And Register</h2>
			<a id="register-btn" href="#registermodal" data-toggle="modal" class="btn btn-primary btn-large">Register</a>
			
		</div>
		
	</div>
	</div>
	<?php include "private/php_scripts/encryption.php" ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="private/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="private/bootstrap/js/script-home.js"></script>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-33395111-1']);
        _gaq.push(['_trackPageview']);
        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
</body>
