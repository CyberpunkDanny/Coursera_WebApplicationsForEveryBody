<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shreyas Jalnapurkar Database</title>

    <!-- Bootstrap -->
    <?php
    require_once "base.php";
     ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php
    require_once "pdo.php";
    // require_once "nav.php";
    session_start();
    if(!isset($_SESSION['login_success']) || $_SESSION['login_success'] === false)
    {
      require_once "nav.php";
      die("<div class = \"container\"><p style = 'color:red'>not logged in. Name parameter missing</p><p> Please <a href = \"login.php\">LogIn</a> </p>");
    }
    else if( !isset($_GET['name']) )
    {
      require_once "nav.php";
      die("<div class = \"container\"><p style = 'color:red'>not logged in(name parameter missing)</p><p> Please <a href = \"login.php\">LogIn</a> </p>");
    }
    else if( isset($_POST['add_record']) )
    {
      require_once "nav_login.php";
      if(empty($_POST['make']))
      {
        echo "<div class = \"container\"><p style = 'color:red'>Make is required</p>";
      }
      else {
        if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
          echo "<div class = \"container\"><p style = 'color:red'>Mileage and year must be numeric</p>";
        }
        else {
          $sql = "INSERT INTO autos(make,year,mileage) VALUES (:mk,:yr,:mlg)";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(Array(':mk'=>htmlentities($_POST['make']),
                               ':yr'=>$_POST['year'],
                               ':mlg'=>$_POST['mileage']));
          echo "<div class = \"container\"><p style = 'color:green'>Record inserted</p>";
        }
      }
    }
    else{
      require_once "nav_login.php";
    }
     ?>
     <div class="container">
      <h1>ADD and update Auto records</h1>
    <form method="post">
      <div class="form-group row" >

        <label for="make" class = "col-form-label col-sm-2"><strong>Make</strong></label>
        <input type="text" class="form-control col-sm-10" id="make" placeholder="Hyundai" name = "make"
        value = <?php if(isset($_POST['make'])){echo htmlentities($_POST['make']);} else{ echo ""; } ?>>
        <!--<p class="help-block">Help text here.</p>-->
      </div>
      <div class="form-group row">

        <label for="year" class = "col-form-label col-sm-2"><strong>Year</strong></label>
        <input type="text" class="form-control col-sm-10" id = "year" name = "year" placeholder="2009"
        value = <?php if(isset($_POST['year'])){echo htmlentities($_POST['year']);} else{ echo ""; } ?>>

      </div>
      <div class="form-group row">

        <label for="mileage" class = "col-form-label col-sm-2"><strong>Mileage</strong></label>
        <input type="text" class="form-control col-sm-10" id = "mileage" name = "mileage" placeholder="180000"
        value = <?php if(isset($_POST['mileage'])){echo htmlentities($_POST['mileage']);} else{ echo ""; } ?>>

      </div>

        <input type="submit" class = "btn btn-primary" value="Add" name = "add_record">

      </form>
      <br>
      <form class = "inline-form" action="index.php" method="post">
        <input type="submit" name="logout" value="logout">
      </form>
    </div>
  <?php
  require_once "pdo.php";
  echo "<div class='container'>
    <h3>Auto records</h3>";
  $sql = "SELECT * FROM Misc.autos";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo "<table class='table'>
    <thead>
    <tr>
    <th scope='col'># </th>
    <th scope = 'col'>Make</th>
    <th scope = 'col'>Year</th>
    <th scope = 'col'>Mileage</th>
    </tr>
    </thead>
    <tbody>";
  foreach ($row as $vals) {
    echo "<tr>
      <th scope = 'row'>".$vals['auto_id']."</th>
      <td>".$vals['make']."</td>
      <td>".$vals['year']."</td>
      <td>".$vals['mileage']."</td>
    </tr>";
  }
  echo "</tbody>
</table>";
  echo "</div>";
  $_SESSION['previous_location'] = 'autos.php';
   ?>
  </body>
</html>