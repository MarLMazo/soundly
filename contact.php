<?php include 'view/header.php';

//echo 'This is the session for user number ' . $_SESSION['id'];

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

  } //if okay then add to table in db

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

      <h1>Contact Us</h1>

      <p>Have a question or concern? Send us a message, we would love to hear from you!</p>

      <div class="align-self-center text-center">
            <?php
                if ($con_errmsg != "") {
                echo '<div class="alert"><h4><strong>Error: </strong> ' . $con_errmsg . '</h4></div>';
                }
            ?>
          </div>

      <form action="" method="POST">

        <div class="form-group">
          <label for="topic">Topic</label>
          <input type="text" name="topic" id="topic" class="form-control" aria-describedby="helpId">
        </div>

        <div class="form-group">
          <label for="message">Message</label>
          <textarea class="form-control" name="message" id="message"rows="3"></textarea>
        </div>

          <button class="btn btn-primary rounded-btn" type="submit" name="addContactMsg">
          Send Message
          </button>

      </form>

<?php include 'view/footer.php'; ?>
