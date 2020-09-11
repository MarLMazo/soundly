<?php

// Starts Session
include 'view/header.php';

require_once "Models/Database.php";
require_once "Models/logregModels/Account.php";


/* 
// check user login details
if(empty($_SESSION['user_id'])) {
    
    header("Location: index.php");

}
*/



$dbconn = Database::getDb();
$app = new Account();

$id = $_SESSION['id'];
$user = $app->UserDetails($_SESSION['id']); // get user details

    if($user){
        //echo "Got user info!";
        //echo "<h2> " . $user->first_name . $user->last_name . "</h2>";
    }
    else {
        //echo "Problem getting user";
    }


?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Soundly | User Profile</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div>
            <h2>Profile</h2>
            <h3>Hey <?php echo $user->first_name . " " . $user->last_name ?>!</h3>
            <p>Please see below for your account details.</p>
            <b>First Name:</b> <?php echo $user->first_name ?><br>
            <b>Last name:</b> <?php echo $user->last_name ?><br>
            <b>Email:</b> <?php echo $user->email ?><br>
            <b>Username:</b> <?php echo $user->username ?><br><br>

            <a href="updateProfile.php" class="btn btn-primary">Update Profile</a>
        </div>
    </div>
</body>
</html>




<?php

/* 

$user = 'root';
$password = '';
$dbname = 'soundly';
$dsn = 'mysql:host=localhost;dbname=' . $dbname;

$dbcon = new PDO($dsn, $user, $password);

$sql = "SELECT * FROM user_accounts";
$pdostm = $dbcon->prepare($sql);
$pdostm->execute();

$users = $pdostm->fetchAll(PDO::FETCH_ASSOC);

echo $users;

*/




?>


<?php  

/* foreach ($users as $user) { ?>
            <tr>
                <th><?= $user['id'] ?></th>
                <td><?= $user['first_name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['last_name'] ?></td>
                <td>
                    <form action="updateStudent.php" method="post">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>"/>
                        <input type="submit" class="button btn btn-primary" name="updateStudent" value="Update"/>
                    </form>
                </td>
                <td>
                    <form action="deleteStudent.php" method="post">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>"/>
                        <input type="submit" class="button btn btn-danger" name="deleteStudent" value="Delete"/>
                    </form>
                </td>
            </tr>
        <?php } 
     */   
?>







