<?php ob_start(); ?>
<?php include 'view/header.php'; ?>
<?php
    require_once 'Models/Database.php';
    require_once 'Models/Playlist.php';

    //Get the database connection
    $dbconn = Database::getDb();
    $pl = new Playlist();
    //Get the id of Get request
    $id = $_GET['id'];
    //get Specific Album
    $playlist = $pl->getPlaylist($id, $dbconn);

    //User click the button delete
    if(isset($_POST['delete'])){
        $pl->deletePlaylist($id, $dbconn);
        header('Location: playlists.php');
    }

?>
<h1 class="text-danger">Are you sure you want to Delete this playlist?</h1>
<div class="row mt-5">
  <div class="col card">
    <h3 class="card-header"><?= $playlist->name; ?></h3>
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Date Created: <p class="text-muted"><?= $playlist->date_created; ?></p>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="my-5">

  <form method="POST" action="">
    <button class="btn rounded-btn btn-danger float-right" type="submit" name="delete">Delete</button>
  </form>
</div>
<div class="mt-4">
    <a href="playlists.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to Playlists</a>
</div>

<?php

?>
