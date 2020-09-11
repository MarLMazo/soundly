<?php include 'view/header.php';
      require_once 'Models/Database.php';
      require_once 'Models/Contact.php';

$con_errmsg = '';


      //check to see if form is submitted
if(isset($_POST['addContactMsg'])) {

  //get the data from the form
  $topic = $_POST['topic'];
  $message = $_POST['message'];

  if($topic == "" || $message == ""){
    //echo "The field is enpty. Please enter something.";
    $con_errmsg = 'Field is empty. Please enter something.';

  }
  //if okay then add to table in db

  else {

    //connest to database
    $db = Database::getDb();
    $c = new Contact();
    $conMsg = $c->addContactMsg($topic, $message, $db);
    if($conMsg){
      echo '<h3>Thank you for contacting us. We will get back to you within 2 business days.</h3>';
    }else{
      echo '<h3>Problem sending contact message!</h3>';
    }


  }


}
?>



<?php include 'view/footer.php'; ?>
