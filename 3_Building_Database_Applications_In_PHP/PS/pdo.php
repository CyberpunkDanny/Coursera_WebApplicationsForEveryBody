<?php
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=userDB', 'cyberpunk', 'hello123');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>