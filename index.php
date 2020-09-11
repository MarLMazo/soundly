<?php

session_start();


require_once "Models/logregModels/Account.php";
require_once "Models/Database.php";


//initilize class
$reg = new Account();

$login_errmsg = '';


//function to remb the input values that the user puts in
function getInputValue($name) {

  if(isset($_POST[$name])) {
    echo $_POST[$name];
  }

}


// check Login request
if (isset($_POST['loginButton'])) {

    //sanitize. removes white space and other predefined characters from both sides of the string
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username == "") {
        $login_errmsg = 'A username field is required.';

    } else if ($password == "") {
        $login_errmsg = 'A password field is required.';

    } else {
        $id = $reg->Login($username, $password); // Checks user login details
        if($id > 0)
          {
              $_SESSION['id'] = $id; // Sets to user id and starts session
              header("Location: main.php"); // Direct user to the main dashboard
              echo $_SESSION['id'];

          }
          else
          {
              $login_errmsg = 'Invalid login details. Please check your username and password.';
          }
    }
}


?>









<?php



    //connects to login handler
    //include_once("handlers/login-handler.php");
    //include("Models/Database.php");


    //echo $account->getError(Constants::$loginFailed); 
/*
 
    require_once 'core/init.php';

    //echo Config::get('mysql/host');

    DB::getInstance();

    $user = DB::getInstance()->query("SELECT username FROM user_accounts WHERE username = ?", array('alex'));

    
    if($user->error()) {

      echo 'No user';

    } else {

      echo 'Okay user!';

    }

*/


?>





<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Soundly | The ultimate music player</title>
  </head>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/login.css">
  <body>
    <h1 class="hidden">Soundly: A music streaming App</h1>
    <div class="container-fluid bg">
      <div class="container">
        <div class="d-flex align-items-center justify-content-center">

          <div class="align-self-center text-center">
            <img class="logo" src="images/logo.png" alt="Logo of Soundly">
            <h3>The ultimate music player</h3>
          </div>

          <?php
            if ($login_errmsg != "") {
                echo '<div class="alert"><h4><strong>Error: </strong> ' . $login_errmsg . '</h4></div>';
            }
          ?>

          <div>
            <form id="loginform" action="" method="POST">
              <input class="input-login form-control" id="usern" type="text" name="username" placeholder="Username" value="<?php getInputValue('username') ?>">

              <input class="input-login form-control" id="userp" type="password" name="password" placeholder="Password">

              <div class="buttons">
                <button type="submit" name="loginButton" id="login" class="btn btn-primary btn-login" >Log In</button>
                <a href="registration.php" class="signup">Sign Up</a>
              </div>
            </form>
          </div>
        </div>
      </div>
  </body>
</html>
