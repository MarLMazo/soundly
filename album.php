<?php
  include 'view/header.php';
  require_once "Models/Database.php";
  require_once "Models/Album.php";
  require_once "Models/Song.php";

  $songIds = array();

// getting the request from the user by clicking on each album on albums.php page
  if(isset($_GET['id'])){
    // store it as a variable
    $albumId =  $_GET['id'];
    // connect to the db
    $db = Database::getDb();
    // initialize an album object
    $album = new Album();
    // initialize an album object
    $song = new Song();
    // get the requested album
    $albumDetail = $album->getAlbumById($albumId,$db);
    // if the user searches using the serahc bar at the top
      if(isset($_POST['submitSearch'])){
        // save the search query in a format to be used in the query
        $searchKey = "%{$_POST['search']}%";
        // trigger relevant data using the function below
        $albumSongs =  $song->search($db, $searchKey);
        // if not, list all of the songs
      }else{
        $albumSongs =  $album->getSongs($albumId, $db);
      }
  }

?>
<!-- no loop because of only one result set -->
  <div class="row mt-5">
    <div class="col">
      <img src="<?= $albumDetail->cover_path; ?>" alt="Cover image" class="img-thumbnail">
      <div class="mt-4">
        <a href="albums.php"><i class="fa fa-chevron-left"></i>&nbsp;Back to Albums</a>
      </div>
    </div>

    <div class="col card">
      <h3 class="card-header"><?= $albumDetail->title ?></h3>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Artist: <p class="text-muted"><?= $albumDetail->artist; ?></p>
          </li>
          <li class="list-group-item">Year Published: <p class="text-muted"><?=$albumDetail->year_published; ?></p>
          </li>
          <li class="list-group-item">Genre: <p class="text-muted"><?= $albumDetail->genre;?></p>
          </li>
        </ul>

      </div>
    </div>
  </div>
<!-- Song list -->
  <div class="my-5">
    <table class="table table-borderless table-hover text-center">

    <?php
    $rowNumber = 1;
    foreach ($albumSongs as $song): ?>
      <tr>
        <!-- iterating through the numbers for the results -->
        <td>
          <?= $rowNumber;?>
        </td>
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
      </tr>
    <?php $rowNumber++; array_push($songIds, $song->id);
      endforeach;
    ?>
    </table>
  </div>
<!-- scripts for the player to work -->
  <script>
      var tempSongIds = '<?php echo json_encode($songIds); ?>';
      var tempPlayList = JSON.parse(tempSongIds);
  </script>

<?php include 'view/footer.php'; ?>
