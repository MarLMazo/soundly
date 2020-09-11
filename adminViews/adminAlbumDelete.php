<?php ob_start(); ?>
<?php include 'adminView/header.php'; ?>
<?php
    require_once '../Models/Database.php';
    require_once '../Models/Album.php';


    //Get the database connection
    $dbconn = Database::getDb();
    $al = new Album();
    //Get the id of Get request
    $id = $_GET['id'];
    //get Specific Album
    $album = $al->getAlbumById($id, $dbconn);

    //User click the button delete
    if(isset($_POST['delete'])){
        $al->deleteAlbum($id, $dbconn);
        header('Location: adminAlbumList.php');
    }



?>
<h1 class="text-danger">Are you sure you want to Delete this album?</h1>
<div class="row mt-5">
  <div class="col">
    <img src="../<?= $album->cover_path; ?>" alt="Cover image" class="img-thumbnail">
  </div>

  <div class="col card">
    <h3 class="card-header"><?= $album->title ?></h3>
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Artist: <p class="text-muted"><?= $album->artist; ?></p>
        </li>
        <li class="list-group-item">Year Published: <p class="text-muted"><?=$album->year_published; ?></p>
        </li>
        <li class="list-group-item">Genre: <p class="text-muted"><?= $album->genre;?></p>
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
    <a href="adminAlbumList.php"><span class="fa fa-chevron-left"></span>&nbsp;Back to Albums</a>
</div>

<?php

?>
