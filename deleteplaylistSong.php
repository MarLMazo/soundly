<?php ob_start(); ?>
<?php include 'view/header.php'; ?>
<?php
    require_once 'Models/Database.php';
    require_once 'Models/Playlist.php';
    require_once 'Models/Song.php';

    //Get the database connection
    $db = Database::getDb();
    $so = new Song();
    $pl = new Playlist();
    //Get the id of Get request
    $songId = $_GET['id'];

    $song = $so->getSong($db, $songId);

    $playlistId = $song->playlist_id;

    //User click the button delete
    if(isset($_POST['delete'])){
      $pl->deleteSong($songId, $db);
      header('Location: playlist.php?id='.$playlistId.'');
    }

?>
<h1 class="text-danger">Are you sure you want to Remove this Song from the playlist?</h1>
<div class="row mt-5">
  <div class="col-6 card offset-3">
    <h3 class="card-header"><?= $song->title; ?></h3>
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <form method="POST" action="">
            <button class="btn rounded-btn btn-danger float-right" type="submit" name="delete">Remove</button>
          </form>
            <a class="btn rounded-btn btn-outline-success float-left" href="playlist.php?id=<?= $playlistId ?>">Cancel</a>
        </li>
      </ul>
    </div>
  </div>
</div>


<?php

?>
