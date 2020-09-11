<?php

// define a class of album to be used as an object
class Album{
  // function to get all the albums
  public function getAlbums($db){
    // the query to collect information from the db
      $sql = "SELECT artists.name AS artist,genres.name AS genre, albums.title, albums.year_published, albums.cover_path, albums.id
              FROM albums
              INNER JOIN artists ON artists.id=albums.artist
              INNER JOIN genres ON genres.id=albums.genre";
      // pdo statement and prepare the sql
      $pdostm = $db->prepare($sql);
      // execute the query
      $pdostm->execute();
      // result set of all albums (fetch all of the albums)
      $albums = $pdostm->fetchAll(\PDO::FETCH_OBJ);
      // trigger the result set
      return $albums;
  }
// function to get an album by its id
  public function getAlbumById($id, $db){
    // using join to get data from other tables as foreign keys
      $sql = "SELECT artists.name AS artist, genres.name AS genre, albums.title, albums.year_published, albums.cover_path
              FROM albums
              INNER JOIN artists ON artists.id=albums.artist
              INNER JOIN genres ON genres.id=albums.genre
              WHERE albums.id = :albumId";
      // pdo statement and prepare the query
      $pdostm = $db->prepare($sql);
      // bind the parameter id
      $pdostm->bindParam(':albumId', $id);
      $pdostm->execute();
      // fetech only one result with the corresponding id
      return $pdostm->fetch(\PDO::FETCH_OBJ);
  }
  // function to get songs of the album
  public function getSongs($id,$db){
    $sql = "SELECT * FROM songs WHERE album_id = :id";
    $pdostm = $db->prepare($sql);
    $pdostm->bindParam(':id', $id);
    $pdostm->execute();
    return $pdostm->fetchAll(\PDO::FETCH_OBJ);
  }

  // function to search through albums
  public function searchAlbums($searchkey, $db){
    // write the query to match the searchkey with the data on the db
    $sql = "SELECT artists.name AS artist, genres.name AS genre,
    albums.title, albums.cover_path, albums.id, albums.year_published
    FROM albums
    INNER JOIN artists
    ON artists.id = albums.artist
    INNER JOIN genres
    ON genres.id = albums.genre
    WHERE title LIKE :searchkey OR artists.name LIKE :searchkey OR genres.name LIKE :searchkey OR year_published LIKE :searchkey";
    $pdostm = $db->prepare($sql);
    $pdostm->bindParam(':searchkey', $searchkey);
    $pdostm->execute();
    // fetching all of the result set (not one)
    $albums = $pdostm->fetchAll(\PDO::FETCH_OBJ);
    return $albums;
  }

  // function to add a new album
    public function addAlbum($title, $artist, $genre, $cover_path, $year_published, $db)
    {

        $sqlAlbum = "INSERT INTO albums(title, artist, genre, cover_path, year_published)
        VALUES (:title, :artist, :genre, :cover_path, :year_published)";
        $pdostm = $db->prepare($sqlAlbum);
        $pdostm->bindParam(':title', $title);
        $pdostm->bindParam(':artist', $artist);
        $pdostm->bindParam(':genre', $genre);
        $pdostm->bindParam(':cover_path', $cover_path);
        $pdostm->bindParam(':year_published', $year_published);
        $pdostm->execute();

    }
    public function updateAlbum($id, $title, $artist, $genre, $cover_path, $year_published, $db)
    {
      $sql = "UPDATE albums SET title = :title, artist = :artist, genre = :genre, cover_path = :cover_path, year_published = :year_published WHERE id = :id";

      $pdostm = $db->prepare($sql);

      //bind parameters
      $pdostm->bindParam(':id',$id);
      $pdostm->bindParam(':title', $title);
      $pdostm->bindParam(':artist', $artist);
      $pdostm->bindParam(':genre', $genre);
      $pdostm->bindParam(':year_published', $year_published);
      $pdostm->bindParam(':cover_path', $cover_path);
      return $pdostm->execute();
    }

    public function deleteAlbum($id, $db){
        //sql query to insert into table
        $sql = "DELETE FROM albums WHERE id = :id";

        $sql = $db->prepare($sql);
        //bind parameters
        $sql->bindParam(':id',$id);
        $count = $sql->execute();
    }
    // with the foregin key numbers
    public function getAlbum($id, $db){
        //Get query for sql
        $query = 'SELECT * FROM albums WHERE id = :id';
        //Prepare and execute the query
        $sql = $db->prepare($query);

        //bind parameters
        $sql->bindParam(':id',$id);
        $sql->execute();
        //Put the executed values to a variable
        $artist = $sql->fetch(\PDO::FETCH_OBJ);
        return $artist;
    }
  }
