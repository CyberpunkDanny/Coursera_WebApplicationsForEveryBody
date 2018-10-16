<?php
     session_start();
     require_once "base.php";
     require_once "nav.php";
     $_SESSION['login_success'] = false;
     $salt = 'XyZzy12*_';
     $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123

     $failure = false;  // If we have no POST data
     if( !empty($_POST['who']) && !empty($_POST['pass']) ){
       $i = 0;
       $cleaned_email = htmlentities($_POST['who']);
       $cleaned_password = htmlentities($_POST['pass']);
       while($i < strlen($_POST['who']))
       {
         if($cleaned_email[$i] === "@")
         {
           $check = hash('md5', $salt.$_POST['pass']);
           if($check === $stored_hash)
           {
             $_SESSION['login_success'] = true;
             $_SESSION['name'] = $cleaned_email;
             error_log("Login success ".$_POST['who']);
             header("location:autos.php?name=".urlencode($_POST['who']));
             die();
           }
           else {
             echo "<p style = \"color:red\">Incorrect password</p>";
             error_log("Login fail ".$_POST['who']." $check");
             break;
           }
         }
         else{
           $i = $i+1;
         }
       }
       if($i >= strlen($_POST['who']))
       {
         echo "<p style = \"color:red\">Email must have an at-sign (@)</p>";
       }
     }
     else {
       if ($_SESSION['previous_location'] ==='login.php')
       echo "<p style = \"color:red\">Email and password are required</p>";
       // error_log("Email and password are required",)
     }
     $_SESSION['previous_location'] = 'login.php';
      ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shreyas Jalnapurkar Login page</title>

    <!-- Bootstrap -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container">
      <h1> Please LogIn to make changes </h1>

    <form method="post">
      <div class="form-group" >

        <label for="Loginid">LoginID(email-ID)</label>
        <input type="text" class="form-control" id="Loginid" placeholder="hello@example.com" name = "who"
        value = <?php if(isset($_POST['who'])){echo htmlentities($_POST['who']);} else{ echo ""; } ?>>
        <!--<p class="help-block">Help text here.</p>-->
        <label for="pass">Password</label>
        <input type="text" class="form-control" id = "pass" name = "pass"
        value = <?php if(isset($_POST['pass'])){echo htmlentities($_POST['pass']);} else{ echo ""; } ?>>
        </div>
        <input type="submit" class = "btn btn-primary" value="Log In" name = "LogIn">


      </form>
    </div>
      </body>
</html>