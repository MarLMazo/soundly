<?php
  class Genre{
    public function listGenres($db){
        //Get query for sql
        $query = 'SELECT * FROM genres';
        //Prepare and execute the query
        $sql = $db->prepare($query);
        $sql->execute();
        //Put the executed values to a variable
        $genres = $sql->fetchAll(\PDO::FETCH_OBJ);
        //return the values
        return $genres;
    }

    public function getGenre($db,$id){
        //Get query for sql
        $query = 'SELECT * FROM genres WHERE id = :id';
        //Prepare and execute the query
        $sql = $db->prepare($query);

        //bind parameters
        $sql->bindParam(':id',$id);
        $sql->execute();
        //Put the executed values to a variable
        $genre = $sql->fetch(\PDO::FETCH_OBJ);
        return $genre;
    }
  }
 ?>
