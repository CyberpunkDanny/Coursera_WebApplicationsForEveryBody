<?php
	require_once "pdo.php";
	session_start();
?>

<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Divyateja Chepuru | Home</title>
	</head>
	
	<body>
		<h2>Welcome to the Automobiles Database</h2>
		<?php
			if(isset($_SESSION["success"]))
			{
				echo '<p style="color:green">'.$_SESSION["success"].'</p>';
				unset($_SESSION["success"]);
			}
		?>
		<?php
			if(!isset($_SESSION["account"]))
			{
				echo '<p><a href="login.php">Please log in</a></p>'	;
				echo '<p>Attempt to go to <a href="add.php">add data</a> without logging in would fail</p>';	
			}
			else
			{
				$sql = "SELECT * FROM autos";
				$stmt = $pdo->query($sql);
				if($stmt->fetch(PDO::FETCH_ASSOC) === FALSE)
				{
					echo "<p>No rows found</p>";
				}
				else
				{
					echo '<table border="1">';
					echo '<tr><th>Make</th><th>Model</th><th>Year</th><th>Mileage</th><th>Action</th></tr>';
					while($row = $stmt->fetch(POD::FETCH_ASSOC))
					{
						echo '<tr><td>'.$row["auto_make"].'</td><td>'.$row["auto_model"].'</td><td>'.
							 $row["auto_year"].'</td><td>'.$row["auto_mileage"].'</td><td>'.
							 '<p><a href="edit.php?userID='.$row["auto_id"].'">Edit</a>/'.
							 '<a href="delete.php?userID='.$row["auto_id"].'">Delete</a></p>'.'</td></tr>';
					}
					echo '</table>';
				}
				echo '<p><a href="add.php">Add New Entry</a></p>';
				echo '<p><a href="logout.php">Logout</a></p>';
			}
		?>
		
	</body>
</html>