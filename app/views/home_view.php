<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>TimeBomb | Time Limited Login Exchange</title>
<meta name="description" content="Timebomb.it is a web and mobile app offering a secure way of sending confidential logins over the internet. We blow your passwords up so hackers can't find them.">
<meta name="author" content="Prime Studios">
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0'/>
<meta name="google-site-verification" content="wpu4XQ5LLwlXxWQyfm34GCLWC3m9PKSRKTomrnXGvcw" />
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
		<form method="POST" action="/create" id="create">
			<input type="hidden" name="expiration" id="expiration" />
			<input type="hidden" name="token" value="<?=$token;?>" />
			<div class="input-wrap">
				<input type="text" name="username" id="username" autocomplete="off" value="username" class="no-input" />
			</div>
			<div class="input-wrap">
				<input type="text" name="password" id="password" autocomplete="off" value="password" class="no-input" />
			</div>
			<div class="input-wrap comment-text">
				<div id="add-comment">
					<canvas id='add-comment-arrow' width='264' height='20'></canvas>
					<a href="#">add a comment</a>
				</div>
			</div>
			<table cellspacing="0">
				<tr>
					<td align=left valign=top>
						<button type="submit" id="exHour"><span>1 Hour</span></button>
					</td>
					<td align=center valign=top>
						<button type="submit" id="exDay"><span>1 Day</span></button>
					</td>
					<td align=right valign=top>
						<button type="submit" id="exWeek"><span>1 Week</span></button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	
	<div id="footer">
		<p>&copy; 2010 | <a href="/terms" id="terms">terms</a></p>
		<a href="http://www.primestudiosllc.com/" id="prime">Prime Studios</a>
	</div>
	
</div>

<script src="js/jquery-1.4.2.min.js?v=1"></script>
<script src="js/action.min.js?view=index&v=4"></script>

</body>
</html>