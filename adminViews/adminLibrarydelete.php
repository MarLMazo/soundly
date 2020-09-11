<?php
    ob_start();
    require_once '../Models/Database.php';
    require_once '../Models/Song.php';
    require_once 'adminView/header.php';

    //Get Database connection
    $db = Database::getDb();
    $sg = new Song();
    //Get Query String Get request
    $id = $_GET['id'];
    //Get specific song, artist, album
    $song = $sg->getSong($db, $id);
    $artist = $sg->getArtist($db, $id);
    $album = $sg->getAlbum($db, $id);

    //User click delete Button
    if(isset($_POST['delSong'])){
        $del = $sg->deleteSong($db,$id);
    }

?>
    <h1 class="text-danger">Are you sure you want to Delete this?</h1>
    <div>
        <dl class="dl-horizontal">
            <dt>Title</dt>
            <dd><?= $song->title; ?></dd>
            <dt> Path</dt>
            <dd><?= $song->path; ?></dd>
            <dt> Duration</dt>
            <dd><?= $song->duration; ?></dd>
            <dt> Artist</dt>
            <dd><?= $artist->name; ?></dd>
            <dt> Album</dt>
            <dd><?= $album->title; ?></dd>

        </dl>
    </div>

    <form method="POST" action="">

        <button class="btn btn-danger float-right" type="submit" name="delSong">Delete</button>
    </form>
    <div class="mt-4">
        <a href="adminLibrarylist.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to List</a>
    </div>
    <?php

    ?>