<?php

class Song
{
// QUERY TO GET ALL
//SELECT * FROM artists INNER JOIN songs ON artists.id = songs.artist_id INNER JOIN albums ON artists.id = albums.artist_id;
    public function listSongs($db){
        //Get query for sql
        $query = 'SELECT songs.*, artists.name FROM songs INNER JOIN artists ON artists.id = songs.artist_id';
        //Prepare and execute the query
        $sql = $db->prepare($query);
        $sql->execute();
        //Put the executed values to a variable
        $songs = $sql->fetchAll(\PDO::FETCH_OBJ);
        //return the values
        return $songs;
    }
    public function addSong($db,$title,$duration,$path,$artist,$album){
        //sql query to insert into table
        $query = "INSERT INTO songs (title, duration, path, artist_id, album_id) VALUES (:title,:duration, :path, :artist_id, :album_id)";

        $sql = $db->prepare($query);

        //bind parameters
        $sql->bindParam(':title',$title);
        $sql->bindParam(':duration',$duration);
        $sql->bindParam(':path',$path);
        $sql->bindParam(':artist_id',$artist);
        $sql->bindParam(':album_id',$album);

        $count = $sql->execute();
        var_dump($count);

        //if returned rows more then 1 refresh page
        if($count){
            header("Location: adminLibrarylist.php");
        }
        else{
            echo "Problem Adding Song";

        }
    }
    public function updateSong($db,$title,$duration,$path,$artist,$album,$songid){
        //sql query to insert into table
        $query = "UPDATE songs SET title = :title, duration = :duration, path =:path, artist_id = :artist_id, album_id = :album_id WHERE id = :song_id";


        $sql = $db->prepare($query);

        //bind parameters
        $sql->bindParam(':title',$title);
        $sql->bindParam(':duration',$duration);
        $sql->bindParam(':path',$path);
        $sql->bindParam(':artist_id',$artist);
        $sql->bindParam(':album_id',$album);
        $sql->bindParam(':song_id',$songid);

        $count = $sql->execute();

        //if returned rows more then 1 refresh page
        if($count){
            header("Location: adminLibrarylist.php");
        }
        else{
            echo "Problem Updating Song";
        }
    }

    public function deleteSong($db,$songid){
        //sql query to insert into table
        $query = "DELETE FROM songs WHERE id = :song_id";

        $sql = $db->prepare($query);
        //bind parameters
        $sql->bindParam(':song_id',$songid);
        $count = $sql->execute();

        //if returned rows more then 1 refresh page
        if($count){
            header("Location: adminLibrarylist.php");
        }
        else{
            echo "Problem Deleting";
        }
    }

    public function getSong($db,$id){
        //Get query for sql
        $query = 'SELECT * FROM songs WHERE id = :id';
        //Prepare and execute the query
        $sql = $db->prepare($query);

        //bind parameters
        $sql->bindParam(':id',$id);
        $sql->execute();
        //Put the executed values to a variable
        $song = $sql->fetch(\PDO::FETCH_OBJ);
        return $song;
    }

    public function getArtist($db,$id){
        $query = "SELECT artists.* FROM artists INNER JOIN songs ON artists.id = songs.artist_id WHERE songs.id = :id";
        $sql = $db->prepare($query);
        $sql->bindParam(':id',$id);
        $sql->execute();
        $artist = $sql->fetch(\PDO::FETCH_OBJ);
        return $artist;
    }

    public function getAlbum($db,$id){
        //sql query to insert into table
        $query = "SELECT albums.* FROM albums INNER JOIN songs ON albums.id = songs.album_id WHERE songs.id = :id";
        $sql = $db->prepare($query);
        //bind parameters
        $sql->bindParam(':id',$id);
        //execute insert
        $sql->execute();
        $album = $sql->fetch(\PDO::FETCH_OBJ);
        return $album;
    }

    public function getAllAlbums($db){
        $query = 'SELECT * FROM albums';
        //Prepare and execute the query
        $sql = $db->prepare($query);
        $sql->execute();
        //Put the executed values to a variable
        $albums = $sql->fetchAll(\PDO::FETCH_OBJ);
        //return the values
        return $albums;
    }

    public function getAllArtists($db){
        $query = 'SELECT * FROM artists';
        //Prepare and execute the query
        $sql = $db->prepare($query);
        $sql->execute();
        //Put the executed values to a variable
        $albums = $sql->fetchAll(\PDO::FETCH_OBJ);
        //return the values
        return $albums;
    }

    public function search($db, $searchkey){
        $query = 'SELECT * FROM songs INNER JOIN artists ON artists.id = songs.artist_id WHERE songs.title LIKE :searchkey
                    OR artists.name LIKE :searchkey';
        $sql = $db->prepare($query);
        $sql->bindParam(':searchkey', $searchkey);
        $sql->execute();

        $songs = $sql->fetchAll(\PDO::FETCH_OBJ);
        return $songs;

    }

    public function listAdminSongs($db, $searchkey, $page,$dataPerPage, $order=null)
    {
        //Get the Order, if Order is Title, sort it by title
        if($order == 'title'){
            $orderby = 'ORDER BY title';
        }
        else if($order == 'artist') {
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
            $search = 'WHERE title LIKE :searchkey';
        }else{
            //If search key is empty
            $search = '';
        }
        //Get the offset per page, this will the value of index to be started to show
        //Ex: 10 data with 5 per page, 1-5, next will be 6-10
        $offset = ($page-1) * $dataPerPage;
        //QUERY should be SELECT * FROM faqs WHERE question Like %key% ORDER BY title LIMIT (start), data per page
        $query = "SELECT songs.*, artists.name FROM songs INNER JOIN artists ON artists.id = songs.artist_id $search  $orderby LIMIT $offset, $dataPerPage";

        $sql = $db->prepare($query);
        $sql->bindParam(':searchkey', $searchkey);
        $sql->execute();

        $songs = $sql->fetchAll(\PDO::FETCH_OBJ);
        //$total_page = count($faqs);
        //var_dump(count($faqs));
        return $songs;
    }
    //Function to determined the count of data in database
    public function getcount($db){
        $query = "SELECT count(*) as count FROM songs";
        $sql = $db->prepare($query);
        $sql->execute();

        $total_count = $sql->fetch(\PDO::FETCH_OBJ);
        return $total_count;
    }

}
