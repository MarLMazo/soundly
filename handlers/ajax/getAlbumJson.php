<?php
include '../../Models/Database.php';
include '../../Models/Song.php';


if(isset($_POST['songId'])) {
    $id = $_POST['songId'];
    $db=Database::getDb();
    $ms = new Song();
    //var_dump(json_encode($ms->listMusic($db)));
    $album = $ms->getAlbum($db,$id);
    //json_encode($songs);
    echo json_encode($album);
    //var_dump($lstsongs);
}

?>