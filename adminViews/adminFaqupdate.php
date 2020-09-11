<?php
    ob_start();
    require_once '../Models/Database.php';
    require_once '../Models/Faq.php';
    require_once 'adminView/header.php';

    //Get Database connection
    $db=Database::getDb();
    $fq = new Faq();
    //Get query string Get request
    $id = $_GET['id'];
    //Get specific Faq
    $faq = $fq->getFaq($db, $id);

    //User submit form Update button
    if(isset($_POST['updateFaq'])){
        $question = $_POST['faqquestion'];
        $answer = $_POST['faqanswer'];
        $fq->updateArtist($db,$question,$answer,$id);
    }

?>

    <h1>Update Faq</h1>
    <form action="" method="post">
        <div class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-md-2" for="faqquestion">Question :</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="faqquestion" id="faqquestion" value="<?= $faq->question; ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="faqanswer">Answer :</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="faqanswer" id="faqanswer" value="<?= $faq->answer; ?>"/>
                </div>
            </div>
            <div>
                <button type="submit" name="updateFaq" class="btn btn-primary float-right" id="btn-submit">Update FAQ</button>
            </div>
        </div>

    </form>
    <div class="mt-4">
        <a href="adminFaqlist.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to List</a>
    </div>

<?php





