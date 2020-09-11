<?php include 'view/header.php'; ?>
<?php

    require_once "Models/Database.php";
    require_once "Models/Playlist.php";
    //connect to the db
    $dbconn = Database::getDb();
    // initialize the object
    $playlist = new Playlist();

    if(isset($_POST['submitSearch'])){
      // save the search query in a format to be used in the query
      $searchKey = "%{$_POST['search']}%";
      // trigger relevant data using the function below
      $playlists =  $playlist->searchPlaylists($searchKey, $dbconn);
      // if not, list all of the albums
    }else{
      $playlists =  $playlist->listPlaylists($dbconn);
    }
 ?>
        <h1><small>My</small> Playlists</h1>

        <div class="py-5">
          <button class="btn btn-success rounded-btn" type="button" name="button" onclick="location.href='addPlaylist.php'">+ New Playlist</button>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mx-auto my-0">
          <?php foreach ($playlists as $playlist): ?>

          <div class="col mb-4">
              <div class="card card-cover shadow-lg ">
                <a href="playlist.php?id=<?= $playlist->id; ?>">
                  <img src="images/covers/playlist_holder.jpg" class="card-img-top px-5 py-5" alt="Playlist image">
                </a>
                <div class="card-body">
                    <h5 class="card-title"><?= $playlist->name; ?></h5>
                    <p class="card-text text-muted"><?= $playlist->date_created; ?></p>
                    <div class="my-3">
                      <a href="updatePlaylist.php?id=<?= $playlist->id; ?>">Edit</a>
                    </div>
                  <a class=" my-3" href="deletePlaylist.php?id=<?= $playlist->id; ?>">Delete</a>
                </div>
              </div>
          </div>
    <?php endforeach; ?>
  </div>




<?php include 'view/footer.php'; ?>
