<?php
	session_start();
		if(isset($_POST["username"]) && isset($_POST["userpwd"]))
		{
			if(strlen($_POST["username"]) || strlen($_POST["userpwd"]))
			{
				$_SESSION["error"] = "Please fill in all the fields";
				header("Location: login.php");
				return;
			}
		}
?>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Divyateja Chepuru | Login</title>
	</head>
	
	<body>
	<h2>Please Login</h2>
	<form method="post">
		<p>Username <input type="text" name="username"/></p>
		<p>Password <input type="text" name="userpwd"/></p>
		<p><input type="submit" value="login" /></p>
	</form>
	</body>
</html>