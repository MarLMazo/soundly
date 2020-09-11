<?php



    if(isset($_POST['registerB'])) {
        
        //Register button was pressed
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $wasSuccessful = $account->register($firstname, $lastname, $email, $username, $password);

        if($wasSuccessful == true) {
            header("Location: index.php");
        }

    }




/*
    //checks to see if the form is submitted
    if(isset($_POST['register'])) {


        //get the data from the form
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($firstname == "" || $lastname == ""){
        echo "The field is empty. Please enter something.";
        }
        //if okay then add to table in db

        else{

            //var_dump($_POST);


        //connect to database
        $db = Database::getDb();
        $c = new CAccount();
        $conMsg = $c->addUserInfo($firstname, $lastname, $email, $username, $password, $db);
        if($conMsg){
        echo '<h3>You are registered</h3>';
        }else{
        echo '<h3>Problem registering!</h3>';
        }

    }




   

        //$regsuccess variable holds registration data and then checks that if the registration was successful 
        //if it is successful then then the user gets sent back to the login page
        $regsuccess = $caccount->register($username, $firstname, $lastname, $email, $password, $db);

        //if registration is true/successful
        if($regsuccess == true) {

            //takes user  back to the login
            header("Location:index.php");

        }




    }

*/


?>