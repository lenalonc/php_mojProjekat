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
        <form action="/users/login" style="" class="login-form" id="UserLoginForm" method="post" accept-charset="utf-8">
          <div class="control-group">
            <div class="input-prepend">


              <span class="add-on"><i class="icon-user"></i></span>
              <input name="username" required="required" placeholder="Username" maxlength="255" type="text" id="UserUsername">
              <br>
              <br>
              <span class="add-on"><i class="icon-lock"></i></span>
              <input name="password" required="required" placeholder="Password" type="password" id="UserPassword"> 
              <br>
              <br>
            <button class="btn btn-primary btn-large btn-block" type="submit" value="Sign in">Prijavi se</button> 
          </div>
        </form>
      </div><!--/.login-->
    </div><!--/.span12-->
  </div><!--/.row-fluid-->
</div><!--/.container-->
</body>
</html>