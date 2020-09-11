<?php include 'view/header.php'; ?>
<?php //include "feedback-Script.php"?>

<?php

require_once "Models/Database.php";
require_once "Models/feedbackModels/Departments.php";
require_once "Models/feedbackModels/FeedBack.php";

$dbconn = Database::getDb();
$department = new Departments();
$feedbacks = new FeedBack();
$departments = $department->getDepartments($dbconn);


//create variables for user details
$fName = $lName = $email = $comment ="";

//if submit button clicked continue
if(isset($_POST['addFeedBack'])){
    //get user input and set to variables
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $comment = $_POST['comment'];

    //check if variables are empty
    //do more validation later
    if($fName == "" || $lName == "" || $email == "" || $comment == ""){
        echo "Please enter info";
    }
    //if okay add to table
    else{
        $feedbacks->addFeedback($fName,$lName,$email,$type,$comment,$dbconn);
    }

}

?>
        <!-- Title of the page -->
        <h1>Feedback</h1>
        <!-- CONTAINER DIV FOR FEEDBACK FORM -->
        <form class="" action="" method="post">
          <div class="row">

            <div class="form-group col">
              <label for="fName">First Name:</label>
              <input type="text" name="fName" id="fName" class="form-control" placeholder="Enter your name" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Enter your first name</small>
            </div>
            <!-- END FIRST NAME GROUP -->
            <div class="form-group col">
              <label for="lName">Last Name:</label>
              <input type="text" name="lName" id="lName" class="form-control" placeholder="Enter your name" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Enter your last name</small>
            </div>
            <!-- END LAST NAME GROUP -->
          </div>
          <!-- END NAME ROW -->
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Enter email" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Enter a valid email EX.(email@me.ca)</small>
          </div>
          <!-- END EMAIL GROUP -->
          <div class="form-group">
              <select class="form-control" name="type">
                  <?php
                  foreach ($departments as $dept){?>
                      <option value="<?php echo $dept->id;?>"><?php echo $dept->name;?></option>
                      <?php
                  }
                  ?>
              </select>
          </div>
          <!-- FORM DROPDOWN GROUP -->
          <div class="form-group">
            <label for="comment">Comment</label>
            <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
          </div>
          <input class="btn btn-primary rounded-btn" type="submit" name="addFeedBack" value="Submit" />
        </form>

<?php include 'view/footer.php'; ?>
