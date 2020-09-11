<?php

include '../../Models/Database.php';
include '../../Models/Faq.php';


    $db=Database::getDb();
    $fq = new Faq();
    //var_dump(json_encode($ms->listMusic($db)));
    $faqs = $fq->listFaqs($db);
    //json_encode($songs);
    echo json_encode($faqs);
    //var_dump($lstsongs);


?>