<?php 

	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=autosess', 'cyberpunk', 'hello123');
	$pdo->setAttribute(PDO::ATTRMODE_WARNING, PDO::ERRMODE_EXCEPTION);
?>