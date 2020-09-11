<?php
    ob_start();
    require_once '../Models/Database.php';
    require_once '../Models/Artist.php';
    require_once 'adminView/header.php';


    //Get the database connection
    $db = Database::getDb();
    $ar = new Artist();
    //Get the id of Get request
    $id = $_GET['id'];
    //get Specific Artist
    $artist = $ar->getArtist($db, $id);

    //User click the button delete
    if(isset($_POST['delArtist'])){
        $del = $ar->deleteArtist($db, $id);
    }



?>
<h1 class="text-danger">Are you sure you want to Delete this?</h1>
<div>
    <dl class="dl-horizontal">
        <dt>Name</dt>
        <dd><?= $artist->name ?></dd>
    </dl>
</div>

<form method="POST" action="">
    <button class="btn btn-danger float-right" type="submit" name="delArtist">Delete</button>
</form>
<div class="mt-4">
    <a href="adminArtistlist.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to List</a>
</div>

<?php

?>
