<?php


class Contact {

    public function addContactMsg($topic, $message, $db) {

        $sql = "INSERT INTO contact_forms (topic, message)
              VALUES (:topic, :message) ";
        $pst = $db->prepare($sql);

        $pst->bindParam(':topic', $topic);
        $pst->bindParam(':message', $message);

        $conMsg = $pst->execute();
        return $conMsg;

    }

/*
    public function getContactMsgs($topic, $message){
        
        $dbconn = Database::getDb();
        $sql = "SELECT * FROM user_accounts WHERE id=:id";
        $query = $dbconn->prepare($sql);
        $query->bindParam(':topic', $topic);
        $query->bindParam(':message', $message);
        $query->execute();

    return $query->fetchAll(PDO::FETCH_OBJ);

       //fetch all records
       //$contactmsgs = $query->fetchAll(PDO::FETCH_OBJ);

}

*/


/*
public function getAllContacts($dbconn){


    $dbconn = Database::getDb();
    $sql = "SELECT * FROM user_accounts";
    $pdostm = $dbconn->prepare($sql);
    $pdostm->execute();

    $contactmsgs = $pdostm->fetchAll(PDO::FETCH_OBJ);
    return $contactmsgs;
}

*/

public function getAllContacts($dbconn){

    $sql = "SELECT * FROM user_accounts";
    $pdostm = $dbconn->prepare($sql);
    $pdostm->execute();

    $contactmsgs = $pdostm->fetchAll(\PDO::FETCH_OBJ);
    return $contactmsgs;
}



}

?>







<?php

/*
    //access the connection from the basatase conntection page
    //allows us to interact with the datavase
 // class contactMsg extends Dbase {


        public function addContactMsg($topic, $message) {

            $sql = "INSERT INTO contact_form (topic, message)
                    VALUES (topic, message) ";

            //connects to connect method from the database class
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$topic, $message]);

        }

    }

 */

?>
