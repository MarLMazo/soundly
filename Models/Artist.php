<?php

class Artist
{
// QUERY TO GET ALL
//SELECT * FROM artists INNER JOIN songs ON artists.id = songs.artist_id INNER JOIN albums ON artists.id = albums.artist_id;
    public function listArtists($db){
        //Get query for sql
        $query = 'SELECT * FROM artists';
        //Prepare and execute the query
        $sql = $db->prepare($query);
        $sql->execute();
        //Put the executed values to a variable
        $artists = $sql->fetchAll(\PDO::FETCH_OBJ);
        //return the values
        return $artists;
    }

    public function addArtist($db,$name){
        //sql query to insert into table
        $query = "INSERT INTO artists (name) VALUES (:name)";

        $sql = $db->prepare($query);

        //bind parameters
        $sql->bindParam(':name',$name);

        $count = $sql->execute();

        //if returned rows more then 1 refresh page
        if($count){
            header("Location: adminArtistlist.php");
        }
        else{
            echo "Problem Adding Song";
        }
    }

    public function updateArtist($db,$name,$artistid){
        //sql query to insert into table
        $query = "UPDATE artists SET name = :name WHERE id = :artist_id";


        $sql = $db->prepare($query);

        //bind parameters
        $sql->bindParam(':name',$name);
        $sql->bindParam(':artist_id',$artistid);

        $count = $sql->execute();

        //if returned rows more then 1 refresh page
        if($count){
            header("Location: adminArtistlist.php");
        }
        else{
            echo "Problem Updating Artist";
        }
    }

    public function deleteArtist($db,$artistid){
        //sql query to insert into table
        $query = "DELETE FROM artists WHERE id = :artist_id";

        $sql = $db->prepare($query);
        //bind parameters
        $sql->bindParam(':artist_id',$artistid);
        $count = $sql->execute();

        //if returned rows more then 1 refresh page
        if($count){
            header("Location: adminArtistlist.php");
        }
        else{
            echo "Problem Deleting";
        }
    }

    public function getArtist($db,$id){
        //Get query for sql
        $query = 'SELECT * FROM artists WHERE id = :id';
        //Prepare and execute the query
        $sql = $db->prepare($query);

        //bind parameters
        $sql->bindParam(':id',$id);
        $sql->execute();
        //Put the executed values to a variable
        $artist = $sql->fetch(\PDO::FETCH_OBJ);
        return $artist;
    }
    public function search($db, $searchkey){
        $query = 'SELECT * FROM artists WHERE artists.name LIKE :searchkey
                    OR artists.name LIKE :searchkey';
        $sql = $db->prepare($query);
        $sql->bindParam(':searchkey', $searchkey);
        $sql->execute();

        $artists = $sql->fetchAll(\PDO::FETCH_OBJ);
        return $artists;
    }

    public function listAdminArtists($db, $searchkey, $page,$dataPerPage, $order=null)
    {
        //Get the Order, if Order is Title, sort it by title
        if($order == 'artist') {
            //Sort by artist name
            $orderby = 'ORDER BY name';
        }
        else{
            //Sort will be empty if its not click
            $orderby = '';
        }
        //Get the search key value of the user
        //If its not empty
        if(!empty($searchkey)){
            $search = 'WHERE name LIKE :searchkey';
        }else{
            //If search key is empty
            $search = '';
        }
        //Get the offset per page, this will the value of index to be started to show
        //Ex: 10 data with 5 per page, 1-5, next will be 6-10
        $offset = ($page-1) * $dataPerPage;
        //QUERY should be SELECT * FROM faqs WHERE question Like %key% ORDER BY title LIMIT (start), data per page
        $query = "SELECT * FROM artists $search  $orderby LIMIT $offset, $dataPerPage";

        $sql = $db->prepare($query);
        $sql->bindParam(':searchkey', $searchkey);
        $sql->execute();

        $artists = $sql->fetchAll(\PDO::FETCH_OBJ);
        //$total_page = count($faqs);
        //var_dump(count($faqs));
        return $artists;
    }
    //Function to determined the count of data in database
    public function getcount($db){
        $query = "SELECT count(*) as count FROM artists";
        $sql = $db->prepare($query);
        $sql->execute();

        $total_count = $sql->fetch(\PDO::FETCH_OBJ);
        return $total_count;
    }

}



