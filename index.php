<?php

require "dbBroker.php";
require "model/user.php";

if(isset($_POST['username']) && isset($_POST['password'])){
  $uid = 1;
  $un = $_POST['username'];
  $up = $_POST['password'];
 

  $korisnik = new User($uid,$un,$up);

  $odg = User::logInUser($korisnik, $conn);

  //nas odg ako je dobar, treba da ima samo jedan red
  if($odg->num_rows == 1){
    echo "Uspesno ste se prijavili";

    $_SESSION['loggeduser'] = "prijavljen";
    $_SESSION['user_id'] = $korisnik->id;
    
    header('Location: home.php');
    exit();
  }

  else{
    echo `
        <script>
        console.log("Niste se prijavili!");
        </script>
        `;
  }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Kozmeticki salon</title>
</head>
<body>
<div id="login" class="container">
  <div class="row-fluid">
    <div class="span12">
      <div class="login well well-small">
        <div class="center">
          <img src="img/logoZ-02.png" alt="logo"> 
        </div>
        <form method="POST" action="#">
          <div class="control-group">
            <div class="input-prepend">


              <span class="add-on"><i class="icon-user"></i></span>
              <input name="username" required="required" placeholder="Username" maxlength="255" type="text" class="form-control">
              <br>
              <br>
              <span class="add-on"><i class="icon-lock"></i></span>
              <input name="password" required="required" placeholder="Password" type="password" class="form-control"> 
              <br>
              <br>
            <button class="btn btn-primary btn-large btn-block" type="submit">Prijavi se</button> 
          </div>
        </form>
      </div><!--/.login-->
    </div><!--/.span12-->
  </div><!--/.row-fluid-->
</div><!--/.container-->
</body>
</html>