<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>TimeBomb | Time Limited Info Exchange</title>
<meta name="author" content="Prime Studios">
<meta name="robots" content="noindex,nofollow"> 
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0'/>
<link rel="shortcut icon" href="/favicon.ico">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="stylesheet" href="css/style.css?v=4">
</head>
<body>
	
<div id="container">
	
	<div id="header">
		<a href="/" id="logo">TimeBomb</a>
		<a href="/about" id="about">about</a>
	</div>
	
	<div id="main">
		<div id="details">
			
			<div id="countDown"></div>
			
			<?php
				if(!empty($username)) {
					echo "<p class='label'>username</p><p id='username' class='copy'>".$username."</p>";
				}
				if(!empty($password)) {
					echo "<p class='label'>password</p><p id='password' class='copy'>".$password."</p>";
				}
				if(!empty($comments)) {
					echo "<p class='label'>comments</p><p id='comments'>".$comments."</p>";
				}
			?>
			
			<p class="label">custom link</p>
			<p id="link"><a href="https://timebomb.it/<?=$url;?>" class="copy">timebomb.it/<?=$url;?></a></p>
			
			<form method="POST" id="blowItUp">
				<input type="hidden" value="<?=$token;?>" name="token" />
				<button type="submit"><span>Blow It Up</span></button>
			</form>
               
		</div>
	</div>
	
	<div id="footer">
		<p>&copy; 2010 | <a href="/terms" id="terms">terms</a></p>
		<a href="http://www.primestudiosllc.com/" id="prime">Prime Studios</a>
	</div>
	
</div>

<script> var plusCount = <?= $plusCount ?> </script>
<script src="js/jquery-1.4.2.min.js?v=1"></script>
<script src="js/action.min.js?view=detail&v=4"></script>

</body>
</html>