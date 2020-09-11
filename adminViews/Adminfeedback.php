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

//show feedback table
$fb = $feedbacks->listFeedback($dbconn);
//create variables for user details
$fName = $lName = $email = $comment ="";


if(isset($_POST['deleteFeedback'])){
    $id = $_POST['feedbackId'];

    if($id == null || $id == ""){

    }
    else{
        $feedbacks->deleteFeedback($id,$dbconn);
    }
}
if(isset($_POST['updateFeedback'])){
    $id = $_POST['feedbackId'];
    if($id == null || $id == ""){

    }
    else{
        header("Location: Adminfeedbackupdate.php?id=".$id);
    }
}
?>
        <!-- Title of the page -->
        <h1>All Feedbacks</h1>
<div>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Comment</th>
        </tr>

        <?php
        foreach ($fb as $f){?>
            <tr>
                <td><?php echo $f->first_name." ".$f->last_name;?></td>
                <td><?php echo $f->email;?></td>
                <td><?php
                    foreach ($departments as $dept){
                        if($dept->id == $f->kind){
                            echo $dept->name;
                        }
                    }
                    ?></td>
                <td><?php echo $f->comment;?></td>
                <td><form method="post" action="">
                        <input type="text" value="<?php echo $f->id?>" name="feedbackId" hidden>
                        <input type="submit" name="updateFeedback" value="Update" class="btn btn-info"/>
                        <input type="submit" name="deleteFeedback" value="X" class="btn btn-danger rounded-btn"/>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

</div>


<!--Taking out footer because it is admin view-->
<?php //include 'adminView/footer.php'; ?>
