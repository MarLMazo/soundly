<?php
    ob_start();
    require_once '../Models/Database.php';
    require_once '../Models/Faq.php';
    require_once 'adminView/header.php';

    //Get database connection
    $db = Database::getDb();
    $fq = new Faq();
    //Get query string Get request
    $id = $_GET['id'];
    //get specific Faq
    $faq = $fq->getFaq($db,$id);

    //User clicks submit button on the form
    if(isset($_POST['delfaq'])){
        $del = $fq->deleteFaq($db,$id);
    }

?>
<h1 class="text-danger">Are you sure you want to Delete this?</h1>
<div>
    <dl class="dl-horizontal">
        <dt>Question</dt>
        <dd><?= $faq->question ?></dd>
        <dt>Answer</dt>
        <dd><?= $faq->answer ?></dd>
    </dl>
</div>

<form method="POST" action="">
    <button class="btn btn-danger float-right" type="submit" name="delfaq">Delete</button>
</form>
<div class="mt-4">
    <a href="adminFaqlist.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to List</a>
</div>
<?php

?>
