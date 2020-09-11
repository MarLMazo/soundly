<?php


namespace project\db;


class Feedbacks
{
    public function getFeedbacks($db){
        $query = "select * from feedbacks";
        $pdostm = $db->prepare($query);
        $pdostm->execute();

        $result = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }
}