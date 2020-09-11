<?php
namespace project\db;


class feedbackRequests
{

//    public function __construct($fname,$lname,$email,$type,$msg)
//    {
//
//    }
    public function addFeedback($fname,$lname,$email,$type,$msg,$db){
        $sql = "INSERT INTO feedbacks (first_name,last_name,email,type,comment)
                VALUES (:fname,:lname,:email,:type,:comment)";
        $pst = $db->prepare($sql);

        $pst->bindParam(':fname',$fname);
        $pst->bindParam(':lname',$lname);
        $pst->bindParam(':email',$email);
        $pst->bindParam(':type',$type);
        $pst->bindParam(':comment',$msg);

        $count = $pst->execute();
        return $count;
    }
}