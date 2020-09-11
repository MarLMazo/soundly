<?php include 'view/header.php'; ?>



<?php
//allows the user to logout

    // Destroys user session
    //unset($_SESSION['id']);
    echo 'This is the session for user number ' . $_SESSION['id'];


    // Redirect to login index.php page
    //header("Location: index.php");

?>




<h1>Logout</h1>
<p>We are sorry to see you go. Are you sure you want to logout? </p>



<?php include 'view/footer.php'; ?>
