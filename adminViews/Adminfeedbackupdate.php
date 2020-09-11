<?php ob_start(); ?>
<?php include 'adminView/header.php'; ?>
<?php //include "feedback-Script.php"?>

<?php

require_once "../Models/Database.php";
require_once "../Models/feedbackModels/Departments.php";
require_once "../Models/feedbackModels/FeedBack.php";

$dbconn = Database::getDb();
$department = new Departments();
$feedbacks = new FeedBack();
$departments = $department->getDepartments($dbconn);

$id = $_GET['id'];


$f = $feedbacks->listOneFeedback($id,$dbconn);


//create variables for user details
$fName = $lName = $email = $comment ="";
if(isset($_POST['updateFeedback'])){

    //FILL THESE FIELDS OUT LATER
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $comment = $_POST['comment'];

    //validate for errors
    if($id == null || $id == ""){

    }
    //if correct go ahead
    else{
        //comment out for now
        $feedbacks->updateFeedback($id,$fName,$lName,$email,$type,$comment,$dbconn);
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
            <input type="text" name="fName" id="fName" class="form-control" placeholder="Enter your name" aria-describedby="helpId" value="<?php echo $f[0]->first_name;?>">
            <small id="helpId" class="text-muted">Enter your first name</small>
        </div>
        <!-- END FIRST NAME GROUP -->
        <div class="form-group col">
            <label for="lName">Last Name:</label>
            <input type="text" name="lName" id="lName" class="form-control" placeholder="Enter your name" aria-describedby="helpId" value="<?php echo $f[0]->last_name;?>">
            <small id="helpId" class="text-muted">Enter your last name</small>
        </div>
        <!-- END LAST NAME GROUP -->
    </div>
    <!-- END NAME ROW -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="Enter email" aria-describedby="helpId" value="<?php echo $f[0]->email;?>">
        <small id="helpId" class="text-muted">Enter a valid email EX.(email@me.ca)</small>
    </div>
    <!-- END EMAIL GROUP -->
    <div class="form-group">
        <select class="form-control" name="type">
            <?php
            foreach ($departments as $dept){?>
                <option value="<?php echo $dept->id;?>" <?php if($f[0]->kind == $dept->id){echo "selected";}?>><?php echo $dept->name; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <!-- FORM DROPDOWN GROUP -->
    <div class="form-group">
        <label for="comment">Comment</label>
        <textarea class="form-control" name="comment" id="comment" rows="3"><?php echo $f[0]->comment;?></textarea>
    </div>
    <input class="btn btn-primary rounded-btn" type="submit" name="updateFeedback" value="Update" />
</form>
