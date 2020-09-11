<?php

class Lyrics{

    public function listLyrics($db){
//        SELECT * FROM `lyrics` join songs on lyrics.id = songs.id
//join artists on songs.artist_id = artists.id
        $query = 'SELECT *,songs.id as sid, concat(left(lyrics.lyric,50),"...") as lyric, lyrics.id as lid FROM lyrics 
                    join songs on lyrics.song_id = songs.id 
                    join artists on songs.artist_id = artists.id';

        $statment = $db->prepare($query);
        $statment->execute();

        $lyrics = $statment->fetchAll(\PDO::FETCH_OBJ);

        return $lyrics;
    }
    public function listOneLyric($id,$db){
        $query = 'SELECT  songs.title as songtitle, artists.name as artistname, lyrics.lyric as lyric, lyrics.pub_date as ddate, albums.cover_path as coverpath, albums.year_published as yyear, songs.id as sid FROM lyrics 
join songs on lyrics.song_id = songs.id 
join artists on songs.artist_id = artists.id 
inner join albums on albums.id = artists.id 
WHERE lyrics.id = :id';

        $statment = $db->prepare($query);
        $statment->bindParam(':id',$id);
        $statment->execute();

        $lyric = $statment->fetchAll(\PDO::FETCH_OBJ);

        return $lyric;
    }
    public function getOneLyric($searchkey,$db){
        $query = 'SELECT  songs.title as songtitle, artists.name as artistname, lyrics.lyric as lyric, lyrics.pub_date as ddate, albums.cover_path as coverpath, albums.year_published as yyear, songs.id as sid FROM lyrics 
join songs on lyrics.song_id = songs.id 
join artists on songs.artist_id = artists.id 
inner join albums on albums.id = artists.id 
WHERE songs.title like :searchkey';

        $statment = $db->prepare($query);
        $statment->bindParam(':searchkey',$searchkey);
        $statment->execute();

        $lyric = $statment->fetchAll(\PDO::FETCH_OBJ);

        return $lyric;
    }
    public function addLyric($songid,$lyric,$date,$db){
        //sql query to insert into table
        $sql = "INSERT INTO lyrics (song_id, lyric, pub_date) VALUES (:id, :lyric, :pub_date)";



        $pst = $db->prepare($sql);

        //bind parameters
        $pst->bindParam(':id',$songid);
        $pst->bindParam(':lyric',$lyric);
        $pst->bindParam(':pub_date',$date);

        $count = $pst->execute();
        //if returned rows more then 1 refresh page
        if($count){
            header("Location: AdminLyric.php");
        }
        else{
            echo "Problem";
        }
    }
    public function deleteLyric($id, $db){
        //sql query to delete from table by id
        $sql = "DELETE FROM lyrics WHERE id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':id',$id);

        $count = $pst->execute();

        //if returned rows more then 1 refresh page
        if($count){
            header("Location: AdminLyric.php");
        }
        else{
            echo "Problem";
        }
    }
    public function updateLyric($id,$date,$lyric,$db){
        //sql query to insert into table
        $sql = "UPDATE lyrics SET lyric = :lyric, pub_date = :pub_date where id = :id ";



        $pst = $db->prepare($sql);

        //bind parameters
        $pst->bindParam(':lyric',$lyric);
        $pst->bindParam(':pub_date',$date);
        $pst->bindParam(':id',$id);


        $count = $pst->execute();

        //if returned rows more then 1 refresh page
        if($count){
            header("Location: AdminLyric.php");
        }
        else{
            echo "Problem";
        }
    }
}
?>