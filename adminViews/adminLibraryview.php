<?php
    require_once '../Models/Database.php';
    require_once '../Models/Song.php';
    require_once 'adminView/header.php';

    //Get Database connection
    $db = Database::getDb();
    $sg = new Song();
    //Get query String
    $id = $_GET['id'];
    //Get specific song, artist, album
    $song = $sg->getSong($db, $id);
    $artist = $sg->getArtist($db, $id);
    $album = $sg->getAlbum($db, $id);

?>

    <h1>View Song</h1>
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
    <div class="mt-4">
        <a href="adminLibrarylist.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to List</a>
    </div>
    <?php

    ?>