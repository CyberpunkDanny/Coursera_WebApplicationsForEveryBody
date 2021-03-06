<?php
	//This code should always be at the top
	if(isset($_POST['cancel'])){
		header("Location: index.php");
		return;
	}
	
	$failure = false;
	$mainPwd = "meow123";
	
	if(isset($_POST['login'])){
	if(isset($_POST['who']) && isset($_POST['pass'])){
		if(strlen($_POST['who'])<1 || strlen($_POST['pass'])<1)
			$failure = "Username and password are required";
		else {
			if($_POST['pass'] == $mainPwd){
					header("Location: game.php?userName=".urlencode($_POST['who']));
					return;
			}
			else 
				$failure = "Wrong Password";
		}
	}
	else $failure = "I am a Monster"; //To show what happens if isset($_POST['login']) isn't used
	//Or avoid using variables of type $failure outside isset($_POST['who']) && isset($_POST['pass')] block
	}
	
?>

<!DOCTYPE html>

<html lang = "en">

<head>
	<meta charset = "UTF-8">
	<title>Login | Rock Paper Scissors</title>
</head>

<body>
	<h1>Please login to play  Rock Paper Scissors</h1>
	<?php
		if($failure != false)
			echo $failure, "</br>";
	?>
	<form method = "post">
			<p><label for = "userName">User Name:</label>
			<input type = "text" id = "userName" name = "who" /></p>
			<p><label for = "userPwd">Password:</label>
			<input type = "password" id = "userPwd" name = "pass" /></p>
			<p><input type = "submit" name = "login" value = "Log In"/>
			<!-- Upon pressing 'Cancel', Page can be redirected to index.php using any of the two methods
			(i)  using a <a> tag
			(ii) using isset() in PHP
			-->
			
			<!-- <a href = "index.php"><input type = "button" value = "Cancel"/></a> -->
			<input type = "submit" name = "cancel" value = "Cancel"/></p>
	</form>
	<p>Search on this page for password hint. Username is your name. </p>
	<!-- Hint: The password is the four character sound a cat
makes (all lower case) followed by 123. -->
</body>

</html>