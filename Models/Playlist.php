<?php
class Playlist {
  public function listPlaylists($db){
    $sql = "SELECT * FROM playlists";
    $pdostm = $db->prepare($sql);
    // execute the query
    $pdostm->execute();
    //result set
    $playlists = $pdostm->fetchAll(\PDO::FETCH_OBJ);
    // trigger the result set
    return $playlists;
  }

  public function searchPlaylists($searchkey, $db){
    // write the query to match the searchkey with the data on the db
    $sql = "SELECT * FROM playlists WHERE name LIKE :searchkey OR date_created LIKE :searchkey";

    $pdostm = $db->prepare($sql);
    $pdostm->bindParam(':searchkey', $searchkey);
    $pdostm->execute();
    // fetching all of the result set (not one)
    $playlists = $pdostm->fetchAll(\PDO::FETCH_OBJ);
    return $playlists;
  }

  public function addPlaylist($name, $date_created, $db){
      //sql query to insert into table
      $sql = "INSERT INTO playlists (name, date_created) VALUES (:name, :date_created)";

      $pdostm = $db->prepare($sql);

      //bind parameters
      $pdostm->bindParam(':name',$name);
      $pdostm->bindParam(':date_created',$date_created);

      $count = $pdostm->execute();

    }


    public function deletePlaylist($id, $db){
        //sql query to insert into table
        $sql = "DELETE FROM playlists WHERE id = :id";

        $sql = $db->prepare($sql);
        //bind parameters
        $sql->bindParam(':id',$id);
        $count = $sql->execute();
    }

    public function getPlaylist($id, $db){
        //Get query for sql
        $sql = 'SELECT * FROM playlists WHERE id = :id';
        //Prepare and execute the query
        $pdostm = $db->prepare($sql);

        //bind parameters
        $pdostm->bindParam(':id',$id);
        $pdostm->execute();
        //Put the executed values to a variable
        $playlist = $pdostm->fetch(\PDO::FETCH_OBJ);
        return $playlist;
    }
    public function updatePlaylist($id, $name, $date_created, $db)
    {
      $sql = 'UPDATE playlists SET name = :name, date_created = :date_created WHERE id = :id';

      $pdostm = $db->prepare($sql);

      //bind parameters
      $pdostm->bindParam(':id',$id);
      $pdostm->bindParam(':name', $name);
      $pdostm->bindParam(':date_created', $date_created);

      $count = $pdostm->execute();
      return $count;
    }

    // songs of the playlist
    public function getSongs($id, $db){
      $sql = 'SELECT * FROM songs WHERE playlist_id = :id';
      $pdostm = $db->prepare($sql);
      $pdostm->bindParam(':id', $id);
      $pdostm->execute();
      return $pdostm->fetchAll(\PDO::FETCH_OBJ);
    }

    public function deleteSong($id, $db){
      $sql = "UPDATE songs SET playlist_id = NULL WHERE id =:id";
      $pdostm = $db->prepare($sql);

      //bind parameters
      $pdostm->bindParam(':id',$id);

      $count = $pdostm->execute();
      return $count;
    }
    public function addSong($id, $playlist_id, $db){
      $sql = "UPDATE songs SET playlist_id = :playlist_id WHERE id =:id";
      $pdostm = $db->prepare($sql);

      //bind parameters
      $pdostm->bindParam(':id',$id);
      $pdostm->bindParam(':playlist_id',$playlist_id);

      $count = $pdostm->execute();
      return $count;

    }

}
?>
