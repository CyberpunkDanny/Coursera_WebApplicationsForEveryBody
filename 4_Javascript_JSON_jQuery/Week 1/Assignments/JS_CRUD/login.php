<?php
	require_once "pdo.php";
	session_start();
?>

<html lang="en">

<head>
	<title>Divyateja Chepuru | Login</title>
	<meta charset="utf-8">
	<script type="text/javascript">
		function validateCredentials()
		{
			console.dir(document.getElementById("userEmail"));
			console.dir(document.getElementById("userPwd"));
			
			var emailId = document.getElementById("userEmail").value;
			var password = document.getElementById("userPwd").value;	

			if(password=="" || password==null || emailId=="" || emailId==null){
				document.getElementById("warningMsg").innerHTML = "Both fields must be filled out";
				document.getElementById("warningMsg").style = "color:red";
				return false;
			}
			else return true;		
		}
	</script>
</head>
<body>
	<h2>Please Log In</h2>
	<form method="post">
		<p>Email: <input type="text" name="userEmail" id="userEmail" /></p>
		<p>Password: <input type="password" name="userPwd" id="userPwd" /></p>
		<input type="submit" onclick="return validateCredentials();" value="Log In" /> <button type="button"><a href="index.php">Cancel</a></button>
	</form>
	<p id="warningMsg"></p>
</body>

</html>
