<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>The Error Page</title>
	<link rel="stylesheet" type="text/css" href="/private/bootstrap/css/bootstrap.css"></link>
	<link rel="stylesheet" type="text/css" href="/private/bootstrap/css/bootstrap-responsive.css"></link>
</head>
<body>
    <div class="container">
        <div class="hero-unit">
            <h1>Oops!</h1>
            <h2>We couldn't find the webpage you were looking for.</h2>
        </div>
    </div>
    <?php include "private/php_scripts/encryption.php" ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="/private/bootstrap/js/bootstrap.js"></script>
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
