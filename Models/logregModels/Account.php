<?php



class Account {

       public function Register($firstname, $lastname, $email, $username, $password) {

        try {

            //go to database class, bind the getDB function to it
            $dbconn = Database::getDb();
            $query = $dbconn->prepare("INSERT INTO user_accounts (first_name, last_name, email, username, password) VALUES (:firstname, :lastname, :email, :username, :password)");
            $query->bindParam(":firstname", $firstname, PDO::PARAM_STR);
            $query->bindParam(":lastname", $lastname, PDO::PARAM_STR);
            $query->bindParam(":email", $email, PDO::PARAM_STR);
            $query->bindParam(":username", $username, PDO::PARAM_STR);
            $enc_password = hash('sha256', $password);
            $query->bindParam(":password", $enc_password, PDO::PARAM_STR);
            $query->execute();
            return $dbconn->lastInsertId();

        } catch (PDOException $e) {

            exit($e->getMessage());

        }

    }



       public function usernameTaken($username) {
        try {
            $dbconn = Database::getDb();
            $query = $dbconn->prepare("SELECT id FROM user_accounts WHERE username=:username");
            $query->bindParam(":username", $username, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }




        public function emailTaken($email) {
        try {
            $dbconn = Database::getDb();
            $query = $dbconn->prepare("SELECT id FROM user_accounts WHERE email=:email");
            $query->bindParam(":email", $email, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    
    
        public function Login($username, $password){
        try {
            $dbconn = Database::getDb();
            $query = $dbconn->prepare("SELECT id FROM user_accounts WHERE username=:username AND password=:password");
            $query->bindParam(":username", $username, PDO::PARAM_STR);
            $enc_password = hash('sha256', $password);
            $query->bindParam(":password", $enc_password, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_OBJ);
                return $result->id;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }


/*
        public function UserDetails($id, $dbconn){
        try {
            $dbconn = Database::getDb();
            $query = $dbconn->prepare("SELECT * id, first_name, last_name, username, email FROM user_accounts WHERE id=:id");
            $query->bindParam("id", $id, PDO::PARAM_INT);
            //$query->bindParam("first_name", $name, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return $query->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

*/


    public function UserDetails($id){
        
        $dbconn = Database::getDb();
        $sql = "SELECT * FROM user_accounts WHERE id=:id";
        $query = $dbconn->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();

    return $query->fetch(PDO::FETCH_OBJ);

}


    public function updateProfile($firstname, $lastname, $email, $username, $password, $id) {

        try {

            //UPDATE playlists SET name = :name, date_created = :date_created WHERE id = :id'

            //go to database class, bind the getDB function to it
            $dbconn = Database::getDb();
            $query = $dbconn->prepare("UPDATE user_accounts SET first_name = :firstname, last_name = :lastname, email = :email, username = :username, password = :password WHERE id = :id");
            $query->bindParam(":firstname", $firstname, PDO::PARAM_STR);
            $query->bindParam(":lastname", $lastname, PDO::PARAM_STR);
            $query->bindParam(":email", $email, PDO::PARAM_STR);
            $query->bindParam(":username", $username, PDO::PARAM_STR);
            $enc_password = hash('sha256', $password);
            $query->bindParam(":password", $enc_password, PDO::PARAM_STR);
            $query->bindParam(":id", $id, PDO::PARAM_STR);
            $query->execute();
            return $dbconn->lastInsertId();

        } catch (PDOException $e) {

            exit($e->getMessage());


        }

    }






}












