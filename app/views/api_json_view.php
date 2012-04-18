<?php
header('HTTP/1.1 202 Created');
echo json_encode(array(
			"username"=>$username,
			"password"=>$password,
			"url"=>$url,
			"expiration"=>$expiration,
			"created"=>$created
			));