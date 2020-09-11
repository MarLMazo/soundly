<?php

    require_once '../Models/Database.php';
    require_once '../Models/Contact.php';
    require_once 'adminView/header.php';


    $dbconn = Database::getDb();

    //$db = Database::getDb();
    $c = new Contact();

/*
    $conMsg = $c->getContactMsgs($topic, $message, $db);
    if($conMsg){
      echo '<h3>Got Contact Messages</h3>';
    }else{
      echo '<h3>Problem getting messages!</h3>';
    }
*/

/*

    $sql = "SELECT * FROM students";
    $pdostm = $dbconn->prepare($sql);
    $pdostm->execute();
    $contactmsgs = $pdostm->fetchAll(PDO::FETCH_ASSOC);

*/


$contactmsgs =  $c->getAllContacts(Database::getDb());


/*
    $conmsgs = $c->getAllContacts($dbconn);
    if($conmsgs){
        echo '<h4>got it</h4>'  ;

      }else{
        echo '<h3>Problem getting messages!</h3>';
      }

      //$contactmsgs = $pdostm->fetchAll(PDO::FETCH_ASSOC);

*/

 /*   
  //fetch all records
  $contactmsgs = $query->fetchAll(PDO::FETCH_OBJ);


    $query =  $dbconn->prepare($sql);
    $query->execute();
    
    //fetch all records
    $contactmsgs = $query->fetchAll(PDO::FETCH_OBJ);
*/

?>




<html lang="en">
<head>
    <title>Student Management System</title>
    <meta name="description" content="Student Management System">
    <meta name="keywords" content="Student, College, Admission, Humber">

</head>

<body>
<p class="h1 text-center">Contact Messages</p>
<div class="m-1">
    <!--    Displaying Data in Table-->
    <table class="table table-bordered tbl">
        <thead>
        <tr>
            <th scope="col">Topic</th>
            <th scope="col">Message</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($contactmsgs as $msg) {
        ?>
        <tr>
            <th><?= $msg->topic; ?></th>
            <td><?= $msg->message; ?></td>
            <td>
                <form action="adminContactupdate.php" method="post">
                    <input type="hidden" name="id" value=""/>
                    <input type="submit" class="button btn btn-primary" name="updateMessage" value="Update"/>
                </form>
            </td>
            <td>
                <form action="adminContactdelete.php" method="post">
                    <input type="hidden" name="id" value="<?= $msg->id; ?>"/>
                    <input type="submit" class="button btn btn-danger" name="deleteMessage" value="Delete"/>
                </form>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <a href="adminContactadd.php" id="btn_addContact" class="btn btn-success btn-lg float-right">Add Message</a>

</div>
</body>
</html>