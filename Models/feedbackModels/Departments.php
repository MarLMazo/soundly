<?php

class Departments{

    public function getDepartments($db){
        $query = 'SELECT * FROM feedback_types';

        $statment = $db->prepare($query);
        $statment->execute();

        $department = $statment->fetchAll(\PDO::FETCH_OBJ);

        return $department;
    }
}