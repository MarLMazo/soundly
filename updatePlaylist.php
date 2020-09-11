<?php ob_start(); ?>
<?php include 'view/header.php'; ?>
<?php
require_once "Models/Database.php";
require_once "Models/Playlist.php";

if(isset($_GET['id'])){

    $playlistId = $_GET['id'];
    // connect to the db
    $db = Database::getDb();
    // initialize the playlist
    $pl = new Playlist();
    $plList = $pl->getPlaylist($playlistId, $db);
}





if(isset($_POST['submit'])){
  //connect to the db
  $dbconn = Database::getDb();
  // initialize the object
  $playlist = new Playlist();

  $id = $_GET['id'];

  $name = $_POST['title'];
  $date_created = date('Y-m-d');

  $playlist->updatePlaylist($id, $name, $date_created, $dbconn);

  header('Location: playlists.php');

}
 ?>
 <h1 class="mb-5">Update <small>Playlist</small></h1>
 <div class="form-group w-50">

   <form action="" method="post">
     <label for="title">Playlist Name:</label>
     <input class="form-control mt-3" type="text" name="title" id="title" value="<?= $plList->name; ?>">
     <button class="btn btn-default rounded-btn my-5" type="submit" name="submit">Save</button>
   </form>
   <div class="mt-4">
     <a href="playlists.php"><i class="fa fa-chevron-left"></i>&nbsp;Back to Playlists</a>
   </div>

 </div>


<?php include 'view/footer.php'; ?>
