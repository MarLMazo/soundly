<?php

//session_start();


require_once "Models/logregModels/Account.php";
require_once "Models/Database.php";

//initialize class
$reg = new Account();

$reg_errmsg = '';



    //function to remb the input values that the user puts in
    function getInputValue($name) {

      if(isset($_POST[$name])) {
      echo $_POST[$name];
      }

    }


// check Register request
if (isset($_POST['registerB'])) {


    //var_dump($_POST);

 
    // set session and redirect user to the profile page
    //$_SESSION['user_id'] = $user_id;
    //echo $_SESSION['user_id'];
    //echo 'Hello';

    if ($_POST['firstname'] == "") {
        $reg_errmsg = 'A first name is required. Try again.';

    } else if ($_POST['lastname'] == "") {
        $reg_errmsg = 'A last name is required. Try again.';

    } else if ($_POST['email'] == "") {
        $reg_errmsg = 'An email is required. Try again.';

    } else if ($_POST['username'] == "") {
        $reg_errmsg = 'A username is required. Try again.';

    } else if ($_POST['password'] == "") {
        $reg_errmsg = 'A password is required. Try again.';

    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $reg_errmsg = 'Invalid email address. Try again.';

     }  else if ($reg->emailTaken($_POST['email'])) {
        $reg_errmsg = 'That email is already in use. Choose a different email.';

    } else if ($reg->usernameTaken($_POST['username'])) {
        $reg_errmsg = 'That username is already in use. Choose a different username.';

    } else {
        $id = $reg->Register($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['password']);
        // set session and redirect user to the main page
        $_SESSION['id'] = $id;
        echo $_SESSION['id'];
        header("Location: index.php");
    }

    

}
?>







<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Soundly | Register</title>
  </head>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/registration.css">
  <body>
    <h1 class="hidden">Soundly: A music streaming App</h1>
    <div class="container-fluid bg">
      <div class="container">
        <div class="d-flex align-items-center justify-content-center">

          <div class="align-self-center text-center">
            <img class="logo" src="images/logo.png" alt="Logo of Soundly">
            <h3> Create an Account</h3>

            <?php

                if ($reg_errmsg != "") {
                echo '<div class="alert"><h4><strong>Error: </strong> ' . $reg_errmsg . '</h4></div>';
                }

            ?>

          </div>
          <div>
            <form id="regform" action="" method="POST">

                <input class="input-login form-control" id="firstn" type="text" name="firstname" placeholder="First Name" value="<?php getInputValue('firstname') ?>"> <!--gets value to remeber-->

                <div class="error">
                   <!--grabs error and displays it if condition applies-->
                </div>

                <input class="input-login form-control" id="lastn" type="text" name="lastname" placeholder="Last Name" value="<?php getInputValue('lastname') ?>">

                <div class="error">
                </div>

                <input class="input-login form-control" id="emailadd" type="email" name="email" placeholder="Email Address" value="<?php getInputValue('email') ?>">

                <div class="error">

                </div>

                <input class="input-login form-control" id="usern" type="text" name="username" placeholder="Username" value="<?php getInputValue('username') ?>">

                <div class="error">
                </div>

                <input class="input-login form-control" id="userp" type="password" name="password" placeholder="Password" >

                <div class="error">
                </div>

                <h4 class="atypelabel">Choose an account type:</h4>

                <label for="free">Free</label>
                <input type="radio" id="free" name="atype" value="Free">

                <label for="premium">Premium</label>
                <input type="radio" id="premium" name="atype" value="premium">

                <!--
                <select class="input-login form-control" id="accounttype">
                    <option value="">--Please choose an option--</option>
                    <option value="Free">Free</option>
                    <option value="premium">Premium</option>
                </select>
                -->

                <div class="buttons">
                <button type="submit" name="registerB" value="register" class="btn btn-primary btn-login">Sign Up</button>
                </div>
            </form>
          </div>
        </div>
      </div>
  </body>
</html>