<?php
	session_start();
	if(!isset($_SESSION["account"]))
	{
		echo "<p><a href='index.php'>Go back</a></p>";
		die("Access denied!");
	}
	
	if(isset($_POST["make"]) && isset($_POST["model"]) && isset($_POST["year"]) && isset($_POST["mileage"]))
	{
		if(strlen($_POST["make"])<1 || strlen($_POST["model"])<1 || strlen($_POST["year"])<1 || strlen($_POST["mileage"])<1)
		{
			$_SESSION["error"] = "Please fill in all the fields";
			header("Location: add.php");
			return;
		}
		if(!is_numeric($_POST["year"]) || !is_numeric($_POST["mileage"]))
		{
			$_SESSION["error"] = "Year and Mileage must be numericals";
			header("Location: add.php");
			return;
		}
		$sql = "INSERT INTO autos(auto_make, auto_model, auto_year, auto_mileage) VALUES(:ph_memberName, :ph_memberEmail, :ph_memberPwd)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
						':ph_memberName' => $_POST["memberName"],
						':ph_memberEmail' => $_POST["memberEmail"],
						':ph_memberPwd' => $_POST["memberPwd"]						
					)
		);
		$_SESSION["success"] = "New member added successfully";
		header("Location: index.php");
		return;
	}
?>

<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Divyateja Chepuru | Add</title>
</head>

<body>
	<h3>Tracking Automobiles for <?= htmlentities($_SESSION["account"]); ?></h3>
	<?php
	if(isset($_SESSION["error"]))
		{
			echo '<p style="color:red">'.$_SESSION["error"].'</p>';
			unset($_SESSION["error"]);
		}
	?>
	<form method="post">
		<p>Make: <input type="text" name="make" /></p>
		<p>Model: <input type="text" name="model" /></p>
		<p>Year: <input type="text" name="year" /></p>	
		<p>Mileage: <input type="text" name="mileage" /></p>
		<p><input type="submit" value="Add" /> | <button><a href="index.php">Cancel</a></button></p>
	</form>
</body>

</html>