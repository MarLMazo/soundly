<?php include 'view/header.php'; 


require_once "Models/logregModels/Account.php";
require_once "Models/Database.php";



$dbconn = Database::getDb();
$app = new Account();

//function to grab the user info
$id = $_SESSION['id'];
$user = $app->UserDetails($_SESSION['id']); 

    if($user){
        //echo "Got user info!";

    }
    else {
       // echo "Problem getting user";
    }


//error message variable
$up_errmsg = '';
    

// check update button request
if (isset($_POST['updateP'])) {


    //function to grab the user info
    $upp = new Account();
    $id = $_SESSION['id'];
    $user = $upp->UserDetails($_SESSION['id']); 


    /*
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    */


    if ($_POST['firstname'] == "") {
        $up_errmsg = 'A first name is required. Try again.';

    } else if ($_POST['lastname'] == "") {
        $up_errmsg = 'A last name is required. Try again.';

    } else if ($_POST['email'] == "") {
        $up_errmsg = 'An email is required. Try again.';

    } else if ($_POST['username'] == "") {
        $up_errmsg = 'A username is required. Try again.';

    } else if ($_POST['password'] == "") {
        $up_errmsg = 'A password is required. Try again.';

    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $up_errmsg = 'Invalid email address. Try again.';

        //The user can use their previous email
     }  else if ($app->emailTaken($_POST['email'] || $user->email !== $user->email )) {
        $up_errmsg = 'That email is already in use. Choose a different email.';

    } else if ($app->usernameTaken($_POST['username'])) {
        $up_errmsg = 'That username is already in use. Choose a different username.';

    } else {
        $id = $app->updateProfile($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['password'], $id);



       // $id = $app->updateProfile($firstname, $lastname, $email, $username, $password);


        //redirect user to the profile
        echo ("Profile Updated!");

        //$_SESSION['id'] = $id;
        //echo $_SESSION['id'];
    }

}
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Soundly | Update Profile</title>
  </head>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <body>


  <h2>Update Profile</h2>

          <div class="align-self-center text-center">
            <?php
                if ($up_errmsg != "") {
                echo '<div class="alert"><h4><strong>Error: </strong> ' . $up_errmsg . '</h4></div>';
                }
            ?>
          </div>

        <div>
            <form id="updateprofile_form" action="" method="POST">

            <div class="form-group">
                <label for="firstn">First Name</label>
                <input class=" form-control" id="firstn" type="text" name="firstname" placeholder="First Name" value="<?php echo $user->first_name ?>"><!--gets value to remeber what the user inputted-->
            </div>

            <div class="form-group">
                <label for="lastn">Last Name</label>
                <input class="input-login form-control" id="lastn" type="text" name="lastname" placeholder="Last Name" value="<?php echo $user->last_name ?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="input-login form-control" id="emailadd" type="email" name="email" placeholder="Email Address" value="<?php echo $user->email ?>">
            </div>

            <div class="form-group">
                <label for="usern">Username</label>
                <input class="input-login form-control" id="usern" type="text" name="username" placeholder="Username" value="<?php echo $user->username ?>">
            </div>
            
            <div class="form-group">
                <label for="firstn">Password</label>
                <input class="input-login form-control" id="userp" type="password" name="password" placeholder="Password" value="<?php echo $user->password ?>">
            </div>

            <div class="form-group">
                <button type="submit" name="updateP" value="register" class="btn btn-primary btn-login">Update Profile</button>
            </div>

            <p><a href="userProfile.php"> Back to Profile</a></p>

            </form>
        </div>
  </body>
</html>






<?php include 'view/footer.php'; ?>
