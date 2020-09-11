<?php
    require_once '../Models/Database.php';
    require_once '../Models/Artist.php';
    require_once 'adminView/header.php';

    //Get database connection
    $db = Database::getDb();
    $ar = new Artist();

    //get Id in get request query
    $id = $_GET['id'];
    //get specific artist
    $artist = $ar->getArtist($db, $id);

    ?>

    <h1>View Artist</h1>
    <div>
        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd><?= $artist->name; ?></dd>
        </dl>
    </div>
    <div class="mt-4">
        <a href="adminArtistlist.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to List</a>
    </div>
