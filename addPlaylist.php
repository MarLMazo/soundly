<?php ob_start(); ?>
<?php include 'view/header.php'; ?>
<?php
require_once "Models/Database.php";
require_once "Models/Playlist.php";

//connect to the db
$dbconn = Database::getDb();
// initialize the object
$playlist = new Playlist();

if(isset($_POST['submit'])){

  $name = $_POST['title'];
  $date_created = date('Y-m-d');

  $playlist->addPlaylist($name, $date_created, $dbconn);

  header('Location: playlists.php');

}
 ?>

 <h1 class="mb-5">New <small>Playlist</small></h1>
 <div class="form-group w-50">

   <form action="" method="post">
     <label for="title">Playlist Name:</label>
     <input class="form-control mt-3" type="text" name="title" id="title">
     <button class="btn btn-default rounded-btn my-5" type="submit" name="submit">Create</button>
   </form>
   <div class="mt-4">
     <a href="playlists.php"><i class="fa fa-chevron-left"></i>&nbsp;Back to Playlists</a>
   </div>

 </div>


<?php include 'view/footer.php'; ?>
