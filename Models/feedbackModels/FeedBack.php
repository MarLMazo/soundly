<?php

class FeedBack{

    public function listFeedback($db){
        $query = 'SELECT * FROM feedbacks';

        $statment = $db->prepare($query);
        $statment->execute();

        $feedbacks = $statment->fetchAll(\PDO::FETCH_OBJ);

        return $feedbacks;
    }
    public function listOneFeedback($id,$db){
        $query = 'SELECT * FROM feedbacks WHERE id = :id';

        $statment = $db->prepare($query);
        $statment->bindParam(':id',$id);
        $statment->execute();

        $feedback = $statment->fetchAll(\PDO::FETCH_OBJ);

        return $feedback;
    }

    public function addFeedback($fName,$lName,$email,$type,$comment,$db){
        //sql query to insert into table
        $sql = "INSERT INTO feedbacks (first_name, last_name, email, kind, comment) VALUES (:fName,:lName, :email, :kind, :comment)";


        $pst = $db->prepare($sql);

        //bind parameters
        $pst->bindParam(':fName',$fName);
        $pst->bindParam(':lName',$lName);
        $pst->bindParam(':email',$email);
        $pst->bindParam(':kind',$type);
        $pst->bindParam(':comment',$comment);

        $count = $pst->execute();
        
        if($count){
            //header("Location: feedback.php");
            echo "Thank you!";
        }
        else{
            echo "Problem";
        }
    }
    public function deleteFeedback($id, $db){
        //sql query to delete from table by id
        $sql = "DELETE FROM feedbacks WHERE id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':id',$id);

        $count = $pst->execute();

        //if returned rows more then 1 refresh page
        if($count){
            header("Location: Adminfeedback.php");
        }
        else{
            echo "Problem";
        }
    }
    public function updateFeedback($id,$fName,$lName,$email,$type,$comment,$db){
        //sql query to insert into table
        $sql = "UPDATE feedbacks SET first_name = :fName, last_name = :lName, email = :email, kind = :kind, comment = :comment where id = :id ";


        $pst = $db->prepare($sql);

        //bind parameters
        $pst->bindParam(':id',$id);
        $pst->bindParam(':fName',$fName);
        $pst->bindParam(':lName',$lName);
        $pst->bindParam(':email',$email);
        $pst->bindParam(':kind',$type);
        $pst->bindParam(':comment',$comment);


        $count = $pst->execute();

        //if returned rows more then 1 refresh page
        if($count){
            header("Location: Adminfeedback.php");
        }
        else{
            echo "Problem";
        }
    }
}