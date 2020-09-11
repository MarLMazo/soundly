<?php
  include 'view/header.php';
  require_once "Models/Database.php";
  require_once "Models/Playlist.php";
  require_once "Models/Song.php";

  $songIds = array();

  if(isset($_GET['id'])){
    $_SESSION["playlistId"] = $_GET['id'];
    // connect to the db
    $db = Database::getDb();
    $pl = new Playlist();
    $song = new Song();
    //get the selected playlist
    $playlist = $pl->getPlaylist($_SESSION["playlistId"], $db);
    // if the user searches using the serahc bar at the top
      if(isset($_POST['submitSearch'])){
        // save the search query in a format to be used in the query
        $searchKey = "%{$_POST['search']}%";
        // trigger relevant data using the function below
        $playlistSongs =  $song->search($db, $searchKey);
        // if not, list all of the songs
      }else{
        $playlistSongs =  $pl->getSongs($_SESSION["playlistId"], $db);
      }
  }





?>
<h1><?= $playlist->name; ?></h1>
<div class="mt-4">
  <a href="playlists.php"><i class="fa fa-chevron-left"></i>&nbsp;Back to Playlists</a>
</div>
<!-- Song list -->
  <div class="my-5">
    <table class="table table-borderless table-hover text-center">

    <?php
    $rowNumber = 1;
    foreach ($playlistSongs as $song): ?>
      <tr>
        <!-- iterating through the numbers for the results -->
        <th>
          <?= $rowNumber;?>
        </th>
          <!-- PLAY BUTTON TO PLAY THE SONG -->
          <td>
            <button class="btn btn-link" onclick="setTrack('.$song->id.',tempPlayList,true);">
              <i class="fa fa-play-circle fa-3x"></i>
            </button>
          </td>
          <!-- Song Title -->
          <td class='text-center'>
             <?= $song->title; ?>
          </td>
          <!-- Song Duration -->
          <td>
            <?= $song->duration; ?>
          </td>
          <td>
              <a class="btn rounded-btn btn-primary" href="deletePlaylistSong.php?id=<?= $song->id ?>">Remove</a>
          </td>
      </tr>
    <?php $rowNumber++; array_push($songIds, $song->id);
      endforeach;
    ?>
    </table>
  </div>
  <div class="mt-4">
    <a class="btn btn-default rounded-btn" href="songs.php">Add Songs</a>
  </div>

  <!-- scripts for the player to work -->
    <script>
        var tempSongIds = '<?php echo json_encode($songIds); ?>';
        var tempPlayList = JSON.parse(tempSongIds);
    </script>

<?php include 'view/footer.php'; ?>
