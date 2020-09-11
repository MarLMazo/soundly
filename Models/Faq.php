<?php

class Faq
{

    public function listFaqs($db)
    {
        //Get query for sql
        $query = 'SELECT * FROM faqs';
        //Prepare and execute the query
        $sql = $db->prepare($query);
        $sql->execute();
        //Put the executed values to a variable
        $faqs = $sql->fetchAll(\PDO::FETCH_OBJ);
        //return the values
        return $faqs;
    }

    public function search($db, $searchkey){
        $query = 'SELECT * FROM faqs WHERE question LIKE :searchkey';
        $sql = $db->prepare($query);
        $sql->bindParam(':searchkey', $searchkey);
        $sql->execute();

        $faqs = $sql->fetchAll(\PDO::FETCH_OBJ);
        return $faqs;
    }

    public function addFaq($db,$question,$answer){
        //sql query to insert into table
        $query = "INSERT INTO faqs (question, answer) VALUES (:question, :answer)";

        $sql = $db->prepare($query);

        //bind parameters
        $sql->bindParam(':question',$question);
        $sql->bindParam(':answer',$answer);

        $count = $sql->execute();

        //if returned rows more then 1 refresh page
        if($count){
            header("Location: adminFaqlist.php");
        }
        else{
            echo "Problem Adding Song";
        }
    }

    public function updateArtist($db,$question, $answer,$id){
        //sql query to insert into table
        $query = "UPDATE faqs SET question = :question, answer = :answer WHERE id = :id";


        $sql = $db->prepare($query);

        //bind parameters
        $sql->bindParam(':question',$question);
        $sql->bindParam(':answer',$answer);
        $sql->bindParam(':id',$id);

        $count = $sql->execute();

        //if returned rows more then 1 refresh page
        if($count){
            header("Location: adminFaqlist.php");
        }
        else{
            echo "Problem Updating Artist";
        }
    }

    public function deleteFaq($db,$id){
        //sql query to insert into table
        $query = "DELETE FROM faqs WHERE id = :id";

        $sql = $db->prepare($query);
        //bind parameters
        $sql->bindParam(':id',$id);
        $count = $sql->execute();

        //if returned rows more then 1 refresh page
        if($count){
            header("Location: adminFaqlist.php");
        }
        else{
            echo "Problem Deleting";
        }
    }

    public function getFaq($db,$id){
        //Get query for sql
        $query = 'SELECT * FROM faqs WHERE id = :id';
        //Prepare and execute the query
        $sql = $db->prepare($query);

        //bind parameters
        $sql->bindParam(':id',$id);
        $sql->execute();
        //Put the executed values to a variable
        $artist = $sql->fetch(\PDO::FETCH_OBJ);
        return $artist;
    }

    public function listAdminFaqs($db, $searchkey, $page,$dataPerPage, $order=null)
    {
        //Get the Order, if Order is question, sort it by question
        if($order == 'question'){
            $orderby = 'ORDER BY question';
        }else{
            //Sort will be empty if its not click
            $orderby = '';
        }
        //Get the search key value of the user
        //If its not empty
        if(!empty($searchkey)){
            $search = 'WHERE question LIKE :searchkey';
        }else{
            //If search key is empty
            $search = '';
        }
        //Get the offset per page, this will the value of index to be started to show
        //Ex: 10 data with 5 per page, 1-5, next will be 6-10
        $offset = ($page-1) * $dataPerPage;
        //QUERY should be SELECT * FROM faqs WHERE question Like %key% ORDER BY question LIMIT (start), data per page
        $query = "SELECT * FROM faqs $search  $orderby LIMIT $offset, $dataPerPage";

        $sql = $db->prepare($query);
        $sql->bindParam(':searchkey', $searchkey);
        $sql->execute();

        $faqs = $sql->fetchAll(\PDO::FETCH_OBJ);
        //$total_page = count($faqs);
        //var_dump(count($faqs));
        return $faqs;
    }

    public function getcount($db){
        $query = "SELECT count(*) as count FROM faqs";
        $sql = $db->prepare($query);
        $sql->execute();


        $total_count = $sql->fetch(\PDO::FETCH_OBJ);
        return $total_count;
    }

}


