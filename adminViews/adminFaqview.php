<?php
    require_once '../Models/Database.php';
    require_once '../Models/Faq.php';
    require_once 'adminView/header.php';

    //Get Database connection
    $db = Database::getDb();
    $fq = new Faq();
    //Get query String Get request
    $id = $_GET['id'];
    //Get specific Faq
    $faq = $fq->getFaq($db, $id);

?>

    <h1>View Faq</h1>
    <div>
        <dl class="dl-horizontal">
            <dt>Question</dt>
            <dd><?= $faq->question; ?></dd>
            <dt>Answer</dt>
            <dd><?= $faq->answer; ?></dd>
        </dl>
    </div>
    <div class="mt-4">
        <a href="adminFaqlist.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to List</a>
    </div>
<?php

?>