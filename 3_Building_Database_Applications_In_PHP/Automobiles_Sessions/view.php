<?php
	session_start();
	require_once "pdo.php";
	if(!isset($_SESSION["account"]))
	{
		echo "<p><a href='index.php'>Go back</a></p>";
		die("Name parameter missing");
	}
?>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Divyateja Chepuru | View</title>
	</head>
	
	<body>
	<h3>Tracking Automobiles for <?php if(isset($_SESSION["account"])) echo $_SESSION["account"];?></h3>
	<?php 
		$sql = "SELECT * FROM autos";
		$stmt = $pdo->query($sql);
		echo "<h2>Automobiles</h2>";
		echo "<ul>";
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			echo "<li>".$row["auto_year"]." ".$row["auto_mileage"]." ".$row["auto_make"]."</li>";
		}
		echo "</ul>";
	?>
	<p><a href="add.php">Add New</a> | <a href="logout.php">Logout</a></p>
	</body>
</html>
