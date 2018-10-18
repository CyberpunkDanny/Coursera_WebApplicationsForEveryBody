<?php
	session_start();
?>

<html>

<head></head>

<body>
	<h2>Cool Application</h2>
	<?php
		if(isset($_SESSION["success"]))
		{
			echo $_SESSION["success"];
		}
		if(isset($_SESSION["account"]))
		{
			?>
			<p>How cool this is gonna be!</p>
			<p><a href="logout.php">Log Out</a></p>
		<?php }?>
	?>
</body>
</html>