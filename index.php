<?php

require "dbBroker.php";
require "model/user.php";

session_start();

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
<html>
<head>
  <title>Login Form</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="login-form">
    <form method="POST" action="#">
      <div class="container">
        <div class="login-container">
          <img src="img/logoZ-02.png" alt="Logo">
          <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
          </div>
          <button type="submit" class="btn btn-primary"style="padding: 10px 50px; margin-top: 20px; font-weight: bold;">Prijavi se</button>
        </div>
      </div>
    </form>
  </div>
</body>
</html>
