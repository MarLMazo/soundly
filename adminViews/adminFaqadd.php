<?php
    ob_start();
    require_once '../Models/Database.php';
    require_once '../Models/Faq.php';
    require_once 'adminView/header.php';

    //Get Database connection
    $db=Database::getDb();
    $fq = new Faq();

    //If user submit the form
    if(isset($_POST['addSong'])){
        $question = $_POST['faqquestion'];
        $answer = $_POST['faqanswer'];

        //Error Handling if question or answer is empty
        if($question == '' || $answer == ''){
            $error = 'Please Enter Appropriate Details';
        } else{
            $fq->addFaq($db, $question, $answer);
        }

    }

?>
<h1>Add FAQ</h1>
<!--    Form to Update  Student -->
<form action="" method="post">
    <div class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-md-2" for="faqquestion">Question :</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="faqquestion" id="faqquestion" <?php if(isset($error)){ echo 'style="border:1px solid red;"';} if(isset($question)){ echo 'value="'.$question.'"';}?>/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="faqanswer">Answer :</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="faqanswer" id="faqanswer" <?php if(isset($error)){ echo 'style="border:1px solid red;"';} if(isset($answer)){ echo 'value="'.$answer.'"';}?>/>
            </div>
        </div>
        <div>
            <button type="submit" name="addSong" class="btn btn-primary float-right" id="btn-submit">Add FAQ</button>
        </div>
        <span style="color: red"><?php if(isset($error)){ echo $error;}?></span>
    </div>



</form>
<div class="mt-4">
    <a href="adminFaqlist.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to List</a>
</div>
